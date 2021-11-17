<?php
class wishlist extends Controller
{
  public $wishlist;
  public $user;
  public $product;

  function __construct()
  {
    $this->wishlist = $this->model("WishlistModel");
    $this->user = $this->model("UserModel");
    $this->product = $this->model("ProductModel");

    if (!isset($_SESSION["user"])) {
      header("Location: " . SITE_URL . "/login");
      exit();
    }    
  }

  function SayHi()
  {
    $user = $_SESSION['user'];
    $user['userId'] = $user['id'];
    $sql = "SELECT * FROM wishlist WHERE `userId` = '".$user['id']."'";
    $wishlist_items = $this->wishlist->pdo_query($sql, $user);
    $uniqueIds = array_map(function($item) { 
      return $item['productId'];
    }, $wishlist_items);

    $uniqueIds = array_unique($uniqueIds);
    $items = array_map(function($id) use($wishlist_items) {
      
      $sql = "SELECT * FROM book WHERE `id` = $id";
      $ar = $this->product->pdo_query($sql);
      $ar['quantity'] = count(array_filter($wishlist_items, function($item) use ($id) {
        return $item['productId'] == $id;
      }));
      
      return $ar;
    }, $uniqueIds);

    $this->view("page-full", [
      "Page" => "wishlist",
      "Title" => "Wishlist",
      "Items" => $items
    ]);
  }
}