<div class="page-wrapper">
  <div class="content container-fluid">
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Đơn hàng</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="./tao-don-hang.php" class="btn btn-primary mr-1">
            <i class="fas fa-plus"></i>
            Tạo đơn hàng
          </a>
          <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
            <i class="fas fa-filter"></i>
          </a>
        </div>
      </div>
    </div>

    <div id="filter_inputs" class="card filter-card">
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label>Mã đơn hàng</label>
              <input type="text" class="form-control" id="invoice_number">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="text" class="form-control" id="phone">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>From</label>
              <div class="cal-icon">
                <input class="form-control datetimepicker" type="text" id="startDate" name="min">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>To</label>
              <div class="cal-icon">
                <input class="form-control datetimepicker" type="text" id="expiryDate" name="max">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Trạng thái:</label>
              <select id="categoryFilter" class="select">
                <option value="">Tất cả</option>
                <?php foreach ($data["Status"] as $status) : ?>
                  <option value="<?= $status["status"] ?>"> <?= $status["status"] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <!-- <div class="col-md-2">
            <div class="form-group">
              <button type="button" class="btn btn-danger" id="clear">Clear</button>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-table">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped table-hover datatable" id="order_list">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tổng</th>
                    <th>Ngày tạo đơn</th>
                    <th>Trạng thái</th>
                    <th>GHTK</th>
                    <th class="text-right">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ListOrder = $data["ListOrder"];
                  if (isset($ListOrder)) {
                    foreach ($ListOrder as $order) {
                  ?>
                      <tr>
                        <td class="id"><?= $order['id']; ?></td>
                        <td>
                          <strong><?= $order['fullName']; ?></strong>
                          <p><?= $order['email']; ?></p>
                        </td>
                        <td><a href="tel:<?= $order['mobile']; ?>"><strong><?= $order['mobile']; ?></strong></a></td>
                        <td><?= number_format($order['total'], 0, ',', '.'); ?>₫</td>
                        <td><?= $order['published']; ?></td>
                        <td class="status">
                          <span class="bg-status-<?= $order['status']; ?>"><?= $order['textStatus']; ?></span>
                        </td>
                        <td class="ghtk">
                          <?php if (isset($order['tracking_id'])) : ?>
                            <p>Mã vận đơn: <strong><?= $order['tracking_id']; ?></strong></p>
                          <?php endif ?>
                        </td>
                        <td class="text-right">
                          <a href="javascript:void(0);" class="btn btn-sm btn-white text-primary mr-2 quick-view"><i class="far fa-eye mr-1"></i>View
                          </a>
                          <?php if($order['status'] < 5 ){ ?>
                            <div class="dropdown dropdown-action" style=" display: inline-block; ">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <?php foreach ($data["Status"] as $status) : ?>
                                <?php if ($status["id"] <= $order['status']) continue; ?>
                                <a class="dropdown-item status" href="javascript:void(0);" data-id="<?= $status["id"] ?>"><i class="far fa-edit mr-2"></i>
                                  <?= $status["status"] ?>
                                </a>
                              <?php endforeach ?>
                            </div>
                          </div>
                           <?php } ?>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="quickview" class="modal custom-modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>