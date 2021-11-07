<?php

use Core\Helper;

class Order extends Controller
{
  public $Orders;
  function __construct()
  {
    $this->Orders = $this->model("OrderModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
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

    $this->view("admin/page-full", [
      "Page" => "view-order",
      "Title" => "Chi tiết đơn hàng",
      "Order" => $order,
      "Items" => $this->Orders->GetOrderItemById($id),
    ]);
  }
  function Delete()
  {
  }
}
