<section id="slider">
  <div class="slider owl-carousel owl-theme container-full">
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/slider-2.jpg" alt="Slider">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/slider-1.jpg" alt="Slider">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/slider-3.jpg" alt="Slider">
    </div>
  </div>
</section>
<section id="banner">
  <div class="row-large">
    <div class="col medium-6 large-3  hide-for-small">
      <div class="col-inner">
        <div class="banner">
          <div class="banner-1 bg-fill bg"></div>
          <div class="banner-content">
            <div style="position: absolute; top: 50px; left: 50px;">
              <h3 class="mg-top-0 fw-bold" style="margin-bottom: 12px; line-height: 40px;">Feature
                book<br>
                <span class="text-italic fs-24 fw-normal">of the month</span>
              </h3>
              <p style="letter-spacing: 1px;"><a class="btn btn-accent btn-link btn-md"
                  href="https://auteur.g5plus.net/shop">PURCHASE <i class="fal fa-chevron-double-right"></i></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-12 small-12 large-6 medium-col-first">
      <div class="banner">
        <div class="banner-2 bg-fill bg"></div>
        <div class="banner-content">
          <div style="position: absolute; bottom: 40px; left: 52px;">
            <h2 class="mg-top-0 fw-bold" style="margin-bottom: 12px; line-height: 1.4;">Henry<br>
              <span class="text-italic fw-normal">&amp; the good dog</span>
            </h2>
            <p style="letter-spacing: 1px;"><a class="btn btn-accent btn-link btn-md"
                href="https://auteur.g5plus.net/shop">PURCHASE <i class="fal fa-chevron-double-right"></i></a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-6 large-3 hide-for-small">
      <div class="banner">
        <div class="banner-3 bg-fill bg"></div>
        <div class="banner-content">
          <div style="position: absolute; bottom: 40px; left: 30px;">
            <h3 class="mg-top-0 fw-bold" style="margin-bottom: 12px; line-height: 40px;">Best seller<br>
              Books</h3>
            <p class="accent-color" style="letter-spacing: 1px;"><a class="btn btn-accent btn-link btn-md"
                href="https://auteur.g5plus.net/shop">PURCHASE <i class="fal fa-chevron-double-right"></i></a></p>
          </div>
        </div>
      </div>
    </div>
</section>
<section id="list-products">
  <div class="container">
    <ul class="nav nav-tabs ">
      <li class="active">
        <a href="#" class="btn-accent">Bestseller Books</a>
      </li>
      <li>
        <a href="#" class="btn-accent">Sale</a>
      </li>
      <li>
        <a href="#" class="btn-accent">Featured Books</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <?php
    $sellList =  $data['sell'];
    if (count($sellList) > 0) {
      foreach ($sellList as $product) { ?>
    <div class="col medium-4 small-6 large-3">
      <div class="col-inner">
        <?php require "./mvc/views/block/product.php" ?>
      </div>
    </div>
    <?php }
    } else { ?>

    <div class="container">
      Không có sản phẩm phù hợp
    </div>
    <?php } ?>
  </div>
</section>
<section id="what-hot">
  <div class="row-collapse" style="justify-content: center">
    <div class="col medium-8 small-12 large-10 text-center">
      <span class="heading-sub-title heading-color">WHAT'S HOT IN AUGUST</span>
      <h2 class="mg-bottom-10 fs-48 sm-fs-34" style="margin-top: 30px;"><span
          style="border-bottom: 1px solid #fff; color: #fff;">Get <span class="fw-bold">-30%</span> purchase
          on</span>
      </h2>
      <a href="https://ps17048.com/PHP_FPOLY/ASM_MVC/checkout" class="button">
        EXPLORE NOW
      </a>

    </div>
  </div>
