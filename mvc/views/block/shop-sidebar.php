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
<aside class="widget widget-author">
  <h3 class="widget-title">Tác giả</h3>
  <ul>
    <?php
    $resultAuthor =  $data['ListAuthor'];
    foreach ($resultAuthor as $author) : ?>
    <li class="cat-item <?= isset($data['id']) && $author["id"] == $data['id'] ? 'active' : ''  ?>">
      <a href="<?= SITE_URL ?>/store/author/<?php echo $author["id"] ?>"><?= $author["title"] ?><span
          class="count">(<?= $author["luot"] ?>)</span></a>
    </li>
    <?php endforeach ?>
  </ul>
</aside>
<aside class="widget widget-star-rating">
  <h3 class="widget-title">ĐÁNH GIÁ</h3>
  <ul>
    <li class="cat-item">
      <a href="<?= SITE_URL ?>/store/rating/5">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <span style="margin-left: 5px;"> từ 5 sao</span>
      </a>
    </li>
    <li class="cat-item">
      <a href="<?= SITE_URL ?>/store/rating/4">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <span style="margin-left: 5px;"> từ 4 sao</span>
      </a>
    </li>
    <li class="cat-item">
      <a href="<?= SITE_URL ?>/store/rating/3">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <span style="margin-left: 5px;"> từ 3 sao</span>
      </a>
    </li>
  </ul>
</aside>
<aside class="widget widget-publisher">
  <h3 class="widget-title">Nhà xuất bản</h3>
  <ul>
    <?php
    $resultPublisher =  $data['ListPublisher'];
    foreach ($resultPublisher as $publisher) : ?>
    <li class="cat-item <?= isset($data['id']) && $publisher["id"] == $data['id'] ? 'active' : ''  ?>">
      <a href="<?= SITE_URL ?>/store/publisher/<?php echo $publisher["id"] ?>"><?= $publisher["title"] ?></a>
    </li>
    <?php endforeach ?>
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