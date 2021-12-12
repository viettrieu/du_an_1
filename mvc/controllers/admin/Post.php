<?php

use Core\HandleForm;

class Post extends Controller
{
  public $ListPost;
  public $ListCategory;
  function __construct()
  {
    $this->ListPost = $this->model("PostModel");
    $this->ListCategory = $this->model("PostcategoryModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "post",
      "ListPost" => $this->ListPost->GetAllPost(),
      "Title" => "Bài viết",
    ]);
  }
  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_post)) {
      $title = HandleForm::rip_tags($request->title);
      $excerpt = HandleForm::rip_tags($request->excerpt);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $id_category = (int)$request->id_category;
      $errors = HandleForm::validations([
        [$title, 'required', 'Tên bài viết không được để trống'],
        [$id_category, 'required', 'Vui lòng chọn danh mục bài viết'],
      ]);
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      if ($thumbnail[1] !== NULL) $thumbnail[1] = str_replace('./', '/', $thumbnail[1]);
      if (count($errors) == 0) {
        $data = array(
          "title" => $title,
          "content" => $content,
          "excerpt" => $excerpt,
          "id_category" => $id_category,
          "id_user" => (int)$_SESSION['user']['id'],
          "thumbnail" => $thumbnail[1],
        );
        $result = $this->ListPost->InsertPost($data);
        if ($result) {
          unset($_POST);
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công bài viết <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Bài viết <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "create-post",
      "Title" => "Bài viết",
      "ListCategory" => $this->ListCategory->GetAllPostcategory(),
      "Errors" => $errors
    ]);
  }
  function Edit($id = 0)
  {
    $post = $this->ListPost->GetPostById($id);
    if ($post == NULL) {
      header("Location: " . ADMIN_URL . "/post ");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_post)) {
      $title = HandleForm::rip_tags($request->title);
      $excerpt = HandleForm::rip_tags($request->excerpt);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $id_category = (int)$request->id_category;
      $errors = HandleForm::validations([
        [$title, 'required', 'Tên bài viết không được để trống'],
        [$id_category, 'required', 'Vui lòng chọn danh mục bài viết'],
      ]);
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      if ($thumbnail[1] !== NULL) $thumbnail[1] = str_replace('./', '/', $thumbnail[1]);
      if (count($errors) == 0) {
        $data = array(
          "title" => $title,
          "content" => $content,
          "excerpt" => $excerpt,
          "id_category" => $id_category,
          "id_user" => (int)$_SESSION['user']['id'],
          "thumbnail" => $thumbnail[1] == NULL ? $post["thumbnail"] : $thumbnail[1],
        );
        $cond = "id = " . $id;
        $result = $this->ListPost->UpdatePostBy($data, $cond);
        if ($result) {
          unset($_POST);
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công Bài viết <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Bài viết <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-post",
      "Title" => "Bài viết",
      "Errors" => $errors,
      "Post" => $this->ListPost->GetPostById($id),
      "ListCategory" => $this->ListCategory->GetAllPostcategory(),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListPost->DeletePostById($cond);
    echo json_encode($result);
    exit();
  }
}