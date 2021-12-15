<style>
p.text-muted.mt-3.mb-0 {
  display: none;
}
</style>
<div class="page-wrapper">
  <div class="content container-fluid">
    <div class="row">
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Lượt truy cập</h5>
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
            <div id="ggg"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title"></h5>
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
              <div class="row justify-content-center">
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
              <h5 class="card-title">Thiết bị truy cập</h5>
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
      <div class="col-xl-6 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Top trang có lượt xem nhiều nhất</h5>
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
    </div>
  </div>
</div>

<!-- Chart JS -->
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/chart-data.js"></script>