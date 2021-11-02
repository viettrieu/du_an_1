<section id="slider">
  <div class="slider owl-carousel owl-theme">
    <div class="item">
      <img src="./assets/img/slider-2.jpg" alt="Slider">
    </div>
    <div class="item">
      <img src="./assets/img/slider-1.jpg" alt="Slider">
    </div>
    <div class="item">
      <img src="./assets/img/slider-3.jpg" alt="Slider">
    </div>
  </div>
</section>
<section id="banner" class="hide-for-medium">
  <div class="row">
    <div class="col medium-6 small-12 large-6">
      <div class="col-inner">
        <div class="banner has-hover bg-zoom">
          <div class="banner-inner fill">
            <a href="" class="banner-1 fill bg-fill bg"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-6 small-12 large-6">
      <div class="banner has-hover bg-zoom">
        <div class="banner-inner fill">
          <a href="" class="banner-2 fill bg-fill bg"></a>
        </div>
      </div>
    </div>
</section>
<section id="list-products">
  <div class="title container text-center">
    <h2>CÁC MÓN BÁN CHẠY</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="row">

    <?php
    $product =  "SELECT product.id,product.title, thumbnail,price, SUM(orderi.quantity) AS 'quantity', X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id JOIN ps_order_item orderi   ON product.id = orderi.productId GROUP BY orderi.productId ORDER BY quantity DESC LIMIT 5";
    $resultproduct = $conn->query($product);
    if ($resultproduct->num_rows > 0) {
      echo '<div class="container list-posts owl-carousel owl-theme">';
      while ($row = $resultproduct->fetch_assoc()) {
    ?>
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
    <?php
      }
      echo '</div>';
    } else {
      echo "0 results";
    }
    //                    $db->close();
    ?>
  </div>
  <div class="title container text-center" style=" margin-top: 1.5rem; ">
    <h2>CÁC MÓN HOT</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="row">
    <?php
    $product =  "SELECT product.id,product.title, thumbnail,price, SUM(orderi.productId) AS 'quantity', X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id  INNER JOIN ps_order_item orderi ON product.id = orderi.productId GROUP BY orderi.productId  ORDER BY orderi.productId DESC LIMIT 5";
    $resultproduct = $conn->query($product);
    if ($resultproduct->num_rows > 0) {
      echo '<div class="container list-posts owl-carousel owl-theme">';
      while ($row = $resultproduct->fetch_assoc()) {
    ?>
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
    <?php
      }
      echo '</div>';
    } else {
      echo "0 results";
    }
    //                    $db->close();
    ?>
  </div>
  <div class="title container text-center" style=" margin-top: 1.5rem; ">
    <h2>CÁC MÓN XEM NHIỀU NHẤT</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="row">
    <?php
    $product =  "SELECT product.id,product.title, thumbnail,price, CAST(mt.content AS int) AS 'view',  X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id  INNER JOIN ps_product_meta mt ON product.id = mt.productId AND `key` = 'view' ORDER BY view DESC";
    $resultproduct = $conn->query($product);
    if ($resultproduct->num_rows > 0) {
      echo '<div class="container list-posts owl-carousel owl-theme">';
      while ($row = $resultproduct->fetch_assoc()) {
    ?>
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
    <?php
      }
      echo '</div>';
    } else {
      echo "0 results";
    }
    //                    $db->close();
    ?>
  </div>
</section>
<section id="introduce">
  <div class="title container text-center">
    <h2>GIỚI THIỆU</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="row" style="align-items: center;">
    <div class="col medium-12 small-12 large-6">
      <div class="col-inner">
        <div class="banner has-hover bg-zoom">
          <div class="banner-inner fill">
            <div class="banner-3 fill bg-fill bg"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-12 small-12 large-6 text-center">
      <div class="col-inner">
        <h3>Thức ăn nhanh làm gì</h3>
        <p style=" text-align: left; ">Thức ăn nhanh (tiếng Anh gọi là fast food), là thuật ngữ chỉ thức ăn
          có thể được chế biến và phục
          vụ cho người ăn rất nhanh chóng. Trong khi bất kỳ bữa ăn với ít thời gian chuẩn bị có thể được
          coi là thức ăn nhanh,
          thông thường thuật ngữ này nói đến thực phẩm được bán tại một nhà hàng hoặc cửa hàng với các
          thành phần làm nóng trước
          hoặc được nấu sẵn, và phục vụ cho khách hàng trong một hình thức đóng gói mang đi. <br>
          Thuật ngữ fast food đã được công nhận trong từ điển tiếng anh Merriam - Webster năm 1951.</p>
        <a href="./index.php?action=gioi-thieu" class="button primary">
          <span>Xem thêm</span>
        </a>
      </div>
    </div>
  </div>
