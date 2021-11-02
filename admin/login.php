<?php
include_once 'config.php';
if (isset($_SESSION['username'])) {
  header('location: ./index.php');
}
$errors = array();
if (isset($_POST['login_user'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);
  if (empty($username)) {
    array_push($errors, "Nhập vào username");
  }
  if (empty($password)) {
    array_push($errors, "Nhập vào mật khẩu");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT ps_users.id FROM ps_users WHERE (username='$username' OR email='$username' OR mobile='$username') AND passwordHash='$password' LIMIT 1";
    $results = $conn->query($query);
    if ($results->num_rows == 1) {
      $user = $results->fetch_assoc();
      $userID =  $user['id'];
      $query = "SELECT ps_users.id FROM ps_users WHERE id = $userID AND admin = 1  LIMIT 1";
      $results = $conn->query($query);
      if ($results->num_rows == 1) {
        $_SESSION['username'] = $username;
        header('location: index.php');
      } else {
        array_push($errors, "Tài khoản bạn không đủ thẩm quyền");
      }
    } else {
      array_push($errors, "Tên đăng nhập hoặc mật khẩu không đúng");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title> Đăng nhập | ADMIN FOODO</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

  <!-- Main Wrapper -->
  <div class="main-wrapper login-body">
    <div class="login-wrapper">
      <div class="container">

        <img class="img-fluid logo-dark mb-2" src="assets/img/logo.png" alt="Logo">
        <div class="loginbox">

          <div class="login-right">
            <div class="login-right-wrap">
              <h1>Login</h1>
              <p class="account-subtitle">Đăng nhập vào quản lý</p>
              <div class="error">
                <?php foreach ($errors as $error) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $error ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <?php endforeach ?>
              </div>
              <form action="" method="POST">
                <div class="form-group">
                  <label class="form-control-label">Email Address</label>
                  <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                  <label class="form-control-label">Password</label>
                  <div class="pass-group">
                    <input type="password" class="form-control pass-input" name="password">
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
  <!-- /Main Wrapper -->

  <!-- jQuery -->
  <script src="assets/js/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Feather Icon JS -->
  <script src="assets/js/feather.min.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/script.js"></script>

</body>

</html>