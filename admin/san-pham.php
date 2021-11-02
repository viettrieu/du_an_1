<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="./index.php?action=tao-san-pham" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tạo sản phẩm
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
            <div class="table-responsive" id="product_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>SKU</th>
                    <th>Danh mục</th>
                    <th>Kho</th>
                    <th>Giá</th>
                    <th>Ngày tạo</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query =  "SELECT ps_product.id, thumbnail, ps_product.title, sku, quantity, price, DATE_FORMAT(ps_product.published, '%e/%c/%Y') AS 'published', GROUP_CONCAT(X.title SEPARATOR ', ') AS 'category' FROM ps_product LEFT JOIN( SELECT title, productId FROM `ps_category` INNER JOIN product_category ON `categoryId` = ps_category.id ) X ON X.productId = ps_product.id GROUP BY ps_product.id";
                  $product = $conn->query($query);
                  if ($product->num_rows > 0) {
                    while ($row = $product->fetch_assoc()) { ?>
                  <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="../?action=san-pham&id=<?php echo $row['id']; ?>"><img
                            class="avatar avatar-lg mr-2 avatar-img rounded" src=".<?php echo $row['thumbnail']; ?> "
                            alt="<?php echo $row['title']; ?>">
                          <span class="title"><?php echo $row['title']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td><?php echo $row['sku']; ?></td>
                    <td><?= $row['category']; ?></td>
                    <td>
                      <span
                        class="badge badge-pill bg-<?php echo $row['quantity'] == null || $row['quantity']  > 10 ? 'success' : ($row['quantity'] == 0 ? 'danger' : 'warning'); ?>-light">
                        <?php echo $row['quantity'] == null || $row['quantity']  > 10 ? 'Còn hàng' : ($row['quantity'] == 0 ? 'Hết hàng' : 'Sắp hết'); ?>
                      </span>
                    </td>
                    <td><?php echo number_format($row['price'], 0, ',', '.'); ?><sup>đ</sup></td>
                    <td><?php echo $row['published']; ?></td>
                    <td class="text-right">
                      <a href="./index.php?action=sua-san-pham&id=<?php echo $row['id']; ?>"
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
  </div>
</div>