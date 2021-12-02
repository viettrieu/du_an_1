<?php
$product = $data["Product"];
$UserById = $data["UserById"];
?>
<div class="row page-wrapper">
  <div class="col medium-6 small-12 large-6">
    <div class="bpfw-images">
      <figure class="woocommerce-product-gallery__wrapper bpfw-flip-wrapper">
        <img src="https://auteur.g5plus.net/wp-content/uploads/2018/11/product-20.jpg" class="wp-post-image" alt="">
        <div class="bpfw-flip bpfw-flip-front"><img
            src="https://auteur.g5plus.net/wp-content/uploads/2018/11/product-20.jpg" class="wp-post-image" alt="">
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
    <h1 class="entry-title product-title"><?= $product['title']; ?></h1>
    <div class="product-rating view">
      <?php if ($data["AVGReview"] != NULL) : ?>
      <div class="star-rating" style=" margin-right: 10px; ">
        <div class="star-ratings-css" style=" font-size: 2rem; ">
          <div class="star-ratings-inner" style="width: <?= $data["AVGReview"] * 20 ?>%"></div>
        </div>
      </div>
      <?php endif ?>
      <span style=" margin-bottom: 0; ">Lượt xem: <?= $data['SumView']; ?></span>
    </div>
    <span class="price product-price" data-price="<?= $product['price']; ?>">
      <span class="unit-price"><?= number_format($product['price'], 0, ',', '.'); ?></span>
      <sup>đ</sup>
    </span>
    <div class="product-short-description">
      <?= $product['summary']; ?>
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
        <a href="#" class="secondary" data-id="<?= $product['id']; ?>">
          <i class="fas fa-shopping-cart"></i>
          <i class="fas fa-box"></i>
          <span>THÊM VÀO GIỎ</span>
        </a>
      </div>
      <div class="add-to-wishlist">
        <a href="" data-id="<?= $product['id']; ?>"></a>
        <span class="tooltiptext tooltip-top">Yêu thích</span>
        </a>
      </div>
    </div>
    <div class="product-meta">
      <span class="sku-wrapper">SKU: <span class="sku"><?= $product['sku']; ?></span> </span>
      <?php
      $resultCategory =  $data['ListCategory'];
      if ($resultCategory) {
        echo "Categorys: ";
        foreach ($resultCategory as $category) { ?>
      <a href="<?= SITE_URL ?>/store/category/<?= $category["id"] ?>" rel="tag"><?= $category["title"] ?></a>
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
    <div class="product-extra-info">
      <ul>
        <li>Free global shipping on all orders</li>
        <li>30 days easy returns if you change your mind</li>
        <li>Order before noon for same day dispatch</li>
      </ul>
    </div>
  </div>
</div>
<section id="product-author-wrap">
  <div class="row">
    <div class="col small-12 large-12">
      <div class="col-inner">
        <h2 class="text-center">Meet The Author</h2>
      </div>
    </div>
    <div class="col medium-4 small-12 large-4">
      <div class="col-inner">
        <div class="author-avatar">
          <img src="<?= SITE_URL ?>/public/img/author-2.jpg">
        </div>
        <div class="author-info">
          <h4 class="text-center" href="https://auteur.g5plus.net/product-author/shia-ung/" title="Shia Ung">Shia
            Ung</a>
          </h4>

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
    <div class="col medium-8 small-12 large-8">
      <div class="col-inner">
        <div class="author-quote">" My books are marked down because most of them are marked with a on the edge by
          publishers. "</div>
        <div class="container list-posts owl-carousel owl-theme">
          <?php
          $RelatedProduct =  $data['RelatedProduct'];
          foreach ($RelatedProduct as $product) : ?>
          <?php require "./mvc/views/block/product.php" ?>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="row">
  <div class="col small-12 large-12">
    <div class="tabs">
      <div class="tab-item active">Mô tả</div>
      <div class="tab-item" id="reviews">Bình luận</div>
    </div>
    <div class="tab-content">
      <div class="tab-pane active">
        typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
        unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only
        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
      </div>
      <div class="tab-pane reviews">
        <div class="row">
          <div class="col medium-12 small-12 large-6">
            <div class="reviews-container">
              <ul id="reviews-list" class="comments-list reviews">
                <?php
                $resultReview =  $data['ListReview'];
                if ($resultReview) {
                  foreach ($resultReview as $review) { ?>
                <li>
                  <div class="comment-main-level">
                    <div class="comment-avatar">
                      <img
                        src="<?= SITE_URL ?><?= $review['avatar'] != NULL ?  $review['avatar'] : '/public/img/avatar-default.png' ?>"
                        alt=" <?= $review['fullName'] ? $review['fullName'] : $review['username'] ?>" />
                    </div>
                    <div class="comment-box">
                      <div class="comment-head">
                        <h6 class="comment-name by-customer">
                          <?= $review['fullName'] ? $review['fullName'] : $review['username'] ?>
                        </h6>
                        <div class="star-ratings-css">
                          <div class="star-ratings-inner" style="width: <?= $review['rating'] * 20 ?>%"></div>
                        </div>
                      </div>
                      <div class="comment-content">
                        <?= $review['content'] ?>
                      </div>
                    </div>
                  </div>
                </li>
                <?php }
                } else {
                  echo '<li class="noreviews">Chưa có đánh giá cho sản phẩm này</li>';
                }
                ?>
              </ul>
            </div>
          </div>
          <div class="col medium-12 small-12 large-6 col-nop medium-col-first">
            <?php if (isset($_SESSION["user"])) : ?>
            <form action="<?php echo SITE_URL . '/store/product/addreview' ?>" method="POST" id="reviewsform">
              <p style="font-weight: 600">
                Địa chỉ email của bạn sẽ không được công bố. Các trường
                bắt buộc được đánh dấu <span class="required">*</span>1
              </p>
              <div class="reviews-form-rating">
                <input type="hidden" name="productId" value="<?= $product['id']?>">
                <label for="rating">Đánh giá của bạn<span class="required">*</span></label>
                <div class="rate">
                  <input type="radio" id="star5" name="rate" value="5" checked />
                  <label for="star5" title="text"><i class="fa fa-star"></i></label>
                  <input type="radio" id="star4" name="rate" value="4" />
                  <label for="star4" title="text"><i class="fa fa-star"></i></label>
                  <input type="radio" id="star3" name="rate" value="3" />
                  <label for="star3" title="text"><i class="fa fa-star"></i></label>
                  <input type="radio" id="star2" name="rate" value="2" />
                  <label for="star2" title="text"><i class="fa fa-star"></i></label>
                  <input type="radio" id="star1" name="rate" value="1" />
                  <label for="star1" title="text"><i class="fa fa-star"></i></label>
                </div>
              </div>
              <div class="form-control reviews-form-comment">
                <label for="reviews">Nội dung <span class="required">*</span></label>
                <textarea id="reviews" name="content" cols="45" rows="8" maxlength="1000" required></textarea>
              </div>

              <div class="text-center" style="margin-top: 1rem">
                <button type="submit" form="reviewsform" class="button primary" value='BinhLuan'>Bình Luan</button>
              </div>
            </form>
            <?php else :
              $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]#reviews";
            ?>

            <p>Vui lòng <a href="<?= SITE_URL ?>/login&refurl=<?= base64_encode($actual_link) ?>"
                style=" color: #cc3528; "><strong>đăng nhập</strong></a> để bình
              luận</p>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$RelatedProduct =  $data['RelatedProduct'];
if ($RelatedProduct) { ?>
<section id="related-products">
  <div class="title container text-center">
    <h2>CÓ THỂ BẠN CŨNG THÍCH</h2>
    <img src="<?= SITE_URL ?>/public/img/title.png" />
  </div>
  <div class="row">
    <?php foreach ($RelatedProduct as $product) { ?>
    <div class="col medium-3 small-12 large-3">
      <div class="col-inner">
        <?php require "./mvc/views/block/product.php" ?>
      </div>
    </div>
    <?php
      }
      ?>
  </div>
</section>
<?php } ?>

<script src="<?= SITE_URL ?>/public/js/reviews.js"></script>
<script>
$(document).ready(function() {
  $(document).on('click', '.bpfw-action-flip', function(e) {
    e.preventDefault();
    $('.bpfw-flip-wrapper').toggleClass('bpfw-view');
  });
});
document.addEventListener("DOMContentLoaded", function() {
  const tabs = document.querySelectorAll(".tab-item");
  const panes = document.querySelectorAll(".tab-pane");
  const tabActive = document.querySelector(".tab-item.active");

  if (window.location.hash) {
    var tab = window.location.hash.replace('#', '');
    if (document.getElementById(tab)) {
      document
        .querySelector(".tab-item.active")
        .classList.remove("active");
      document
        .querySelector(".tab-pane.active")
        .classList.remove("active");
      document.getElementById(tab).classList.add("active");
      document.querySelector(".tab-pane.reviews").classList.add("active");
    }

  }
  tabs.forEach((tab, index) => {
    const pane = panes[index];
    tab.onclick = function() {
      document
        .querySelector(".tab-item.active")
        .classList.remove("active");
      document
        .querySelector(".tab-pane.active")
        .classList.remove("active");
      this.classList.add("active");
      pane.classList.add("active");
    };
  });
});
</script>