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
          <a href="<?= ADMIN_URL ?>/user/create" class="btn btn-primary mr-1">
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
                  $ListUser = $data["ListUser"];
                  if (isset($ListUser)) {
                    foreach ($ListUser as $user) {
                  ?>
                  <tr>
                    <td class="id"><?= $user['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle"
                            src="<?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>"
                            alt="User Image" /></a>
                        <a href="#">
                          <span class="title">
                            <?= $user['fullName'] == null ? $user['username'] : $user['fullName']; ?></span>
                          <span><?= $user['mobile']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['admin'] == 1 ? "Quản lý" : "Khách hàng"; ?></td>
                    <td><?= $user['registeredAt']; ?></td>
                    <td class="status">
                      <span class="badge-pill <?= $user['verify'] == 1 ? "bg-success-light" : "bg-danger-light"; ?>">
                        <?= $user['verify'] == 1 ? "Đã xác minh" : "Chưa xác minh"; ?></span>
                    </td>
                    <td class="text-right">
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-primary mr-2 quick-view"><i
                          class="far fa-eye mr-1"></i>View
                      </a>
                      <a href="<?= ADMIN_URL ?>/user/edit/<?= $user['id']; ?>"
                        class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Sửa</a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger mr-2 delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
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
<div id="quick_view_user" class="modal custom-modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <div class="modal-body" style=" padding: 0; ">
      </div>
    </div>
  </div>
</div>
<!-- Chart JS -->
<script src="<?= SITE_URL ?>/public/admin/plugins/apexchart/apexcharts.min.js"></script>