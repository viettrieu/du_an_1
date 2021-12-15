<style>
p.text-muted.mt-3.mb-0 {
  display: none;
}
</style>
<div class="page-wrapper">
  <div class="content container-fluid">

    <div class="row">

      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-4">
                <i class="fas fa-boxes"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Sản phẩm</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][0] ?></p>
                </div>
              </div>
            </div>
            <div class="progress progress-sm mt-3">
              <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i
                  class="fas fa-arrow-down mr-1"></i>8.68%</span> since last week</p>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-2">
                <i class="fas fa-users"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Thành viên</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][1] ?></p>
                </div>
              </div>
            </div>
            <div class="progress progress-sm mt-3">
              <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i
                  class="fas fa-arrow-up mr-1"></i>2.37%</span> since last week</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-3">
                <i class="fas fa-file-alt"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Đơn hàng</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][2] ?></p>
                </div>
              </div>
            </div>
            <div class="progress progress-sm mt-3">
              <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i
                  class="fas fa-arrow-up mr-1"></i>3.77%</span> since last week</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-1">
                <i class="fas fa-star"></i>

              </span>
              <div class="dash-count">
                <div class="dash-title">Đánh giá</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][3] ?></p>
                </div>
              </div>
            </div>
            <div class="progress progress-sm mt-3">
              <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i
                  class="fas fa-arrow-down mr-1"></i>1.15%</span> since last week</p>
          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-xl-6 d-flex" id="hot_product">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Sản phẩm mua nhiều nhất</h5>
              <div class="dropdown">
                <select name="category" class="select category custom-select" required>
                  <option value="" selected>Chọn danh mục sản phẩm</option>
                  <?php foreach ($data["ListCategory"] as $category) : ?>
                  <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="dropdown">
                <div class="reportrange"
                  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="fa fa-calendar"></i>
                  <span></span> <i class="fa fa-caret-down"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th class="text-right">Số lượng</th>
                  </tr>
                </thead>
                <tbody class="show">
                  <?php
                  $listProduct = $data["HotProduct"];
                  foreach ($listProduct as $product) : ?>
                  <tr>
                    <td class="id"><?= $product['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="<?= SITE_URL ?>/store/product/<?= $product['id']; ?>"><img
                            class="avatar avatar-lg mr-2 avatar-img rounded"
                            src="<?= SITE_URL ?><?= $product['thumbnail']; ?> " alt="<?= $product['title']; ?>">
                          <span class="title"><?= $product['title']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td>
                      <?php if (isset($product["discount"])) : ?>
                      <del aria-hidden="true">
                        <span><?= number_format($product["price"], 0, ',', '.') ?>₫</span>
                      </del>
                      <?php endif ?>
                      <ins class="sizeprice-1">
                        <span><?= number_format(isset($product["discount"]) ? $product["discount"] : $product["price"], 0, ',', '.') ?>₫</span>
                      </ins>
                    </td>
                    <td class="text-right">
                      <?= $product['quantity']; ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex" id="wishlist_product">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Sản phẩm được yêu thích</h5>
              <div class="dropdown">
                <select name="category" class="select category custom-select" required>
                  <option value="" selected>Chọn danh mục sản phẩm</option>
                  <?php foreach ($data["ListCategory"] as $category) : ?>
                  <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th class="text-right">Yêu thích</th>
                  </tr>
                </thead>
                <tbody class="show">
                  <?php
                  $listProduct = $data["WishlistProduct"];
                  foreach ($listProduct as $product) : ?>
                  <tr>
                    <td class="id"><?= $product['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="<?= SITE_URL ?>/store/product/<?= $product['id']; ?>"><img
                            class="avatar avatar-lg mr-2 avatar-img rounded"
                            src="<?= SITE_URL ?><?= $product['thumbnail']; ?> " alt="<?= $product['title']; ?>">
                          <span class="title"><?= $product['title']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td>
                      <?php if (isset($product["discount"])) : ?>
                      <del aria-hidden="true">
                        <span><?= number_format($product["price"], 0, ',', '.') ?>₫</span>
                      </del>
                      <?php endif ?>
                      <ins class="sizeprice-1">
                        <span><?= number_format(isset($product["discount"]) ? $product["discount"] : $product["price"], 0, ',', '.') ?>₫</span>
                      </ins>
                    </td>
                    <td class="text-right">
                      <?= $product['quantity']; ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Invoice Analytics</h5>
              <div class="dropdown">
                <select name="loai" class="select custom-select" required style=" width: max-content; ">
                  <option value="tong" selected>Theo tổng đơn hàng</option>
                  <option value="sl">Theo số lượng đơn hàng</option>
                </select>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="invoice_chart"></div>
            <div class="text-center text-muted d-none d-sm-block">
              <div class="row justify-content-center" id="invoice_statistic">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Category Analytics</h5>
              <div class="dropdown">
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="category_chart"></div>
            <div class="text-center text-muted d-none d-sm-block">
              <div class="row justify-content-center" id="category_statistic">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart JS -->
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/apexcharts.min.js"></script>
<!-- Custom JS -->
<script src="<?= SITE_URL ?>/public/admin/js/statistical.js"></script>