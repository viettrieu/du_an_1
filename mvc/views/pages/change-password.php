<?php $user = $data["UserById"]; ?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">
    <div class="account-user">
      <span class="image">
        <img alt=""
          src="<?= SITE_URL ?><?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>"
          height="70" width="70">
      </span>
      <span class="user-name">
        <?= $user['username']; ?>
      </span>
    </div>
    <ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/orders">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link active">
        <a href="<?= SITE_URL ?>/account/changepassword">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/userlogout">Đăng xuất</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">
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