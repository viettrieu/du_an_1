<?php
$user = $data["User"];
$errors = $data["Errors"];
?>
<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Thành viên</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Tạo thành viên</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="edit_user" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                    <div id="thumbnailPreview" style="background-image: url(<?= $user['avatar'] ?>);">
                    </div>
                  </div>
                </div>
                <p class="text-center">Allowed *.jpeg, *.jpg, *.png, *.gif<br> max size of 3.1 MB</p>
              </div>
              <div class="form-group ">
                <label>Vai trò:</label>
                <select class="select" name="admin">
                  <option value="0"
                    <?= htmlspecialchars($_POST['admin'] ?? $user['admin'] ?? "") == 0 ? "selected" : "" ?>>Thành viên
                  </option>
                  <option value="1"
                    <?= htmlspecialchars($_POST['admin'] ?? $user['admin'] ?? "") == 1 ? "selected" : "" ?>>Quản lý
                  </option>
                </select>
              </div>
              <div class="form-group row">
                <label class="col-lg-9 col-form-label" for="switch">
                  <h6><strong>Xác minh tài khoản</strong></h6>
                  Tắt tính năng này sẽ tự động gửi cho người dùng một mã xác minh
                </label>
                <div class="col-lg-3">
                  <input type="checkbox" id="switch" name="verify" value="1"
                    <?= htmlspecialchars($_POST['verify'] ?? $user['verify'] ?? "") == 1 ? "checked" : "" ?> /><label
                    for="switch">Toggle</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-7">
          <div class="card">
            <div class="card-body">
              <?php foreach ($errors as $error) :
                $class = $error["status"] == "ERROR" ? "alert-danger" : "alert-success";
              ?>
              <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
                <?= $error["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php endforeach ?>
              <div class="form-group ">
                <label>Tên đăng nhập:</label>
                <input type="text" class="form-control" name="username"
                  value="<?= htmlspecialchars($_POST['username'] ?? $user['username'] ?? ""); ?>" required>
                <div class=" invalid-feedback">Vui lòng nhập vào username.</div>
              </div>
              <div class="form-group">
                <label>Họ và tên:</label>
                <input type="text" class="form-control" name="fullName"
                  value="<?= htmlspecialchars($_POST['fullName'] ?? $user['fullName'] ?? ""); ?>">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email"
                      value="<?= htmlspecialchars($_POST['email'] ?? $user['email'] ?? ""); ?>" required>
                    <div class=" invalid-feedback">Vui lòng nhập Email.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Số điện thoại:</label>
                    <input type="text" class="form-control" name="mobile"
                      value="<?= htmlspecialchars($_POST['mobile'] ?? $user['mobile'] ?? ""); ?>" required
                      pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})">
                    <div class=" invalid-feedback">Vui lòng nhập vào số điện thoại.</div>
                  </div>
                </div>
              </div>
              <div class=" form-group">
                <label class="d-block">Giới tính:</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0"
                    <?= htmlspecialchars($_POST['gender'] ?? $user['gender'] ?? "") == 0 ? "checked" : "" ?> />
                  <label class="form-check-label" for="gender_male">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1"
                    <?= htmlspecialchars($_POST['gender'] ?? $user['gender'] ?? "") == 1 ? "checked" : "" ?> />
                  <label class="form-check-label" for="gender_female">Nữ</label>
                </div>
              </div>
              <div class="form-group">
                <label>Đại chỉ:</label>
                <input type="text" class="form-control" name="address"
                  value="<?= htmlspecialchars($_POST['address'] ?? $user['address'] ?? ""); ?>">
              </div>
              <div class="form-group ">
                <label>Mật khẩu</label>
                <div class="pass-group">
                  <input type="password" class="form-control pass-input" name="password" id="PassEntry">
                  <span class="fas fa-eye toggle-password"></span>
                  <div class=" invalid-feedback">Vui lòng nhập mật khẩu.</div>
                </div>
                <span id="StrengthDisp" class="badge displayBadge">Weak</span>
              </div>
              <div class="form-group ">
                <label>Nhập lại mật khẩu</label>
                <div class="pass-group">
                  <input type="password" class="form-control pass-input" name="re_password" id="re_password">
                  <div class=" invalid-feedback">Vui lòng nhập lại mật khẩu.</div>
                </div>
              </div>
              <button type="submit" class="btn btn-block btn-primary btn-lg" name="edit_user">Cập nhật thành
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