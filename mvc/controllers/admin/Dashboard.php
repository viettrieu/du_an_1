<?php

use Core\GoogleAnalytics;

class Dashboard extends Controller
{
  public $Statistical;
  public $ListProduct;
  public $ListCategory;
  function __construct()
  {
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
    $this->Statistical = $this->model("StatisticalModel");
    $this->ListProduct = $this->model("ProductModel");
    $this->ListCategory = $this->model("CategoryModel");
  }
  function SayHi()
  {
    $sd = date('Y-m-d', strtotime('-6 days'));
    $en = date('Y-m-d', strtotime('+1 days'));
    $this->view("admin/page-full", [
      "Page" => "dashboard",
      "Title" => "Dashboard",
      "Count" => [$this->Statistical->count("book"), $this->Statistical->count("users"), $this->Statistical->count("order_item"), $this->Statistical->count("book_review"),],
      "WishlistProduct" => $this->Statistical->GetWishlistProduct(1, 5),
      "HotProduct" => $this->Statistical->GetHotProduct(1, $sd, $en, 5),
      "ListCategory" => $this->ListCategory->GetAllCategory(),
    ]);
  }
  function Invoice()
  {
    $invoice = $this->Statistical->SumOrderByStatus();
    foreach ($invoice  as $row) {
      $row_title[]  = $row['status'];
      $row_luot[]   = (int)$row['total'];
      $row_id[]   = (int)$row['id'];
    }
    echo json_encode([$row_title, $row_luot, $row_id]);
  }
  function Category()
  {
    $category = $this->Statistical->Category();
    foreach ($category  as $row) {
      $row_title[]  = $row['title'];
      $row_luot[]   = (int)$row['quantily'];
    }
    echo json_encode([$row_title, $row_luot]);
  }
  function getDataSQL()
  {
    $id = $_POST['id'];
    $cond = $id !== "" ? 'categoryId	= ' . (int) $id : 1;
    $start = $_POST['start'];
    $end = $_POST['end'];
    if ($_POST['action'] == "hot_product") {
      $result = $this->Statistical->GetHotProduct($cond, $start, $end, 5);
    } elseif ($_POST['action'] == "wishlist_product") {
      $result = $this->Statistical->GetWishlistProduct($cond, 5);
    }
    echo json_encode($result);
  }
}