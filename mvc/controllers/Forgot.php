<?php

use Core\HandleForm;

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
                    $mail = new PHPMailer(true);
                    $token = md5(time().rand(0, 9999));

                    try {
                        $this->PwReset->insert('password_reset', [
                            'token' => $token,
                            'email' => $email,
                            'created_at' => date('Y-m-d H:i:s', time())
                        ]);

                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'baondgps16885@fpt.edu.vn';                     //SMTP username
                        $mail->Password   = 'gecztawxiwvnjphf';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        //Recipients
                        $mail->setFrom('no-reply@giabao.com', 'Gia bao');
                        $mail->addAddress($email);               //Name is optional
                        $mail->addReplyTo('no-reply@giabao.com', 'Gia bao');
                    
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Khôi phục mật khẩu';
                        $mail->Body    = '
                            Hãy bấm vào liên kết bên dưới để khôi phục mật khẩu của bạn: </br>
                            <a href="http://localhost/du_an_1/recovery?token='.$token.'">http://localhost/du_an_1/recovery?token='.$token.'</a>
                        ';
                    
                        $mail->send();
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
