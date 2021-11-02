<div class="page-wrapper">
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Thành viên</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách thành viên</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="./index.php?action=tao-thanh-vien" class="btn btn-primary mr-1">
            <i class="fas fa-plus"></i>
            Thêm thành viên
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
            <div class="table-responsive" id='user_list'>
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Thành viên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Ngày đăng ký</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT id, admin, username, fullName, mobile, email, avatar, DATE_FORMAT(registeredAt, '%e/%c/%Y') AS'registeredAt',verify FROM ps_users";
                  $member = $conn->query($query);
                  while ($row = $member->fetch_assoc()) {
                  ?>
                  <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                            src=".<?php echo $row['avatar'] == null ? './assets/img/avatar-default.png' : $row['avatar']; ?>"
                            alt="User Image" /></a>
                        <a href="#">
                          <span class="title">
                            <?php echo $row['fullName'] == null ? $row['username'] : $row['fullName']; ?></span>
                          <span><?php echo $row['mobile']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo  $row['admin'] == 1 ? "Quản lý" : "Khách hàng"; ?></td>
                    <td><?php echo $row['registeredAt']; ?></td>
                    <td>
                      <span
                        class="badge badge-pill <?php echo  $row['verify'] == 1 ? "bg-success-light" : "bg-danger-light"; ?>">
                        <?php echo  $row['verify'] == 1 ? "Đã xác minh" : "Chưa xác minh"; ?></span>
                    </td>
                    <td class="text-right">
                      <a href="./index.php?action=sua-thanh-vien&id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Sửa</a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger mr-2 delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
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