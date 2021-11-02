<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT title FROM ps_category WHERE id = $id";
  $product = $conn->query($query)->fetch_assoc();
  if ($product == NULL) {
    echo ("<script>location.href = './index.php?action=cua-hang';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=cua-hang';</script>");
}
$title =  $product['title'];
include_once './breadcrumb.php'; ?>
<div class="row page-wrapper">
  <div class="large-9 col-nop">
    <div class="row">
      <?php
      $page = isset($_GET['page']) ?  $_GET['page'] : 1;
      $perPage = 6;
      $offset = ($page - 1) * $perPage;
      $base_url = './index.php?action=danh-muc&id=' . $id;
      $totalProduct =  totalProduct('category', $id);
      $productList = productList('category', $id, $offset, $perPage);
      if ($productList->num_rows > 0) {
        while ($row = $productList->fetch_assoc()) {
      ?>
      <div class="col medium-6 small-12 large-4">
        <div class="col-inner">
          <div class="product has-hover">
            <div class="box-image image-zoom">

              <a href="./index.php?action=san-pham&id=<?php echo $row["id"] ?>">
                <img src="<?php echo $row["thumbnail"] ?>" alt="<?php echo $row["title"] ?>">
                <?php if ($row["rating"] != NULL) : ?>
                <div class="star-rating">
                  <div class="star-ratings-css">
                    <div class="star-ratings-inner" style="width: <?= $row["rating"] * 20 ?>%"></div>
                  </div>
                </div>
                <?php endif ?>
              </a>
            </div>
            <div class="box-text text-center">
              <p class="product-title"><a
                  href="./index.php?action=san-pham&id=<?php echo $row["id"] ?>"><?php echo $row["title"] ?></a></p>
              <span class="price" data-price="<?php echo $row["price"] ?>">
                <span class="unit-price"><?php echo number_format($row["price"], 0, ',', '.') ?></span>
                <sup>đ</sup>
              </span>
              <div class="add-the-cart">
                <a href="#" data-id="<?php echo $row["id"] ?>">
                  <i class="fas fa-shopping-cart"></i>
                  <i class="fas fa-box"></i>
                  <span>Thêm vào giỏ</span>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        echo "0 results";
      }
      //                    $db->close();
      ?>
    </div>
    <div class="container">
      <?= taoLinkPhanTrang($base_url, $totalProduct, $page, $perPage); ?>
    </div>
  </div>
  <div class="large-3 col sidebar">
    <?php include_once('./shop-sidebar.php') ?>
  </div>
</div>