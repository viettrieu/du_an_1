<?php

use Core\HandleForm;

class Tag extends Controller
{
  public $ListTag;
  function __construct()
  {
    $this->ListTag = $this->model("TagModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_tag)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Tên từ khóa không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => HandleForm::rip_tags($request->title),
          "content" => $request->content,
        );
        $result = $this->ListTag->InsertTag($data);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công từ khóa <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Từ khóa <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "tag",
      "Title" => "Từ khóa",
      "ListTag" => $this->ListTag->GetAllTag(),
      "Errors" => $errors
    ]);
  }
  function Edit($id = 0)
  {
    if ($this->ListTag->GetTagById($id) == NULL) {
      header("Location: " . ADMIN_URL . "/tag ");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_tag)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Tên từ khóa không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => HandleForm::rip_tags($request->title),
          "content" => $request->content,
        );
        $cond = "id = " . $id;
        $result = $this->ListTag->UpdateTagBy($data, $cond);
        unset($_POST);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công từ khóa <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Từ khóa <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-tag",
      "Title" => "Từ khóa",
      "Errors" => $errors,
      "Tag" => $this->ListTag->GetTagById($id),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListTag->DeleteTagById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}