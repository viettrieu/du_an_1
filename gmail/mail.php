<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require './PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
$last_id = $_POST['last_id'];
$email = $_POST['email'];
$fullName = $_POST['fullName'];
try {

    $mail->SMTPDebug = 0;                  //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'trungnghia191919@gmail.com';                     //SMTP username
    $mail->Password   = 'trryunuvpshnmryr';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have
    //Recipients
    $mail->setFrom('trungnghia191919@gmail.com', 'Foodo');
    $mail->addAddress($email, $fullName);     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    ob_start();
    include('./demo.php');
    $body = ob_get_clean();
    $mail->Body    = $body;

    $mail->send();
    echo json_encode('Message has been sent');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}