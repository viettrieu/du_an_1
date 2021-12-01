<?php

use Core\GoogleAnalytics;

class Dashboard extends Controller
{
  public $Statistical;
  public $ListProduct;
  function __construct()
  {
    $this->Statistical = $this->model("StatisticalModel");
    $this->ListProduct = $this->model("ProductModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "dashboard",
      "Title" => "Dashboard",
      "Count" => [$this->Statistical->count("ps_product"), $this->Statistical->count("ps_users"), $this->Statistical->count("ps_order"), $this->Statistical->count("ps_product_review"),],
      "ProductView" => $this->ListProduct->GetViewProduct(5),
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