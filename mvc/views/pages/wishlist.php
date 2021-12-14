<?php $user = $data["UserById"]; ?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">
    <div class="account-user">
      <span class="image">
        <img alt="" src="<?= $user['avatar'] ?>" height="70" width="70">
      </span>
      <span class="user-name">
        <?= $user['username']; ?>
      </span>
    </div>
    <ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/orders">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link active">
        <a href="<?= SITE_URL ?>/wishlist">Sản phẩm yêu thích</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/changepassword">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account/userlogout">Đăng xuất</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">
    <?php if (($number = count($data['Items'])) > 0) { ?>
    <table class="cart table-form shop_table yproduct" cellspacing="0">
      <thead>
        <tr>
          <th class="product-remove"></th>
          <th class="product-thumbnail"></th>
          <th class="product-name">Hàng hóa</th>
          <th class="product-price">Đơn giá</th>
          <th class="add-to-card"></th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['Items'] as $key => $item) { ?>
        <tr class="cart-item" data-id="<?= $item["id"] ?>">
          <td class="product-remove">
            <i class="far fa-times-circle remove" onclick="removeItemFromWishlist(this)"></i>
          </td>
          <td class="product-thumbnail">
            <a href="<?= SITE_URL ?>/store/product/<?= $item["id"] ?>">
              <img width="90" height="90" src="<?= SITE_URL ?><?= $item['thumbnail'] ?>">
            </a>
          </td>
          <td class="product-name">
            <a href="<?= SITE_URL ?>/store/product/<?= $item["id"] ?>"><?= $item['title'] ?></a>
          </td>
          <td class="product-price" data-title="Giá" data-price="<?= $item['price'] ?>">
            <span class="price">
              <span> <?= number_format($item['price']) ?></span>
              ₫
            </span>
          </td>
          <td>
            <div class="add-the-cart">
              <a href="#" class="secondary" data-id="<?= $item["id"] ?>">
                <i class="fas fa-shopping-cart"></i>
                <i class="fas fa-book"></i>
                <span>THÊM VÀO GIỎ</span>
              </a>
            </div>

          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <div class="nproduct" style="display: <?= $number > 0 ? "none" : "block" ?>">
      <div class="text-center">
        <p>Chưa có sản phẩm yêu thích</p>
        <a href="<?= SITE_URL ?>/store" class="button primary">
          <span>Quay trở về của hàng</span>
        </a>
      </div>
    </div>
  </div>
</div>