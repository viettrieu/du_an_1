<?php
// var_dump($data["fb"]);
// var_dump($_SESSION['infofb']);
// // var_dump($_SESSION['facebook_access_token']);
// unset($_SESSION['facebook_access_token']);
// unset($_SESSION['infofb'])
?>
<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-8 small-12 large-5">
    <form action="" method="post" id="recovery-form" class="needs-validation" novalidate>
      <div class="errors"></div>
      <div class="form-group">
        <input class="form-control" id="account" name="account" type="text" value="" required
          placeholder="Vui lòng điền vào số điện thoại/Email">
      </div>
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" form="recovery-form" value="Submit" name="recovery_password" class="button primary">
          Lấy Lại Mật Khẩu
        </button>
      </div>
    </form>
  </div>
  <div class="col medium-12 small-12 large-8" id="recover_method">
  </div>
</div>