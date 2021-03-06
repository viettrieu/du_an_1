<?php
$wishlist = ["link" => "javascript:void(0);", "class" => "wishlist", "icon" => "far",];
if (isset($_SESSION['user']['wishlist']) && in_array($product["id"], $_SESSION['user']['wishlist'])) {
  $wishlist = ["link" => SITE_URL . "/wishlist", "class" => "", "icon" => "fas",];
} ?>
<div class="product has-hover">
  <div class="box-image">
    <div class="product-actions">
      <ul>
        <li class="add-the-cart">
          <a href="#" data-id="<?= $product["id"] ?>">
            <i class="fas fa-shopping-cart"></i>
            <i class="fas fa-book"></i>
          </a>
          <span class="tooltiptext tooltip-left">Thêm vào giỏ</span>
        </li>
        <li>
          <a href="<?= $wishlist["link"] ?>" class="<?= $wishlist["class"] ?>" data-id="<?= $product["id"] ?>"><i
              class="<?= $wishlist["icon"] ?> fa-heart"></i>
          </a>
          <span class="tooltiptext tooltip-left">Yêu thích</span>
        </li>
        <li>
          <a href="javascript:void(0);" class="md-trigger quick_view" data-id="<?= $product["id"] ?>"
            data-modal="modal-quick_view"><i class="fas fa-search"></i></a>
          <span class="tooltiptext tooltip-left">Xem nhanh</span>
        </li>
      </ul>
    </div>
    <a href="<?= SITE_URL ?>/store/product/<?= $product["id"] ?>">
      <?php if (isset($product["discount"])) : ?>
      <span class="on-sale product-flash"><?= round(($product["discount"] / $product["price"]) * 100 - 100) ?>% </span>
      <?php endif ?>
      <span class="on-featured product-flash">Hot</span>
      <img src="<?= SITE_URL ?>/<?= $product["thumbnail"] ?>" alt="<?= $product["title"] ?>">
      <?php if ($product["rating"] != NULL) : ?>
      <div class="star-rating">
        <div class="star-ratings-css">
          <div class="star-ratings-inner" style="width: <?= $product["rating"] * 20 ?>%"></div>
        </div>
      </div>
      <?php endif ?>
    </a>
  </div>
  <div class="box-textx text-center">
    <span class="price">
      <?php if (isset($product["discount"])) : ?>
      <del aria-hidden="true">
        <span><?= number_format($product["price"], 0, ',', '.') ?>₫</span>
      </del>
      <?php endif ?>
      <ins class="sizeprice-1">
        <span><?= number_format(isset($product["discount"]) ? $product["discount"] : $product["price"], 0, ',', '.') ?>₫</span></ins>
    </span>
    <h4 class="product-title">
      <a href="<?= SITE_URL ?>/store/product/<?= $product["id"] ?>"><?= $product["title"] ?></a>
    </h4>
    <div class="product-author"><span>By</span>
      <?php
      $author = json_decode('[' . $product["author"] . ']', true);
      foreach ($author as $key => $a) : ?>
      <?= $key > 0 ? ", " : "" ?>
      <a href="<?= SITE_URL ?>/store/author/<?= $a["id"] ?>" rel="tag"><?= $a["title"] ?></a>
      <?php endforeach ?>
    </div>
  </div>
</div>