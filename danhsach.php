<!DOCTYPE html>
<html lang="vi">

<head>
  <?php include_once 'layout/layout.meta' ?>
</head>
<?php session_start(); ?>
<?php
$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', ''); ?>

<body style="background-color: #ffffff">
  <!-- HEADER -->
  <?php include_once 'layout/layout-header.php' ?>
  <!-- END HEADER -->

  <!------------------------------------------>
  <section class="breadcrumbs">
    <div class="container">
      <ul>
        <li>
          <a href="index.php">Trang chủ</a>
          <i class="fas fa-chevron-right"></i>
        </li>
        <li>
          <span>Giới thiệu</span>
        </li>
      </ul>
    </div>
  </section>
  <section class="hn-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include_once 'layout/layout.side-bar.php' ?>
        </div>
        <div class="col-lg-9">
          <div class="hn-sort-bar">
            <div class="row">
              <div class="col-md-6">
                <i class="grid-menu fas fa-th"></i>
                <i class="list-menu fas fa-th-list"></i>
              </div>
              <div class="col-md-6 text-right">
                <div class="hn-sort-by">
                  <span>Thứ tự</span>
                  <select>
                    <option>Mặc định</option>
                    <option>A > Z</option>
                    <option>Z > A</option>
                    <option>Giá tăng dần</option>
                    <option>Giá giảm dần</option>
                    <option>Hàng mới nhất</option>
                    <option>Hàng cũ nhất</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="hn-grid row">
            <?php
            $page = isset($_GET['page']) ?  $_GET['page'] : 1;
            $perPage = 6;
            $offset = ($page - 1) * $perPage;
            $base_url = './danhsach.php?a';
            $list = 'SELECT * FROM products';
            $tong = "SELECT count(*) AS 'count' FROM products ";
            $where = '';
            if (isset($_GET['danh-muc'])) {
              $where = ' WHERE category_id= ' . $_GET['danh-muc'];
              $base_url = './danhsach.php?danh-muc=' . $_GET['danh-muc'];
            }
            if (isset($_GET['thuong-hieu'])) {
              $where = ' WHERE brand_id= ' . $_GET['thuong-hieu'];
              $base_url = './danhsach.php?thuong-hieu=' . $_GET['thuong-hieu'];
            }
            if (isset($_GET['search'])) {
              $where = " WHERE product_name LIKE '%" . $_GET['search'] . "%'";
              $base_url = './danhsach.php?search=' . $_GET['search'];
            }
            $list .= $where;
            $list .= ' ORDER BY product_id DESC';
            $list .= " LIMIT $offset, $perPage";
            $tong .= $where;
            $totalProduct = $conn->query($tong)->fetch();
            $totalPost =  $totalProduct['count'];
            $products = $conn->query($list);
            if ($products->rowCount() > 0) {
              foreach ($products as $product) {
                echo '
							<div class="col-12 col-sm-6 col-md-4 col-lg-4">
							<div class="product-box-item">
							<div class="hn-product-item text-center">
								<div class="hn-button-wrap justify-content-center">
									<div class="hn-product-button">
										<a href="giohang.php?add=' . $product['product_id'] . '">Thêm vào giỏ hàng</a>
									</div>
								</div>
								<div class="sale">
									<span>-90%</span>
								</div>
								<div class="item-thumb">
									<img src="./images/product-images/' . $product['product_images'] . '" alt="">
								</div>
								<div class="item-title">
									<a href="sanpham.php?id=' . $product['product_id'] . '">' . $product['product_name'] . '</a>
								</div>
								<div class="item-star">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>
								<div class="item-price">
									';
                if ($product['product_sale'] != 0) {
                  echo '
									<div class="special-price">
										<span>' . $product['product_sale'] . '₫</span>
									</div>
									<div class="old-price">
									<span>' . $product['product_price'] . '₫</span>
									</div>';
                } else {
                  echo '
									<div class="special-price">
										<span>' . $product['product_price'] . '₫</span>
									</div>
									<div class="old-price">
									<span></span>
									</div>';
                }


                echo '
								</div>
							</div>
							</div>
							</div>';
              }
            } else {
              echo 'Chưa có sản phẩm nào';
            }
            ?>
          </div>
          <?php if ($page <= 0) return "";
          $totalPages = ceil($totalPost / $perPage);
          if ($totalPages <= 1) return "";
          $links = "<div class='pagination'><ul>";
          if ($page > 1) {
            $first = "<li><a href='{$base_url}&page=1'> << </a></li>";
            $page_prev = $page - 1;
            $prev = "<li><a href='{$base_url}&page={$page_prev}'> < </a></li>";
            $links .= $first . $prev;
          }
          $from = $page - 3;
          $to = $page + 3;
          if ($from < 1) $from  = 1;
          if ($to > $totalPages) $to  = $totalPages;
          for ($i = $from; $i <= $to; $i++) {
            if ($i == $page) {
              $str = "<li><a href='javascript:void(0)' class='active'>{$i}</a></li>";
            } else {
              $str = "<li><a href='{$base_url}&page={$i}'> {$i} </a></li>";
            }
            $links .= $str;
          }
          if ($page < $totalPages) {
            $page_next = $page + 1;
            $next = "<li><a  href='{$base_url}&page={$page_next}'> > </a></li>";
            $last = "<li><a href='{$base_url}&page={$totalPages}'> >> </a></li>";
            $links .= $next . $last;
          }

          $links .= "</ul> </div>";
          echo $links;
          ?>
        </div>
      </div>
    </div>
  </section>


  <!------------------------------------------>



  <!------------------------------------------>

  <!-- FOLLOW -->
  <?php include_once 'layout/layout.follow' ?>
  <!-- END FOLLOW -->

  <!------------------------------------------>

  <!-- FOOTER -->
  <?php include_once 'layout/layout.footer' ?>
  <!-- END FOOTER -->

  <!------------------------------------------>

  <!-- COPYRIGHT -->
  <?php include_once 'layout/layout.copyright' ?>
  <!-- END COPYRIGHT -->

  <!------------------------------------------>

