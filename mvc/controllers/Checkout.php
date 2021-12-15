<?php

use Core\Address;
use Core\Helper;
use Core\HandleForm;

class Checkout extends Controller
{
  public $CartModel;
  public $User;
  public $Orders;
  public $Coupon;
  public $Transport;

  function __construct()
  {
    $this->CartModel = $this->model("CartModel");
    $this->User = $this->model("UserModel");
    $this->Orders = $this->model("OrderModel");
    $this->Coupon = $this->model("CouponModel");
    $this->Transport = $this->model("TransportModel");
  }
  function SayHi()
  {
    $errors = array();
    // unset($_SESSION['cart']);
    $listCart = $_SESSION['cart']['item'];
    if (!isset($_SESSION['user'])) {
      $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $_SESSION['errors'] = ["status" => "ERROR", "message" => "Vui lòng đăng nhập để tiếp tục thanh toán"];
      header("Location: " . SITE_URL . "/login&refurl=" . base64_encode($actual_link));
      exit();
    }
    if (isset($_SESSION['user'])) {
      $UserById = $this->User->GetUserById($_SESSION['user']['username']);
    }
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_order)) {
      $subtotal = 0;
      foreach ($listCart as $values) {
        $subtotal +=  $values['quantity'] *  $values['price'];
      }
      $errors = HandleForm::validations([
        [$request->fullName, 'required', 'Vui lòng nhập họ và tên'],
        [$request->mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$request->address, 'required', 'Vui lòng nhập địa chỉ'],
      ]);
      if (isset($_SESSION['cart']['coupon']) && count($_SESSION['cart']['coupon']) > 0) {
        $coupon = $this->Coupon->GetCoupon('id = ' . (int)$_SESSION['cart']['coupon']['id']);
        if ($coupon['usages'] >= $coupon['usageLimit'] && $coupon['usageLimit'] > 0) {
          $errors[] = ["status" => "ERROR", "message" => "Coupon đã hết lượt sử dụng"];
          unset($_SESSION['cart']['coupon']);
        }
        if (strtotime($coupon['expiryDate']) < strtotime('now') && $coupon['expiryDate'] !=  NULL) {
          $errors[] = ["status" => "ERROR", "message" => "Coupon giá hết hạn"];
          unset($_SESSION['cart']['coupon']);
        }
        if (strtotime($coupon['startDate']) > strtotime('now') && $coupon['startDate'] !=  NULL) {
          $errors[] = ["status" => "ERROR", "message" => "Coupon chưa đến ngày áp dụng"];
          unset($_SESSION['cart']['coupon']);
        }
      }
      $shipping = $_SESSION['cart']['shipment']['fee'];
      $discount = 0;
      if (isset($coupon['type'])) {
        $discount = $coupon['type'] == 0 ?  $coupon['discount'] / 100 * $subtotal : $coupon['discount'];
      }
      $total = $subtotal - $discount + $shipping;
      $fullName =  HandleForm::rip_tags($request->fullName);
      $mobile =  HandleForm::rip_tags($request->mobile);
      $email =  HandleForm::rip_tags($request->email);
      $transaction =  HandleForm::rip_tags($request->transaction);
      $content =  HandleForm::rip_tags($request->comments);
      $bankcode  =  HandleForm::rip_tags($request->bankcode);
      $data = array(
        "userId" => (int)$UserById["id"],
        "idCoupon" => isset($coupon['id']) ? (int)$coupon['id'] : NULL,
        "fullName" => $fullName,
        "mobile" => $mobile,
        "email" => $email,
        "transaction" => $transaction,
        "shipping" => $shipping,
        "content" => $content,
        "subTotal" => $subtotal,
        "discount" => $discount,
        "total" => $total < 0 ? 0 : $total,
      );
      if (count($errors) == 0) {
        $this->Orders->InsertOrder($data);
        $orderId  = $this->Orders->lastInsertId();
        $dataTransport = array(
          "orderId"  => $orderId,
          "method" => HandleForm::rip_tags($request->shipping),
          "address" => HandleForm::rip_tags($request->address),
          "ward" => HandleForm::rip_tags($request->ward),
          "district" => HandleForm::rip_tags($request->district),
          "province" => HandleForm::rip_tags($request->province)
        );
        $this->Transport->insertTransport($dataTransport);
        $this->Coupon->UpdateCoupon(['usages' => $coupon['usages'] + 1], 'id = ' . (int)$coupon['id']);
        foreach ($listCart as $values) {
          $item = array(
            "orderId" => $orderId,
            "productId" => $values['id'],
            "price" => $values['price'],
            "quantity" => $values['quantity'],
          );
          $this->Orders->InsertOrderItem($item);
        }
        setcookie("orderId", base64_encode($orderId), time() + (5 * 60), "/");
        $data["orderId"] = $orderId;
        $data["date"] = date("d/m/Y");
        $data["Page"] = $listCart;
        $data['transaction'] = Helper::PaymentMethods($data['transaction']);
        Helper::sendTelegram([
          'orderId' => $orderId,
          'total' => $total,
          'fullName' => $fullName,
          'mobile' => $mobile,
          'address' => $dataTransport['address'] . ', ' . $dataTransport['ward'] . ', ' . $dataTransport['district'] . ', ' . $dataTransport['province'],
        ]);
        ob_start();
        $this->view("pages/cc", $data);
        $body = ob_get_clean();
        $data = array(
          "Subject" => "Cảm ơn bạn đã đặt hàng tại AUTEUR",
          "Page" => $body,
          "Email" => $email,
          "FullName" => $fullName,
        );
        Helper::sendMail($data);
        unset($_SESSION['cart']);
        unset($_SESSION['shipment']);
        if ($transaction == "bacs" || $transaction == "credit") {
          $data = array("status" => 2);
          $this->Orders->UpdateOrderBy($data, 'id = ' . (int)$orderId);
          $VNpayData = Helper::VNpayCreatePayment($orderId, $total, $bankcode);
          $VNpayData = json_decode($VNpayData,  true);
          header("Location: " . $VNpayData["data"]);
          exit();
        } else {
          header("Location: " . SITE_URL . "/checkout/OrderReceived/" . $orderId);
          exit();
        }
      }
    }
    $this->view("page-full", [
      "Page" => "checkout",
      "Title" => "Thanh toán",
      "UserById" => $UserById,
      "Errors" => $errors,
      "Province" => Address::Province(),
      "District" => isset($UserById['province']) ? Address::District($UserById['province']) : [],
      "Ward" => isset($UserById['district']) ? Address::Ward($UserById['district']) : [],
    ]);
  }
  function OrderReceived($id = 0)
  {
    $order = $this->Orders->GetOrderById($id);
    if (isset($_COOKIE["orderId"]) && base64_encode($id) == $_COOKIE["orderId"] && $order != NULL) {
      if ($order['transaction'] == "bacs" || $order['transaction'] == "credit") {
        $returnData = json_decode(Helper::cc($order), true);
        if ($returnData['RspCode'] == "00") {
          $data = array("status" => 3);
          $cond = "id = '$id'";
          $this->Orders->UpdateOrderBy($data, $cond);
          $order['status'] = 3;
        }
      }
      $status = $this->Orders->GetOrderStatus("id= " . $order['status']);
      $order['status'] = $status[0]["status"];
      $order['transaction'] = Helper::PaymentMethods($order['transaction']);
      if (isset($order['idCoupon'])) {
        $coupon = $this->Coupon->GetCoupon('id = ' . (int)$order['idCoupon']);
        $order["coupon"] = $coupon['code'];
      }
      $this->view("page-full", [
        "Page" => "order-received",
        "Title" => "Chi tiết đơn hàng",
        "Order" => $order,
        "Items" => $this->Orders->GetOrderItemById($id),
        "Transport" => $this->Transport->GetId($id),
      ]);
    } else {
      header("Location: " . SITE_URL);
    }
  }
}
