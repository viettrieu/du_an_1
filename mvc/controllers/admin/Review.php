<?php
class Review extends Controller
{
  public $ListReview;
  function __construct()
  {
    $this->ListReview = $this->model("ReviewModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "review",
      "Title" => "Đánh giá",
      "ListReview" => $this->ListReview->GetAllReview(),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListReview->DeleteReviewById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }

  function Approve()
  {
    $id = $_POST['idReview'];
    $cond = "id = '$id'";
    $data = array(
      "status" => 1,
    );
    $result = $this->ListReview->UpdateReview($data, $cond);
    echo json_encode($result);
    exit();
  }
}