<section id="news-letter">
  <div class="row row-collapse" style="align-items: center">
    <div class="col medium-12 small-12 large-6 hide-for-medium">
      <div class="col-inner">
        <img src="<?= SITE_URL ?>/public/img/banner_newsletter.png" alt="Newsletter" />
      </div>
    </div>
    <div class="col medium-12 small-12 large-6">
      <div class="col-inner">
        <div class="errors"></div>
        <form class="form-subscribe" id="mailchimp">
          <div class="input-group">
            <input type="text" placeholder="Your eamil address" name="email" required />
            <span class="input-group-btn">
              <button class="button secondary" type="submit">
                Đăng ký
              </button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<div class="cart-side">
  <div class="cart-side-heading">
    <span class="cart-side-title">GIỎ HÀNG</span>
    <i class="far fa-times-circle remove close-cart-side"></i>
  </div>
  <div class="widget_shopping_cart">
    <div class="mini-cart-scroll">
      <ul class="product_list_widget" id="mini-cart">
      </ul>
    </div>
    <div class="mini-cart-total">
      <strong>
        <span>Tạm tính:</span>
        <span class="price-total">
          <span class="total"></span>
          <sup>đ</sup>
        </span>
      </strong>
      <a href="<?= SITE_URL ?>/checkout" class="button secondary">
        THANH TOÁN
      </a>
      <a href="<?= SITE_URL ?>/cart" class="button primary">
        GIỎ HÀNG
      </a>
    </div>
  </div>
</div>
<div class="cart-side-overlay"></div>
<div class="page-loading">
  <div class="preloader-content">
    <div class="preloader-img">
      <img alt="Preloader images" src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png">
    </div>
    <div class="preloader-icon">
      <img alt="Preloader icon" src="<?= SITE_URL ?>/public/img/loader-img.gif">
    </div>
  </div>
</div>
<div class="md-modal md-effect-3" id="modal-quick_view">
  <div class="md-content">
    <button class="md-close"><i class="fas fa-times-circle"></i></button>
    <div class="show_quick_view"></div>
  </div>
</div>
<div class="md-modal md-effect-7" id="modal-7">
  <button class="md-close" hidden>Close!</button>
  <div class="md-content">
    <form method="get" class="searchform" action="<?= SITE_URL ?>/store/search">
      <div class="flex-row relative">
        <div class="flex-col flex-grow" style="flex: 1;">
          <input class="search-field" type="search" name="s" value="" placeholder="Nhập ít nhất 3 ký tự để tìm kiếm">
        </div>
        <div class="flex-col">
          <button type="submit" class="submit-button">
            <i class="fas fa-search"></i></button>
        </div>
      </div>
      <div class="live-search-results text-left z-top"></div>
    </form>
  </div>
</div>
<div class="md-overlay"></div>
<div id="toast"></div>
<footer id="footer">
  <div class="row">
    <div class="col medium-6 small-12 large-3">
      <div class="col-inner contact">
        <h5 class="text-center">Liên hệ</h5>
        <div class="icon-box featured-box icon-box-left text-left">
          <div class="icon-box-img">
            <span class="box-diamond">
              <i class="fas fa-phone-alt" style="font-size: 14px"></i></span>
          </div>
          <div class="icon-box-text">
            <p>Hotline:</p>
            <p>(+84) 961174894</p>
          </div>
        </div>
        <div class="icon-box featured-box icon-box-left text-left">
          <div class="icon-box-img">
            <span class="box-diamond">
              <i class="fas fa-envelope" style="font-size: 14px"></i></span>
          </div>
          <div class="icon-box-text">
            <p>E-mail:</p>
            <p>support@woovn.com</p>
          </div>
        </div>
        <div class="icon-box featured-box icon-box-left text-left">
          <div class="icon-box-img">
            <span class="box-diamond">
              <i class="fas fa-clock" style="font-size: 14px"></i></span>
          </div>
          <div class="icon-box-text">
            <p>Thời gian làm việc:</p>
            <p>06:00 - 18:00 hàng ngày</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-6 small-12 large-3 hide-for-medium">
      <div class="col-inner">
        <h5 class="text-center">Liên kết</h5>
        <ul>
          <li class="text-center"><a href="./cua-hang.html">Cửa hàng</a></li>
          <li class="text-center"><a href="./dich-vu.html">Dịch vụ</a></li>
          <li class="text-center"><a href="./chinh-sach.html">Chính sách</a></li>
          <li class="text-center"><a href="./cau-hoi-thuong-gap.html">Câu hỏi thường gặp</a></li>
          <li class="text-center"><a href="./tin-tuc.html">Tin tức</a></li>
          <li class="text-center"><a href="./lien-he.html">Liên hệ</a></li>
        </ul>
      </div>
    </div>
    <div class="col medium-6 small-12 large-3 hide-for-medium">
      <div class="col-inner">
        <h5 class="text-center">Follow Us</h5>
        <ul class="social-icons">
          <li>
            <a href="#facebook"><i class="fab fa-facebook-f"></i>Facebook</a>
          </li>
          <li>
            <a href="#twitter"><i class="fab fa-twitter"></i>Twitter</a>
          </li>
          <li>
            <a href="#youtube"><i class="fab fa-youtube"></i>Youtube</a>
          </li>
          <li>
            <a href="#instagram"><i class="fab fa-instagram"></i>Instagram</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col medium-6 small-12 large-3">
      <div class="col-inner">
        <h5 class="text-center">MAP</h5>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.281541581405!2d108.11218031526086!3d10.942092459104883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317683143e7bae9d%3A0xaefd8984ce71af22!2zVHLGsOG7nW5nIFRIUFQgQ2h1ecOqbiBUcuG6p24gSMawbmcgxJDhuqFv!5e0!3m2!1svi!2s!4v1611763060560!5m2!1svi!2s"
          width="100%" height="200" frameborder="0" style="border: 0" allowfullscreen="" aria-hidden="false"
          tabindex="0"></iframe>
      </div>
    </div>
  </div>
  <div class="absolute-footer">
    <div class="container text-center">
      <p>
        Copyright © 2020 .All rights reserved by <span>Foodo</span>.
        Designed by <span>Nghia.lt</span>
      </p>
    </div>
  </div>
