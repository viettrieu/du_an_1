<?php

use Core\Helper;
use Core\HandleForm;
use Core\Address;

class Account extends Controller
{
  public $User;
  public $Orders;
  public $UserById;
  public $Coupon;
  public $Transport;
  function __construct()
  {
    $this->User = $this->model("UserModel");
    $this->Orders = $this->model("OrderModel");
    $this->Coupon = $this->model("CouponModel");
    $this->Transport = $this->model("TransportModel");
    if (!isset($_SESSION["user"])) {
      header("Location: " . SITE_URL . "/login");
    } else {
      $userlg = $_SESSION["user"];
      $this->UserById = $this->User->GetUserById($userlg["username"]);
    }
  }

  function SayHi()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->update_user)) {
      $fullName = HandleForm::rip_tags($request->fullName);
      $mobile = HandleForm::rip_tags($request->mobile);
      $email = HandleForm::rip_tags($request->email);
      $gender =  (bool)$request->gender;
      $ward = HandleForm::rip_tags($request->ward);
      $district = HandleForm::rip_tags($request->district);
      $province = HandleForm::rip_tags($request->province);
      $address = HandleForm::rip_tags($request->address);
      $errors = HandleForm::validations([
        [$fullName, 'required', 'Vui lòng nhập lại họ tên'],
        [$mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$email, 'email', 'Vui lòng điền đúng Email'],
        [$province, 'required', 'Vui lòng chọn Tỉnh/Thành phố'],
        [$district, 'required', 'Vui lòng chọn Quận/Huyện'],
        [$ward, 'required', 'Vui lòng chọn Xã/Phường/Thị trấn'],
        [$address, 'required', 'Vui lòng điền địa chỉ nhận hàng'],
      ]);
      $avatar = HandleForm::upload($_FILES["avatar"], ['jpeg', 'jpg', 'png'], 500000,  "./public/img/");
      if (!$avatar[0]) {
        $errors[] = ["status" => "ERROR", "message" => $avatar[1]];
      }
      $user = $this->User->GetUserById(0, $email, $mobile, "NOT id = " . (int)$_SESSION["user"]["id"]);
      if ($user) {
        if ($user['email'] == $email)
          $errors[] = ["status" => "ERROR", "message" => "Email đã tồn tại"];
        if ($user['mobile'] == $mobile)
          $errors[] = ["status" => "ERROR", "message" => "Số điện thoại đã tồn tại"];
      }
      $data = array(
        "fullName" => $fullName,
        "mobile" => $mobile,
        "email" => $email,
        "address" => $address,
        "ward" => $ward,
        "district" => $district,
        "province" => $province,
        "gender" => $gender,
        "avatar" => $avatar[1] == NULL ? $this->UserById["avatar"] : SITE_URL . '' . $avatar[1],
      );
      if (count($errors) == 0) {
        $cond = "id = " . (int) $_SESSION["user"]["id"];
        $result = $this->User->UpdateUserBy($data, $cond);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công thành viên <strong>" . $_SESSION["user"]["username"] . "</strong>"];
        }
      }
    }
    $UserById = $this->User->GetUserById($_SESSION["user"]["username"]);
    $this->view("page-full", [
      "Page" => "account",
      "Title" => "Tài khoản",
      "UserById" => $UserById,
      "Errors" => $errors,
      "Province" => Address::Province(),
      "District" =>  isset($UserById['province']) ? Address::District($UserById['province']) : [],
      "Ward" => isset($UserById['district']) ? Address::Ward($UserById['district']) : [],
    ]);
  }
  public function Orders()
  {
    $this->view("page-full", [
      "Page" => "orders",
      "Title" => "Đơn Hàng",
      "UserById" => $this->UserById,
      "Orders" => $this->Orders->GetOrderByUser($this->UserById["id"])
    ]);
  }
  public function ViewOrder($id = 0)
  {
    $order = $this->Orders->GetOrderById($id);
    if ($order == NULL || $order["userId"] != $this->UserById["id"]) {
      $order = false;
    } else {
      $status = $this->Orders->GetOrderStatus("id= " . $order['status']);
      $order['status'] = $status[0]["status"];
      $order['transaction'] = Helper::PaymentMethods($order['transaction']);
    }
    if (isset($order['idCoupon'])) {
      $coupon = $this->Coupon->GetCoupon('id = ' . (int)$order['idCoupon']);
      $order["coupon"] = $coupon['code'];
    }
    $this->view("page-full", [
      "Page" => "view-order",
      "Title" => "Chi tiết đơn hàng",
      "UserById" => $this->UserById,
      "Order" => $order,
      "Items" => $this->Orders->GetOrderItemById($id),
      "Transport" => $this->Transport->GetId($id),
    ]);
  }

  public function ChangePassword()
  {

    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->update_pass)) {
      $errors = HandleForm::validations([
        [$request->password, 'required', 'Vui lòng nhập vào mật khẩu cũ'],
        [$request->passwordnew, 'required', 'Vui lòng nhập vào mật khẩu mới'],
        [$request->re_passwordnew, 'required', 'Vui lòng nhập lại mật khẩu'],
      ]);
      $password =  HandleForm::rip_tags($request->password);
      $passwordnew = HandleForm::rip_tags($request->passwordnew);
      $re_passwordnew =  HandleForm::rip_tags($request->re_passwordnew);
      $user = $this->User->GetUserById($_SESSION["user"]["username"]);
      if ($user) {
        $md5password = md5($password);
        if ($user['passwordHash'] != $md5password)
          $errors[] = ["status" => "ERROR", "message" => "Mật khẩu cũ không đúng"];

        if ($passwordnew != $re_passwordnew)
          $errors[] = ["status" => "ERROR", "message" => "Hai mật khẩu không giống nhau"];
      }
      if (count($errors) == 0) {
        $md5password = md5($passwordnew);
        $data = array("passwordHash" => $md5password);
        $username = $_SESSION["user"]["username"];
        $cond = "username = '$username'";
        $this->User->UpdateUserBy($data, $cond);
        $errors[] = ["status" => "OK", "message" => "Cập nhật thành công"];
      }
    }
    $this->view("page-full", [
      "Page" => "change-password",
      "Title" => "Đổi mật khẩu",
      "UserById" => $this->UserById,
      "Errors" => $errors,
    ]);
  }
  public function UserLogout()
  {
    unset($_SESSION['user']);
    header("Location: " . SITE_URL . "/login");
  }
  function error404()
  {
    $this->view("page-full", [
      "Page" => "404",
    ]);
  }
}