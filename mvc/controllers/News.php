<?php

use Core\HandleForm;
use Core\Helper;

class News extends Controller
{
  public $ListPost;
  public $ListTag;
  public $ListComment;
  function __construct()
  {
    $this->ListPost = $this->model("PostModel");
    $this->ListComment = $this->model("CommentModel");
  }
  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "news",
      "Title" => "Tin tức",
      "ListPost" => $this->ListPost->GetAllPost(),
    ]);
  }
  function Post($id = 0)
  {
    if ($id == "addcomment" && isset($_SESSION["user"])) {
      if (isset($_POST["postId"])) {
        $userId = (int)$_SESSION["user"]["id"];
        $postId = (int)HandleForm::rip_tags($_POST["postId"]);
        $content = HandleForm::rip_tags($_POST["content"]);
        $parent_id = isset($_POST["parent_id"]) ? (int)$_POST["parent_id"] : 0;
        $data = array(
          "userId" => $userId,
          "postId" => $postId,
          "content" => $content,
          "parent_id" => $parent_id,
        );
        $result = $this->ListComment->InsertComment($data);
        if ($result) {
          $data["avatar"] = $_SESSION["user"]["avatar"];
          $data["username"] = $_SESSION["user"]["fullName"] ? $_SESSION["user"]["fullName"] : $_SESSION["user"]["username"];
          $data["id"]  = $this->ListComment->lastInsertId();
          $result = ["type" => "success", "message" => "Bình luận đã được gửi thành công", "data" => $data];
        } else {
          $result = ["type" => "error", "message" => "Đã có lỗi trong quá trình gửi bình luận"];
        }
      } else {
        $result = ["type" => "error", "message" => "Đã có lỗi"];
      }
      echo json_encode($result);
      exit();
    }
    $post =  $this->ListPost->GetPostById($id);
    if ($post == NULL) {
      header("Location: " . SITE_URL . "/news");
      exit();
    }
    $this->view("page-full", [
      "Page" => "post",
      "Title" => $post["title"],
      "Post" => $post,
      "RelatedPost" => $this->ListPost->GetRelatedPostById((int)$post["id_category"], (int)$id, 4),
      "Comment" => Helper::fixUrlImg($this->ListComment->GetCommentByPost((int)$id), "avatar"),
    ]);
  }
}