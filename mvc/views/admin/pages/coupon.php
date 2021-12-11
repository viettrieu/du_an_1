<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Coupon</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách Coupon</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="<?= ADMIN_URL; ?>/coupon/create" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tạo Coupon
          </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <!-- Search Filter -->

    <!-- /Search Filter -->

    <div class="row">
      <div class="col-sm-12">
        <div class="card card-table">
          <div class="card-body">
            <div class="table-responsive" id="coupon_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Đơn hàng tối thiểu</th>
                    <th>Lượt</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thức</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listCoupon = $data["ListCoupon"];
                  if (isset($listCoupon)) {
                    foreach ($listCoupon as $coupon) { ?>
                  <tr>
                    <td class="id"><?= $coupon['id']; ?></td>
                    <td><?= $coupon['code']; ?></td>
                    <td><?= $coupon['type'] == 0 ? "Phần trăm" : "Cố định"; ?></td>
                    <td>
                      <?= $coupon['type'] == 0 ? $coupon['discount'] . "%" : number_format($coupon['discount'], 0, ',', '.') . "₫"; ?>
                    </td>
                    <td>
                      <?= $coupon['minOrder'] == NULL ? "∞" :  number_format($coupon['minOrder'], 0, ',', '.') . "₫"; ?>
                    </td>
                    <td><?= $coupon['usages']; ?>/<?= $coupon['usageLimit'] == NULL ? "∞" : $coupon['usageLimit']; ?>
                    </td>
                    <td><?= $coupon['startDate'] == NULL ? "∞" : date("d/m/Y", strtotime($coupon['startDate'])); ?>
                    </td>
                    <td><?= $coupon['expiryDate'] == NULL ? "∞" : date("d/m/Y", strtotime($coupon['expiryDate'])); ?>
                    </td>
                    <td class="text-right">
                      <a href="<?= ADMIN_URL ?>/coupon/edit/<?= $coupon['id']; ?>"
                        class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
                    </td>
                  </tr>
                  <?php }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>