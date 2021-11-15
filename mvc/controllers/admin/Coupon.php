<?php

use Core\HandleForm;

class Coupon extends Controller
{
  public $listCoupon;

  function __construct()
  {
    $this->listCoupon = $this->model("CouponModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "coupon",
      "ListCoupon" => $this->listCoupon->GetAllCoupon(),
      "Title" => "Coupon",
    ]);
  }
  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));

    if (isset($request->create_coupon)) {
      $errors = HandleForm::validations([
        [$request->code, 'required', 'Vui lòng nhập coupon'],
      ]);
      $code = HandleForm::rip_tags($_POST['code']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float)HandleForm::rip_tags($_POST['discount']);
      $expiryDate = HandleForm::rip_tags($_POST['expiryDate']);
      $usageLimit = HandleForm::rip_tags($_POST['usageLimit']);
      $data = array(
        "code" => $code,
        "summary" => $summary,
        "discount" => $discount,
        "expiryDate" => $expiryDate,
        "usageLimit" => $usageLimit,
      );
      if (count($errors) == 0) {
        $InsertCoupon = $this->listCoupon->InsertCoupon($data);
        if ($InsertCoupon) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công sản phẩm <strong>" . $code . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "create-coupon",
      "Title" => "Coupon",
      "Errors" => $errors,
    ]);
  }
  function Edit($id = 0)
  {
    $coupon = $this->listCoupon->GetCoupon('id = ' . $id);
    if ($coupon == NULL) {
      header("Location: " . ADMIN_URL . "/coupon");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_coupon)) {
      $errors = HandleForm::validations([
        [$request->code, 'required', 'Vui lòng nhập coupon'],
      ]);
      $code = HandleForm::rip_tags($_POST['code']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float)HandleForm::rip_tags($_POST['discount']);
      $expiryDate = HandleForm::rip_tags($_POST['expiryDate']);
      $usageLimit = HandleForm::rip_tags($_POST['usageLimit']);
      $data = array(
        "code" => $code,
        "summary" => $summary,
        "discount" => (int)$discount,
        "expiryDate" => $expiryDate,
        "usageLimit" => (int)$usageLimit,
      );
      if (count($errors) == 0) {
        $UpdateCoupon = $this->listCoupon->UpdateCoupon($data, "id = " . $id);
        if ($UpdateCoupon) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công coupon <strong>" . $code . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "edit-coupon",
      "Title" => "Chỉnh sửa coupon",
      "Coupon" => $this->listCoupon->GetCoupon('id = ' . $id),
      "Errors" => $errors,
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result = $this->listCoupon->DeleteCoupon($cond);
    if ($result) {
      echo json_encode($result);
    }

    exit();
  }
  function check($id = 0)
  {
    $errors = array();
    $coupon = $this->listCoupon->GetCoupon($id);
    if ($coupon == NULL) {
      $errors[] = ["status" => "ERROR", "message" => "Coupon không tồn tại"];
    } else {
      $errors = HandleForm::validations([
        [$coupon['expiryDate'], 'future', 'Mã giảm giá hết hạn'],
      ]);
    }
    var_dump($errors);
  }
}