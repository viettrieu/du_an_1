<?php

use Core\HandleForm;

class Cart extends Controller
{
  public $Coupon;
  public $Product;
  function __construct()
  {
    $this->Coupon = $this->model("CouponModel");
    $this->Product = $this->model("ProductModel");
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
    if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
      $_SESSION['cart']['item'][$index]['quantity'] += $quantity;
    } else {
      $cartItem = $this->Product->GetProductById($productId);
      $cartItem = array(
        'id' =>  $cartItem['id'],
        'thumbnail' => $cartItem['thumbnail'],
        'title' => $cartItem['title'],
        'price' => $cartItem['price'],
        'quantity' => $quantity,
      );
      array_push($_SESSION['cart']['item'], $cartItem);
    }
    $_SESSION['cart']['subTotal'] = $this->GetCartSubTotal();
    $_SESSION['cart']['weight'] = $this->GetCartWeight();
    $listCart = $_SESSION['cart']['item'];
    echo json_encode($listCart);
    exit();
  }
  function removeTheCart()
  {
    $productId = $_POST['productId'];
    if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
      array_splice($_SESSION['cart']['item'], $index, 1);
      $_SESSION['cart']['subTotal'] = $this->GetCartSubTotal();
      $_SESSION['cart']['weight'] = $this->GetCartWeight();
      $listCart = $_SESSION['cart']['item'];
    }
    echo json_encode($listCart);
    exit();
  }
  function changeQuantity()
  {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
      $_SESSION['cart']['item'][$index]['quantity'] = $quantity;
      $_SESSION['cart']['subTotal'] = $this->GetCartSubTotal();
      $_SESSION['cart']['weight'] = $this->GetCartWeight();
      $listCart = $_SESSION['cart']['item'];
    }
    echo json_encode($listCart);
    exit();
  }
  function GetCartWeight()
  {
    $listCart = $_SESSION['cart']['item'];
    $weight = 0;
    foreach ($listCart as $values) {
      $weight +=  $values['quantity'] *  200;
    }
    return $weight;
  }
  function GetCartSubTotal()
  {
    $listCart = $_SESSION['cart']['item'];
    $subTotal = 0;
    foreach ($listCart as $values) {
      $subTotal +=  $values['quantity'] *  $values['price'];
    }
    if (isset($_SESSION['cart']['coupon']) && count($_SESSION['cart']['coupon']) > 0) {
      $subTotal -= $_SESSION['cart']['coupon']["type"] == 0 ? ($_SESSION['cart']['coupon']["discount"] / 100) * $subTotal : $_SESSION['cart']['coupon']["discount"];
    }
    return $subTotal;
  }
  function checkCoupon()
  {
    $code = $_POST['coupon_code'];
    $errors = array();
    $coupon = $this->Coupon->GetCoupon("code = '" . $code . "'");
    if ($coupon == NULL) {
      $errors[] = ["status" => "ERROR", "message" => "Coupon không tồn tại"];
    } else {
      if ($coupon['usages'] >= $coupon['usageLimit'] && $coupon['usageLimit'] > 0) {
        $errors[] = ["status" => "ERROR", "message" => "Coupon đã hết lượt sử dụng"];
      }
      if (strtotime($coupon['expiryDate']) < strtotime('now') && $coupon['expiryDate'] !=  NULL) {
        $errors[] = ["status" => "ERROR", "message" => "Coupon quá ngày áp dụng"];
      }
      if (strtotime($coupon['startDate']) > strtotime('now') && $coupon['startDate'] !=  NULL) {
        $errors[] = ["status" => "ERROR", "message" => "Coupon chưa đến ngày áp dụng"];
      }
      if ($coupon['minOrder'] > $_SESSION['cart']['subTotal'] && $coupon['minOrder'] !=  NULL) {
        $errors[] = ["status" => "ERROR", "message" => "Đơn hản phải trên " . number_format($coupon['minOrder'], 0, ',', '.') . " <sup>đ</sup>"];
      }
    }
    if (count($errors) == 0) {
      $errors[] = ["status" => "OK", "message" => "Coupon đã được áp dụng"];
      $_SESSION['cart']['coupon'] = ['id' => $coupon['id'], 'code' => $code, 'type' => $coupon['type'], 'discount' => $coupon['discount']];
      $_SESSION['cart']['subTotal'] = $this->GetCartSubTotal();
    } else {
      $_SESSION['cart']['coupon'] = [];
    }
    echo json_encode(['info' => $errors, 'coupon' => $_SESSION['cart']['coupon']]);
  }
}