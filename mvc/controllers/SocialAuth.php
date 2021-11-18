<?php

use Core\loginfb;

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
    $fb_user = loginfb::login();
    if (count($fb_user) > 0) {
      $IdUser = $this->SocialAuthModel->Get($fb_user['id']);
      if (isset($IdUser)) {
        $result = $this->SocialAuthModel->Check($IdUser);
        $_SESSION['user'] = $result;
      } else {
        echo '<script> window.close();window.opener.document.location.href = "register";</script>';
      }
      echo '<script> window.close(); window.opener.location.reload();</script>';
    }
  }
}