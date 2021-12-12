<div class="sidebar" id="sidebar">
  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 820px">
    <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 820px">
      <div id="sidebar-menu" class="sidebar-menu">
        <ul>
          <li class="menu-title"><span>Main</span></li>
          <li class="<?php if ($data["Page"] == "dashboard") echo "active"; ?>">
            <a href="<?= ADMIN_URL; ?>/dashboard"><i class="fas fa-home"></i><span>Bảng tin</span></a>
          </li>
          <li class="submenu">
            <a href="#"><i class="fas fa-boxes"></i> <span>
                Sản phẩm</span> <span class="menu-arrow"></span></a>
            <ul>
              <li>
                <a href="<?= ADMIN_URL; ?>/product" class="<?php if ($data["Page"] == "product") echo "active"; ?>">
                  Danh sách sản phẩm
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/author" class="<?php if ($data["Page"] == "list_author") echo "active"; ?>">
                  Tác giả
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/category" class="<?php if ($data["Page"] == "category") echo "active"; ?>">
                  Danh mục
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/publisher" class="<?php if ($data["Page"] == "publisher") echo "active"; ?>">
                  Nhà xuất bản
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/tag" class="<?php if ($data["Page"] == "tag") echo "active"; ?>">
                  Từ khóa
                </a>
              </li>
            </ul>
          </li>
          <li class="submenu">
            <a href="#"><i class="fas fa-store"></i> <span>Cửa hàng</span> <span class="menu-arrow"></span></a>
            <ul>
              <li>
                <a href="<?= ADMIN_URL; ?>/order" class="<?php if ($data["Page"] == "order") echo "active"; ?>">
                  Đơn hàng
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/coupon" class="<?php if ($data["Page"] == "coupon") echo "active"; ?>">
                  Coupon
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/review" class="<?php if ($data["Page"] == "review") echo "active"; ?>">
                  Đánh giá
                </a>
              </li>
            </ul>
          </li>
          <li class="submenu">
            <a href="#"><i class="far fa-address-book"></i><span>Bài viết</span> <span class="menu-arrow"></span></a>
            <ul>
              <li>
                <a href="<?= ADMIN_URL; ?>/post" class="<?php if ($data["Page"] == "post") echo "active"; ?>">
                  Danh sách bài viết
                </a>
              </li>
              <li>
                <a href="<?= ADMIN_URL; ?>/postcategory"
                  class="<?php if ($data["Page"] == "post-category") echo "active"; ?>">
                  Danh mục
                </a>
              </li>
            </ul>
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