</footer>
<a id="back-to-top" class="fas fa-chevron-up"></a>
<div class="support-nav">
  <ul>
    <li>
      <a href="https://www.google.com/maps?ll=10.942087,108.114369&z=15&t=m&hl=vi&gl=US&mapclient=embed&cid=12609385735199502114"
        rel="nofollow" target="_blank"><i class="ticon-heart"></i>Tìm đường</a>
    </li>
    <li>
      <a href="https://zalo.me/0961174894" rel="nofollow" target="_blank"><i class="ticon-zalo-circle2"></i>Chat
        Zalo</a>
    </li>
    <li class="phone-mobile">
      <a href="tel:0961174894" rel="nofollow" class="button">
        <span class="phone_animation animation-shadow">
          <i class="icon-phone-w" aria-hidden="true"></i>
        </span>
        <span class="btn_phone_txt">Gọi điện</span>
      </a>
    </li>
    <li>
      <a href="https://www.messenger.com/t/nghia.l.t" rel="nofollow" target="_blank"><i
          class="ticon-messenger"></i>Messenger</a>
    </li>
    <li>
      <a href="sms:0961174894" class="chat_animation">
        <i class="ticon-chat-sms" aria-hidden="true" title="Nhắn tin sms"></i>
        Nhắn tin SMS</a>
    </li>
  </ul>
</div>
<?php
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = ['item' => []];
} ?>
<script>
<?php
  $listCart = $_SESSION['cart']['item'];
  $coupon = isset($_SESSION['cart']['coupon']) ? $_SESSION['cart']['coupon'] : [];
  echo "let cart = " . json_encode($listCart) . ";";
  echo "let coupon = " . json_encode($coupon) . ";";
  echo "let SITE_URL = '" . SITE_URL . "';"; ?>
</script>
<script src="<?= SITE_URL ?>/public/js/owl.carousel.js"></script>
<script src="<?= SITE_URL ?>/public/js/aos.js"></script>
<script src="<?= SITE_URL ?>/public/js/main.js"></script>
<script src="<?= SITE_URL ?>/public/js/add-cart.js"></script>
<script src="<?= SITE_URL ?>/public/js/mini-cart.js"></script>
<script src="<?= SITE_URL ?>/public/js/modal.js"></script>
<script src="<?= SITE_URL ?>/public/js/live-search.js"></script>
<script src="<?= SITE_URL ?>/public/plugins/select2/js/select2.min.js"></script>
<script src="<?= SITE_URL ?>/public/plugins/toastr/toastr.js"></script>
<?php if ($data["Page"] == "faq") : ?>
<script>
(function($) {
  $(".accordion > li:eq(0) a").addClass("active").next().slideDown();
  $(".accordion a").click(function(j) {
    var dropDown = $(this).closest("li").find("p");

    $(this).closest(".accordion").find("p").not(dropDown).slideUp();

    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(this)
        .closest(".accordion")
        .find("a.active")
        .removeClass("active");
      $(this).addClass("active");
    }
    dropDown.stop(false, true).slideToggle();
    j.preventDefault();
  });
})(jQuery);
</script>
<?php endif; ?>

<?php if ($data["Page"] == "account") : ?>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#imagePreview').hide();
      $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#imageUpload").change(function() {
  readURL(this);
});
</script>
<?php endif; ?>
<?php if ($data["Page"] == "cart") : ?>
<script src="<?= SITE_URL ?>/public/js/cart.js"></script>
<?php endif; ?>
<?php if ($data["Page"] == "wishlist") : ?>
<script src="<?= SITE_URL ?>/public/js/wishlist.js"></script>
<?php endif; ?>
<?php if ($data["Page"] == "checkout") : ?>
<script src="<?= SITE_URL ?>/public/js/checkout.js"></script>
<?php endif; ?>
<?php if ($data["Page"] == "forgot_password") : ?>
<script src="<?= SITE_URL ?>/public/js/sms.js"></script>
<div id="rcccont"></div>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-auth.js"></script>
<script>
const firebaseConfig = {
  apiKey: "AIzaSyCc2CNzGp-0MXOF7e3_rFB8jkJ0oXXkwfs",
  authDomain: "myxit-8fa60.firebaseapp.com",
  projectId: "myxit-8fa60",
  storageBucket: "myxit-8fa60.appspot.com",
  messagingSenderId: "48579088544",
  appId: "1:48579088544:web:9aff3b8437922b310b79c5",
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
</script>
<?php endif; ?>