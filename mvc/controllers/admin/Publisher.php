<?php

use Core\HandleForm;

class Publisher extends Controller
{
  public $ListPublisher;
  function __construct()
  {
    $this->ListPublisher = $this->model("PublisherModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->create_publisher)) {
      $title = HandleForm::rip_tags($request->title);
      $errors = HandleForm::validations([
        [$title, 'required', 'Tên NXB không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => $title,
          "content" => $request->content,
        );
        $result = $this->ListPublisher->InsertPublisher($data);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công NXB <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "NXB <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "publisher",
      "Title" => "NXB",
      "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
      "Errors" => $errors
    ]);
  }
  function Edit($id = 0)
  {
    if ($this->ListPublisher->GetPublisherById($id) == NULL) {
      header("Location: " . ADMIN_URL . "/publisher ");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_publisher)) {
      $title = HandleForm::rip_tags($request->title);
      $errors = HandleForm::validations([
        [$title, 'required', 'Tên NXB không được để trống'],
      ]);
      if (count($errors) == 0) {
        $data = array(
          "title" => $title,
          "content" => $request->content,
        );
        $cond = "id = " . $id;
        $result = $this->ListPublisher->UpdatePublisherBy($data, $cond);
        unset($_POST);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công NXB <strong>" . $request->title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "NXB <strong>" . $request->title . "</strong> đã tồn tại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-publisher",
      "Title" => "NXB",
      "Errors" => $errors,
      "Publisher" => $this->ListPublisher->GetPublisherById($id),
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListPublisher->DeletePublisherById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}