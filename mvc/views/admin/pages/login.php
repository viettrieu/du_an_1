<?php $errors = $data["Errors"]; ?>
<div class="main-wrapper login-body">
  <div class="login-wrapper">
    <div class="container">

      <img class="img-fluid logo-dark mb-2" src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png" alt="Logo">
      <div class="loginbox">

        <div class="login-right">
          <div class="login-right-wrap">
            <h1>Login</h1>
            <p class="account-subtitle">Đăng nhập vào quản lý</p>
            <div class="error">
              <?php foreach ($errors as $error) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <?php endforeach ?>
            </div>
            <form action="" method="POST">
              <div class="form-group">
                <label class="form-control-label">Email Address</label>
                <input type="text" class="form-control" name="username"
                  value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>" require>
              </div>
              <div class="form-group">
                <label class="form-control-label">Password</label>
                <div class="pass-group">
                  <input type="password" class="form-control pass-input" name="password" require>
                  <span class="fas fa-eye toggle-password"></span>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="cb1">
                      <label class="custom-control-label" for="cb1">Ghi nhớ</label>
                    </div>
                  </div>
                  <div class="col-6 text-right">
                    <a class="forgot-link" href="forgot-password.html">Quên mật khẩu?</a>
                  </div>
                </div>
              </div>
              <button class="btn btn-lg btn-block btn-primary" type="submit" name="login_user">Đăng nhập</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>