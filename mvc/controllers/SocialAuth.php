<?php

use Core\loginfb;
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
  private function Check($user, $column)
  {
    if (count($user) > 0) {
      $IdUser = $this->SocialAuthModel->Get($column . '=' . $user['id']);
      if (isset($IdUser)) {
        $result = $this->SocialAuthModel->Check($IdUser);
        $_SESSION['user'] = $result;
        setcookie("social_user", "", time() - 3600);
      } else {
        echo '<script> window.close();window.opener.document.location.href = "' . SITE_URL . '/register";</script>';
      }
      echo '<script> window.close(); window.opener.location.reload();</script>';
    }
  }
}