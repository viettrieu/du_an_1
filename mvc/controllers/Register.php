<?php

use Core\HandleForm;
use Core\Helper;

class Register extends Controller
{
  public $User;
  public $SocialAuthModel;
  function __construct()
  {
    $this->User = $this->model("UserModel");
    $this->SocialAuthModel = $this->model("SocialAuthModel");
    if (isset($_SESSION['user'])) {
      header("Location: " . SITE_URL . "/account");
      exit();
    }
  }
  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($_COOKIE['social_user'])) {
      $social_user = json_decode(base64_decode($_COOKIE['social_user']), true);
      $social_user['username'] = Helper::to_slug($social_user['name']);
      $username = $social_user['username'];
      $email = isset($social_user['email']) ? $social_user['email'] : NULL;
      $avatar = isset($social_user['avatar']) ? $social_user['avatar'] : NULL;
      $fullName = isset($social_user['name']) ? $social_user['name'] : NULL;
      $social = isset($social_user['social']) ? $social_user['social'] : NULL;
      $user = $this->User->GetUserById($username, $email);
      if ($user) {
        if ($user['username'] == $username)
          $username =  $username . "1";
        if ($user['email'] == $email)
          $errors[] = ["status" => "ERROR", "message" => "Email đã tồn tại"];
      }
      $data = array(
        "username" => $username,
        "email" => $email,
        "fullName" => !empty($fullName) ? $fullName : NULL,
        "avatar" => !empty($avatar) ? $avatar : NULL,
      );
      if (count($errors) == 0) {
        $password = "111";
        $md5password = md5($password);
        $data["passwordHash"] = $md5password;
        $this->User->InsertUser($data);
        $IdUser = $this->User->lastInsertId();
        if (isset($social)) {
          if ($social == "zalo") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "zalo_token" => $social_user["id"]]
            );
          } elseif ($social == "facebook") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "fb_token" => $social_user["id"]]
            );
          } elseif ($social == "gmail") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "gmail_token" => $social_user["id"]]
            );
          }
        }
        $_SESSION['user'] = Helper::fixUrlImg($this->User->CheckLogin($username, $password), "avatar", true);
        $_SESSION['user']['wishlist'] = [];
        header("Location: " . SITE_URL . "/account");
        exit();
      }
    }
    if (isset($request->reg_user)) {
      $username = HandleForm::rip_tags($request->username);
      $mobile = HandleForm::rip_tags($request->mobile);
      $email = HandleForm::rip_tags($request->email);
      $password = HandleForm::rip_tags($request->password);
      $fullName = HandleForm::rip_tags($request->fullName);
      $avatar = HandleForm::rip_tags($request->avatar);
      $social = HandleForm::rip_tags($request->social);
      $user = $this->User->GetUserById($username, $email, $mobile);
      $errors = HandleForm::validations([
        [$username, 'required', 'Vui lòng nhập vào username'],
        [$mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$request->email, 'email', 'Vui lòng điền đúng Email'],
        [$password, 'required', 'Vui lòng nhập vào mật khẩu'],
      ]);
      if ($request->password != $request->re_password) {
        $errors[] = ["status" => "ERROR", "message" => "Hai mật khẩu không khớp nhau"];
      }
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
        "fullName" => !empty($fullName) ? $fullName : NULL,
        "avatar" => !empty($avatar) ? $avatar : NULL,
      );
      if (count($errors) == 0) {
        $md5password = md5($password);
        $data["passwordHash"] = $md5password;
        $this->User->InsertUser($data);
        $IdUser = $this->User->lastInsertId();
        if (isset($social)) {
          if ($social == "zalo") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "zalo_token" => $social_user["id"]]
            );
          } elseif ($social == "facebook") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "fb_token" => $social_user["id"]]
            );
          } elseif ($social == "gmail") {
            $this->SocialAuthModel->insert(
              'social_auth',
              ["userId" => $IdUser, "gmail_token" => $social_user["id"]]
            );
          }
        }
        $_SESSION['user'] = Helper::fixUrlImg($this->User->CheckLogin($username, $password), "avatar", true);
        $_SESSION['user']['wishlist'] = [];
        header("Location: " . SITE_URL . "/account");
        exit();
      }
    }
    setcookie('social_user', '', time() - 3600, '/');
    $this->view("page-full", [
      "Page" => "register",
      "Title" => "Đăng ký",
      "Errors" => $errors,
      "SocialUser" => isset($social_user) ? $social_user : '',
    ]);
  }
}