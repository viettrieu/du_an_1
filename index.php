<!DOCTYPE html>
<html lang="vi">

<head>
  <?php include_once 'layout/layout.meta' ?>
</head>

<body>
  <?php
  session_start();
  $conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');

  $sql = 'SELECT * FROM PRODUCTS LIMIT 10';

  $products = $conn->query($sql);
  ?>
  <!-- HEADER -->
  <?php include_once 'layout/layout-header.php' ?>
  <!-- END HEADER -->

  <!------------------------------------------>
  <!-- SLIDE -->
  <!-- đây là slider -->

  <!-- END SLIDE -->

  <!------------------------------------------>

  <!-- BANNER -->

  <!-- END BANNER -->

  <!------------------------------------------>

  <!-- PRODUCT + SIDE BAR -->
  <section class="hn-section-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="hn-side-bar">
            <div class="side-bar-title">
              <span>DANH MỤC SẢN PHẨM</span>
            </div>
            <div class="side-bar-list">
              <?php
              $categories = $conn->query('SELECT * FROM categories LIMIT 10');
              foreach ($categories as $category) {
                echo '
									<div class="side-bar-item ">
										<a href="./danhsach.php?danh-muc=' . $category["category_id"] . '">' . $category['category_name'] . '</a>
									</div>
									';
              };
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="product-box">
            <div class="hn-product-title">
              <h4>SẢN PHẨM NỔI BẬT</h4>
            </div>
            <div class="hn-product-slide">
              <div class="owl-carousel product-carousel owl-theme">
                <?php
                foreach ($products as $product) {
                  echo '
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
									</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END PRODUCT + SIDE BAR -->

  <!------------------------------------------>

  <!-- PRODUCT -->
  <section class="hn-section-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-box">
            <div class="hn-product-title d-flex justify-content-between">
              <h4>Các Mặt Hàng Mới</h4>
              <div class="hn-product-nav d-none d-md-block">
                <ul>
                  <li class="active"><a href="">Iphone</a></li>
                  <li><a href="">SamSung</a></li>
                  <li><a href="">Paypal</a></li>
                </ul>
              </div>
            </div>
            <div class="hn-product-slide">
              <div class="owl-carousel product-carousel owl-theme">

                <?php
                $products = $conn->query('SELECT * FROM PRODUCTS ORDER BY product_id DESC LIMIT 10');
                foreach ($products as $product) {
                  echo '
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
									</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="hn-section-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-box">
            <div class="hn-product-title d-flex justify-content-between">
              <h4>SẢN PHẨM XEM NHIỀU NHẤT</h4>
              <div class="hn-product-nav d-none d-md-block">
                <ul>
                  <li class="active"><a href="">Iphone</a></li>
                  <li><a href="">SamSung</a></li>
                  <li><a href="">Paypal</a></li>
                </ul>
              </div>
            </div>
            <div class="hn-product-slide">
              <div class="owl-carousel product-carousel owl-theme">

                <?php
                $products = $conn->query('SELECT * FROM PRODUCTS ORDER BY view DESC LIMIT 10');
                foreach ($products as $product) {
                  echo '
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
									</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- NEWSLETTER -->
  <section class="hn-section-8">
    <div class="hn-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="hn-newsletter-title">
              <h3>ĐĂNG KÝ NHẬN <span>TƯ VẤN MIỄN PHÍ</span></h3>
            </div>
            <div class="hn-newsletter-text">
              <p>Bạn là khách hàng, lớn hay nhỏ, muốn được hỗ trợ, tư vấn, xin vui lòng gửi email cho chúng tôi để được
                hỗ trợ tốt nhất!</p>
            </div>
            <div class="hn-newsletter-form">
              <input type="text" placeholder="Email của bạn"><button>ĐĂNG KÝ</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END NEWSLETTER -->

  <!------------------------------------------>

  <!-- PRODUCT + BANNER -->

  <!-- END PRODUCT + BANNER -->

  <!------------------------------------------>

  <!-- REVIEW -->

  <!-- END REVIEW -->

  <!------------------------------------------>

  <!-- NEWS -->
  <section class="hn-section-11">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-box">
            <div class="hn-product-title d-flex justify-content-between">
              <h4>TIN MỚI</h4>
            </div>
            <div class="hn-product-slide">
              <div class="owl-carousel news-carousel owl-theme">
                <div class="hn-news-box">
                  <div class="news-image">
                    <img
                      src="https://hoanghamobile.com/i/productlist/dsp/Uploads/2021/03/10/image-removebg-preview_637509826551438442.png"
                      alt="">
                  </div>
                  <div class="hn-news-content">
                    <div class="hn-news-title">
                      <h6><a href="/nguoi-dung-chuong-noi-that-sach-chuan-chau-au"
                          title="Người dùng chuộng nội thất sạch, chuẩn châu Âu">Người dùng chuộng Sản Phẩm mới</a></h6>
                    </div>
                    <div class="hn-news-text">
                      <p>Người dùng chuộng Sản Phẩm Mới, chuẩn châu Âu
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias repellat quasi, ea maxime
                        explicabo deleniti suscipit, totam sed officia ex illum nobis dolores consequuntur dolorem
                        repellendus quisquam voluptatem sapiente illo?,...</p>
                      <button><a href="">Xem thêm</a></button>
                    </div>
                  </div>
                </div>
                <div class="hn-news-box">
                  <div class="news-image">
                    <img
                      src="https://hoanghamobile.com/i/productlist/dsp/Uploads/2021/03/10/image-removebg-preview_637509826551438442.png"
                      alt="">
                  </div>
                  <div class="hn-news-content">
                    <div class="hn-news-title">
                      <h6><a href="/nguoi-dung-chuong-noi-that-sach-chuan-chau-au"
                          title="Người dùng chuộng nội thất sạch, chuẩn châu Âu">Người dùng chuộng Sản Phẩm mới</a></h6>
                    </div>
                    <div class="hn-news-text">
                      <p>Người dùng chuộng Sản Phẩm Mới, chuẩn châu Âu
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias repellat quasi, ea maxime
                        explicabo deleniti suscipit, totam sed officia ex illum nobis dolores consequuntur dolorem
                        repellendus quisquam voluptatem sapiente illo?,...</p>
                      <button><a href="">Xem thêm</a></button>
                    </div>
                  </div>
                </div>
                <div class="hn-news-box">
                  <div class="news-image">
                    <img
                      src="https://hoanghamobile.com/i/productlist/dsp/Uploads/2021/03/10/image-removebg-preview_637509826551438442.png"
                      alt="">
                  </div>
                  <div class="hn-news-content">
                    <div class="hn-news-title">
                      <h6><a href="/nguoi-dung-chuong-noi-that-sach-chuan-chau-au"
                          title="Người dùng chuộng nội thất sạch, chuẩn châu Âu">Người dùng chuộng Sản Phẩm mới</a></h6>
                    </div>
                    <div class="hn-news-text">
                      <p>Người dùng chuộng Sản Phẩm Mới, chuẩn châu Âu
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias repellat quasi, ea maxime
                        explicabo deleniti suscipit, totam sed officia ex illum nobis dolores consequuntur dolorem
                        repellendus quisquam voluptatem sapiente illo?,...</p>
                      <button><a href="">Xem thêm</a></button>
                    </div>
                  </div>
                </div>
                <div class="hn-news-box">
                  <div class="news-image">
                    <img
                      src="https://hoanghamobile.com/i/productlist/dsp/Uploads/2021/03/10/image-removebg-preview_637509826551438442.png"
                      alt="">
                  </div>
                  <div class="hn-news-content">
                    <div class="hn-news-title">
                      <h6><a href="/nguoi-dung-chuong-noi-that-sach-chuan-chau-au"
                          title="Người dùng chuộng nội thất sạch, chuẩn châu Âu">Người dùng chuộng Sản Phẩm mới</a></h6>
                    </div>
                    <div class="hn-news-text">
                      <p>Người dùng chuộng Sản Phẩm Mới, chuẩn châu Âu
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias repellat quasi, ea maxime
                        explicabo deleniti suscipit, totam sed officia ex illum nobis dolores consequuntur dolorem
                        repellendus quisquam voluptatem sapiente illo?,...</p>
                      <button><a href="">Xem thêm</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END NEWS -->

  <!------------------------------------------>

  <!-- PARTNER -->
  <section class="hn-section-12">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-box">
            <div class="hn-product-title d-flex justify-content-between">
              <h4>Hình ảnh sản phẩm</h4>
            </div>
            <div class="hn-product-slide">
              <div class="owl-carousel partner-carousel owl-theme">
                <div class="partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
							<div class=" partner">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhvbbwleqmQJLUhRBz0iwRLlYVQzSJ2LZItR4V1Hw6PDgmADD7vWJQypvoyDN4WRZ9jjDFmL5C&usqp=CAc"" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
			<!-- END PARTNER -->

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
<script src=" js/jquery-3.4.0.slim.min.js"> </script> <!-- jquery -->
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
                  </script>

</html>