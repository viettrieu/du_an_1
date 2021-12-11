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
                        <span><?= number_format($product["price"], 0, ',', '.') ?></span><sup>đ</sup>
                      </del>
                      <?php endif ?>
                      <ins class="sizeprice-1">
                        <span><?= number_format(isset($product["discount"]) ? $product["discount"] : $product["price"], 0, ',', '.') ?><sup>đ</sup></span>
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
                        <span><?= number_format($product["price"], 0, ',', '.') ?></span><sup>đ</sup>
                      </del>
                      <?php endif ?>
                      <ins class="sizeprice-1">
                        <span><?= number_format(isset($product["discount"]) ? $product["discount"] : $product["price"], 0, ',', '.') ?><sup>đ</sup></span>
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
              <h5 class="card-title">Sản phẩm xem nhiều nhất</h5>
              <div class="dropdown">
                <div id="reportrange"
                  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="fa fa-calendar"></i>
                  <span></span> <i class="fa fa-caret-down"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="ggg"> </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Invoice Analytics</h5>
              <div class="dropdown">
                <div id="reportrange2"
                  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="fa fa-calendar"></i>
                  <span></span> <i class="fa fa-caret-down"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="invoice_chart"></div>
            <div class="text-center text-muted d-none d-sm-block">
              <div class="row">
                <div class="col-4">
                  <div id="percentNewSessions"></div>
                </div>
                <div class="col-4">
                  <div id="percentOldSessions"></div>
                </div>
                <div class="col-4">
                  <div id="bounceRate"></div>
                </div>
              </div>
              <div class=" row" id="invoice_statistic">
                <div class="col-4">
                  <div class="mt-3">
                    <p class="mb-1 text-truncate">Số người dùng</p>
                    <h6 id="users"></h6>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mt-3">
                    <p class="mb-1 text-truncate">Số phiên hoạt động</p>
                    <h6 id="sessions"></h6>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mt-3">
                    <p class="mb-1 text-truncate">Số trang/phiên</p>
                    <h6 id="pageviewsPerSession"></h6>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mt-3">
                    <p class="mb-1 text-truncate">Số lượt xem</p>
                    <h6 id="Pageviews"></h6>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mt-3">
                    <p class="mb-1 text-truncate">Thời gian trung bình</p>
                    <h6 id="avgSessionDuration"></h6>
                  </div>
                </div>
              </div>
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
                <div id="reportrange3"
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
                    <th>Trang</th>
                    <th>Số lần xem trang</th>
                    <th>Số lần xem trang duy nhất</th>
                    <th>Thời gian tr.bình trên trang</th>
                    <th>Số lần truy cập</th>
                    <th>Tỷ lệ thoát</th>
                    <th class="text-right">% Thoát</th>
                  </tr>
                </thead>
                <tbody id='pageview'>
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
                <div id="reportrange4"
                  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="fa fa-calendar"></i>
                  <span></span> <i class="fa fa-caret-down"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="device_category"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart JS -->
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/chart-data.js"></script>