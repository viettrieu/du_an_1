<?php

use Core\HandleForm;

class Category extends Controller
{
  public $ListCategory;
  function __construct()
  {
    $this->ListCategory = $this->model("CategoryModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_category)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Tên danh mục không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => HandleForm::rip_tags($request->title),
          "content" => $request->content,
        );
        $result = $this->ListCategory->InsertCategory($data);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công danh mục <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Danh mục <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "category",
      "Title" => "Danh mục",
      "ListCategory" => $this->ListCategory->GetAllCategory(),
      "Errors" => $errors
    ]);
  }
  function Edit($id = 0)
  {
    if ($this->ListCategory->GetCategorById($id) == NULL) {
      header("Location: " . ADMIN_URL . "/category ");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_category)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Tên danh mục không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => HandleForm::rip_tags($request->title),
          "content" => $request->content,
        );
        $cond = "id = " . $id;
        $result = $this->ListCategory->UpdateCategorBy($data, $cond);
        unset($_POST);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công danh mục <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Danh mục <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-category",
      "Title" => "Danh mục",
      "Errors" => $errors,
      "Category" => $this->ListCategory->GetCategorById($id),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListCategory->DeleteCategoryById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}