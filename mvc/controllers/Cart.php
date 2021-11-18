<?php

use Core\HandleForm;

class Cart extends Controller
{
  public $CartModel;
  public $listCoupon;
  function __construct()
  {
    $this->listCoupon = $this->model("CouponModel");
    $this->CartModel = $this->model("CartModel");
  }
  function SayHi()
  {
    // unset($_SESSION['cart']);

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
  function checkCoupon()
  {
    $code = $_POST['coupon_code'];
    $errors = array();
    $coupon = $this->listCoupon->GetCoupon("code = '" . $code . "'");
    if ($coupon == NULL) {
      $errors[] = ["status" => "ERROR", "message" => "Coupon không tồn tại"];
    } else {
      if ($coupon['usages'] >= $coupon['usageLimit'] && $coupon['usageLimit'] > 0) {
        $errors[] = ["status" => "ERROR", "message" => "Coupon đã hết lượt sử dụng"];
      }
      if (strtotime($coupon['expiryDate']) < strtotime('now') && $coupon['expiryDate'] !=  NULL) {
        $errors[] = ["status" => "ERROR", "message" => "Coupon giá hết hạn"];
        unset($_SESSION['cart']['coupon']);
      }
    }
    if (count($errors) == 0) {
      $errors[] = ["status" => "OK", "message" => "Coupon đã được áp dụng"];
      $_SESSION['cart']['coupon'] = ['id' => $coupon['id'], 'code' => $code, 'discount' => $coupon['discount']];
    } else {
      $_SESSION['cart']['coupon'] = [];
    }
    echo json_encode(['info' => $errors, 'coupon' => $_SESSION['cart']['coupon']]);
  }
}