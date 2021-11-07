<?php

use Core\HandleForm;

class Register extends Controller
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
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->reg_user)) {
      $errors = HandleForm::validations([
        [$request->username, 'required', 'Vui lòng nhập vào username'],
        [$request->mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$request->email, 'email', 'Vui lòng điền đúng Email'],
        [$request->password, 'required', 'Vui lòng nhập vào mật khẩu'],
      ]);
      if ($request->password != $request->re_password) {
        $errors[] = ["status" => "ERROR", "message" => "Hai mật khẩu không khớp nhau"];
      }
      $username = HandleForm::rip_tags($request->username);
      $mobile = HandleForm::rip_tags($request->mobile);
      $email = HandleForm::rip_tags($request->email);
      $password = HandleForm::rip_tags($request->password);
      $user = $this->User->GetUserById($username, $email, $mobile);
      if ($user) {
        if ($user['username'] == $username)
          $errors[] = ["status" => "ERROR", "message" => "Username đã tồn tại"];
        if ($user['email'] == $email)
          $errors[] = ["status" => "ERROR", "message" => "Email đã tồn tại"];
        if ($user['mobile'] == $mobile)
          $errors[] = ["status" => "ERROR", "message" => "Số điện thoại đã tồn tại"];
      }
      $data = array(
        "username" => $username,
        "mobile" => $mobile,
        "email" => $email,
      );
      if (count($errors) == 0) {
        $md5password = md5($password);
        $data["passwordHash"] = $md5password;
        $this->User->InsertUser($data);
        $_SESSION['user'] = $this->User->CheckLogin($username, $password);
        header("Location: " . SITE_URL . "/account");
      }
    }
    $this->view("page-full", [
      "Page" => "register",
      "Title" => "Đăng ký",
      "Errors" => $errors,
    ]);
  }
}