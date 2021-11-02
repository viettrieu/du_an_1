<?php include_once('./config.php'); ?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM `ps_users` WHERE id = $id";
  $user = $conn->query($query)->fetch_assoc();
  if ($user == NULL) {
    echo ("<script>location.href = './index.php?action=thanh-vien';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=thanh-vien';</script>");
}
$errors = array();
if (isset($_POST['edit_user'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $fullName = $conn->real_escape_string($_POST['fullName']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $gender = $conn->real_escape_string($_POST['gender']);
  $address = $conn->real_escape_string($_POST['address']);
  $admin = $conn->real_escape_string($_POST['admin']);
  if (isset($_POST['verify'])) {
    $verify = $conn->real_escape_string($_POST['verify']);
  } else {
    $verify = 0;
  }
  if (empty($username)) {
    array_push($errors, "Username bắt buốc");
  }
  if (empty($mobile)) {
    array_push($errors, "Mobile bắt buốc");
  }
  if (empty($email)) {
    array_push($errors, "Email bắt buộc");
  }
  $user_check_query = "SELECT * FROM ps_users WHERE (email='$email' OR mobile='$mobile' OR username='$username') AND NOT id = '$id' LIMIT 1";
  $userCheck = $conn->query($user_check_query)->fetch_assoc();

  if ($userCheck) { // if user exists
    if ($userCheck['username'] === $username) {
      array_push($errors, "Username đã tồn tại");
    }
    if ($userCheck['email'] === $email) {
      array_push($errors, "Email đã tồn tại");
    }
    if ($userCheck['mobile'] === $mobile) {
      array_push($errors, "Số điện thoại đã tồn tại");
    }
  }
  if (count($errors) == 0) {
    if (isset($_FILES["avatar"]) && !empty($_FILES["avatar"]['name'])) {
      $query = "SELECT avatar FROM ps_users WHERE id = $id";
      $user = $conn->query($query)->fetch_assoc();
      if ($user['avatar'] != NULL) {
        $file_path = '.' . $user['avatar'];
        unlink($file_path);
      }
      move_uploaded_file($_FILES['avatar']['tmp_name'], '../assets/img/' . basename($_FILES['avatar']['name']));
      $avatar = './assets/img/' . basename($_FILES['avatar']['name']);
      $query = "UPDATE ps_users SET avatar = '$avatar' WHERE id= $id";
      $conn->query($query);
    }
    if (isset($_POST['password'])) {
      $password = $conn->real_escape_string($_POST['password']);
      $md5password = md5($password);
      $query = "UPDATE ps_users SET password = '$md5password' WHERE id= $id";
      $conn->query($query);
    }
    $query = "UPDATE ps_users SET username = '$username', admin = $admin, fullName = '$fullName', mobile = '$mobile', email = '$email', address = '$address', gender = $gender, verify = $verify WHERE id = $id";
    $conn->query($query);
    $query = "SELECT * FROM ps_users WHERE id = $id";
    $user = $conn->query($query)->fetch_assoc();
    $result = "Đã tạo tài khoản thành công";
  }
}
?>

<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Thành viên</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Sửa thành viên</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="edit_user" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-4 col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <div class="thumbnail-upload">
                  <div class="thumbnail-edit">
                    <input type="file" id="thumbnail" name="avatar" accept=".png, .jpg, .jpeg" />
                    <label for="thumbnail"><i class="fas fa-pencil-alt"></i></label>
                  </div>
                  <div class="thumbnail-preview">
                    <div id="thumbnailPreview"
                      style="background-image: url(.<?php echo $user['avatar'] == null ? './assets/img/avatar-default.png' : $user['avatar']; ?>)">
                    </div>
                  </div>
                </div>
                <p class="text-center">Allowed *.jpeg, *.jpg, *.png, *.gif<br> max size of 3.1 MB</p>
              </div>
              <div class="form-group">
                <label>Vai trò:</label>
                <select class="select" name="admin">
                  <option value="0" <?php echo $user['admin'] == 0 ? 'selected' : '' ?>>Thành viên</option>
                  <option value="1" <?php echo $user['admin'] == 1 ? 'selected' : '' ?>>Quản lý</option>
                </select>
              </div>
              <div class="form-group row">
                <label class="col-lg-9 col-form-label" for="switch">
                  <h6><strong>Xác minh tài khoản</strong></h6>
                  Tắt tính năng này sẽ tự động gửi cho người dùng một mã xác minh
                </label>
                <div class="col-lg-3">
                  <input type="checkbox" id="switch" name="verify" value="1"
                    <?php echo $user['verify'] == 1 ? 'checked' : '' ?> /><label for="switch">Toggle</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-7">
          <div class="card">
            <div class="card-body">
              <?php if (count($errors) > 0) : ?>
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
              <?php elseif (isset($_POST['edit_user'])) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $result ?> <a href="./thanh-vien.php">Xem danh sách thành viên</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php endif ?>
              <div class="form-group">
                <label>Tên đăng nhập:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>"
                  required>
              </div>
              <div class="form-group">
                <label>Họ và tên:</label>
                <input type="text" class="form-control" name="fullName" value="<?php echo $user['fullName']; ?>">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>"
                      required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input type="text" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>"
                      required
                      pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})">
                  </div>
                </div>
              </div>
              <div class=" form-group">
                <label class="d-block">Giới tính:</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0"
                    <?php echo $user['gender'] == 0 ? 'checked' : '' ?>>
                  <label class="form-check-label" for="gender_male">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1"
                    <?php echo $user['gender'] == 1 ? 'checked' : '' ?>>
                  <label class="form-check-label" for="gender_female">Nữ</label>
                </div>
              </div>
              <div class="form-group">
                <label>Đại chỉ:</label>
                <input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>">
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <div class="pass-group">
                  <input type="password" class="form-control pass-input" name="password" id="PassEntry">
                  <span class="fas fa-eye toggle-password"></span>
                </div>
                <span id="StrengthDisp" class="badge displayBadge">Weak</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary btn-lg" name="edit_user">Tạo thành
                viên</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
let timeout;

// traversing the DOM and getting the input and span using their IDs

let password = document.getElementById('PassEntry')
let strengthBadge = document.getElementById('StrengthDisp')

// The strong and weak password Regex pattern checker

let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
let mediumPassword = new RegExp(
  '((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))'
)

function StrengthChecker(PasswordParameter) {
  // We then change the badge's color and text based on the password strength

  if (strongPassword.test(PasswordParameter)) {
    strengthBadge.style.backgroundColor = "green"
    strengthBadge.textContent = 'Mạnh'
  } else if (mediumPassword.test(PasswordParameter)) {
    strengthBadge.style.backgroundColor = 'blue'
    strengthBadge.textContent = 'Trung bình'
  } else {
    strengthBadge.style.backgroundColor = 'red'
    strengthBadge.textContent = 'Yếu'
  }
}

// Adding an input event listener when a user types to the  password input

password.addEventListener("input", () => {

  //The badge is hidden by default, so we show it

  strengthBadge.style.display = 'block'
  clearTimeout(timeout);

  //We then call the StrengChecker function as a callback then pass the typed password to it

  timeout = setTimeout(() => StrengthChecker(password.value), 200);

  //Incase a user clears the text, the badge is hidden again

  if (password.value.length !== 0) {
    strengthBadge.style.display != 'block'
  } else {
    strengthBadge.style.display = 'none'
  }
});
</script>