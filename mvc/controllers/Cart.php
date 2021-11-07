<?php
class Cart extends Controller
{
  public $CartModel;
  function __construct()
  {
    $this->CartModel = $this->model("CartModel");
  }
  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "cart",
      "Title" => "Giỏ hàng",
    ]);
  }
  function addTheCarts()
  {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $cc = $this->CartModel->addTheCart($productId, $quantity);
    echo json_encode($cc);
    return false;
  }
  function removeTheCart()
  {
    $productId = $_POST['productId'];
    $cc = $this->CartModel->removeTheCart($productId);
    echo json_encode($cc);
    return false;
  }
  function changeQuantity()
  {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $cc = $this->CartModel->changeQuantity($productId, $quantity);
    echo json_encode($cc);
    return false;
  }
}