<?php
if (isset($userID)) {
  echo ("<script>location.href = './index.php?action=tai-khoan';</script>");
}
$errors = array();
if (isset($_POST['login_user'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);
  if (empty($username)) {
    array_push($errors, "Nhập vào tên");
  }
  if (empty($password)) {
    array_push($errors, "Nhập vào mật khẩu");
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT ps_users.id FROM ps_users WHERE (username='$username' OR email='$username' OR mobile='$username') AND passwordHash='$password' LIMIT 1";
    $results = $conn->query($query);
    if ($results->num_rows == 1) {
      $user = $results->fetch_assoc();
      $_SESSION['username'] = $username;
      setcookie("username", $username, time() + 86400  * 7, "/");
      setcookie("password", $password, time() + 86400  * 7, "/");
      echo ("<script>location.href = './index.php?action=tai-khoan';</script>");
    } else {
      array_push($errors, "Sai xác thực tên người dùng / mật khẩu");
    }
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
    <form action="" method="post" id="login-form">
      <input class="form-control" id="username" name="username" type="text" value="" size="30" required
        placeholder="Email / Số điện thoại / Tên đăng nhập" />
      <input class="form-control" id="password" name="password" type="password" value="" placeholder="Mật khẩu" required
        autocomplete="off" />
      <input id="cookies-consent" name="cookies-consent" type="checkbox" value="yes" />
      <label for="cookies-consent"> Ghi nhớ mật khẩu</label>
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" form="login-form" value="Submit" name="login_user" class="button primary">
          ĐĂNG NHẬP
        </button>
      </div>
      <p class="lost-password">
        <a href="#lost-password">Quên mật khẩu?</a>
      </p>
    </form>
    <div class="contact-icon text-center">
      <h6>Hoặc đăng nhập bằng:</h6>
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