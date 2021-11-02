<div class="page-loading">
  <div class="preloader-content">
    <div class="preloader-img">
      <img alt="Preloader images" src="./assets/img/logo.png" />
    </div>
    <div class="preloader-icon">
      <img alt="Preloader icon" src="./assets/img/circles.svg" />
    </div>
  </div>
</div>
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
          <?php if (isset($displayname)) : ?>
          <li>
            <a href="./index.php?action=tai-khoan">
              <i class="fas fa-user"></i>
              <span class="hide-for-small"><?php echo $displayname; ?></span>
            </a>
          </li>
          <?php else : ?>
          <li>
            <a href="./index.php?action=dang-nhap">
              <i class="fas fa-user"></i>
              <span class="hide-for-small">Đăng nhập</span>
            </a>
          </li>
          <li class="hide-for-medium">
            <a href="./index.php?action=dang-ky"><i class="fas fa-edit"></i> Đăng ký</a>
          </li>
          <?php endif ?>
          <li>
            <a href="./index.php?action=gio-hang" class="mini-cart"><i class="fas fa-shopping-cart"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div id="header-main" class="header-main flex-row container">
    <div class="flex-col hide-for-medium flex-left">
      <div class="icon-box featured-box icon-box-left text-left">
        <div class="icon-box-img">
          <i class="fas fa-phone-alt" style="font-size: 32px"></i>
        </div>
        <div class="icon-box-text">
          <h4>Hotline (+84) 961174894</h4>
          <p>E-mail : support@woovn.com</p>
        </div>
      </div>
    </div>
    <div id="logo" class="flex-col logo">
      <a href="./index.php"><img src="./assets/img/logo.png" alt="logo" /></a>
    </div>
    <div class="flex-col hide-for-medium flex-right">
      <div class="icon-box featured-box icon-box-left text-left">
        <div class="icon-box-img">
          <i class="fas fa-clock" style="font-size: 32px"></i>
        </div>
        <div class="icon-box-text">
          <h4>Thời gian làm việc:</h4>
          <p>06:00 - 22:00 hàng ngày</p>
        </div>
      </div>
    </div>
    <div class="flex-col show-for-medium flex-right">
      <a href="#" class="menu-mobi">
        <i class="fas fa-bars" style="font-size: 4rem"></i>
      </a>
    </div>
  </div>
  <div id="header-bottom" class="header-bottom wide-nav flex-has-center">
    <div class="flex-row container">
      <div class="flex-col flex-left">
        <ul class="nav header-nav header-bottom-nav">
          <li><a href="./index.php" class="<?php if ($page == 'trang-chu') echo 'active'; ?>">Trang chủ</a></li>
          <li><a href="./index.php?action=gioi-thieu" class="<?php if ($page == 'gioi-thieu') echo 'active'; ?>">Giới
              thiệu</a></li>
          <li><a href="./index.php?action=cua-hang" class="<?php if ($page == 'cua-hang') echo 'active'; ?>">Cửa
              hàng</a></li>
          <li><a href="./index.php?action=cau-hoi-thuong-gap"
              class="<?php if ($page == 'cau-hoi-thuong-gap') echo 'active'; ?>">FAQ</a></li>
          <li><a href="./index.php?action=chinh-sach" class="<?php if ($page == 'chinh-sach') echo 'active'; ?>">Chính
              sách</a></li>
          <li><a href="./index.php?action=tin-tuc" class="<?php if ($page == 'tin-tuc') echo 'active'; ?>">Tin tức</a>
          </li>
          <li><a href="./index.php?action=lien-he" class="<?php if ($page == 'lien-he') echo 'active'; ?>">Liên hệ</a>
          </li>
        </ul>
      </div>
      <div class="flex-col hide-for-medium flex-right">
        <form method="get" class="searchform" action="./index.php">
          <input type="hidden" name="action" value="search">
          <div class="flex-row">
            <div class="flex-col flex-grow">
              <input type="search" name="s" value="<?= isset($_GET['s']) ? $_GET['s'] : ''   ?>"
                placeholder="Tìm kiếm…">
            </div>
            <div class="flex-col">
              <button type="submit" class="button primary">
                <i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>