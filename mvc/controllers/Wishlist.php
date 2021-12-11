<?php

use Core\Helper;

class Wishlist extends Controller
{
  public $wishlist;
  public $UserById;
  public $product;
  public $User;
  function __construct()
  {
    $this->wishlist = $this->model("WishlistModel");
    $this->User = $this->model("UserModel");
    $this->product = $this->model("ProductModel");
    if (!isset($_SESSION["user"])) {
      header("Location: " . SITE_URL . "/login");
    } else {
      $userlg = $_SESSION["user"];
      $this->UserById = $this->User->GetUserById($userlg["username"]);
    }
  }

  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "wishlist",
      "Title" => "Wishlist",
      "Items" => $this->wishlist->GetWishlistBy($this->UserById['id']),
      "UserById" => Helper::fixUrlImg($this->UserById, "avatar", true),
    ]);
  }
  function Remove()
  {
    if (!isset($this->UserById)) {
      echo json_encode(["type" => "warning", "message" => "Bạn cần phải đăng nhập để thực hiện tính năng này"]);
      exit();
    }
    $productId = (int)$_POST['productId'];
    $result = $this->wishlist->DeleteWishlist("productId = " . $productId . " AND userId = " .  $this->UserById['id']);
    if ($result) {
      $result = ["type" => "success", "message" => "Đã xoá sản phẩm khỏi wishlist"];
      if (($key = array_search($productId, $_SESSION['user']['wishlist'])) !== false) {
        unset($_SESSION['user']['wishlist'][$key]);
      }
    } else {
      $result = ["type" => "error", "message" => "Đã có lỗi trong quá trình xóa vui lòng thử lại"];
    }
    echo json_encode($result);
  }
  function Add()
  {
    if (!isset($this->UserById)) {
      echo json_encode(["type" => "warning", "message" => "Bạn cần phải đăng nhập để thực hiện tính năng này"]);
      exit();
    }
    $productId = (int)$_POST['productId'];
    $result = $this->wishlist->InsertWishlist(["productId" => $productId, "userId" =>  $this->UserById['id']]);
    if ($result) {
      $result = ["type" => "success", "message" => "Đã thêm sản phẩm vào wishlist"];
      $_SESSION['user']['wishlist'][] = $productId;
    } else {
      $result = ["type" => "error", "message" => "Thêm sản phẩm thất bại"];
    }
    echo json_encode($result);
  }
}