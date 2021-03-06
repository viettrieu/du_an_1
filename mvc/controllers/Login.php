<?php

use Core\HandleForm;
use Core\Helper;

class Login extends Controller
{
  public $User;
  function __construct()
  {
    $this->User = $this->model("UserModel");
    if (isset($_SESSION['user'])) {
      header("Location: " . SITE_URL . "/account");
      exit();
    }
  }

  function SayHi()
  {
    $errors = isset($_SESSION['errors']) ?  array($_SESSION['errors']) :  array();
    unset($_SESSION['errors']);
    $request = json_decode(json_encode($_POST));
    if (isset($request->login_user)) {
      $errors = HandleForm::validations([
        [$request->username, 'required', 'Vui lòng nhập vào username'],
        [$request->password, 'required', 'Vui lòng nhập vào mật khẩu'],
      ]);
      $username = HandleForm::rip_tags($request->username);
      $password = $request->password;
      if (count($errors) == 0) {
        $result  = $this->User->CheckLogin($username, $password);
        if ($result["id"] === NULL) {
          $errors[] = ["status" => "ERROR", "message" => "Sai xác thực tên người dùng / mật khẩu"];
        } else {
          $refurl = isset($_GET['refurl']) ? base64_decode($_GET['refurl']) :  SITE_URL . "/account";
          $_SESSION['user'] =  Helper::fixUrlImg($result, "avatar", true);
          $_SESSION['user']['wishlist'] = explode(",", $_SESSION['user']['wishlist']);
          header("Location: " . $refurl);
          exit();
        }
      }
    }
    $this->view("page-full", [
      "Page" => "login",
      "Title" => "Đăng nhập",
      "Errors" => $errors,
    ]);
  }
}