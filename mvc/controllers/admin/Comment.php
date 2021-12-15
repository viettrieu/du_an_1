<?php

use Core\Helper;

class Comment extends Controller
{
  public $ListComment;
  function __construct()
  {
    $this->ListComment = $this->model("CommentModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "comment",
      "Title" => "Bình luận",
      "ListComment" => Helper::fixUrlImg($this->ListComment->GetAllComment(), "avatar"),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListComment->DeleteCommentById($cond);
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
    $result = $this->ListComment->UpdateComment($data, $cond);
    echo json_encode($result);
    exit();
  }
}