<?php

use Core\HandleForm;

class Author extends Controller
{
  public $ListAuthor;

  function __construct()
  {
    $this->ListAuthor = $this->model("AuthorModel");

    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "list_author",
      "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
      "Title" => "Tác giả",
    ]);
  }
  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));

    if (isset($request->create_author)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Vui lòng nhập tên tác giả']
      ]);
      $title = HandleForm::rip_tags($_POST['title']);
      $fblink = HandleForm::rip_tags($_POST['fblink']);
      $youtubelink = HandleForm::rip_tags($_POST['youtubelink']);
      $twitterlink = HandleForm::rip_tags($_POST['twitterlink']);
      $quote = $_POST['quote'] == '<p><br></p>' ? NULL : $_POST['quote'];
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $avatar = HandleForm::upload($_FILES["avatar"], ['jpeg', 'jpg', 'png'], 5000000, "./public/img/");
      if (!$avatar[0]) {
        $errors[] = ["status" => "ERROR", "message" => $avatar[1]];
      }
      if ($avatar[1] !== NULL) $avatar[1] = str_replace('./', '/', $avatar[1]);
      $data = array(
        "title" => $title,
        "quote" => $quote,
        "content" => $content,
        "fblink" => $fblink,
        "youtubelink" => $youtubelink,
        "twitterlink" => $twitterlink,
        "avatar" => $avatar[1],
      );
      if (count($errors) == 0) {
        $InsertAuthor = $this->ListAuthor->InsertAuthor($data);
        if ($InsertAuthor) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công tác giả <strong>" . $title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "create-author",
      "Title" => "Tạo tác giả mới",
      "Errors" => $errors,
    ]);
  }
  function Edit($id = 0)
  {
    $author = $this->ListAuthor->GetAuthorById($id);
    if ($author == NULL) {
      header("Location: " . ADMIN_URL . "/author");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_author)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Vui lòng nhập tên tác giả']
      ]);
      $title = HandleForm::rip_tags($_POST['title']);
      $fblink = HandleForm::rip_tags($_POST['fblink']);
      $youtubelink = HandleForm::rip_tags($_POST['youtubelink']);
      $twitterlink = HandleForm::rip_tags($_POST['twitterlink']);
      $quote = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $avatar = HandleForm::upload($_FILES["avatar"], ['jpeg', 'jpg', 'png'], 5000000, "./public/img/");
      if (!$avatar[0]) {
        $errors[] = ["status" => "ERROR", "message" => $avatar[1]];
      }
      $data = array(
        "title" => $title,
        "quote" => $quote,
        "content" => $content,
        "fblink" => $fblink,
        "youtubelink" => $youtubelink,
        "twitterlink" => $twitterlink,
        "avatar" => $avatar[1],
      );
      if (count($errors) == 0) {
        $UpdateAuthor = $this->ListAuthor->UpdateAuthorBy($data, 'id = ' . $id);
        if ($UpdateAuthor) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công tác giả <strong>" . $title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }

    $this->view("admin/page-full", [
      "Page" => "edit-author",
      "Author" => $this->ListAuthor->GetAuthorById($id),
      "Title" => "Chỉnh sửa sản phẩm",
      "Errors" => $errors,
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListAuthor->DeleteAuthorById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}