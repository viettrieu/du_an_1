<?php
if (isset($_POST['create_category'])) {
  $title = $conn->real_escape_string($_POST['title']);
  $content = $conn->real_escape_string($_POST['content']);
  $content =  $content == '<p><br></p>' ? NULL : $content;
  $query = "INSERT INTO ps_category(title, content) VALUES
  ('$title', '$content')";
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
            <li class="breadcrumb-item active">Danh mục sản phẩm</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-5">
        <form method="POST" id="create_category">
          <div class="card">
            <div class="card-body">
              <?php
              if (isset($result)) {
                if ($result[0] == 1) {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Bạn đã thêm thành công danh mục <strong><?php echo $result[1]; ?></strong>
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
                <input type="text" class="form-control" id="title" required name="title">
                <div class=" invalid-feedback">Vui lòng nhập tên danh mục.
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả danh mục:</label>
                <div id="content"></div>
                <input type="hidden" name="content">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg" name="create_category">Tạo danh
            mục</button>
        </form>
      </div>
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive" id="category_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th>Lượt</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query =  "SELECT ps_category.id, ps_category.title, DATE_FORMAT(ps_category.published, '%e/%c/%Y') AS'published', COUNT(product_category.categoryId) AS 'luot' FROM ps_category LEFT JOIN product_category ON product_category.categoryId = ps_category.id GROUP BY ps_category.id";
                  $category = $conn->query($query);
                  if ($category->num_rows > 0) {
                    while ($row = $category->fetch_assoc()) { ?>
                  <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td class="title"><?php echo $row['title']; ?></td>
                    <td><?php echo $row['published']; ?></td>
                    <td><?php echo $row['luot']; ?></td>
                    <td class="text-right">
                      <a href="./index.php?action=sua-danh-muc&id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
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