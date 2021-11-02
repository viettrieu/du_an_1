2<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT ps_category.* FROM ps_category WHERE ps_category.id = $id";
    $product = $conn->query($query)->fetch_assoc();
    if ($product == NULL) {
      echo ("<script>location.href = './index.php?action=tu-khoa';</script>");
    } else {
      $title = $product['title'];
      $content = $product['content'];
    }
  } else {
    echo ("<script>location.href = './index.php?action=tu-khoa';</script>");
  }
  if (isset($_POST['edit_category'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $content =  $content == '<p><br></p>' ? NULL : $content;
    $query = "UPDATE ps_category SET title ='$title', content = '$content' WHERE id = $id";
    if ($conn->query($query)) {
      $result = [1, $_POST['title']];
    } else {
      $result = [0, $_POST['title']];
    }
  }
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
        <form method="POST" id="create_tag">
          <div class="card">
            <div class="card-body">
              <?php
              if (isset($result)) {
                if ($result[0] == 1) {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Bạn đã chỉnh sửa thành công danh mục <strong><?php echo $result[1]; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php } else {
                ?>
              <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                Danh mục <strong><?php echo $result[1]; ?></strong> đã tồn tại
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <?php
                }
              }
              ?>
              <div class="form-group validate-me">
                <label>Tên danh mục:</label>
                <input type="text" class="form-control" id="title" required name="title" value="<?= $title ?>">
              </div>
              <div class="form-group">
                <label>Mô tả danh mục:</label>
                <div id="content"> <?= $content ?></div>
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