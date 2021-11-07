<aside class="widget widget-categories">
  <h3 class="widget-title">Danh mục</h3>
  <ul>
    <?php
    $resultCategory =  $data['ListCategory'];
    foreach ($resultCategory as $category) : ?>
    <li class="cat-item <?= isset($data['id']) && $category["id"] == $data['id'] ? 'active' : ''  ?>">
      <a href="<?= SITE_URL ?>/store/category/<?php echo $category["id"] ?>"><?= $category["title"] ?><span
          class="count">(<?= $category["luot"] ?>)</span></a>
    </li>
    <?php endforeach ?>
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
    $resultTag =  $data['ListTag'];
    foreach ($resultTag as $tag) : ?>
    <a href="<?= SITE_URL ?>/store/tag/<?php echo $tag["id"] ?>"
      class="tag-cloud-link <?= isset($data['id']) && $tag["id"] == $data['id'] ? 'active' : ''  ?>"><?= $tag["title"] ?></a>
    <?php endforeach ?>
  </div>
</aside>