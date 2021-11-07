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
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-table">
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Ngày tạo đơn</th>
                    <th>Tổng</th>
                    <th>Trạng thái</th>
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
                      <h2 class="table-avatar">
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?= $order['id']; ?>"
                          class="avatar avatar-sm mr-2">
                          <img class="avatar-img rounded-circle"
                            src="<?= SITE_URL ?><?= $order['avatar'] == null ? '/public/img/avatar-default.png' : $order['avatar']; ?>"
                            alt="User Image" />
                        </a>
                        <a href="<?= ADMIN_URL ?>/order/vieworder/<?= $order['id']; ?>">
                          <?= $order['fullName'] == null ? $order['username'] : $order['fullName']; ?>
                          <span><?= $order['mobile']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td><?= $order['email']; ?></td>
                    <td><?= $order['published']; ?></td>
                    <td><?php echo number_format($order['total'], 0, ',', '.'); ?><sup>đ</sup></td>
                    <td><span class="badge bg-status-<?= $order['status']; ?>"><?= $order['textStatus']; ?></span>
                    </td>
                    <td class="text-right">
                      <a href="edit-expenses.html" class="btn btn-sm btn-white text-success mr-2"><i
                          class="far fa-edit mr-1"></i> Edit</a>
                      <a href="<?= ADMIN_URL ?>/order/vieworder/<?= $order['id']; ?>"
                        class="btn btn-sm btn-white text-primary mr-2"><i class="far fa-eye mr-1"></i>View</a>
                      <div class="dropdown dropdown-action" style=" display: inline-block; ">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                            class="fas fa-ellipsis-h"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                          <?php foreach ($data["Status"] as $status) : ?>
                          <?php if ($status["id"] == $order['status']) continue; ?>
                          <a class="dropdown-item status" href="javascript:void(0);" data-id="<?= $status["id"] ?>"><i
                              class="far fa-edit mr-2"></i>
                            <?= $status["status"] ?>
                          </a>
                          <?php endforeach ?>
                        </div>
                      </div>
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