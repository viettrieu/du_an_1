<?php
// var_dump($data["fb"]);
// var_dump($_SESSION['infofb']);
// // var_dump($_SESSION['facebook_access_token']);
// unset($_SESSION['facebook_access_token']);
// unset($_SESSION['infofb'])
?>
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
    <form action="" method="post" id="recovery-form">
      <input class="form-control" id="email" name="email" type="email"
        value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required
        placeholder="Nhập Email Của Bạn" >
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" form="recovery-form" value="Submit" name="recovery_password" class="button primary">
          Lấy Lại Mật Khẩu
        </button>
      </div>
    </form>
  </div>
</div>