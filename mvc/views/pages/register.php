<?php

$social_user = $data['SocialUser'];
$username = isset($_POST['username']) ? $_POST['username'] : $social_user['username']  ?? '';
$email = isset($_POST['email']) ? $_POST['email'] : $social_user['email']  ?? '';
$avatar = isset($social_user['avatar']) ? $social_user['avatar'] : '';
$fullName = isset($social_user['name']) ? $social_user['name'] : '';
$social = isset($social_user['social']) ? $social_user['social'] : '';

?>
<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-8 small-12 large-5">
    <?php if ($social) : ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Đang được liên kết với tài khoản <?= $social ?>: <strong><?= $social_user['name'] ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php endif ?>
    <?php foreach ($data["Errors"] as $error) :
      $class = $error["status"] == "ERROR" ? "alert-danger" : "alert-success";
    ?>
      <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
        <?= $error["message"] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php endforeach ?>
    <form action="" method="post" class="needs-validation" novalidate>
      <div class="form-group">
        <input class="form-control" id="username" name="username" type="text" value="<?= htmlspecialchars($username  ?? ''); ?>" size="30" required placeholder="Tên đăng nhập *" />
      </div>
      <div class="form-group">
        <input class="form-control" id="phone" name="mobile" type="tel" value="<?= htmlspecialchars($_POST['mobile'] ?? ''); ?>" size="30" required pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})" placeholder="Số điện thoại *" />
      </div>
      <div class="form-group">
        <input class="form-control" id="email" name="email" type="email" value="<?= htmlspecialchars($email ?? ''); ?>" size="30" required placeholder="Địa chỉ Email *" />
      </div>
      <div class="form-group">
        <input class="form-control" id="password" name="password" type="password" value="" required placeholder="Mật khẩu *" autocomplete="off" />
      </div>
      <div class="form-group">
        <input class="form-control" id="re_password" name="re_password" type="password" value="" required placeholder="Nhập lại mật khẩu *" autocomplete="off" />
      </div>
      <div class="form-group">
        <input class="form-control" id="avatar" name="avatar" type="hidden" value="<?= $avatar; ?>" />
        <input class="form-control" id="fullName" name="fullName" type="hidden" value="<?= $fullName; ?>" />
        <input class="form-control" id="social" name="social" type="hidden" value="<?= $social; ?>" />
      </div>
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="reg_user" class="button primary">
          ĐĂNG KÝ
        </button>
      </div>
    </form>
    <div class="contact-icon text-center">
      <h6>Hoặc đăng ký bằng:</h6>
      <ul class="social-media" id="socialauth">
        <li>
          <a class="facebook" href="<?= SITE_URL; ?>/socialauth/facebook"> <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="zalo" href="<?= SITE_URL; ?>/socialauth/zalo"><img src="https://cdn1.iconfinder.com/data/icons/logos-brands-in-colors/2500/zalo-seeklogo.com-512.png" alt="">
          </a>
        </li>
        <li>
          <a class="google" href="<?= SITE_URL; ?>/socialauth/gmail" target="blank">
            <i class="fab fa-google"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>