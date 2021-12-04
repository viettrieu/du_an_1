<?php
class wishlist extends Controller
{
  public $wishlist;
  public $userId;
  public $product;

  function __construct()
  {
    $this->wishlist = $this->model("WishlistModel");
    $this->user = $this->model("UserModel");
    $this->product = $this->model("ProductModel");
    if (isset($_SESSION["user"])) {
      $user = $_SESSION['user'];
      $this->userId = (int)$user['id'];
    }
  }

  function SayHi()
  {
    if (!isset($this->userId)) {
      header("Location: " . SITE_URL . "/login");
      exit();
    }
    $this->view("page-full", [
      "Page" => "wishlist",
      "Title" => "Wishlist",
      "Items" => $this->wishlist->GetWishlistBy($this->userId),
    ]);
  }
  function Remove()
  {
    if (!isset($this->userId)) {
      echo json_encode(["type" => "warning", "message" => "Bạn cần phải đăng nhập để thực hiện tính năng này"]);
      exit();
    }
    $productId = (int)$_POST['productId'];
    $result = $this->wishlist->DeleteWishlist("productId = " . $productId . " AND userId = " .  $this->userId);
    if (($key = array_search($productId, $_SESSION['user']['wishlist'])) !== false) {
      unset($_SESSION['user']['wishlist'][$key]);
    }
    if ($result) {
      $result = ["type" => "success", "message" => "Đã xoá sản phẩm khỏi wishlist"];
    } else {
      $result = ["type" => "error", "message" => "Đã có lỗi trong quá trình xóa vui lòng thử lại"];
    }
    echo json_encode($result);
  }
  function Add()
  {
    if (!isset($this->userId)) {
      echo json_encode(["type" => "warning", "message" => "Bạn cần phải đăng nhập để thực hiện tính năng này"]);
      exit();
    }
    $productId = (int)$_POST['productId'];
    $_SESSION['user']['wishlist'][] = $productId;
    $result = $this->wishlist->InsertWishlist(["productId" => $productId, "userId" =>  $this->userId]);
    if ($result) {
      $result = ["type" => "success", "message" => "Đã thêm sản phẩm vào wishlist"];
    } else {
      $result = ["type" => "error", "message" => "Thêm sản phẩm thất bại"];
    }
    echo json_encode($result);
  }
}