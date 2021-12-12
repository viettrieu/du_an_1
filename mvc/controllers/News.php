<?php
class News extends Controller
{
  public $ListPost;
  public $ListTag;
  function __construct()
  {
    $this->ListPost = $this->model("PostModel");
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
    $post =  $this->ListPost->GetPostById($id);
    if ($post == NULL) {
      header("Location: " . SITE_URL . "/news");
      exit();
    }
    $this->view("page-full", [
      "Page" => "post",
      "Title" => $post["title"],
      "Post" => $post,
    ]);
  }
}