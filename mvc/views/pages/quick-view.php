<?php
$Cproduct = $data["Product"];
$wishlist = ["link" => "javascript:void(0);", "class" => "wishlist", "icon" => "far",];
if (in_array($Cproduct["id"], $_SESSION['user']['wishlist'])) {
  $wishlist = ["link" => SITE_URL . "/wishlist", "class" => "", "icon" => "fas",];
}
?>
<div class="row row-collapse">
  <div class="col medium-6 small-12 large-6">
    <div class="bpfw-images">
      <figure class="woocommerce-product-gallery__wrapper bpfw-flip-wrapper">
        <img src="<?= SITE_URL ?>/<?= $Cproduct["thumbnail"] ?>" class="wp-post-image" alt="">
        <div class="bpfw-flip bpfw-flip-front"><img src="<?= SITE_URL ?>/<?= $Cproduct["thumbnail"] ?>"
            class="wp-post-image" alt="">
        </div>
        <div class="bpfw-flip bpfw-flip-back">
          <img src="https://auteur.g5plus.net/wp-content/uploads/2018/11/product-11.jpg" alt="Back Cover">
        </div>
        <div class="bpfw-flip bpfw-flip-first-page"></div>
        <div class="bpfw-flip bpfw-flip-second-page"></div>
        <div class="bpfw-flip bpfw-flip-side"></div>
        <div class="bpfw-flip bpfw-flip-side-paper"></div>
      </figure>
      <div class="bpfw-btn-action">
        <a href="#" class="bpfw-btn bpfw-action-flip">

          <span>Flip to Back</span>
        </a>
        <a href="https://auteur.g5plus.net/wp-admin/admin-ajax.php?action=bpfw_read_book&amp;product_id=126&amp;acds_read_book_nonce=1606f631e6"
          class="bpfw-btn bpfw-action-read-book">
          <span>Look inside</span>
        </a>
      </div>
    </div>
  </div>
  <div class="col medium-6 small-12 large-6">
    <h1 class="entry-title product-title"><?= $Cproduct['title']; ?></h1>
    <div class="product-rating view">
      <!-- <?php if ($data["AVGReview"] != NULL) : ?> -->
      <div class="star-rating" style=" margin-right: 10px; ">
        <div class="star-ratings-css" style=" font-size: 2rem; ">
          <div class="star-ratings-inner" style="width: <?= $data["AVGReview"] * 20 ?>%"></div>
        </div>
      </div>
      <?php endif ?>
      <!-- <span style=" margin-bottom: 0; ">Lượt xem: <?= $data['SumView']; ?></span> -->
    </div>
    <span class="price product-price" data-price="<?= $Cproduct['price']; ?>">
      <span class="unit-price"><?= number_format($Cproduct['price'], 0, ',', '.'); ?></span>
      <sup>đ</sup>
    </span>
    <div class="product-short-description">
      <?= $Cproduct['summary']; ?>
    </div>

    <div class="buttons-added">
      <div class="quantity">
        <span>Số lượng:</span>
        <button class="minus-btn" type="button" name="button" onclick="buttonMinusPlus(this, -1)">
          -
        </button>
        <input type="text" name="quantity" value="1" onchange="changeQuantity(this)">
        <button class="plus-btn" type="button" name="button" onclick="buttonMinusPlus(this, +1)">
          +
        </button>
      </div>

    </div>
    <div style=" display: flex; ">
      <div class="add-the-cart">
        <a href="#" class="secondary" data-id="<?= $Cproduct['id']; ?>">
          <i class="fas fa-shopping-cart"></i>
          <i class="fas fa-book"></i>
          <span>THÊM VÀO GIỎ</span>
        </a>
      </div>
      <div class="add-to-wishlist">
        <a href="<?= $wishlist["link"] ?>" class="<?= $wishlist["class"] ?>" data-id="<?= $Cproduct["id"] ?>"><i
            class="<?= $wishlist["icon"] ?> fa-heart"></i>
        </a>
      </div>
    </div>
    <div class="product-meta">
      <span class="sku-wrapper">SKU: <span class="sku"><?= $Cproduct['sku']; ?></span> </span>
      <?php
      $resultCategory =  $data['ListCategory'];
      if ($resultCategory) {
        echo "Categorys: ";
        foreach ($resultCategory as $category) { ?>
      <a href="<?= SITE_URL ?>/store/category/<?= $category["id"] ?>" rel="tag"><?= $category["title"] ?></a> <br>
      <?php }
      }
      $resultTag =  $data['ListTag'];
      if ($resultTag) {
        echo "Tags: ";
        foreach ($resultTag as $tag) { ?>
      <a href="<?= SITE_URL ?>/store/tag/<?= $tag["id"] ?>" rel="tag"><?= $tag["title"] ?></a>
      <?php }
      }
      ?>
      </span>
    </div>
    <div class="social-share">
      <span class="social-share-title">Chia sẻ:</span>
      <ul class="social-media">
        <li>
          <a class="facebook" href="#" target="blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="twitter" href="#" target="blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a class="linkedin" href="#" target="blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </li>
        <li>
          <a class="pinterest" href="#" target="blank">
            <i class="fab fa-pinterest"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>