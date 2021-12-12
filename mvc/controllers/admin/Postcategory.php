<?php

use Core\HandleForm;

class Postcategory extends Controller
{
  public $ListPostcategory;
  function __construct()
  {
    $this->ListPostcategory = $this->model("PostcategoryModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_post_category)) {
      $title = HandleForm::rip_tags($request->title);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $errors = HandleForm::validations([
        [$title, 'required', 'Tên danh mục không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => $title,
          "content" => $content,
        );
        $result = $this->ListPostcategory->InsertPostcategory($data);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công danh mục <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Danh mục <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "post-category",
      "Title" => "Danh mục bài viết",
      "Listpost_category" => $this->ListPostcategory->GetAllPostcategory(),
      "Errors" => $errors
    ]);
  }
  function Edit($id = 0)
  {
    if ($this->ListPostcategory->GetPostcategorById($id) == NULL) {
      header("Location: " . ADMIN_URL . "/postcategory ");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_post_category)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Tên danh mục không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => HandleForm::rip_tags($request->title),
          "content" => $request->content,
        );
        $cond = "id = " . $id;
        $result = $this->ListPostcategory->UpdatePostcategorBy($data, $cond);
        unset($_POST);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công bài viết <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Danh mục <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-postcategory",
      "Title" => "Danh mục bài viết",
      "Errors" => $errors,
      "Postcategory" => $this->ListPostcategory->GetPostcategorById($id),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListPostcategory->DeletePostcategoryById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}