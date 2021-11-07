<?php
$category = $data["Category"];
$errors = $data["Errors"];
?>

<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Danh mục</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Sửa danh mục sản phẩm</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row justify-content-center">
      <div class="col-md-9">
        <form method="POST" id="edit_category" class="needs-validation" novalidate>
          <div class="card">
            <div class="card-body">
              <?php foreach ($errors as $error) :
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
                <label>Tên danh mục:</label>
                <input type="text" class="form-control" id="title" required name="title" value="<?= $category["title"] ?>">
                <div class=" invalid-feedback">Vui lòng nhập tên danh mục.</div>
              </div>
              <div class="form-group">
                <label>Mô tả danh mục:</label>
                <div id="content"><?= $category["content"] ?></div>
                <input type="hidden" name="content">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg" name="edit_category">Sửa danh mục</button>
        </form>
      </div>
    </div>
    </form>
  </div>
</div>