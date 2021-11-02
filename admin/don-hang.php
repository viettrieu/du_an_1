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
                  $query = "SELECT ps_order.id, avatar, ps_order.fullName, username, ps_order.mobile, ps_order.email, DATE_FORMAT(published, '%e/%c/%Y') AS'published', ps_order.status, ps_order_status.status AS 'textStatus', total FROM ps_order LEFT JOIN ps_users on ps_order.userId = ps_users.id INNER JOIN ps_order_status on ps_order.status = ps_order_status.id";
                  $member = $conn->query($query);
                  while ($row = $member->fetch_assoc()) {
                  ?>
                  <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>"
                          class="avatar avatar-sm mr-2">
                          <img class="avatar-img rounded-circle"
                            src=".<?php echo $row['avatar'] == null ? './assets/img/avatar-default.png' : $row['avatar']; ?>"
                            alt="User Image" />
                        </a>
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>">
                          <?php echo $row['fullName'] == null ? $row['username'] : $row['fullName']; ?>
                          <span><?php echo $row['mobile']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['published']; ?></td>
                    <td><?php echo number_format($row['total'], 0, ',', '.'); ?><sup>đ</sup></td>
                    <td><span
                        class="badge bg-status-<?php echo $row['status']; ?>"><?php echo $row['textStatus']; ?></span>
                    </td>
                    <td class="text-right">
                      <a href="edit-expenses.html" class="btn btn-sm btn-white text-success mr-2"><i
                          class="far fa-edit mr-1"></i> Edit</a>
                      <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-white text-primary mr-2"><i class="far fa-eye mr-1"></i>View</a>
                      <div class="dropdown dropdown-action" style=" display: inline-block; ">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                            class="fas fa-ellipsis-h"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                          <?php
                            $status = $row['status'];
                            $query = "SELECT * FROM ps_order_status WHERE NOT id = $status";
                            $status = $conn->query($query);
                            while ($row = $status->fetch_assoc()) { ?>
                          <a class="dropdown-item status" href="javascript:void(0);"
                            data-id="<?php echo $row['id'] ?>"><i class="far fa-edit mr-2"></i>
                            <?php echo $row['status'] ?>
                          </a>
                          <?php  } ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>