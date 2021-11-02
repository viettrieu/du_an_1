<?php
if (!isset($userID)) {
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
$errors = array();
if (isset($_POST['update_pass'])) {
  $password = $conn->real_escape_string($_POST['password']);
  $passwordnew = $conn->real_escape_string($_POST['passwordnew']);
  $re_passwordnew = $conn->real_escape_string($_POST['re_passwordnew']);
  $user_check_query = "SELECT * FROM ps_users WHERE id = '$userID' LIMIT 1";
  $user = $conn->query($user_check_query)->fetch_assoc();
  if ($user) {
    $md5password = md5($password);
    if ($user['passwordHash'] != $md5password) {
      array_push($errors, "Mật khẩu cũ không  đúng");
    } else {
      if (empty($password)) {
        array_push($errors, "Mật khẩu là bắt buộc");
      }
      if ($passwordnew != $re_passwordnew) {
        array_push($errors, "Hai mật khẩu không giống nhau");
      }
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $md5password = md5($passwordnew);
    $query = "UPDATE ps_users SET passwordHash = '$md5password' WHERE id='$userID'";
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

      <li class="mycccount-navigation-link">
        <a href="./index.php?action=tai-khoan">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=don-hang">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link active">
        <a href="./index.php?action=doi-mat-khau">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=tai-khoan&logout">Thoát</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">
    <?php if (count($errors) > 0) : ?>
    <div class="error">
      <?php foreach ($errors as $error) : ?>
      <p class="note"><?php echo $error ?></p>
      <?php endforeach ?>
    </div>
    <?php elseif (isset($_POST['update_pass'])) : ?>
    <p class="note">Cập nhật thành công</p>
    <?php endif ?>
    <form action="" method="post" enctype="multipart/form-data">
      <input class="form-control" id="password" name="password" type="password" value="" required
        placeholder="Mật khẩu cũ *" autocomplete="off" />
      <input class="form-control" id="password" name="passwordnew" type="password" value="" required
        placeholder="Mật khẩu mới *" autocomplete="off" />
      <input class="form-control" id="re_password" name="re_passwordnew" type="password" value="" required
        placeholder="Nhập lại mật khẩu mới *" autocomplete="off" />
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="update_pass" class="button primary">
          Cập nhật
        </button>
      </div>
    </form>
  </div>
</div>