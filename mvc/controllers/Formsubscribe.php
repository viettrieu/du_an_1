<?php

use Core\HandleForm;
use Core\MailChimp;

class Formsubscribe extends Controller
{
  function SayHi()
  {
    $errors = array();
    if (!empty($_POST)) {
      $request = json_decode(json_encode($_POST));
      $email = $request->email;
      $errors = HandleForm::validations([
        [$email, 'email', 'Vui lòng điền đúng Email'],
      ]);
      if (count($errors) == 0) {
        $result = json_decode(MailChimp::AddSubscriber($email));
        if ($result->status == 400) {
          foreach ($result->errors as $error) {
            $errors[] = ["status" => "ERROR", "message" => $error->message];
          }
        } elseif ($result->status == 'subscribed') {
          $errors[] = ["status" => "OK", "message" => "Cảm ơn bạn, Bạn đã đăng ký thành công"];
        }
      }
    } else {
      $errors[] = ["status" => "ERROR", "message" => 'Vui lòng điền đúng Email'];
    }
    echo json_encode($errors);
    exit();
  }
}