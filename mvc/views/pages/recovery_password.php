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
    <form action="" method="post" id="recovery-form" class="needs-validation" novalidate>
      <div class="form-group">
        <input class="form-control" name="new_password" type="email" placeholder="Email" required
          value="<?= base64_decode($_GET['email']); ?>" disabled>
      </div>
      <div class="form-group">
        <input class="form-control" name="new_password" type="password" placeholder="Nhập Mật Khẩu Mới" required>
      </div>
      <div class="form-group">
        <input class="form-control" name="password_confirm" type="password" placeholder="Nhập Lại Mật Khẩu" required>
      </div>
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" form="recovery-form" value="Submit" name="recovery_password" class="button primary">
          Đổi Mật Khẩu
        </button>
      </div>
    </form>
  </div>
</div>