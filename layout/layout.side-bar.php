<div class="hn-side-bar">
  <div class="side-bar-title">
    <span>DANH MỤC SẢN PHẨM</span>
  </div>
  <div class="filter-price">
    <?php
    $sql = "SELECT DISTINCT c.* from categories c INNER JOIN products p ON p.category_id = c.category_id  ORDER BY c.category_id DESC";
    $categories = $conn->query($sql);
    foreach ($categories as $category) { ?>
    <p><a href="./danhsach.php?danh-muc=<?= $category["category_id"] ?>"><?= $category["category_name"] ?></a> </p>
    <?php } ?>
  </div>
</div>

<div class="hn-side-bar">
  <div class="side-bar-title">
    <span>THƯƠNG HIỆU</span>
  </div>
  <div class="filter-price">
    <?php
    $sql = "SELECT DISTINCT b.* from brands b INNER JOIN products p ON p.brand_id = b.brand_id  ORDER BY b.brand_id DESC";
    $categories = $conn->query($sql);
    foreach ($categories as $category) { ?>
    <p><a href="./danhsach.php?thuong-hieu=<?= $category["brand_id"] ?>"><?= $category["brand_name"] ?></a> </p>
    <?php } ?>
  </div>
</div>