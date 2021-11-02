<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Tạo sản phẩm</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <form method="POST" id="create_product">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="form-group validate-me">
                <label>Tên sản phẩm:</label>
                <input type="text" class="form-control" id="title" required name="title">
                <div class=" invalid-feedback">Vui lòng nhập tên sản phẩm.
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <div id="content"></div>
              </div>
              <div class="form-group">
                <label>Mô tả ngắn:</label>
                <div id="summary"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>SKU:</label>
                <input type="text" class="form-control" id="sku" name="sku">
              </div>
              <div class="form-group">
                <label>Danh mục sản phẩm:</label>
                <select name="category[]" class="select2tag" multiple="multiple">
                  <?php
                  $categories = $conn->query('SELECT * FROM ps_category');
                  foreach ($categories as $category) {
                    echo '<option value="' . $category['title'] . '">' . $category['title'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Từ khóa sản phẩm:</label>
                <select name="tag[]" class="select2tag" multiple="multiple">
                  <?php
                  $tags = $conn->query('SELECT * FROM ps_tag');
                  foreach ($tags as $tag) {
                    echo '<option value="' . $tag['title'] . '">' . $tag['title'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Giá bán thường:</label>
                <div class="input-group validate-me">
                  <input type="text" class="form-control" id="price" required name="price">
                  <div class="input-group-append">
                    <span class="input-group-text">VNĐ</span>
                  </div>
                  <div class="invalid-feedback">Vui lòng nhập giá bán sản phẩm.</div>
                </div>
              </div>
              <div class="form-group">
                <label>Giá khuyến mãi:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="discount" name="discount">
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
                    <div id="thumbnailPreview" style="background-image: url(../assets/img/default-product-image.png)">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-lg">Đăng sản
            phẩm</button>
        </div>
      </div>
    </form>
  </div>
</div>