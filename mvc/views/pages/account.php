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

      <li class="mycccount-navigation-link active">
        <a href="<?= SITE_URL ?>/account">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/orders">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/changepassword">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/userlogout">Đăng xuất</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">


    <p>
      Xin chào <strong><?= $user['username']; ?></strong> (không phải tài khoản
      <strong><?= $user['username']; ?></strong>? Hãy <a href="./tai-khoan.php?logout"><strong>thoát
          ra</strong></a> và
      đăng nhập vào tài khoản của bạn)
    </p>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="avatar-upload">
        <div class="avatar-edit">
          <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
          <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
        </div>
        <div class="avatar-preview">
          <div id="imagePreview"
            style="background-image: url(<?= SITE_URL ?><?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>);">
          </div>
        </div>
      </div>
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
      <input class="form-control" name="username" type="text" value="<?= $user['username']; ?>" required disabled />
      <input class="form-control" name="mobile" type="text" value="<?= $user['mobile']; ?>" required
        pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})"
        placeholder="Số điện thoại *" />
      <input class="form-control" id="email" name="email" type="text" value="<?= $user['email']; ?>" required
        placeholder="Địa chỉ Email *" />
      <input class="form-control" name="fullName" type="text" value="<?= $user['fullName']; ?>"
        placeholder="Họ và tên" />
        <input type="radio" id="male" name="gender" value="0" <?= $user['gender'] == false ? 'checked' : '' ?>>
        <label for="male">Nam</label><br>
        <input type="radio" id="female" name="gender" value="1" <?= $user['gender'] == true ? 'checked' : '' ?>>
        <label for="female">Nữ</label>
      <input class="form-control" name="address" type="text" value="<?= $user['address']; ?>" placeholder="Địa chỉ" />
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="update_user" class="button primary">
          Cập nhật
        </button>
      </div>
    </form>
  </div>
</div>