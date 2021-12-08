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
      "WishlistProduct" => $this->Statistical->GetWishlistProduct(5),
      "HotProduct" => $this->Statistical->GetHotProduct(1, $sd, $en, 5),
      "ListCategory" => $this->ListCategory->GetAllCategory(),
    ]);
  }
  function cc()
  {
    $cc = $this->Statistical->SumOrderByStatus();
    foreach ($cc  as $row) {
      $row_title[]  = $row['status'];
      $row_luot[]   = (int)$row['total'];
    }
    $stats = [$row_title, $row_luot];
    echo json_encode($stats);
  }
  function getDaterangeSU()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:Pageviews', 'ga:users', 'ga:Sessions'];
      $dimension =  ['ga:date'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
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
  function get()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:users', 'ga:Sessions', 'ga:percentNewSessions', 'ga:bounceRate', 'ga:avgSessionDuration', 'ga:pageviewsPerSession', 'ga:Pageviews'];
      $dimension =  [];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
  }
  function DeviceCategory()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:users'];
      $dimension =  ['ga:DeviceCategory', 'ga:date'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
  }
  function listPageView()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:sessions', 'ga:bounceRate', 'ga:Pageviews', 'ga:uniquePageviews', 'ga:avgTimeOnPage', 'ga:exitRate'];
      $dimension =  ['ga:pagepath'];
      $sort =  ['ga:pageviews'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension, $sort);
    } else {
      echo 'Lỗi';
    }
  }
}