<header id="header" class="header">
  <div id="top-bar" class="header-top">
    <div class="flex-row container">
      <div class="flex-col flex-left">
        <ul class="nav social-icons">
          <li>
            <a href="#facebook"><i class="fab fa-facebook-f"></i></a>
          </li>
          <li>
            <a href="#twitter"><i class="fab fa-twitter"></i></a>
          </li>
          <li>
            <a href="#youtube"><i class="fab fa-youtube"></i></a>
          </li>
          <li>
            <a href="#instagram"><i class="fab fa-instagram"></i></a>
          </li>
        </ul>
      </div>
      <div class="flex-col flex-right">
        <ul class="nav top-bar-nav">
          <?php if (isset($_SESSION["user"])) : ?>
          <li>
            <a href="<?= SITE_URL ?>/account">
              <i class="fas fa-user"></i>
              <span class="hide-for-small"><?= $_SESSION["user"]["username"]; ?></span>
            </a>
          </li>
          <?php else : ?>
          <li>
            <a href="<?= SITE_URL ?>/login">
              <i class="fas fa-user"></i>
              <span class="hide-for-small">Đăng nhập</span>
            </a>
          </li>
          <li class="hide-for-medium">
            <a href="<?= SITE_URL ?>/register"><i class="fas fa-edit"></i> Đăng ký</a>
          </li>
          <?php endif ?>
          <li>
            <a href="<?= SITE_URL ?>/cart"
              class="<?= $data["Page"] == "cart" ||  $data["Page"] == "checkout" ? "" : "mini-cart" ?>">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div id="header-main" class="header-main flex-row container logo-center">
    <div class="flex-col logo">
      <a href="<?= SITE_URL ?>"><img src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png"
          alt="logo" /></a>
    </div>
    <div class="flex-col show-for-medium flex-left">
      <div class="hamburger-menu"></div>
    </div>
    <div class="flex-col hide-for-medium flex-left">
      <ul class="nav header-nav header-nav-left">
        <li><a href="<?= SITE_URL ?>" class="<?php if ($data["Page"] == 'home') echo 'active'; ?>">Trang chủ</a></li>
        <li><a href="<?= SITE_URL ?>/about" class="<?php if ($data["Page"] == 'about') echo 'active'; ?>">Giới
            thiệu</a></li>
        <li><a href="<?= SITE_URL ?>/store" class="<?php if ($data["Page"] == 'store') echo 'active'; ?>">Cửa
            hàng</a></li>

      </ul>
    </div>
    <div class="flex-col hide-for-medium flex-right">
      <ul class="nav header-nav header-nav-right">
        <li><a href="<?= SITE_URL ?>/faq" class="<?php if ($data["Page"] == 'faq') echo 'active'; ?>">FAQ</a></li>
        <li><a href="<?= SITE_URL ?>/news" class="<?php if ($data["Page"] == 'news') echo 'active'; ?>">Tin
            tức</a>
        </li>
        <li><a href="<?= SITE_URL ?>/contact" class="<?php if ($data["Page"] == 'contact') echo 'active'; ?>">Liên
            hệ</a>
        </li>
        <li>
          <a href="javascript:void(0);" class="md-trigger sea" data-modal="modal-7"> <i class="fas fa-search"></i></a>
        </li>
      </ul>
    </div>
    <div class="flex-col show-for-medium flex-right">
      <a href="javascript:void(0);" class="md-trigger sea" data-modal="modal-7"><i class="fas fa-search"
          style="font-size: 3rem"></i></a>
    </div>
  </div>
  <div id="header-bottom" class="header-bottom wide-nav flex-has-center">
    <div class="flex-row container-large">
      <div class="flex-col flex-left">
        <ul class="nav header-nav header-bottom-nav">
          <li><a href="<?= SITE_URL ?>">Trang chủ</a></li>
          <li><a href="<?= SITE_URL ?>/about">Giới
              thiệu</a></li>
          <li><a href="<?= SITE_URL ?>/store">Cửa
              hàng</a></li>
          <li><a href="<?= SITE_URL ?>/faq">FAQ</a></li>
          <li><a href="<?= SITE_URL ?>/news">Tin
              tức</a>
          </li>
          <li><a href="<?= SITE_URL ?>/contact">Liên
              hệ</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>