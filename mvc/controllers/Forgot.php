<?php

use Core\HandleForm;
use Core\Helper;
use GuzzleHttp\Promise\Is;

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
        $this->view("page-full", [
            "Page" => "forgot_password",
            "Title" => "Quen mat khau",
        ]);
    }
    public function checkExistAccount()
    {
        if (isset($_POST)) {
            $account = HandleForm::rip_tags($_POST['account']);
            if (!isset($account)) {
                echo json_encode(["error" => ["status" => "ERROR", "message" => "Vui lòng điền vào số điện thoại/Email"]]);
                exit();
            }
            $result = $this->User->GetUserByAccount($account);
            if (!$result) {
                echo json_encode(["error" => ["status" => "ERROR", "message" => "Người dùng không tồn tại"]]);
                exit();
            }
            $check = 'email';
            $email = explode("@", $result['email']);
            $mobile = $result['mobile'];
            if ($account == $result['email']) {
                $mobile = Helper::hideString($mobile);
            } elseif ($account == $mobile) {
                $check = 'mobile';
                $email[0] = Helper::hideString($email[0]);
            } else {
                $mobile = Helper::hideString($mobile);
                $email[0] = Helper::hideString($email[0]);
            }
            $email = implode('@', $email);
            echo json_encode(['error' => ['status' => 'OK'], 'account' => $result['username'], 'method' => ['email' => $email, 'mobile' => $mobile], 'check' => $check]);
            exit();
        }
        echo json_encode(["error" => ["status" => "ERROR", "message" => "LỖI"]]);
        exit();
    }

    public function SendToken()
    {
        if (isset($_POST)) {
            $action = HandleForm::rip_tags($_POST['action']);
            $account = HandleForm::rip_tags($_POST['account']);
            $result = $this->User->GetUserByAccount($account);
            if (!$result) {
                echo json_encode(["error" => ["status" => "ERROR", "message" => "Người dùng không tồn tại"]]);
                exit();
            }
            if ($action == "send_email") {
                $token = md5(time() . rand(0, 9999));
                try {
                    $this->PwReset->insert('password_reset', [
                        'token' =>  $token,
                        'method' => $result['email'],
                    ]);
                    $link = SITE_URL . '/recovery?method=' . base64_encode($result['email']) . '&token=' .  $token;
                    $email_data = [];
                    $email_data['Email'] = $result['email'];
                    $email_data['FullName'] = $result['fullName'];
                    $email_data['Subject'] = 'Khôi phục mật khẩu';
                    $email_data['Page'] = '
                            Hãy bấm vào liên kết bên dưới để khôi phục mật khẩu của bạn: </br>
                            <a href="' . $link . '">' . $link . '</a>';
                    Helper::sendMail($email_data);
                    echo json_encode(['error' => ["status" => "OK", "message" => "Hãy kiểm tra email của bạn"]]);
                    $_SESSION['method'] = $result['email'];
                    exit();
                } catch (Exception $e) {
                    echo json_encode([
                        'error' => [
                            "status" => "ERROR",
                            "message" => " Đã xảy ra lỗi vui lòng thử lại"
                        ]
                    ]);
                    exit();
                }
            } elseif ($action == "send_mobile") {
                echo json_encode([
                    'error' => ["status" => "OK", "message" => "Mã xác nhận đã được gửi thành công"],
                    'mobile' => $result['mobile']
                ]);
                $_SESSION['method'] = $result['mobile'];
                exit();
            }
        }
        echo json_encode(['error' => ["status" => "ERROR", "message" => "LỐI"]]);
        exit();
    }
    public function CheckToken()
    {
        if (isset($_POST) && isset($_SESSION['method'])) {
            $action = HandleForm::rip_tags($_POST['action']);
            if ($action == "send_email") {
                $token = HandleForm::rip_tags($_POST['token']);
                $is_valid = $this->PwReset->checkValidToken($token);
                if (!$is_valid) {
                    echo json_encode(["error" => ["status" => "ERROR", "message" => "Nhập sai mã vui lòng kiểm tra lại"]]);
                    exit();
                }
                $link = SITE_URL . '/recovery?method=' . base64_encode($_SESSION['method']) . '&token=' .  $token;
                echo json_encode(["error" => ["status" => "OK", "message" => "Xác nhận thành công"], 'link' => $link]);
                unset($_SESSION['method']);
                exit();
            } elseif ($action == "send_mobile") {
                $token = md5(time() . rand(0, 9999));
                $this->PwReset->insert('password_reset', [
                    'token' =>  $token,
                    'method' => $_SESSION['method'],
                ]);
                $link = SITE_URL . '/recovery?method=' . base64_encode($_SESSION['method']) . '&token=' .  $token;
                echo json_encode(["error" => ["status" => "OK", "message" => "Xác nhận thành công"], 'link' => $link]);
                unset($_SESSION['method']);
                exit();
            }
        }
    }
}