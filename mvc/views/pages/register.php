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
    <form action="" method="post">
      <input class="form-control" id="username" name="username" type="text"
        value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>" size="30" required placeholder="Tên đăng nhập *" />
      <input class="form-control" id="phone" name="mobile" type="tel"
        value="<?= htmlspecialchars($_POST['mobile'] ?? ''); ?>" size="30" required
        pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})"
        placeholder="Số điện thoại *" />
      <input class="form-control" id="email" name="email" type="email"
        value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" size="30" required placeholder="Địa chỉ Email *" />
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