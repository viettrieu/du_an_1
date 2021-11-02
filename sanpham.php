<!DOCTYPE html>
<html lang="vi">

<head>
  <?php include_once 'layout/layout.meta' ?>
  <link rel="stylesheet" href="css/albery.css">
</head>

<?php
if (!isset($_GET['id'])) {
	header('Location: index.php');
	exit();
}

$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');

$id = $_GET['id'];
$sql = "UPDATE products SET view = view + 1 WHERE product_id = $id";
$conn->query($sql);
$sql = '
SELECT *
FROM ((products
INNER JOIN brands ON products.brand_id = brands.brand_id)
INNER JOIN categories ON products.category_id = categories.category_id)
WHERE products.product_id=' . $id;
$row = $conn->query($sql)->fetch();

?>

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
        <div class="col-lg-5">
          <div class="zoomWrapper">

            <?php
						echo '<img id="zoom_03" src="./images/product-images/' . $row['product_images'] . '" data-zoom-image="./images/product-images/' . $row['product_images'] . '" style="">';
						?>
          </div>
          <!-- <div id="gallery_01">
						<a href="#" data-image="https://picsum.photos/1000/666?image=660" data-zoom-image="https://picsum.photos/1000/666?image=660" style="" class="active">
							<img id="img_01" src="https://picsum.photos/116/77?image=660">
						</a>
						<a href="#" data-image="https://picsum.photos/1000/666?image=661" data-zoom-image="https://picsum.photos/1000/666?image=661" style="" class="">
							<img id="img_01" src="https://picsum.photos/116/77?image=661">
						</a>
						<a href="#" data-image="https://picsum.photos/1000/666?image=662" data-zoom-image="https://picsum.photos/1000/666?image=662">
							<img id="img_01" src="https://picsum.photos/116/77?image=662">
						</a>
						<a href="#" data-image="https://picsum.photos/1000/666?image=663" data-zoom-image="https://picsum.photos/1000/666?image=663">
							<img id="img_01" src="https://picsum.photos/116/77?image=663">
						</a>
						<a href="#" data-image="https://picsum.photos/1000/666?image=664" data-zoom-image="https://picsum.photos/1000/666?image=664">
							<img id="img_01" src="https://picsum.photos/116/77?image=664">
						</a>
					</div> -->
        </div>
        <div class="col-lg-7">
          <div class="product">
            <div class="product-name">
              <?php
							echo '<span class="h2">' . $row['product_name'] . '</span>';
							?>
            </div>
            <div class="inventory">
              <span>Còn hàng</span>
            </div>
            <div class="">
              <span>Lượt xem: <?= $row['view'] ?> </span>
            </div>
            <div class="price-box">

              <?php
							if ($row['product_name'] > 0) {
								$product_sale = $row['product_sale'] == 0 ? $row['product_price'] : $row['product_sale'];
								echo '
									<span class="special-price">' . $product_sale . '₫</span>
									<span class="old-price">' . $row['product_price'] . '₫</span>
								';
							} else {
								echo '<span class="special-price">' . $row['product_price'] . '₫</span>';
							}
							?>
            </div>
            <div class="information">
              <p>Nhà sản xuất:
                <?php echo '<a href="danhsach.php?brand-id=' . $row['brand_id'] . '">' . $row['brand_name'] . '</a>'; ?>
              </p>
              <p>Dòng sản phẩm:
                <?php echo '<a href="danhsach.php?category-id=' . $row['category_id'] . '">' . $row['category_name'] . '</a>'; ?>
              </p>
            </div>
            <div class="description">
              <h5>MÔ TẢ:</h5>
              <?php echo '<a href="">' . $row['product_destination'] . '</a>'; ?>
              <p>Bảo hành: 6 Năm </p>
              <p> Nguồn gốc: Hugo, Malaysia</p>
            </div>
            <div class="product-form">
              <div class="color-select">
                <h5>Màu sắc</h5>
                <label class="color">
                  <input type="radio" name="color" checked="checked">
                  <span class="checkmark"></span>
                </label>
                <label class="color">
                  <input type="radio" name="color">
                  <span class="checkmark black"></span>
                </label>
                <label class="color">
                  <input type="radio" name="color">
                  <span class="checkmark brown"></span>
                </label>
              </div>
              <form method="GET" action="giohang.php" class="quantity">
                <h5>Số lượng</h5>
                <input type="text" name="add" value="<?php echo  $row['product_id'] ?>" hidden>
                <input type="number" name="quantity" min="1" max="9" step="1" value="1">
                <button type="submit">Thêm vào giỏ hàng</a>
              </form>
              <button class="iwish d-inline"><i class="far fa-heart heart"></i></button>
              <button class="iwish d-inline"><i class="fas fa-heart heart"></i></button>
              <span>Yêu thích</span>
              <div class="contact">
                <div class="row">
                  <div class="phone-icon">
                    <i class="fas fa-phone-volume"></i>
                  </div>
                  <p>
                    <span>Đặt Mua Qua Điện Thoại (8h00 - 20h00) </span>
                    <br>
                    <a href="">0902068068</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-lg-9">
          <div class="product-tab">
            <div class="product-tab-nav">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="product-info-tab" data-toggle="tab" href="#product-info" role="tab"
                    aria-controls="product-info" aria-selected="true">Thông tin sản phẩm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab"
                    aria-controls="shipping" aria-selected="false">Hình thức giao hàng</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating"
                    aria-selected="false">Đánh giá sản phẩm</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="product-info" role="tabpanel"
                  aria-labelledby="product-info-tab">Thông tin sản phẩm</div>
                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">Hình thức giao
                  hàng</div>
                <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">
                  <h3>Đánh giá sản phẩm</h3>
                  <ul class="list-unstyled">
                    <li class="media">
                      <img class="mr-3" src="..." alt="Generic placeholder image">
                      <div class="media-body">
                        <h5 class="mt-0 mb-1">List-based media object</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                        vulputate fringilla. Donec lacinia congue felis in faucibus.
                      </div>
                    </li>
                    <li class="media my-4">
                      <img class="mr-3" src="..." alt="Generic placeholder image">
                      <div class="media-body">
                        <h5 class="mt-0 mb-1">List-based media object</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                        vulputate fringilla. Donec lacinia congue felis in faucibus.
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3" src="..." alt="Generic placeholder image">
                      <div class="media-body">
                        <h5 class="mt-0 mb-1">List-based media object</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                        vulputate fringilla. Donec lacinia congue felis in faucibus.
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="product-tab-content">
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="hn-side-bar">
            <div class="side-bar-title">
              <span>Có thể bạn thích</span>
            </div>
            <div class="side-bar-list">
              <div class="small-product">
                <div class="row">
                  <div class="col-4 text-center">
                    <div class="item-thumb">
                      <img src="https://dummyimage.com/200x200/333333/ffffff/ alt=" "="">
										</div>
									</div>
									<div class=" col-8">
                      <div class="item-title">
                        <a href="">Tủ quần áo hiện đại</a>
                      </div>
                      <div class="item-price">
                        <div class="special-price">
                          <span>1.800.000₫</span>
                        </div>
                        <div class="old-price">
                          <span>
                            1.900.000₫
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="small-product">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div class="item-thumb">
                        <img src="https://dummyimage.com/200x200/333333/ffffff/ alt=" "="">
										</div>
									</div>
									<div class=" col-8">
                        <div class="item-title">
                          <a href="">Tủ quần áo hiện đại</a>
                        </div>
                        <div class="item-price">
                          <div class="special-price">
                            <span>1.800.000₫</span>
                          </div>
                          <div class="old-price">
                            <span>
                              1.900.000₫
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="small-product">
                    <div class="row">
                      <div class="col-4 text-center">
                        <div class="item-thumb">
                          <img src="https://dummyimage.com/200x200/333333/ffffff/ alt=" "="">
										</div>
									</div>
									<div class=" col-8">
                          <div class="item-title">
                            <a href="">Tủ quần áo hiện đại</a>
                          </div>
                          <div class="item-price">
                            <div class="special-price">
                              <span>1.800.000₫</span>
                            </div>
                            <div class="old-price">
                              <span>
                                1.900.000₫
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="small-product">
                      <div class="row">
                        <div class="col-4 text-center">
                          <div class="item-thumb">
                            <img src="https://dummyimage.com/200x200/333333/ffffff/ alt=" "="">
										</div>
									</div>
									<div class=" col-8">
                            <div class="item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="product-box">
                    <div class="hn-product-title d-flex justify-content-between">
                      <h4>Sản phẩm cùng loại</h4>
                    </div>
                    <div class="hn-product-slide">
                      <div class="owl-carousel product-carousel owl-theme">
                        <div class="product-box-item">
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="sale">
                              <span>-90%</span>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="sale">
                              <span>-90%</span>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="sale">
                              <span>-90%</span>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="hn-product-item text-center ">
                            <div class="hn-button-wrap justify-content-center">
                              <div class="hn-product-button">
                                <span>Mua hàng</span>
                              </div>
                              <div class="hn-product-button">
                                <span>Xem thêm</span>
                              </div>
                            </div>
                            <div class="item-thumb">
                              <img src="https://dummyimage.com/240x160/333333/ffffff/ alt="">
										</div>
										<div class=" item-title">
                              <a href="">Tủ quần áo hiện đại</a>
                            </div>
                            <div class="item-star">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="far fa-star"></i>
                              <i class="far fa-star"></i>

                            </div>
                            <div class="item-price">
                              <div class="special-price">
                                <span>1.800.000₫</span>
                              </div>
                              <div class="old-price">
                                <span>
                                  1.900.000₫
                                </span>
                              </div>
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


  <!------------------------------------------>

  <!-- MAP -->
  <?php include_once 'layout/layout.map' ?>
  <!-- END MAP -->

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

<script src="js/jquery.ez-plus.js"></script>
<script src="js/albery.js"></script>

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

$(".demo").ezPlus({});
$(".albery-container").albery({
  speed: 100, // default: 200
  imgWidth: 500, // default: 600
  paginationBorder: 15,
  paginationItemWidth: 100
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $("#zoom_03").ezPlus({
    gallery: 'gallery_01',
    cursor: 'pointer',
    galleryActiveClass: "active",
    imageCrossfade: true,
    loadingIcon: "images/spinner.gif"
  });

  $("#zoom_03").bind("click", function(e) {
    var ez = $('#zoom_03').data('ezPlus');
    ez.closeAll(); //NEW: This function force hides the lens, tint and window
    $.fancybox(ez.getGalleryList());
    return false;
  });

});
</script>

</html>