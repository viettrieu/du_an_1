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
                  <?php $tong =  $conn->query("SELECT COUNT(*) AS 'count' FROM ps_product")->fetch_assoc(); ?>
                  <p><?= $tong['count'] ?></p>
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
                  <?php $tong =  $conn->query("SELECT COUNT(*) AS 'count' FROM ps_users")->fetch_assoc(); ?>
                  <p><?= $tong['count'] ?></p>
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
                  <?php $tong =  $conn->query("SELECT COUNT(*) AS 'count' FROM ps_order")->fetch_assoc(); ?>
                  <p><?= $tong['count'] ?></p>
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
                  <?php $tong =  $conn->query("SELECT COUNT(*) AS 'count' FROM ps_product_review")->fetch_assoc(); ?>
                  <p><?= $tong['count'] ?></p>
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
      <div class="col-xl-7 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Phân tích bán hàng</h5>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
              <div class="w-md-100 d-flex align-items-center mb-3">
                <!-- <div>
                  <span>Total Sales</span>
                  <p class="h3 text-primary mr-5">$1000</p>
                </div>
                <div>
                  <span>Receipts</span>
                  <p class="h3 text-success mr-5">$1000</p>
                </div>
                <div>
                  <span>Expenses</span>
                  <p class="h3 text-danger mr-5">$300</p>
                </div>
                <div>
                  <span>Earnings</span>
                  <p class="h3 text-dark mr-5">$700</p>
                </div> -->
              </div>
            </div>
            <div id="sales_chart"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-5 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Phân tích hóa đơn</h5>
            </div>
          </div>
          <div class="card-body">
            <div id="invoice_chart"></div>
            <div class="text-center text-muted d-none d-sm-block">
              <div class=" row" id="invoice_statistic">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h5 class="card-title">Recent Invoices</h5>
              </div>
              <div class="col-auto">
                <a href="invoices.html" class="btn-right btn btn-sm btn-outline-primary">
                  View All
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <div class="progress progress-md rounded-pill mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 47%" aria-valuenow="47"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 28%" aria-valuenow="28"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="row">
                <div class="col-auto">
                  <i class="fas fa-circle text-success mr-1"></i> Paid
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-warning mr-1"></i> Unpaid
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-danger mr-1"></i> Overdue
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-info mr-1"></i> Draft
                </div>
              </div>
            </div>

            <div class="table-responsive">

              <table class="table table-stripped table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <h2 class="table-avatar">
                        <a href="profile.html"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle"
                            src="assets/img/profiles/avatar-04.jpg" alt="User Image">Barbara Moore</a>
                      </h2>
                    </td>
                    <td>$118</td>
                    <td>23 Nov 2020</td>
                    <td><span class="badge bg-success-light">Paid</span></td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                            class="fas fa-ellipsis-h"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit mr-2"></i>Edit</a>
                          <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye mr-2"></i>View</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-trash-alt mr-2"></i>Delete</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-check-circle mr-2"></i>Mark
                            as sent</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-paper-plane mr-2"></i>Send
                            Invoice</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy mr-2"></i>Clone
                            Invoice</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h5 class="card-title">Recent Invoices</h5>
              </div>
              <div class="col-auto">
                <a href="invoices.html" class="btn-right btn btn-sm btn-outline-primary">
                  View All
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <div class="progress progress-md rounded-pill mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 47%" aria-valuenow="47"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 28%" aria-valuenow="28"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                  aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="row">
                <div class="col-auto">
                  <i class="fas fa-circle text-success mr-1"></i> Paid
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-warning mr-1"></i> Unpaid
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-danger mr-1"></i> Overdue
                </div>
                <div class="col-auto">
                  <i class="fas fa-circle text-info mr-1"></i> Draft
                </div>
              </div>
            </div>

            <div class="table-responsive">

              <table class="table table-stripped table-hover">
                <thead class="thead-light">
                  <tr>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <h2 class="table-avatar">
                        <a href="profile.html"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle"
                            src="assets/img/profiles/avatar-04.jpg" alt="User Image">Barbara Moore</a>
                      </h2>
                    </td>
                    <td>$118</td>
                    <td>23 Nov 2020</td>
                    <td><span class="badge bg-success-light">Paid</span></td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                            class="fas fa-ellipsis-h"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit mr-2"></i>Edit</a>
                          <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye mr-2"></i>View</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-trash-alt mr-2"></i>Delete</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-check-circle mr-2"></i>Mark
                            as sent</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i
                              class="far fa-paper-plane mr-2"></i>Send
                            Invoice</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy mr-2"></i>Clone
                            Invoice</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<!-- Chart JS -->
<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>