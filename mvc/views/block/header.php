
<header id="header" class="header">
  <div id="header-main" class="header-main flex-row container-large">
    <div class="flex-col hide-for-medium flex-left">
      <ul class="nav header-nav header-nav-left">
        <li><a href="<?= SITE_URL ?>" class="<?php if ($data["Page"] == 'home') echo 'active'; ?>">Trang chủ</a></li>
        <li><a href="<?= SITE_URL ?>/about" class="<?php if ($data["Page"] == 'about') echo 'active'; ?>">Giới
            thiệu</a></li>
        <li><a href="<?= SITE_URL ?>/store" class="<?php if ($data["Page"] == 'store') echo 'active'; ?>">Cửa
            hàng</a></li>

      </ul>
    </div>
    <div id="logo" class="flex-col logo-header">
      <a href="<?= SITE_URL ?>"><img src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png"
          alt="logo" /></a>
      <!-- <a href="<?= SITE_URL ?>"><img src="<?= SITE_URL ?>/public/img/logo.png" alt="logo" /></a> -->
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
        <ul class="nav top-bar-nav">
        <li>
            <button class="md-trigger" data-modal="modal-7" id='sea'> <i class="fas fa-search"></i></button>
        </li>
        <li>
          <a href="<?= SITE_URL ?>/login">
            <i class="fas fa-lock"></i>

          </a>
        </li>
        <li>
          <a href="<?= SITE_URL ?>/register">
            <i class="fas fa-user"></i>
          </a>
        </li>
        <li class="hide-for-medium">
          <a href="<?= SITE_URL ?>/wishlist"><i class="fas fa-heart"></i></a>
        </li>
        <li>
          <a href="<?= SITE_URL ?>/cart" class="mini-cart">
            <i class="fas fa-shopping-cart" data-count="0"></i>
          </a>
        </li>
      </ul>
      </ul>
      
    </div>
    <div class="flex-col show-for-medium flex-right">
      <a href="#" class="menu-mobi">
        <i class="fas fa-bars" style="font-size: 4rem"></i>
      </a>
    </div>
  </div>
  <div id="header-bottom" class="header-bottom wide-nav flex-has-center">
    <div class="flex-row container-large">
      <div class="flex-col flex-left">
        <ul class="nav header-nav header-bottom-nav">
          <li><a href="<?= SITE_URL ?>" class="<?php if ($data["Page"] == 'home') echo 'active'; ?>">Trang chủ</a></li>
          <li><a href="<?= SITE_URL ?>/about" class="<?php if ($data["Page"] == 'about') echo 'active'; ?>">Giới
              thiệu</a></li>
          <li><a href="<?= SITE_URL ?>/store" class="<?php if ($data["Page"] == 'store') echo 'active'; ?>">Cửa
              hàng</a></li>
          <li><a href="<?= SITE_URL ?>/faq" class="<?php if ($data["Page"] == 'faq') echo 'active'; ?>">FAQ</a></li>
          <li><a href="<?= SITE_URL ?>/news" class="<?php if ($data["Page"] == 'news') echo 'active'; ?>">Tin
              tức</a>
          </li>
          <li><a href="<?= SITE_URL ?>/contact" class="<?php if ($data["Page"] == 'contact') echo 'active'; ?>">Liên
              hệ</a>
          </li>
        </ul>
      </div>
      <div class="flex-col hide-for-medium flex-right">
        <ul class="nav top-bar-nav">
          <li>
            <a href="<?= SITE_URL ?>/login">
              <i class="fas fa-search"></i>
            </a>
          </li>
          <li>
            <a href="<?= SITE_URL ?>/login">
              <i class="fas fa-user"></i>
            </a>
          </li>
          <li class="hide-for-medium">
            <a href="<?= SITE_URL ?>/wishlist"><i class="fas fa-heart"></i></a>
          </li>
          <li>
            <a href="<?= SITE_URL ?>/cart" class="mini-cart">
              <i class="fas fa-shopping-cart" data-count="0"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>