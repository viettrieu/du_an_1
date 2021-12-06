<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Tạo sản phẩm</li>
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
              <div class="form-group">
                <label>Phần trăm giảm giá:</label>
                <input type="number" class="form-control" id="discount" required name="discount"
                  value="<?= $coupon['discount']; ?>">
              </div>
              <div class="form-group">
                <label>Giới hạn:</label>
                <input type="number" class="form-control" id="usageLimit" name="usageLimit"
                  value="<?= $coupon['usageLimit']; ?>">
              </div>
              <div class=" form-group">
                <label>Ngày hết hạn:</label>
                <div class="cal-icon">
                  <input type="text" class="form-control datetimepicker" id="expiryDate" name="expiryDate"
                    value="<?= $coupon['expiryDate']; ?>">
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