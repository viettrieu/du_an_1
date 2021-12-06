<?php

use Core\HandleForm;

class User extends Controller
{
  public $User;
  function __construct()
  {
    $this->User = $this->model("UserModel");
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "user",
      "Title" => "Thành viên",
      "ListUser" => $this->User->GetAllUser(),
    ]);
  }

  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->reg_user)) {
      $errors = HandleForm::validations([
        [$request->username, 'required', 'Vui lòng nhập vào username'],
        [$request->mobile, 'mobile', 'Vui lòng điền đúng số điện thoại'],
        [$request->email, 'email', 'Vui lòng điền đúng Email'],
        [$request->password, 'required', 'Vui lòng nhập vào mật khẩu'],
      ]);
      if ($request->password != $request->re_password) {
        $errors[] = ["status" => "ERROR", "message" => "Hai mật khẩu không khớp nhau"];
      }
      $username =  HandleForm::rip_tags($request->username);
      $fullName = HandleForm::rip_tags($request->fullName);
      $mobile = HandleForm::rip_tags($request->mobile);
      $email = HandleForm::rip_tags($request->email);
      $gender =  (bool)$request->gender;
      $address = HandleForm::rip_tags($request->address);
      $password = HandleForm::rip_tags($request->password);
      $admin =  (bool)$request->admin;
      $verify = isset($_POST['verify']) ?  (bool)$request->verify : false;
      $avatar = HandleForm::upload($_FILES["avatar"], ['jpeg', 'jpg', 'png'], 5000000,  "/public/img/");
      if (!$avatar[0]) {
        $errors[] = ["status" => "ERROR", "message" => $avatar[1]];
      }
      if ($avatar[1] !== NULL) $avatar[1] = str_replace('./', '/', $avatar[1]);
      $user = $this->User->GetUserById($username, $email, $mobile);
      if ($user) {
        if ($user['username'] == $username)
          $errors[] = ["status" => "ERROR", "message" => "Username đã tồn tại"];
        if ($user['email'] == $email)
          $errors[] = ["status" => "ERROR", "message" => "Email đã tồn tại"];
        if ($user['mobile'] == $mobile)
          $errors[] = ["status" => "ERROR", "message" => "Số điện thoại đã tồn tại"];
      }
      $data = array(
        "admin" => $admin,
        "fullName" => $fullName,
        "username" => $username,
        "mobile" => $mobile,
        "email" => $email,
        "address" => $address,
        "address" => $address,
        "gender" => $gender,
        "verify" => $verify,
        "avatar" => $avatar[1],
      );
      if (count($errors) == 0) {
        $md5password = md5($password);
        $data["passwordHash"] = $md5password;
        $result = $this->User->InsertUser($data);
        if ($result) {
          $errors[] = ["status" => "OK", "message" => " Bạn đã thêm thành công thành viên <strong>" . $request->username . "</strong>"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "create-user",
      "Title" => "Tạo thành viên",
      "Errors" => $errors,
    ]);
  }
  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->User->DeleteUserById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}