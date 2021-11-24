<?php

use Core\HandleForm;
use Core\Helper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Forgot extends Controller
{
    public $User;
    public $PwReset;

    public function __construct()
    {
        $this->User = $this->model("UserModel");
        $this->PwReset = $this->model('PasswordResetModel');
        // print_r($this->User);
        // die();
        if (isset($_SESSION['user'])) {
            header("Location: " . SITE_URL . "/account");
            exit();
        }
    }

    public function SayHi()
    {
        $errors = isset($_SESSION['errors']) ?  array($_SESSION['errors']) :  array();
        unset($_SESSION['errors']);
        $request = json_decode(json_encode($_POST));

        if (isset($request->recovery_password)) {
            $errors = HandleForm::validations([
                [$request->email, 'required', 'Vui lòng nhập email của bạn'],
                [$request->email, 'email', 'Vui lòng nhập email hợp lệ'],
            ]);

            $email = HandleForm::rip_tags($request->email);
            if (count($errors) == 0) {
                $result  = $this->User->GetUserByEmail($email);
                if (!$result) {
                    $errors[] = ["status" => "ERROR", "message" => "Người dùng không tồn tại"];
                } else {
                    $token = md5(time() . rand(0, 9999));
                    try {
                        $this->PwReset->insert('password_reset', [
                            'token' => $token,
                            'email' => $email,
                        ]);

                        $email_data = [];
                        $email_data['Email'] = $result['email'];
                        $email_data['FullName'] = $result['fullName'];
                        $email_data['Subject'] = 'Khôi phục mật khẩu';
                        $email_data['Page'] = '
                        Hãy bấm vào liên kết bên dưới để khôi phục mật khẩu của bạn: </br>
                        <a href="' . SITE_URL . '/recovery?email=' . base64_encode($result['email']) . '&token=' . $token . '">' . SITE_URL . '/recovery?token=' . $token . '</a>';

                        Helper::sendMail($email_data);

                        $errors[] = ["status" => "OK", "message" => " Hãy kiểm tra email của bạn"];
                    } catch (Exception $e) {
                        $errors[] = ["status" => "ERROR", "message" => " Đã xảy ra lỗi vui lòng thử lại"];
                    }
                }
            }
        }

        $this->view("page-full", [
            "Page" => "forgot_password",
            "Title" => "Quen mat khau",
            "Errors" => $errors
        ]);
    }
}