<?php if (isset($_GET['id'])) {
  $email = $fullName = '';
  if (isset($userID)) {
    $query = "SELECT email, fullName FROM ps_users WHERE id = $userID";
    $user = $conn->query($query)->fetch_assoc();
    $email = $user['email'];
    $fullName = $user['fullName'];
  }
  $id = $_GET['id'];
  $query = "INSERT INTO ps_product_meta (productId, `key`, content) VALUES ('$id', 'view', 1)  ON DUPLICATE KEY UPDATE content = content + 1";
  $conn->query($query);
  $query = "SELECT product.*, mt.content AS 'view',  X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id LEFT JOIN ps_product_meta mt ON product.id = mt.productId  AND mt.key = 'view' WHERE product.id = $id";
  $row = $conn->query($query);
  if ($row->num_rows > 0) {
    $product = $row->fetch_assoc();
    function getCategoryAndTag($key, $title)
    {
      global $conn, $id;
      if ($key == "tag") {
        $query = "SELECT id, title FROM ps_tag
      INNER JOIN product_tag ON tagId = ps_tag.id WHERE productId = $id";
      } else {
        $query = "SELECT id, title FROM ps_category
        INNER JOIN product_category ON categoryId = ps_category.id WHERE productId = $id";
      }
      $rows = $conn->query($query);
      if ($rows->num_rows > 0) {
        echo '<span class="posted-in">' . $title;
        foreach ($rows as $row) {
          echo '<a href="' . $row['id'] . '" rel="tag">' . $row['title'] . '</a>';
        }
      }
      echo '</span>';
    }
  } else {
    echo ("<script>location.href = './index.php?action=cua-hang';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=cua-hang';</script>");
}
?>

<body>
  <div class="breadcrumbs single-product">
    <div class="container">
      <nav>
        <a href="./index.php">Trang chủ</a>
        <span class="divider">/</span>
        <a href="./index.php?action=cua-hang">Của hàng</a>
        <span class="divider">/</span>
        <?php echo $product['title']; ?>
      </nav>
    </div>
  </div>
  <div class="row page-wrapper">
    <div class="col medium-6 small-12 large-6">
      <div class="slider-for">
        <div class="item">
          <img src="<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-2.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-3.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-4.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-5.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-6.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-7.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-8.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
      </div>
      <div class="slider-nav">
        <div class="item">
          <img src="<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-2-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-3-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-4-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-5-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-6-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-7-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
        <div class="item">
          <img src="./assets/img/product-8-150x150.jpg" alt="<?php echo $product['title']; ?>" />
        </div>
      </div>
    </div>
    <div class="col medium-6 small-12 large-6">
      <h1 class="entry-title product-title"><?php echo $product['title']; ?></h1>
      <div class="product-rating view">
        <?php if ($product["rating"] != NULL) : ?>
        <div class="star-rating" style=" margin-right: 10px; ">
          <div class="star-ratings-css" style=" font-size: 2rem; ">
            <div class="star-ratings-inner" style="width: <?= $product["rating"] * 20 ?>%"></div>
          </div>
        </div>
        <?php endif ?>
        <span style=" margin-bottom: 0; ">Lượt xem: <?= $product['view']; ?></span>
      </div>
      <span class="price product-price" data-price="<?php echo $product['price']; ?>">
        <span class="unit-price"><?php echo number_format($product['price'], 0, ',', '.'); ?></span>
        <sup>đ</sup>
      </span>
      <div class="product-short-description">
        <?php echo $product['summary']; ?>
      </div>
      <form class="add-cart" action="./gio-hang.html" method="get">
        <div class="buttons-added">
          <div class="quantity">
            <button class="minus-btn" type="button" name="button" onclick="buttonMinusPlus(this, -1)">
              -
            </button>
            <input type="text" name="quantity" value="1" onchange="changeQuantity(this)">
            <button class="plus-btn" type="button" name="button" onclick="buttonMinusPlus(this, +1)">
              +
            </button>
          </div>
          <div class="add-the-cart">
            <a href="#" class="secondary">
              <i class="fas fa-shopping-cart"></i>
              <i class="fas fa-box"></i>
              <span>THÊM VÀO GIỎ</span>
            </a>
          </div>
        </div>
      </form>
      <div class="product-meta">
        <span class="sku-wrapper">SKU: <span class="sku"><?php echo $product['sku']; ?></span> </span>
        <?= getCategoryAndTag('category', 'Danh mục: ') ?>
        <?= getCategoryAndTag('tag', 'Từ khóa: ') ?>
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
    <div class="col small-12 large-12">
      <div class="tabs">
        <div class="tab-item active">Mô tả</div>
        <div class="tab-item">Đánh giá</div>
        <div class="line"></div>
      </div>
      <div class="tab-content">
        <div class="tab-pane active">
          <?php echo $product['content']; ?>
        </div>
        <div class="tab-pane">
          <div class="row">
            <div class="col medium-12 small-12 large-6">
              <div class="reviews-container">
                <ul id="reviews-list" class="comments-list reviews">
                  <?php $query = "SELECT  review.fullName, rating , content, avatar FROM ps_product_review review LEFT JOIN ps_users ON userId  = ps_users.id WHERE productId = $id AND status = 1  ORDER BY published DESC";
                  $reviewsList = $conn->query($query);
                  if ($reviewsList->num_rows > 0) {
                    while ($row = $reviewsList->fetch_assoc()) { ?>
                  <li>
                    <div class="comment-main-level">
                      <div class="comment-avatar">
                        <img src="./<?= $row['avatar'] != NULL ?  $row['avatar'] : './assets/img/avatar-default.png' ?>"
                          alt="<?= $row['fullName'] ?>" />
                      </div>
                      <div class="comment-box">
                        <div class="comment-head">
                          <h6 class="comment-name by-customer">
                            <?= $row['fullName'] ?>
                          </h6>
                          <div class="star-ratings-css">
                            <div class="star-ratings-inner" style="width: <?= $row['rating'] * 20 ?>%"></div>
                          </div>
                        </div>
                        <div class="comment-content">
                          <?= $row['content'] ?>
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
              <form action="" method="POST" id="reviews-form" data-id="<?php echo $id; ?>">
                <div class=" row">
                  <div class="col small-12 large-12">
                    <p style="font-weight: 600">
                      Địa chỉ email của bạn sẽ không được công bố. Các trường
                      bắt buộc được đánh dấu <span class="required">*</span>
                    </p>
                    <div class="reviews-form-rating">
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
                  </div>
                  <div class="col medium-6 small-12 large-6">
                    <div class="form-control reviews-form-author">
                      <label for="fullName">
                        Họ và tên
                        <span class="required">*</span></label>
                      <input id="fullName" name="fullName" type="text" value="<?= $fullName ?>" size="30" required />
                    </div>
                  </div>
                  <div class="col medium-6 small-12 large-6">
                    <div class="form-control reviews-form-email">
                      <label for="email">
                        Email <span class="required">*</span>
                      </label>
                      <input id="email" name="email" type="email" value="<?= $email ?>" size="30" required />
                    </div>
                  </div>
                </div>
                <div class="container">
                  <input id="cookies-consent" name="cookies-consent" type="checkbox" value="yes" />
                  <label for="cookies-consent">Lưu tên, email và trang web của tôi trong trình duyệt này
                    cho lần tôi nhận xét tiếp theo.</label>
                  <div class="text-center" style="margin-top: 1rem">
                    <button type="submit" form="reviews-form" value="Submit" class="button primary">
                      ĐÁNH GIÁ
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  $query =  "SELECT product.id, thumbnail, product.title, price, X.rating, categoryId FROM ps_product product
  LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id
  LEFT JOIN product_category category ON product.id = category.productId WHERE categoryId IN( SELECT id FROM ps_category INNER JOIN product_category ON categoryId = ps_category.id WHERE productId = $id) AND NOT product.id = $id GROUP BY  product.id ORDER BY RAND() LIMIT 3";
  $product = $conn->query($query);
  if ($product->num_rows > 0) { ?>
  <section id="related-products">
    <div class="title container text-center">
      <h2>CÓ THỂ BẠN CŨNG THÍCH</h2>
      <img src="./assets/img/title.png" />
    </div>
    <div class="row">
      <?php while ($row = $product->fetch_assoc()) {
          // $label = $row["content"] ? '<div class="label-new ' . $row["content"] . '">' . $row["content"] . '</div>' : '';
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
        } ?>
    </div>
  </section>
  <?php } ?>
  <?php include_once 'footer.php' ?>

  <script src="./assets/js/reviews.js"></script>
  <script src="./assets/js/slick.js"></script>
  <script src="./assets/js/jquery.zoom.js"></script>
  <script>
  $(document).ready(function() {
    $(".slider-for").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: ".slider-nav",
    });
    $(".slider-nav").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: ".slider-for",
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      responsive: [{
        breakpoint: 849,
        settings: {
          slidesToShow: 3,
        },
      }, ],
    });
    $(".slider-for .item").zoom(); // add zoom
  });
  document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".tab-item");
    const panes = document.querySelectorAll(".tab-pane");
    const tabActive = document.querySelector(".tab-item.active");
    const line = document.querySelector(".tabs .line");
    line.style.left = tabActive.offsetLeft + "px";
    line.style.width = tabActive.offsetWidth + "px";
    tabs.forEach((tab, index) => {
      const pane = panes[index];
      tab.onclick = function() {
        document
          .querySelector(".tab-item.active")
          .classList.remove("active");
        document
          .querySelector(".tab-pane.active")
          .classList.remove("active");
        line.style.left = this.offsetLeft + "px";
        line.style.width = this.offsetWidth + "px";
        this.classList.add("active");
        pane.classList.add("active");
      };
    });
  });
  </script>
</body>

</html>