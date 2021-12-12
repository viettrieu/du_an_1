<?php
$post = $data["Post"];
?>

<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Bài viết</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Tạo bài viết</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="edit_post" enctype="multipart/form-data" class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-9">
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
                <label>Tên bài viết:</label>
                <input type="text" class="form-control" id="title" required name="title" value="<?= $post['title']; ?>">
                <div class=" invalid-feedback">Vui lòng nhập bài viết.
                </div>
              </div>
              <div class="form-group">
                <label>Trích đoạn:</label>
                <textarea class="form-control" name="excerpt" maxlength="160"><?= $post['excerpt']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <div id="content"><?= $post['content']; ?></div>
                <input type="hidden" name="content">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Danh mục bài viết:</label>
                <select name="id_category" class="select custom-select" required>
                  <option value="" selected>Chọn danh mục bài viết</option>
                  <?php foreach ($data["ListCategory"] as $category) : ?>
                  <option value="<?= $category['id'] ?>"
                    <?= $post['id_category'] == $category['id'] ? 'selected' : '' ?>>
                    <?= $category['title'] ?>
                  </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Ảnh bài viết</label>
                <div class="thumbnail-upload">
                  <div class="thumbnail-edit">
                    <input type="file" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg" />
                    <label for="thumbnail"><i class="fas fa-pencil-alt"></i></label>
                  </div>
                  <div class="thumbnail-preview">
                    <div id="thumbnailPreview"
                      style="background-image: url(<?= SITE_URL ?><?= $post['thumbnail'] ? $post['thumbnail'] : "/public/img/default-product-image.png"; ?>)">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg" name="edit_post">Đăng sản
            phẩm</button>
        </div>
      </div>
    </form>
  </div>
</div>