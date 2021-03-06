<?php
$Cproduct = $data["Product"];
$UserById = $data["UserById"];
$ListAuthor = $data["ListAuthor"];
$wishlist = ["link" => "javascript:void(0);", "class" => "wishlist", "icon" => "far",];
if (isset($_SESSION['user']['wishlist']) && in_array($Cproduct["id"], $_SESSION['user']['wishlist'])) {
  $wishlist = ["link" => SITE_URL . "/wishlist", "class" => "", "icon" => "fas",];
}
?>
<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-6 small-12 large-4">
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
        <a href="https://auteur.g5plus.net/wp-admin/admin-ajax.php?action=bpfw_read_book&product_id=126&acds_read_book_nonce=1606f631e6"
          class="bpfw-btn bpfw-action-read-book">
          <span>Look inside</span>
        </a>
      </div>
    </div>
  </div>
  <div class="col medium-6 small-12 large-5">
    <h1 class="entry-title product-title"><?= $Cproduct['title']; ?></h1>
    <?php if ($data["AVGReview"] != NULL) : ?>
    <div class="product-rating view">
      <div class="star-rating" style=" margin-right: 10px; ">
        <div class="star-ratings-css" style=" font-size: 2rem; ">
          <div class="star-ratings-inner" style="width: <?= $data["AVGReview"] * 20 ?>%"></div>
        </div>
      </div><a href="#reviews" id="show_review">(Xem <?= count($data['ListReview']) ?> ????nh gi??)</a>
    </div>
    <?php endif ?>
    <span class="price product-price">
      <?php if (isset($Cproduct["discount"])) : ?>
      <del aria-hidden="true">
        <span><?= number_format($Cproduct["price"], 0, ',', '.') ?>???</span>
      </del>
      <?php endif ?>
      <ins class="sizeprice">
        <span><?= number_format(isset($Cproduct["discount"]) ? $Cproduct["discount"] : $Cproduct["price"], 0, ',', '.') ?>???</span>
      </ins>
    </span>
    <div class="product-short-description">
      <?= $Cproduct['summary']; ?>
    </div>

    <div class="buttons-added">
      <div class="quantity">
        <span>S??? l?????ng:</span>
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
          <span>TH??M V??O GI???</span>
        </a>
      </div>
      <div class="add-to-wishlist">
        <a href="<?= $wishlist["link"] ?>" class="<?= $wishlist["class"] ?>" data-id="<?= $Cproduct["id"] ?>"><i
            class="<?= $wishlist["icon"] ?> fa-heart"></i>
        </a>
      </div>
    </div>
    <div class="product-meta">
      <span class="nxb-wrapper">NXB: <a href="<?= SITE_URL ?>/store/publisher/<?= $Cproduct['publisherId'] ?>"
          rel="tag"><?= $Cproduct['publisher'] ?></a> </span> <br>
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
      <span class="social-share-title">Chia s???:</span>
      <ul class="social-media">
        <li>
          <a class="facebook"
            href="https://www.facebook.com/share.php?u=<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>&title=<?= $Cproduct['title']; ?>"
            target="blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="twitter"
            href="https://twitter.com/intent/tweet?text=<?= $Cproduct['title']; ?>&url=<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>"
            target="blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a class="linkedin"
            href="https://www.linkedin.com/shareArticle?mini=true&url=<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>&title=<?= $Cproduct['title']; ?>&source={{source}}"
            target="blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </li>
        <li>
          <a class="pinterest"
            href="https://pinterest.com/pin/create/bookmarklet/?media=<?= SITE_URL ?>/<?= $Cproduct["thumbnail"] ?>&url=<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>&is_video=false&description=<?= $Cproduct['title']; ?>"
            target="blank">
            <i class="fab fa-pinterest"></i>
          </a>
        </li>
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
    <div class="owl-carousel owl-theme container-full" id="book_author">
      <?php
      foreach ($ListAuthor as $author) : ?>
      <div class="item">
        <div class="row">
          <div class="col medium-4 small-12 large-4">
            <div class="col-inner">
              <div class="author-avatar">
                <img src="<?= SITE_URL ?><?= $author['avatar'] ?>">
              </div>
              <div class="author-info">
                <h4 class="text-center" href="https://auteur.g5plus.net/product-author/shia-ung/" title="Shia Ung">
                  <?= $author['title'] ?></a>
                </h4>

                <ul class="social-media">
                  <li>
                    <a class="facebook" href="<?= $author['fblink'] ?>" target="blank">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li>
                    <a class="twitter" href="<?= $author['twitterlink'] ?>" target="blank">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a class="youtube" href="<?= $author['youtubelink'] ?>" target="blank">
                      <i class="fab fa-youtube"></i>
                    </a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <div class="col medium-8 small-12 large-8">
            <div class="col-inner">
              <div class="author-quote">" <?= $author['quote'] ?>"</div>
              <div class="container related-book owl-carousel owl-theme">
                <?php
                  $listBook =  $author['listbook'];
                  foreach ($listBook as $product) :
                    if ($Cproduct['id'] == $product['id']) continue;
                  ?>
                <?php require "./mvc/views/block/product.php" ?>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<div class="row">
  <div class="col small-12 large-12">
    <div class="tabs">
      <div class="tab-item active">M?? t???</div>
      <div class="tab-item" id="reviews">????nh gi??</div>
    </div>
    <div class="tab-content">
      <div class="tab-pane active">
        <?= $Cproduct['content'] ?>
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
                      <img src="<?= $review['avatar'] ?>"
                        alt="<?= $review['fullName'] ? $review['fullName'] : $review['username'] ?>" />
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
                  echo '<li class="noreviews">Ch??a c?? ????nh gi?? cho s???n ph???m n??y</li>';
                }
                ?>
              </ul>
            </div>
          </div>
          <div class="col medium-12 small-12 large-6 col-nop medium-col-first">
            <?php if (isset($_SESSION["user"])) : ?>
            <form action="" method="POST" id="reviews-form" data-id="<?= $Cproduct['id']; ?>">
              <p style="font-weight: 600">
                ?????a ch??? email c???a b???n s??? kh??ng ???????c c??ng b???. C??c tr?????ng
                b???t bu???c ???????c ????nh d???u <span class="required">*</span>
              </p>
              <div class="reviews-form-rating">
                <label for="rating">????nh gi?? c???a b???n<span class="required">*</span></label>
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
                <label for="reviews">N???i dung <span class="required">*</span></label>
                <textarea id="reviews" name="content" cols="45" rows="8" maxlength="1000" required></textarea>
              </div>

              <div class="text-center" style="margin-top: 1rem">
                <button type="submit" form="reviews-form" value="Submit" class="button primary">
                  B??nh lu???n
                </button>
              </div>
            </form>
            <?php else :
              $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]#reviews";
            ?>

            <p>Vui l??ng <a href="<?= SITE_URL ?>/login&refurl=<?= base64_encode($actual_link) ?>"
                style=" color: #cc3528; "><strong>????ng nh???p</strong></a> ????? b??nh
              lu???n</p>
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
    <h2>C?? TH??? B???N C??NG TH??CH</h2>
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
document.addEventListener("DOMContentLoaded", function() {
  const tabs = document.querySelectorAll(".tab-item");
  const panes = document.querySelectorAll(".tab-pane");
  const tabActive = document.querySelector(".tab-item.active");
  $("#show_review").click(showTabReview);

  function showTabReview() {
    var tab = "reviews";
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
  if (window.location.hash) {
    showTabReview()
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