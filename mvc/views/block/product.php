<?php
$wishlist = ["link" => "javascript:void(0);", "class" => "wishlist", "icon" => "far",];
if (in_array($product["id"], $_SESSION['user']['wishlist'])) {
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
      <span class="on-sale product-flash">Sale</span>
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
    <span class="price" data-price="<?= $product["price"] ?>">
      <span class="unit-price"><?= number_format($product["price"], 0, ',', '.') ?></span>
      <sup>đ</sup>
    </span>
    <h4 class="product-title">
      <a href="<?= SITE_URL ?>/store/product/<?= $product["id"] ?>"><?= $product["title"] ?></a>
    </h4>
    <div class="product-author"><span>By</span><a href="#" rel="tag"><?= $product["author"] ?></a></div>
  </div>
</div>