</body>

<!-- jquery.slim.min.js -->
<script src="js/jquery-3.4.0.slim.min.js"></script>
<!-- jquery -->
<script src="js/jquery-3.4.0.min.js"></script>
<!-- fancybox script -->
<script src="js/jquery.fancybox.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap.min.js -->
<script src="js/bootstrap_js/bootstrap.min.js"></script>

<!-- owlcarousel -->
<script src="owlcarousel/owl.carousel.min.js"></script>


<script>
//carousel script
$(".partner-carousel").owlCarousel({
  loop: !1,
  margin: 10,
  responsiveClass: !0,
  responsive: {
    0: {
      items: 1,
      nav: !1
    },
    360: {
      items: 2,
      nav: !1
    },
    760: {
      items: 3,
      nav: !0
    },
    1000: {
      items: 5,
      nav: !0
    },
    1200: {
      items: 6,
      nav: !0,
      loop: !1
    }
  }
}), $(".news-carousel").owlCarousel({
  loop: !1,
  margin: 10,
  responsiveClass: !0,
  responsive: {
    0: {
      items: 1,
      nav: !1
    },
    480: {
      items: 2,
      nav: !0
    },
    768: {
      items: 3,
      nav: !0
    },
    1024: {
      items: 4,
      nav: !0,
      loop: !1
    }
  }
}), $("#hn-review-carousel").owlCarousel({
  autoplay: !0,
  autoplayTimeout: 5e3,
  loop: !0,
  margin: 0,
  items: 1
}), $(".owl-carousel").owlCarousel({
  loop: !1,
  margin: 10,
  responsiveClass: !0,
  responsive: {
    0: {
      items: 2,
      nav: !1
    },
    480: {
      items: 3,
      nav: !0
    },
    768: {
      items: 4,
      nav: !0
    },
    1024: {
      items: 4,
      nav: !0,
      loop: !1
    }
  }
});

// dropdown script
$('.dropdown-toggle').dropdown({
  flip: false
})
$(document).ready(function() {
  $('.dropdown a.drop').on("click", function(e) {
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

$(document).ready(function() {
  $(".list-menu").click(function() {
    $(".hn-grid").removeClass("d-flex").addClass("d-none");
    $(".hn-list").removeClass("d-none").addClass("d-flex");
  });
  $(".grid-menu").click(function() {
    $(".hn-list").removeClass("d-flex").addClass("d-none");
    $(".hn-grid").removeClass("d-none").addClass("d-flex");
  });
});
</script>

</html>