</section>

<section id="our-team">
  <div class="title container text-center">
    <h2>ĐẦU BẾP HÀNG ĐẦU</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="container our-team owl-carousel owl-theme">
    <div class="person has-hover">
      <div class="box-image image-zoom">
        <img src="./assets/img/chef-4.jpg" alt="Gordon Ramsay">
        <ul class="person-social">
          <li><a href="#facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#twitter"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#youtube"><i class="fab fa-youtube"></i></a></li>
          <li><a href="#instagram"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>

      <div class="box-text">
        <span class="person-name">Gordon Ramsay</span><br>
        <span class="person-title">Master Chef</span>
        <p class="person-introduce">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
          ligula eget dolor sociis natoque</p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <img src="./assets/img/chef-3.jpg" alt="Mark Anthony">
        <ul class="person-social">
          <li><a href="#facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#twitter"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#youtube"><i class="fab fa-youtube"></i></a></li>
          <li><a href="#instagram"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
      <div class="box-text">
        <span class="person-name">Mark Anthony</span><br>
        <span class="person-title">Founder & CEO</span>
        <p class="person-introduce">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
          ligula eget dolor sociis natoque</p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <img src="./assets/img/chef-2.jpg" alt="Jessica Lee">
        <ul class="person-social">
          <li><a href="#facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#twitter"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#youtube"><i class="fab fa-youtube"></i></a></li>
          <li><a href="#instagram"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
      <div class="box-text">
        <span class="person-name">Jessica Lee</span><br>
        <span class="person-title">Chinese Kitchen Lead</span>
        <p class="person-introduce">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
          ligula eget dolor sociis natoque</p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <img src="./assets/img/chef-1.jpg" alt="John Bennett">
        <ul class="person-social">
          <li><a href="#facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#twitter"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#youtube"><i class="fab fa-youtube"></i></a></li>
          <li><a href="#instagram"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
      <div class="box-text">
        <span class="person-name">John Bennett</span><br>
        <span class="person-title">French Kitchen Lead</span>
        <p class="person-introduce">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
          ligula eget dolor sociis natoque</p>
      </div>
    </div>
  </div>
