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

    if (!isset($_SESSION["user"])) {
      header("Location: " . SITE_URL . "/login");
      exit();
    } else {
      $user = $_SESSION['user'];
      $this->userId = (int)$user['id'];
    }
  }

  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "wishlist",
      "Title" => "Wishlist",
      "Items" => $this->wishlist->GetWishlistBy($this->userId),
    ]);
  }
  function Remove()
  {
    $productId = (int)$_POST['productId'];
    $result = $this->wishlist->DeleteWishlist("productId = " . $productId . " AND userId = " .  $this->userId);
    if (($key = array_search($productId, $_SESSION['user']['wishlist'])) !== false) {
      unset($_SESSION['user']['wishlist'][$key]);
    }
    echo json_encode($result);
  }
  function Add()
  {
    $productId = (int)$_POST['productId'];
    $_SESSION['user']['wishlist'][] = $productId;
    $result = $this->wishlist->InsertWishlist(["productId" => $productId, "userId" =>  $this->userId]);
    echo json_encode($result);
  }
}