<?php

use Core\Helper;
use Core\HandleForm;

class Checkout extends Controller
{
  public $CartModel;
  public $User;
  public $Order;

  function __construct()
  {
    $this->CartModel = $this->model("CartModel");
    $this->User = $this->model("UserModel");
    $this->Order = $this->model("OrderModel");
  }
  function SayHi()
  {
    $errors = array();
    if (!isset($_SESSION['user']) && count($_SESSION['cart']) > 0) {
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
      foreach ($_SESSION['cart'] as $values) {
        $subtotal +=  $values['quantity'] *  $values['price'];
      }
      $errors = HandleForm::validations([
        [$request->fullName, 'required', 'Vui lòng nhập họ và tên'],
        [$request->mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$request->address, 'required', 'Vui lòng nhập địa chỉ'],
      ]);
      $fullName =  HandleForm::rip_tags($request->fullName);
      $mobile =  HandleForm::rip_tags($request->mobile);
      $email =  HandleForm::rip_tags($request->email);
      $address =  HandleForm::rip_tags($request->address);
      $transaction =  HandleForm::rip_tags($request->transaction);
      $content =  HandleForm::rip_tags($request->comments);
      $bankcode  =  HandleForm::rip_tags($request->bankcode);
      $data = array(
        "fullName" => $fullName,
        "mobile" => $mobile,
        "email" => $email,
        "address" => $address,
        "transaction" => $transaction,
        "content" => $content,
        "subTotal" => (float)$subtotal,
        "total" => (float)$subtotal,
      );
      if (isset($_SESSION['user'])) {
        $data["userId"] = $UserById["id"];
      }
      if (count($errors) == 0) {
        $this->Order->InsertOrder($data);
        $orderId  = $this->Order->lastInsertId();
        foreach ($_SESSION['cart'] as $values) {
          $item = array(
            "orderId" => $orderId,
            "productId" => $values['id'],
            "price" => $values['price'],
            "quantity" => $values['quantity'],
          );
          $this->Order->InsertOrderItem($item);
        }
        setcookie("orderId", base64_encode($orderId), time() + (5 * 60), "/");
        $data["orderId"] = $orderId;
        $data["date"] = date("d/m/Y");
        $data["Page"] = $_SESSION['cart'];
        $data['transaction'] = Helper::PaymentMethods($data['transaction']);
        Helper::sendTelegram($data);
        ob_start();
        $this->view("pages/cc", $data);
        $body = ob_get_clean();
        $data = array(
          "Subject" => "Cảm ơn bạn đã đặt hàng tại Foodo",
          "Page" => $body,
          "Email" => $email,
          "FullName" => $fullName,
        );
        Helper::sendMail($data);
        unset($_SESSION['cart']);
        if ($transaction == "bacs" || $transaction == "credit") {
          $data = array("status" => 2);
          $cond = "id = '$orderId'";
          $this->Order->UpdateOrderBy($data, $cond);
          $VNpayData = Helper::VNpayCreatePayment($orderId, $subtotal, $bankcode);
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
    ]);
  }
  function OrderReceived($id = 0)
  {
    $order = $this->Order->GetOrderById($id);
    if (isset($_COOKIE["orderId"]) && base64_encode($id) == $_COOKIE["orderId"] && $order != NULL) {
      if ($order['transaction'] == "bacs" || $order['transaction'] == "credit") {
        $returnData = json_decode(Helper::cc($order), true);
        if ($returnData['RspCode'] == "00") {
          $data = array("status" => 3);
          $cond = "id = '$id'";
          $this->Order->UpdateOrderBy($data, $cond);
          $order['status'] = 3;
        }
      }
      $status = $this->Order->GetOrderStatus("id= " . $order['status']);
      $order['status'] = $status[0]["status"];
      $order['transaction'] = Helper::PaymentMethods($order['transaction']);
      $this->view("page-full", [
        "Page" => "order-received",
        "Title" => "Chi tiết đơn hàng",
        "Order" => $order,
        "Items" => $this->Order->GetOrderItemById($id),
      ]);
    } else {
      header("Location: " . SITE_URL);
    }
  }
}