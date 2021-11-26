<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Helper
{

  public static function sendTelegram($data)
  {
    $chatID = '-702325711';
    $token = 'bot2129085748:AAFJbpweBEngncg8psfE-wdIyDMoU1JKvPE';
    $url = "https://api.telegram.org/" . $token . "/sendMessage?parse_mode=html&chat_id=" . $chatID;
    $message = "<b>Đơn hàng mới <i>#" . $data['orderId'] . "</i></b>
    \nTổng: " . $data['total'] . " VNĐ
    \n <b>Thông tin khách hàng</b>
    \n Họ và tên: " . $data['fullName'] . "
    \n Số điện thoại: " . $data['mobile'] . "
    \n Địa chỉ: " . $data['address'] . "
    ";
    $url = $url . "&text=" . urlencode($message);
    file_get_contents($url);
  }
  public static function sendMail($data)
  {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
      $mail->isSMTP(); //Send using SMTP
      $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
      $mail->SMTPAuth = true; //Enable SMTP authentication
      $mail->Username = 'trungnghia191919@gmail.com'; //SMTP username
      $mail->Password = 'muwprjepewtknlwh'; //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
      $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      $mail->CharSet = 'UTF-8';
      //Recipients
      $mail->setFrom('trungnghia191919@gmail.com', 'Foodo');
      $mail->addAddress($data["Email"], $data["FullName"]); //Add a recipient
      // $mail->addAddress('ellen@example.com'); //Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

      //Content
      $mail->isHTML(true); //Set email format to HTML
      $mail->Subject = $data["Subject"];
      $mail->Body = $data["Page"];
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
      return true;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  public static function PaymentMethods($method)
  {
    switch ($method) {
      case "cod":
        return "Trả tiền mặt khi nhận hàng";
      case "bacs":
        return "Chuyển khoản ngân hàng";
      case "credit":
        return "Thanh Toán Thẻ Visa/Master";
    }
  }
  public static function VNpayCreatePayment(int $orderId, float $total, string $bankCode)
  {
    $vnp_TmnCode = "RF17G16Z"; //Mã website tại VNPAY
    $vnp_HashSecret = "GTODSRNPZFJLHQCGAVKICUYJTOFJDSVL"; //Chuỗi bí mật
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = SITE_URL . "/checkout/OrderReceived/" . $orderId;
    ///////////////////
    $vnp_TxnRef = $orderId;
    $vnp_OrderInfo = 'Thanh toán hoa đơn số: ' . $vnp_TxnRef;
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $total * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = $bankCode;
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $inputData = array(
      "vnp_Version" => "2.0.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
      } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
      $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
      'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    );
    return json_encode($returnData);
  }
  public static function cc($order)
  {
    $vnp_HashSecret = "GTODSRNPZFJLHQCGAVKICUYJTOFJDSVL"; //Chuỗi bí mật
    ///////////////////
    $inputData = array();
    $returnData = array();
    $data = $_REQUEST;
    foreach ($data as $key => $value) {
      if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
      }
    }
    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHashType']);
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashData = $hashData . '&' . $key . "=" . $value;
      } else {
        $hashData = $hashData . $key . "=" . $value;
        $i = 1;
      }
    }
    $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
    $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
    //$secureHash = md5($vnp_HashSecret . $hashData);
    $secureHash = hash('sha256', $vnp_HashSecret . $hashData);
    $Status = 0;
    $orderId = $inputData['vnp_TxnRef'];
    $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
    try {
      //Check Orderid
      //Kiểm tra checksum của dữ liệu
      if ($secureHash == $vnp_SecureHash) {
        if ($order != NULL) {
          if ($order["total"] == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng.
          //$order["Amount"] == $vnp_Amount
          {
            if ($order["status"] != NULL && $order["status"] == 2) {
              if ($inputData['vnp_ResponseCode'] == '00') {
                $returnData['RspCode'] = '00';
                $returnData['Message'] = 'Confirm Success';
              } else {
                $returnData['RspCode'] = '02';
                $returnData['Message'] = 'Order already confirmed';
              }
            }
          } else {
            $returnData['RspCode'] = '04';
            $returnData['Message'] = 'invalid amount';
          }
        } else {
          $returnData['RspCode'] = '01';
          $returnData['Message'] = 'Order not found';
        }
      } else {
        $returnData['RspCode'] = '97';
        $returnData['Message'] = 'Invalid signature';
      }
    } catch (Exception $e) {
      $returnData['RspCode'] = '99';
      $returnData['Message'] = 'Unknow error';
    }
    //Trả lại VNPAY theo định dạng JSON
    return json_encode($returnData);
  }
  public static function Pagination($base_url, $totalPost, $page, $perPage)
  {
    if ($page <= 0) return "";
    $totalPages = ceil($totalPost / $perPage);
    if ($totalPages <= 1) return "";
    $links = "<nav class='pagination'><ul class='page-numbers nav-pagination links text-center'>";
    if ($page > 1) {
      $first = "<li><a class='page-number' href='{$base_url}?page=1'>
      << </a>
  </li>";
      $page_prev = $page - 1;
      $prev = "<li><a class='page-number' href='{$base_url}?page={$page_prev}'>
      < </a>
  </li>";
      $links .= $first . $prev;
    }
    $from = $page - 3;
    $to = $page + 3;
    if ($from < 1) $from = 1;
    if ($to > $totalPages) $to = $totalPages;
    for ($i = $from; $i <= $to; $i++) {
      if ($i == $page) {
        $str = "<li><span class='page-number current'>{$i}<span></li>";
      } else {
        $str = "<li><a class='page-number' href='{$base_url}?page={$i}'> {$i} </a></li>";
      }
      $links .= $str;
    }
    if ($page < $totalPages) {
      $page_next = $page + 1;
      $next = "<li><a class='page-number' href='{$base_url}?page={$page_next}'> > </a></li>";
      $last = "<li><a class='page-number' href='{$base_url}?page={$totalPages}'> >> </a></li>";
      $links .= $next . $last;
    }
    $links .= "</ul> </nav>";
    return $links;
  }
  public static function to_slug($str)
  {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
  }
}
