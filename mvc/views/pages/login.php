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