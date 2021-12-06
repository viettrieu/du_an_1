<?php

use Core\HandleForm;

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
        $errors = array();
        $request = json_decode(json_encode($_POST));

        if (empty($_GET['token'])) {
            header("Location: " . SITE_URL . "/");
            exit();
        }
        $token = $_GET['token'];
        $is_valid = $this->PwReset->checkValidToken($token);
        if (!$is_valid) {
            header("Location: " . SITE_URL . "/");
            exit();
        }
        if (isset($request->recovery_password)) {
            $errors = HandleForm::validations([
                [$request->new_password, 'required', 'Vui lòng nhập mật khẩu mới của bạn'],
                [$request->password_confirm, 'required', 'Vui lòng nhập lại mật khẩu bạn'],
                [$request->new_password, 'min:6', 'Mật Khẩu Mới Tối Thiểu Phải Có 6 Ký Tự'],
                [$request->new_password, 'max:15', 'Mật Khẩu Mới Không Được Quá 15 Ký Tự'],
                [$request->password_confirm, 'confirmed:' . $request->new_password, 'Nhập Lại Mật Khẩu Phải Khớp Với Nhau'],
            ]);
            $method = $is_valid['method'];
            if (count($errors) == 0) {
                $this->User->UpdateUserBy([
                    'passwordHash' => md5($request->new_password)
                ], "email = '$method' OR mobile = '$method'");
                $this->PwReset->delete('password_reset', "method = '$method'");
                $_SESSION['errors'] = ["status" => "OK", "message" => "Tài khoản có '$method' đã đổi pass thành công"];
                header("Location: " . SITE_URL . "/login");
                exit();
            }
        }

        $this->view("page-full", [
            "Page" => "recovery_password",
            "Title" => "Khôi Phục Mật Khẩu",
            "Errors" => $errors,
        ]);
    }
}