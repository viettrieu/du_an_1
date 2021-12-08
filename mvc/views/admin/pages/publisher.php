<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Nhà xuất bản</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">NXB sản phẩm</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-5">
        <form method="POST" id="create_publisher" class="needs-validation" novalidate>
          <div class="card">
            <div class="card-body">
              <?php foreach ($data["Errors"] as $error) :
                $class = $error["status"] == "ERROR" ? "alert-danger" : "alert-success";
              ?>
                <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
                  <?= $error["message"] ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php endforeach ?>
              <div class="form-group ">
                <label>Tên NXB:</label>
                <input type="text" class="form-control" id="title" required name="title">
                <div class=" invalid-feedback">Vui lòng nhập tên NXB.
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả NXB:</label>
                <div id="content"></div>
                <input type="hidden" name="content">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg" name="create_publisher">Tạo NXB</button>
        </form>
      </div>
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive" id="publisher_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $ListPublisher = $data["ListPublisher"];
                  if (isset($ListPublisher)) {
                    foreach ($ListPublisher as $publisher) { ?>
                      <tr>
                        <td class="id"><?php echo $publisher['id']; ?></td>
                        <td class="title"><?php echo $publisher['title']; ?></td>
                        <td><?php echo $publisher['published']; ?></td>
                        <td class="text-right">
                          <a href="<?= ADMIN_URL ?>/publisher/edit/<?php echo $publisher['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
                          <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i class="far fa-trash-alt mr-1"></i>Xóa</a>
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
    </form>
  </div>
</div>