</section>
<section id="services">
  <div class="title container text-center">
    <h2>DỊCH VỤ TỐT NHẤT</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="row row-collapse">
    <div class="col medium-12 small-12 large-4">
      <div class="col-inner">
        <div class="service has-hover">
          <div class="box-image">
            <b></b>
            <span class="box-diamond"><img src="./assets/img/icon-1.png" style=" width: 4rem; "></span>
            <b></b>
          </div>
          <div class="box-text text-center">
            <h5>Miễn phí vận chuyển</h5>
            <p>Đăng ký và đặt hàng để nhận giao hàng miễn phí ngay bây giờ.</p>
            <a href="./index.php?action=chinh-sach" class="button">
              <span>Xem chi tiết</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-12 small-12 large-4">
      <div class="col-inner">
        <div class="service has-hover">
          <div class="box-image">
            <b></b>
            <span class="box-diamond"><img src="./assets/img/icon-2.png" style=" width: 4rem; "></span>
            <b></b>
          </div>
          <div class="box-text text-center">
            <h5>30 phút giao hàng</h5>
            <p>Mọi thứ bạn đặt hàng sẽ nhanh chóng được giao đến tận nơi.</p>
            <a href="./index.php?action=chinh-sach" class="button">
              <span>Xem chi tiết</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-12 small-12 large-4">
      <div class="col-inner">
        <div class="service has-hover">
          <div class="box-image">
            <b></b>
            <span class="box-diamond"><img src="./assets/img/icon-3.png" style=" width: 4rem; "></span>
            <b></b>
          </div>
          <div class="box-text text-center">
            <h5>Đảm bảo chất lượng</h5>
            <p>Chúng tôi chỉ sử dụng những nguyên liệu tốt nhất để nấu những món ăn tươi ngon cho bạn.
            </p>
            <a href="./index.php?action=chinh-sach" class="button">
              <span>Xem chi tiết</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="list-posts">
  <div class="title container text-center">
    <h2>TIN TỨC</h2>
    <img src="./assets/img/title.png">
  </div>
  <div class="container list-posts owl-carousel owl-theme">
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <a href="./index.php?action=bai-viet">
          <img src="./assets/img/blog-1.jpg" alt="Những lý do nên bao gồm rau hữu cơ trong chế độ ăn">
        </a>
      </div>
      <div class="box-text">
        <div class="post-meta flex-row">
          <p class="post-date">10/02/2021</p>
          <p class="post-author">Posted by <a href="/author.html">Nghia.l.t</a></p>
        </div>
        <h5 class="post-title">
          <a href="./index.php?action=bai-viet">Những lý do nên bao gồm rau hữu cơ trong chế độ ăn</a>
        </h5>
        <p class="post-excerpt">
          Ngay cả khi bạn không phải là một chuyên gia về da, không khó để nhận ra rằng hầu hết
          phụ nữ Hàn Quốc có làn da như
          sương, sáng và gần như mờ…
        </p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <a href="./index.php?action=bai-viet"><img src="./assets/img/blog-2.jpg"
            alt="Chiếc bánh hamburger ngon nhất thế giới hiện tại"></a>
      </div>
      <div class="box-text">
        <div class="post-meta flex-row">
          <p class="post-date">10/02/2021</p>
          <p class="post-author">Posted by <a href="/author.html">Nghia.l.t</a></p>
        </div>
        <h5 class="post-title">
          <a href="./index.php?action=bai-viet">Chiếc bánh hamburger ngon nhất thế giới hiện tại</a>
        </h5>
        <p class="post-excerpt">
          Ai cũng biết McDonald’s – Cửa hàng bán bánh hamburger Big Mac nổi tiếng nhất thế giới
          vừa mới mở cửa hàng đầu tiên ở
          Việt Nam....
        </p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <a href="./index.php?action=bai-viet"><img src="./assets/img/blog-3.jpg"
            alt="Tổng hợp các chiếc bánh hamburger xúc xích ngon nhất"></a>
      </div>
      <div class="box-text">
        <div class="post-meta flex-row">
          <p class="post-date">10/02/2021</p>
          <p class="post-author">Posted by <a href="/author.html">Nghia.l.t</a></p>
        </div>
        <h5 class="post-title">
          <a href="./index.php?action=bai-viet">Tổng hợp các chiếc bánh hamburger xúc xích ngon nhất</a>
        </h5>
        <p class="post-excerpt">
          Nhắc đến xúc xích sẽ chẳng xa lạ gì với mọi thực khách từ trẻ đến già. Hầu hết chúng ta
          thưởng thức xúc xích rán, ăn lẩu hay nấu canh...
        </p>
      </div>
    </div>
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <a href="./index.php?action=bai-viet"><img src="./assets/img/blog-2.jpg"
            alt="Chiếc bánh hamburger ngon nhất thế giới hiện tại"></a>
      </div>
      <div class="box-text">
        <div class="post-meta flex-row">
          <p class="post-date">10/02/2021</p>
          <p class="post-author">Posted by <a href="/author.html">Nghia.l.t</a></p>
        </div>
        <h5 class="post-title">
          <a href="./index.php?action=bai-viet">Chiếc bánh hamburger ngon nhất thế giới hiện tại</a>
        </h5>
        <p class="post-excerpt">
          Ai cũng biết McDonald’s – Cửa hàng bán bánh hamburger Big Mac nổi tiếng nhất thế giới
          vừa mới mở cửa hàng đầu tiên ở
          Việt Nam....
        </p>
      </div>
    </div>
  </div>
</section>