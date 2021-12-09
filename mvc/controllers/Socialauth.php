<?php

use Core\Helper;
use Core\loginfb;
use Core\LoginMail;
use Core\Zalologin;

class SocialAuth extends Controller
{
  public $User;
  public $SocialAuthModel;
  public function __construct()
  {
    $this->User = $this->model("UserModel");
    $this->SocialAuthModel = $this->model("SocialAuthModel");
  }
  function SayHi()
  {
  }

  function Facebook()
  {
    $user = loginfb::login();
    if (!isset($user)) {
      header('Location: ' . loginfb::loginUrl());
      exit();
    }
    $column = 'fb_token';
    $this->Check($user, $column);
  }
  function Zalo()
  {
    $user = Zalologin::login();
    if (!isset($user)) {
      header('Location: ' . Zalologin::loginUrl());
      exit();
    }
    $column = 'zalo_token';
    $this->Check($user, $column);
  }
  function Gmail()
  {
    $user = LoginMail::login();
    if (!isset($user)) {
      header('Location: ' . LoginMail::loginUrl());
      exit();
    }
    $column = 'gmail_token';
    $this->Check($user, $column);
  }
  private function Check($user, $column)
  {
    if (count($user) > 0) {
      $IdUser = $this->SocialAuthModel->Get($column . '=' . $user['id']);
      if (isset($IdUser)) {
        $_SESSION['user'] = Helper::fixUrlImg($this->SocialAuthModel->Check((int)$IdUser), "avatar", true);
        $_SESSION['user']['wishlist'] = explode(",", $_SESSION['user']['wishlist']);
        setcookie("social_user", "", time() - 3600);
      } else {
        echo '<script> window.close();window.opener.document.location.href = "' . SITE_URL . '/register";</script>';
      }
      echo '<script> window.close(); window.opener.location.reload();</script>';
    }
  }
}