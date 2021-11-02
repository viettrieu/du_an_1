<aside class="widget widget-categories">
  <h3 class="widget-title">Danh mục</h3>
  <ul>
    <?php
    $category = "SELECT ps_category.id, ps_category.title, COUNT(product_category.categoryId) AS 'luot' FROM ps_category LEFT JOIN product_category ON product_category.categoryId = ps_category.id GROUP BY ps_category.id HAVING luot > 0 ORDER BY published DESC";
    $resultCategory = $conn->query($category);
    if ($resultCategory->num_rows > 0) {
      // output data of each row
      while ($row = $resultCategory->fetch_assoc()) {
    ?>
    <li class="cat-item <?= isset($_GET['id']) && $row["id"] == $_GET['id'] ? 'active' : ''  ?>">
      <a href="./index.php?action=danh-muc&id=<?php echo $row["id"] ?>"><?= $row["title"] ?><span
          class="count">(<?= $row["luot"] ?>)</span></a>
    </li>
    <?php
      }
    } else {
      echo "0 results";
    }
    // $db->close();
    ?>

  </ul>
</aside>
<aside class="widget widget-star-rating">
  <h3 class="widget-title">ĐÁNH GIÁ</h3>
  <ul>
    <li class="cat-item">
      <a href=""><i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <span class="count">(10)</span>
    </li>
    <li class="cat-item">
      <a href="">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <span class="count">(4)</span>
      </a>
    </li>
    <li class="cat-item">

      <a href="">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <span class="count">(8)</span>
      </a>
    </li>
    <li class="cat-item">
      <a href="">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <span class="count">(4)</span>
      </a>
    </li>
    <li class="cat-item">
      <a href="">
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <span class="count">(4)</span>
      </a>
    </li>
  </ul>
</aside>
<aside class="widget widget-tagcloud">
  <h3 class="widget-title">Từ khóa</h3>
  <div class="tagcloud">
    <?php
    $category = "SELECT ps_tag.id, ps_tag.title, COUNT(product_tag.tagId) AS 'luot' FROM ps_tag LEFT JOIN product_tag ON product_tag.tagId = ps_tag.id GROUP BY ps_tag.id HAVING luot > 0 ORDER BY luot DESC LIMIT 5";
    $resultCategory = $conn->query($category);
    if ($resultCategory->num_rows > 0) {
      // output data of each row
      while ($row = $resultCategory->fetch_assoc()) {
    ?>

    <a href="./index.php?action=tu-khoa&id=<?php echo $row["id"] ?>"
      class="tag-cloud-link <?= isset($_GET['id']) && $row["id"] == $_GET['id'] ? 'active' : ''  ?>"><?= $row["title"] ?></a>
    <?php
      }
    } else {
      echo "0 results";
    }
    // $db->close();
    ?>
  </div>
</aside>