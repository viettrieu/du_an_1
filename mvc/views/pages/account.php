<?php
$user = $data["UserById"];
$listProvince = $data['Province'];
$listDistrict = $data['District'];
$listWard = $data['Ward'];
?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">
    <div class="account-user">
      <span class="image">
        <img alt="" src="<?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>"
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
      <strong><?= $user['username']; ?></strong>? Hãy <a href="<?= SITE_URL ?>/account/userlogout"><strong>thoát
          ra</strong></a> và
      đăng nhập vào tài khoản của bạn)
    </p>

    <form action="" method="POST" enctype="multipart/form-data" id="update_user" class="needs-validation" novalidate>
      <div class="avatar-upload">
        <div class="avatar-edit">
          <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
          <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
        </div>
        <div class="avatar-preview">
          <div id="imagePreview"
            style="background-image: url(<?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>);">
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
      <div class="row">
        <div class="col small-12 large-12">
          <div class="form-group">
            <label for="username">
              Username <span class="required">*</span>
            </label>
            <input class="form-control" id="username" name="username" type="text" value="<?= $user['username']; ?>"
              required disabled />
          </div>
          <div class="form-group">
            <label for="fullname">
              Họ và tên <span class="required">*</span>
            </label>
            <input class="form-control" id="fullName" name="fullName" type="text" value="<?= $user['fullName']; ?>"
              placeholder="Họ và tên" required />
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="province">
              Số điện thoại <span class="required">*</span>
            </label>
            <input class="form-control" name="mobile" type="text" value="<?= $user['mobile']; ?>" required
              pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})"
              placeholder="Số điện thoại *" />
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="email">
              Địa chỉ Email <span class="required">*</span>
            </label>
            <input class="form-control" id="email" name="email" type="text" value="<?= $user['email']; ?>" required
              placeholder="Địa chỉ Email *" />
          </div>
        </div>
        <div class="col small-12 large-12">
          <div class="form-group">
              <input type="radio" id="male" name="gender" value="0" <?= $user['gender'] == false ? 'checked' : '' ?>>
              <label for="male">Nam</label><br>
              <input type="radio" id="female" name="gender" value="1" <?= $user['gender'] == true ? 'checked' : '' ?>>
              <label for="female">Nữ</label>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="province">
              Tỉnh/Thành phố <span class="required">*</span>
            </label>
            <select id="province" class=" custom-select select2" name="province" required>
              <option value=""></option>
              <?php foreach ($listProvince as $key => $province) : ?>
              <?= $selected = $key == $user['province'] ? 'selected' : "" ?>
              <option data-province="<?= $key ?>" value="<?= $province ?>" <?= $selected ?>><?= $province ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group district">
            <label for="district">
              Quận/Huyện <span class="required">*</span>
            </label>
            <select id="district" name="district" class=" custom-select select2" required>
              <?php foreach ($listDistrict as $key =>  $district) : ?>
              <?= $selected =  $key == $user['district'] ? 'selected' : "" ?>
              <option data-district="<?= $key ?>" value="<?= $district ?>" <?= $selected ?>><?= $district ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group ward">
            <label for="ward">
              Xã/Phường/Thị trấn <span class="required">*</span>
            </label>
            <select id="ward" name="ward" class=" custom-select select2" required>
              <?php foreach ($listWard as $key =>  $ward) : ?>
              <?= $selected =  $key == $user['ward'] ? 'selected' : "" ?>
              <option data-ward="<?= $key ?>" value="<?= $ward ?>" <?= $selected ?>><?= $ward ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="address">
              Địa chỉ<span class="required">*</span>
            </label>
            <input class="form-control" name="address" type="text" value="<?= $user['address']; ?>"
              placeholder="Địa chỉ" required />
          </div>
        </div>
      </div>
      <div class="text-center" style="margin-top: 1rem">
        <button type="submit" value="Submit" name="update_user" class="button primary">
          Cập nhật
        </button>
      </div>
    </form>
  </div>
</div>

<script>
$("#update_user").submit(function(e) {
  $("#province :selected").val($("#province :selected").data("province"));
  $("#district :selected").val($("#district :selected").data("district"));
  $("#ward :selected").val($("#ward :selected").data("ward"));
});
$(document).ready(function() {
  var xhrPool = [];
  if ($(".select2").length > 0) {
    $(".select2").select2({
      placeholder: "Select a state",
      width: "100%",
    });
  }
  $("select#province").change(function() {
    abortAll();
    let _province_id = $("#province :selected").data("province");
    $.ajax({
      url: `${SITE_URL}/transport/district/${_province_id}`,
      dataType: "JSON",
      beforeSend: function(jqXHR) {
        xhrPool.push(jqXHR);
        $(".form-group.district").addClass("address_loading");
      },
      success: function(data) {
        let district = `<option value=""></option>`;
        Object.keys(data).forEach(function(key) {
          district += `<option data-district="${key}" value="${data[key]}">${data[key]}</option>`;
        });
        $("#district").empty().append(district);
        $(".form-group.district").removeClass("address_loading");
        $("#ward").empty().append(`<option value=""></option>`);
      },
    });
  });
  $("select#district").change(function() {
    abortAll();
    let _district_id = $("#district :selected").data("district");
    $.ajax({
      url: `${SITE_URL}/transport/ward/${_district_id}`,
      dataType: "JSON",
      beforeSend: function(jqXHR) {
        xhrPool.push(jqXHR);
        $(".form-group.ward").addClass("address_loading");
      },
      success: function(data) {
        let ward = `<option value=""></option>`;
        Object.keys(data).forEach(function(key) {
          ward += `<option data-ward="${key}" value="${data[key]}">${data[key]}</option>`;
        });
        $("#ward").empty().append(ward);
        $(".form-group.ward").removeClass("address_loading");
      },
    });
  });

  function abortAll() {
    if (xhrPool.length > 0) {
      console.log(xhrPool);
      $.each(xhrPool, function(idx, jqXHR) {
        jqXHR.abort();
      });
      xhrPool = [];
    }
  }
});
</script>