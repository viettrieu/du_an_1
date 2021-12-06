<?php

use Core\Helper;

class Order extends Controller
{
  public $Orders;
  public $Coupon;
  public $Transport;
  function __construct()
  {
    $this->Orders = $this->model("OrderModel");
    $this->Coupon = $this->model("CouponModel");
    $this->Transport = $this->model("TransportModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    if(isset($_POST) && isset($_POST['print'])){
      $id = $_POST['pdfId'];
      header("location: " . SITE_URL .'/pdf/' . $id);
      exit();
    }
    $this->view("admin/page-full", [
      "Page" => "order",
      "Title" => "Đơn hàng",
      "Status" => $this->Orders->GetOrderStatus(),
      "ListOrder" => $this->Orders->GetAllOrder(),
    ]);
  }
  public function StatusChange()
  {
    $data = array(
      "status" => (int)$_POST["idStatus"]
    );
    $cond = "id = " . (int)$_POST["idOrder"];
    $result = $this->Orders->UpdateOrderBy($data, $cond);
    echo json_encode($result);
    exit();
  }
  public function ViewOrder($id = 0)
  {
    
    $order = $this->Orders->GetOrderById($id);
    if ($order == NULL) {
      header("Location: " . ADMIN_URL . "/order");
      exit();
    }
    $status = $this->Orders->GetOrderStatus("id= " . $order['status']);
    $order['status'] = $status[0]["status"];
    $order['transaction'] = Helper::PaymentMethods($order['transaction']);
    if (isset($order['idCoupon'])) {
      $coupon = $this->Coupon->GetCoupon('id = ' . (int)$order['idCoupon']);
      $order["coupon"] = $coupon['code'];
    }
    $this->view("admin/page-full", [
      "Page" => "view-order",
      "Title" => "Chi tiết đơn hàng",
      "Order" => $order,
      "Items" => $this->Orders->GetOrderItemById($id),
      "Transport" => $this->Transport->GetId($id),
    ]);
  }
  public function OrderQuickView($id = 0)
  {
    $order = $this->Orders->GetOrderById($id);
    if ($order == NULL) {
      echo 'Không tìm thấy đơn hàng';
      exit();
    }
    $status = $this->Orders->GetOrderStatus("id= " . $order['status']);
    $order['status'] = $status[0]["status"];
    $order['transaction'] = Helper::PaymentMethods($order['transaction']);
    if (isset($order['idCoupon'])) {
      $coupon = $this->Coupon->GetCoupon('id = ' . (int)$order['idCoupon']);
      $order["coupon"] = $coupon['code'];
    }
    $this->view("admin/pages/order-quick-view", [
      "Title" => "Chi tiết đơn hàng",
      "Order" => $order,
      "Items" => $this->Orders->GetOrderItemById($id),
      "Transport" => $this->Transport->GetId($id),
    ]);
  }
}