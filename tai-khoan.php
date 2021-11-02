<?php
if (!isset($userID)) {
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
$mobile = "";
$email = "";
$errors = array();
if (isset($_POST['update_user'])) {
  // receive all input values from the form

  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $fullName = $conn->real_escape_string($_POST['fullName']);
  $address = $conn->real_escape_string($_POST['address']);
  $gender = $conn->real_escape_string($_POST['gender']);
  if (empty($mobile)) {
    array_push($errors, "Mobile bắt buốc");
  }
  if (empty($email)) {
    array_push($errors, "Email bắt buộc");
  }
  $user_check_query = "SELECT * FROM ps_users WHERE (email='$email' OR mobile='$mobile') AND NOT id = '$userID' LIMIT 1";
  $user = $conn->query($user_check_query)->fetch_assoc();
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email đã tồn tại");
    }
    if ($user['mobile'] === $mobile) {
      array_push($errors, "mobile đã tồn tại");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    if (isset($_FILES["avatar"]) && !empty($_FILES["avatar"]['name'])) {
      $query = "SELECT avatar FROM ps_users WHERE id = $userID";
      $user = $conn->query($query)->fetch_assoc();
      if ($user['avatar'] != NULL) {
        $file_path = $user['avatar'];
        unlink($file_path);
      }
      move_uploaded_file($_FILES['avatar']['tmp_name'], './assets/img/' . basename($_FILES['avatar']['name']));
      $avatar = './assets/img/' . basename($_FILES['avatar']['name']);
      $query = "UPDATE ps_users SET avatar = '$avatar' WHERE id= $userID";
      $conn->query($query);
    }
    $query = "UPDATE ps_users SET mobile = '$mobile', email = '$email', fullName = '$fullName' , address = '$address' , gender = $gender WHERE id='$userID'";
    $conn->query($query);
  }
}
?>
<?php
$sql = "select * from ps_users where id='$userID'";
$result = $conn->query($sql)->fetch_assoc();
?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">
    <div class="account-user">
      <span class="image">
        <img alt=""
          src="<?php echo $result['avatar'] == null ? './assets/img/avatar-default.png' : $result['avatar']; ?>"
          height="70" width="70">
      </span>
      <span class="user-name">
        <?php echo $result['username']; ?>
      </span>

    </div>
    <ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

      <li class="mycccount-navigation-link active">
        <a href="./index.php?action=tai-khoan">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=don-hang">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=doi-mat-khau">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=tai-khoan&logout">Thoát</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">


    <p>
      Xin chào <strong><?php echo $result['username']; ?></strong> (không phải tài khoản
      <strong><?php echo $result['username']; ?></strong>? Hãy <a href="./tai-khoan.php?logout"><strong>thoát
          ra</strong></a> và
      đăng nhập vào tài khoản của bạn)
    </p>

    <?php if (count($errors) > 0) : ?>
    <div class="error">
      <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
      <?php endforeach ?>
    </div>
    <?php elseif (isset($_POST['update_user'])) : ?>
    <p class="note">Cập nhật thành công</p>
    <?php endif ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="avatar-upload">
        <div class="avatar-edit">
          <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
          <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
        </div>
        <div class="avatar-preview">
          <div id="imagePreview"
            style="background-image: url(<?php echo $result['avatar'] == null ? './assets/img/avatar-default.png' : $result['avatar']; ?>);">
          </div>
        </div>
      </div>
      <input class="form-control" id="username" name="username" type="text" value="<?php echo $result['username']; ?>"
        required disabled />
      <input class="form-control" id="phone" name="mobile" type="tel" value="<?php echo $result['mobile']; ?>" required
        placeholder="Số điện thoại *" />
      <input class="form-control" id="email" name="email" type="email" value="<?php echo $result['email']; ?>" required
        placeholder="Địa chỉ Email *" />
      <input class="form-control" id="email" name="fullName" type="text" value="<?php echo $result['fullName']; ?>"
        required placeholder="Họ và tên" />
        <input type="radio" id="male" name="gender" value="0" <?php echo $result['gender'] == 0 ? 'checked' : '' ?>>
        <label for="male">Nam</label><br>
        <input type="radio" id="female" name="gender" value="1" <?php echo $result['gender'] == 1 ? 'checked' : '' ?>>
        <label for="female">Nữ</label>
      <input class="form-control" id="email" name="address" type="text" value="<?php echo $result['address']; ?>"
        required placeholder="Địa chỉ" />
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="update_user" class="button primary">
          Cập nhật
        </button>
      </div>
    </form>
  </div>
</div>