</section>
<section id="best-author">

  <div class="row">

    <div class="col medium-12 small-12 large-4">
      <div class="IN-AUGUST">IN AUGUST</div>
      <div class="best-author">Best Author of The Month</div>
      <a href="https://ps17048.com/PHP_FPOLY/ASM_MVC/checkout" class="button">
        EXPLORE NOW
      </a>
    </div><?php
          $ListAuthor = $data["ListAuthor"];
          ?>
    <div class="col medium-12 small-12 large-4">
      <img src="<?= SITE_URL ?><?= $ListAuthor['avatar'] ?>">
    </div>
    <div class="col medium-12 small-12 large-4">
      <div class="quote">” <?= $ListAuthor['quote'] ?>”</div>
      <div class="name_author"><?= $ListAuthor['title'] ?></div>
      <ul class="social-media">
        <li>
          <a class="facebook" href="<?= $ListAuthor['fblink'] ?>" target="blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="twitter" href="<?= $ListAuthor['twitterlink'] ?>" target="blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a class="youtube" href="<?= $ListAuthor['youtubelink'] ?>" target="blank">
            <i class="fab fa-youtube"></i>
          </a>
        </li>

      </ul>
    </div>

  </div>

</section>
<section id="newest">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="cat-item active" data-id="all">
        <a class="btn-accent" href="#">ALL</a>
      </li>
      <?php
      $resultCategory =  $data['ListCategory'];
      foreach ($resultCategory as $key => $category) { ?>
      <li class="cat-item" data-id="<?= $category["id"] ?>">
        <a class="btn-accent" href="<?= SITE_URL ?>/store/category/<?= $category["id"] ?>"><?= $category["title"] ?></a>
      </li>
      <?php } ?>
    </ul>
  </div>

  <div class="row" id="show_product">
    <?php
    $sellList =  $data['sell'];
    if (count($sellList) > 0) {
      foreach ($sellList as $product) { ?>
    <div class="col medium-4 small-6 large-3">
      <div class="col-inner">
        <?php require "./mvc/views/block/product.php" ?>
      </div>
    </div>
    <?php }
    } else { ?>
    <div class="container">
      Không có sản phẩm phù hợp
    </div>
    <?php } ?>
  </div>

</section>
<section id="list-posts">
  <div class="title container text-center">
    <h2>TIN TỨC</h2>
    <img src="<?= SITE_URL ?>/public/img/title.png">
  </div>
  <div class="container list-posts owl-carousel owl-theme">
    <div class="post has-hover item">
      <div class="box-image image-zoom">
        <a href="./index.php?action=bai-viet">
          <img src="<?= SITE_URL ?>/public/img/blog-1.jpg" alt="Những lý do nên bao gồm rau hữu cơ trong chế độ ăn">
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
        <a href="./index.php?action=bai-viet"><img src="<?= SITE_URL ?>/public/img/blog-4.jpg"
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
        <a href="./index.php?action=bai-viet"><img src="<?= SITE_URL ?>/public/img/blog-3.jpg"
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
        <a href="./index.php?action=bai-viet"><img src="<?= SITE_URL ?>/public/img/blog-2.jpg"
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
<section id="our-awards">
  <div class="container our-awards owl-carousel owl-theme">
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/cambridge.jpg" alt="cambridge">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/cengage.jpg" alt="cengage">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/Harper-Collins.jpg" alt="Harper-Collins">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/hachette.jpg" alt="hachette">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/macgrawhill.jpg" alt="macgrawhill">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/macmillan.jpg" alt="macmillan">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/oxford.jpg" alt="oxford">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/paragon.jpg" alt="paragon">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/PearsonLogo_Avatar.png" alt="PearsonLogo_Avatar">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/penguin.jpg" alt="penguin">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/sterling.jpg" alt="sterling">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/usborn.jpg" alt="usborn">
    </div>
    <div class="item">
      <img src="<?= SITE_URL ?>/public/img/Scholastic-bar-logo.png" alt="Scholastic-bar-logo">
    </div>
  </div>
</section>