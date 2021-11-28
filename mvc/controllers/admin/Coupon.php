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
      $code = HandleForm::rip_tags($_POST['code']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $type = (int)HandleForm::rip_tags($_POST['coupon-type']);
      $discount = (int)HandleForm::rip_tags($_POST['discount']);
      $minOrder = (int)HandleForm::rip_tags($_POST['minOrder']);
      $usageLimit = (int)HandleForm::rip_tags($_POST['usageLimit']);
      $startDate = HandleForm::rip_tags($_POST['startDate']);
      $expiryDate = HandleForm::rip_tags($_POST['expiryDate']);
      $errors = HandleForm::validations([
        [$code, 'required', 'Vui lòng nhập coupon'],
        [$discount, 'Nmin:0', 'Giá trị phải lớn hơn 0'],
        [$minOrder, 'Nmin:0', 'Đơn hàng tối thiểu phải lớn hơn 0'],
        [$usageLimit, 'Nmin:0', 'Số lần sử dụng phải lớn hơn 0'],
        [strtotime($startDate), 'Nmax:' . strtotime($expiryDate), 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc'],
      ]);
      $data = array(
        "code" => $code,
        "summary" => $summary,
        "type" => $type,
        "discount" => $discount,
        "minOrder" => !empty($minOrder) ? $minOrder : NULL,
        "usageLimit"  => !empty($usageLimit) ? $usageLimit : NULL,
        "startDate" => !empty($startDate) ?  date("Y-m-d", strtotime($startDate)) : NULL,
        "expiryDate" => !empty($expiryDate) ? date("Y-m-d", strtotime($expiryDate)) : NULL,
      );
      if (count($errors) == 0) {
        $InsertCoupon = $this->listCoupon->InsertCoupon($data);
        if ($InsertCoupon) {
          unset($_POST);
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
      $code = HandleForm::rip_tags($_POST['code']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $type = (int)HandleForm::rip_tags($_POST['coupon-type']);
      $discount = (int)HandleForm::rip_tags($_POST['discount']);
      $minOrder = (int)HandleForm::rip_tags($_POST['minOrder']);
      $usageLimit = (int)HandleForm::rip_tags($_POST['usageLimit']);
      $startDate = HandleForm::rip_tags($_POST['startDate']);
      $expiryDate = HandleForm::rip_tags($_POST['expiryDate']);
      $errors = HandleForm::validations([
        [$code, 'required', 'Vui lòng nhập coupon'],
        [$discount, 'Nmin:0', 'Giá trị phải lớn hơn 0'],
        [$minOrder, 'Nmin:0', 'Đơn hàng tối thiểu phải lớn hơn 0'],
        [$usageLimit, 'Nmin:0', 'Số lần sử dụng phải lớn hơn 0'],
        [strtotime($startDate), 'Nmax:' . strtotime($expiryDate), 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc'],
      ]);
      $data = array(
        "code" => $code,
        "summary" => $summary,
        "type" => $type,
        "discount" => $discount,
        "minOrder" => !empty($minOrder) ? $minOrder : NULL,
        "usageLimit"  => !empty($usageLimit) ? $usageLimit : NULL,
        "startDate" => !empty($startDate) ?  date("Y-m-d", strtotime($startDate)) : NULL,
        "expiryDate" => !empty($expiryDate) ? date("Y-m-d", strtotime($expiryDate)) : NULL,
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
}