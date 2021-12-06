<?php
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
}
