<?php

use Core\HandleForm;

class Login extends Controller
{
  public $User;
  function __construct()
  {
    $this->User = $this->model("UserModel");
    if (isset($_SESSION['user']) && $_SESSION['user']["admin"] == true) {
      header("Location: " . ADMIN_URL . "/dashboard");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->login_user)) {
      $errors = HandleForm::validations([
        [$request->username, 'required', 'Vui lòng nhập vào Email'],
        [$request->password, 'required', 'Vui lòng nhập vào mật khẩu'],
      ]);
      $username = HandleForm::rip_tags($request->username);
      $password = $request->password;
      if (count($errors) == 0) {
        $result  = $this->User->CheckLogin($username, $password);
        if (!$result) {
          $errors[] = ["status" => "ERROR", "message" => "Sai xác thực tên người dùng / mật khẩu"];
        } elseif ($result["admin"] == 0) {
          $errors[] = ["status" => "ERROR", "message" => "Tài khoản bạn không đủ thẩm quyền"];
        } else {
          $_SESSION['user'] = $result;
          $_SESSION['user']['wishlist'] = [];
          header("Location: " . ADMIN_URL . "/dashboard");
        }
      }
    }
    $this->view("admin/blank-page", [
      "Page" => "login",
      "Title" => "Đăng nhập",
      "Errors" => $errors,
    ]);
  }
}