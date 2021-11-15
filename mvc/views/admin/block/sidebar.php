<div class="sidebar" id="sidebar">
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 820px">
    <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 820px">
      <div id="sidebar-menu" class="sidebar-menu">
        <ul>
          <li class="menu-title"><span>Main</span></li>
          <li class="<?php if ($data["Page"] == "dashboard") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/dashboard"><i class="fas fa-home"></i><span>Bảng tin</span></a>
          </li>
          <li class="menu-title"><span>Sản phẩm</span></li>
          <li class="<?php if ($data["Page"] == "product") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/product"><i class="fas fa-boxes"></i><span>Danh sách sản
                phẩm</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "create-product") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/product/create"><i class="fas fa-parachute-box"></i>
              <span>Tạo sản phẩm mới</span>
            </a>
          </li>
          <li class="<?php if ($data["Page"] == "author") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/author"><i class="fas fa-boxes"></i><span>Danh sách tác giả</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "create-author") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/author/create"><i class="fas fa-parachute-box"></i><span>Tạo tác giả
              </span></a>
          </li>
          <li class="<?php if ($data["Page"] == "category") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/category"><i class="fas fa-folder-open"></i><span>Danh mục</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "tag") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/tag"><i class="fas fa-tags"></i><span>Từ khóa</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "coupon") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/coupon"><i class="fas fa-tags"></i><span>Coupon</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "review") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/review"><i class="fas fa-star"></i><span>Đánh giá</span></a>
          </li>
          <li class="menu-title"><span>Đơn hàng</span></li>
          <li class="<?php if ($data["Page"] == "order") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/order"><i class="fas fa-file-invoice-dollar"></i><span>Danh sách đơn
                hàng</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "tao-don-hang") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/product"><i class="fas fa-file-signature"></i><span>Tạo đơn hàng
                mới</span></a>
          </li>
          <li class="menu-title"><span>Thành viên</span></li>
          <li class="<?php if ($data["Page"] == "user") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/user"><i class="fas fa-users"></i><span>Danh sách Thành
                viên</span></a>
          </li>
          <li class="<?php if ($data["Page"] == "create-user") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/user/create"><i class="fas fa-user-plus"></i><span>Tạo thành viên
                mới</span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="slimScrollBar" style="
        background: rgb(204, 204, 204);
        width: 7px;
        position: absolute;
        top: 0px;
        opacity: 0.4;
        display: block;
        border-radius: 7px;
        z-index: 99;
        right: 1px;
        height: 733.373px;
      "></div>
    <div class="slimScrollRail" style="
        width: 7px;
        height: 100%;
        position: absolute;
        top: 0px;
        display: none;
        border-radius: 7px;
        background: rgb(51, 51, 51);
        opacity: 0.2;
        z-index: 90;
        right: 1px;
      "></div>
  </div>
</div>