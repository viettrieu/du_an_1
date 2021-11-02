<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT ps_product.* FROM ps_product WHERE ps_product.id = $id";
  $product = $conn->query($query)->fetch_assoc();
  if ($product == NULL) {
    echo ("<script>location.href = './index.php?action=san-pham';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=san-pham';</script>");
}
?>

<div class="page-wrapper">
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Sửa sản phẩm</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="edit_product" data-id="<?php echo $id; ?>">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="form-group validate-me">
                <label>Tên sản phẩm:</label>
                <input type="text" class="form-control" id="title" required name="title"
                  value="<?php echo $product['title']; ?>" />
                <div class="invalid-feedback">
                  Vui lòng nhập tên sản phẩm.
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <div id="content">
                  <?php echo $product['content']; ?>
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả ngắn:</label>
                <div id="summary">
                  <?php echo $product['summary']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>SKU:</label>
                <input type="text" class="form-control" id="sku" name="sku" value="<?php echo $product['sku']; ?>" />
              </div>
              <div class="form-group">
                <label>Danh mục sản phẩm:</label>
                <select name="category[]" class="select2tag" multiple="multiple">
                  <?php
                  $categories = $conn->query(' SELECT title, productId  FROM `ps_category` LEFT JOIN product_category ON `categoryId` = id AND `productId` = ' . $id);
                  foreach ($categories as $category) { ?>
                  <option value="<?php echo $category['title']; ?>"
                    <?= $category['productId'] ==  $id ? 'selected' : '' ?>>
                    <?php echo $category['title']; ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Từ khóa sản phẩm:</label>
                <select class="select2tag" name="tag[]" id="tag" multiple="multiple">
                  <?php
                  $tags = $conn->query(' SELECT title, productId  FROM `ps_tag` LEFT JOIN product_tag ON `tagId` = id AND `productId` = ' . $id);
                  foreach ($tags as $tag) { ?>
                  <option value="<?php echo $tag['title']; ?>" <?= $tag['productId'] ==  $id ? 'selected' : '' ?>>
                    <?php echo $tag['title']; ?>
                  </option>
                  <?php }  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Giá bán thường:</label>
                <div class="input-group validate-me">
                  <input type="text" class="form-control" id="price" name="price"
                    value="<?php echo $product['price']; ?>" required />
                  <div class="input-group-append">
                    <span class="input-group-text">VNĐ</span>
                  </div>
                  <div class="invalid-feedback">
                    Vui lòng nhập giá bán sản phẩm.
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Giá khuyến mãi:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="discount" name="discount"
                    value="<?php echo $product['discount']; ?>" />
                  <div class="input-group-append">
                    <span class="input-group-text">VNĐ</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <div class="thumbnail-upload">
                  <div class="thumbnail-edit">
                    <input type="file" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg" />
                    <label for="thumbnail"><i class="fas fa-pencil-alt"></i></label>
                  </div>
                  <div class="thumbnail-preview">
                    <div id="thumbnailPreview" style="
                              background-image: url(.<?php echo $product['thumbnail']; ?>);
                            "></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg">
            Cập nhật sản phẩm
          </button>
        </div>
      </div>
    </form>
  </div>
</div>