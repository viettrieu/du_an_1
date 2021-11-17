<?php

use Core\HandleForm;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Recovery extends Controller
{
    public $User;
    public $PwReset;

    public function __construct()
    {
        $this->User = $this->model("UserModel");
        $this->PwReset = $this->model('PasswordResetModel');

        if (isset($_SESSION['user'])) {
            header("Location: " . SITE_URL . "/account");
            exit();
        }
    }

    public function SayHi()
    {
        $errors = isset($_SESSION['errors']) ?  array($_SESSION['errors']) :  array();
        unset($_SESSION['errors']);
        $request_uri = $_SERVER['REQUEST_URI'];
        $request = json_decode(json_encode($_POST));
        $is_success = false;

        if(strpos($request_uri, '?token=') === false) {
            header("Location: " . SITE_URL . "/");
            exit();            
        }

        //Chuyển chuỗi thành mảng
        $token = explode('=', $request_uri)[1];
        $is_valid = $this->PwReset->checkValidToken($token);

        if(!$is_valid) {
            header("Location: " . SITE_URL . "/");
            exit();  
        }

        if (isset($request->recovery_password)) {
            $errors = HandleForm::validations([
                [$request->new_password, 'required', 'Vui lòng nhập mật khẩu mới của bạn'],
                [$request->password_confirm, 'required', 'Vui lòng nhập lại mật khẩu bạn'],
                [$request->new_password, 'min:6', 'Mật Khẩu Mới Tối Thiểu Phải Có 6 Ký Tự'],
                [$request->new_password, 'max:15', 'Mật Khẩu Mới Không Được Quá 15 Ký Tự'],
                [$request->password_confirm, 'confirmed:'.$request->new_password, 'Nhập Lại Mật Khẩu Phải Khớp Với Nhau'],
            ]);

            $email = $is_valid['email'];
            $this->User->UpdateUserBy([
                'passwordHash' => md5($request->new_password)
            ], "email = '$email'");

            $this->PwReset->delete('password_reset', "email = '$email'", 1000);

            $is_success = true;
        }

        $this->view("page-full", [
            "Page" => "recovery_password",
            "Title" => "Khôi Phục Mật Khẩu",
            "Errors" => $errors,
            "IsSuccess" => $is_success
        ]);
    }
}
