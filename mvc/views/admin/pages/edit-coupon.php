<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Mã giảm giá</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="edit_coupon" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <?php
              $coupon = $data["Coupon"];
              foreach ($data["Errors"] as $error) :
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
                <label>Coupon:</label>
                <input type="text" class="form-control" id="code" required name="code" value="<?= $coupon['code']; ?>">
                <div class=" invalid-feedback">Vui lòng nhập coupon.</div>
                <button type="button" class="btn btn-secondary mt-2" onclick="generateCoupon()">Tạo Coupon</button>
              </div>
              <div class="form-group">
                <label>Mô tả ngắn:</label>
                <div id="summary"><?= $coupon['summary']; ?></div>
                <input type="hidden" name="summary">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class=" form-group">
                <label>Loại:</label>
                <select name="coupon-type" id="coupon-type" class="select custom-select" required>
                  <option value="0" <?= $coupon['type'] == 1 ? 'selected' : '' ?>>
                    Theo phần trăm</option>
                  <option value="1" <?= $coupon['type'] == 1 ? 'selected' : '' ?>>
                    Cố định</option>
                </select>
              </div>
              <div class="form-group">
                <label>Giá trị:</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="discount" required name="discount" min="1" max="100" aria-describedby="basic-addon2" value="<?= $coupon['discount']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">%</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Giới hạn:</label>
                <input type="number" class="form-control" id="usageLimit" name="usageLimit" min="1" value="<?= $coupon['usageLimit']; ?>">
              </div>
              <div class="form-group">
                <label>Đơn hàng tối thiểu:</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="minOrder" name="minOrder" min="1" aria-describedby="basic-addon3" value="<?= $coupon['minOrder']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon3">VNĐ</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Ngày bắt đầu:</label>
                <div class="cal-icon">
                  <input type="text" class="form-control datetimepicker-coupon" id="startDate" name="startDate" value="<?= isset($coupon['startDate']) ? date("d/m/Y", strtotime($coupon['startDate'])) : ''; ?>" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label>Ngày kết thúc:</label>
                <div class="cal-icon">
                  <input type="text" class="form-control datetimepicker-coupon" id="expiryDate" name="expiryDate" value="<?= isset($coupon['expiryDate']) ? date("d/m/Y", strtotime($coupon['expiryDate'])) : ''; ?>" autocomplete="off">
                </div>
              </div>

            </div>
          </div>
          <button type="submit" name="edit_coupon" class="btn btn-block btn-primary btn-lg">Tạo Coupon</button>
        </div>
      </div>
    </form>
  </div>
</div>



<script>
  let type = $('#coupon-type option:selected').val();

  function couponType(val) {
    if (val == 1) {
      $("#basic-addon2").text('VNĐ');
      $("#discount").removeAttr("max");
      $("#minOrder").prop('min', $("#discount").val());
      $("#minOrder").prop('required', true);
    } else {
      $("#basic-addon2").text('%');
      $("#minOrder").removeAttr('required');
      $("#minOrder").prop('min', 1);
      $("#discount").prop('max', 100);
    }
  }
  couponType(type)
  $(document).on('change', '#coupon-type', function(event) {
    couponType(event.target.value)
  })
  $(document).on('change', '#discount', () => {
    $("#minOrder").prop('min', $("#discount").val());
  })
</script>