<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-8 small-12 large-5">
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
    <form action="" method="post" id="login-form">
      <input class="form-control" id="username" name="username" type="text"
        value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>" size="30" required
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
        <a href="<?= SITE_URL ?>/forgot">Quên mật khẩu?</a>
      </p>
    </form>
    <div class="contact-icon text-center">
      <h6>Hoặc đăng nhập bằng:</h6>
      <ul class="social-media" id="socialauth">
        <li>
          <a class="facebook" href="<?= SITE_URL; ?>/socialauth/facebook"> <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="" href="<?= SITE_URL; ?>/socialauth/zalo"> <img
              src="https://cdn1.iconfinder.com/data/icons/logos-brands-in-colors/2500/zalo-seeklogo.com-512.png" alt="">
          </a>
        </li>
        <li>
          <a class="linkedin" href="<?= SITE_URL; ?>/socialauth/gmail" target="blank">
            <i class="fab fa-google"></i>
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