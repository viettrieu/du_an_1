<?php
if (isset($userID)) {
  echo ("<script>location.href = './index.php?action=tai-khoan';</script>");
}
$username = "";
$mobile = "";
$email = "";
$errors = array();
if (isset($_POST['reg_user'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);
  $re_password = $conn->real_escape_string($_POST['re_password']);

  if (empty($username)) {
    array_push($errors, "Username bắt buốc");
  }
  if (empty($mobile)) {
    array_push($errors, "Mobile bắt buốc");
  }
  if (empty($email)) {
    array_push($errors, "Email bắt buộc");
  }
  if (empty($password)) {
    array_push($errors, "Mật khẩu là bắt buộc");
  }
  if ($password != $re_password) {
    array_push($errors, "Hai mật khẩu không giống nhau");
  }
  $user_check_query = "SELECT * FROM ps_users WHERE username='$username' OR email='$email' OR mobile='$mobile' LIMIT 1";
  $user = $conn->query($user_check_query)->fetch_assoc();

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username đã tồn tại");
    }
    if ($user['email'] === $email) {
      array_push($errors, "email đã tồn tại");
    }
    if ($user['mobile'] === $mobile) {
      array_push($errors, "Số điện thoại đã tồn tại");
    }
  }
  if (count($errors) == 0) {
    $md5password = md5($password);
    $query = "INSERT INTO ps_users (username, mobile, email, passwordHash)
  			  VALUES('$username','$mobile','$email', '$md5password')";
    $conn->query($query);
    $_SESSION['username'] = $username;
    echo "<script>location.href = './index.php?action=tai-khoan';</script>";
  }
}
?>

<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-8 small-12 large-5">
    <?php if (count($errors) > 0) : ?>
    <div class="error">
      <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
      <?php endforeach ?>
    </div>
    <?php endif ?>
    <form action="" method="post">
      <input class="form-control" id="username" name="username" type="text" value="<?php echo $username; ?>" size="30"
        required placeholder="Tên đăng nhập *" />
      <input class="form-control" id="phone" name="mobile" type="tel" value="<?php echo $mobile; ?>" size="30" required
        placeholder="Số điện thoại *" />
      <input class="form-control" id="email" name="email" type="email" value="<?php echo $email; ?>" size="30" required
        placeholder="Địa chỉ Email *" />
      <input class="form-control" id="password" name="password" type="password" value="" required
        placeholder="Mật khẩu *" autocomplete="off" />
      <input class="form-control" id="re_password" name="re_password" type="password" value="" required
        placeholder="Nhập lại mật khẩu *" autocomplete="off" />
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="reg_user" class="button primary">
          ĐĂNG KÝ
        </button>
      </div>
    </form>
    <div class="contact-icon text-center">
      <h6>Hoặc đăng ký bằng:</h6>
      <ul class="social-media">
        <li>
          <a class="facebook" href="https://www.facebook.com/share.php?u={{url}}&amp;title={{title}}" target="blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="twitter" href="https://twitter.com/intent/tweet?status={{title}}+{{url}}" target="blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a class="linkedin"
            href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url}}&amp;title={{title}}&amp;source={{source}}"
            target="blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </li>
        <li>
          <a class="pinterest"
            href="https://pinterest.com/pin/create/bookmarklet/?media={{media}}&amp;url={{url}}&amp;is_video=false&amp;description={{title}}"
            target="blank">
            <i class="fab fa-pinterest"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>