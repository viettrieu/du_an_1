<?php

$user = $data["UserById"];
$order = $data["Order"];
$items = $data["Items"];
$transport = $data["Transport"];
?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">
    <div class="account-user">
      <span class="image">
        <img alt=""
          src="<?= SITE_URL ?><?= $user['avatar'] == null ? '/public/img/avatar-default.png' : $user['avatar']; ?>"
          height="70" width="70">
      </span>
      <span class="user-name">
        <?= $user['username']; ?>
      </span>

    </div>
    <ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

      <li class="mycccount-navigation-link">
        <a href="<?= SITE_URL ?>/account">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link active">
        <a href="<?= SITE_URL ?>/account/orders">Đơn hàng</a>
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
    <?php if ($data["Order"] != false) : ?>
    <p>
      Đơn hàng #<mark class="order-number"><?= $order['id'] ?></mark> đã được đặt lúc <mark
        class="order-date"><?= $order['published'] ?></mark> và hiện tại là <mark
        class="order-status"><?= $order['status'] ?></mark>.</p>
    <div class="cart-totals">
      <h5>CHI TIẾT ĐƠN HÀNG</h5>
      <table class="shop_table checkout-review-table">
        <thead>
          <tr>
            <th class="product-name">Sản phẩm</th>
            <th class="product-total">Tổng</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item) : ?>
          <tr class="cart_item">
            <td class="product-name"> <?= $item['title']; ?>
              <strong class="product-quantity">× <?= $item['quantity']; ?></strong>
            </td>
            <td class="product-total">
              <span class="price">
                <span class="unit-price">
                  <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>
                <sup>đ</sup>
              </span>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr class="cart-subtotal">
            <th>Tạm tính</th>
            <td>
              <strong>
                <span class="subtotal"><?= number_format($order['subTotal'], 0, ',', '.'); ?> </span>
                <sup>đ</sup>
              </strong>
            </td>
          </tr>
          <?php if (isset($order['coupon'])) : ?>
          <tr class="cart-discount">
            <th>Coupon: <?= $order['coupon']; ?></th>
            <td> <strong>
                <span class="discount">-<?= number_format($order['discount'], 0, ',', '.'); ?></span>
                <sup>đ</sup>
                <strong>
            </td>
          </tr>
          <?php endif ?>
          <tr class="shipping-totals shipping">
            <th>Phí vận chuyển</th>
            <td data-title="Shipping">
              <strong>
                <span><?= number_format($order['shipping'], 0, ',', '.'); ?></span>
                <sup>đ</sup>
              </strong>
            </td>
          </tr>
          <tr class="order-total">
            <th>Tổng</th>
            <td>
              <strong>
                <span class="total"><?= number_format($order['total'], 0, ',', '.'); ?></span>
                <sup>đ</sup>
              </strong>
            </td>
          </tr>
          <tr>
            <th scope="row">Phương thức thanh toán:</th>
            <td><?= $order['transaction']; ?></td>
          </tr>
        </tfoot>
      </table>
      <div class="customer-details">
        <h5>THÔNG TIN THANH TOÁN</h5>
        <p><strong>Họ và tên:</strong> <?= $order['fullName'] ?></p>
        <p><strong>Số điện thoại:</strong> <?= $order['mobile'] ?></p>
        <p><strong>Email:</strong> <?= $order['email'] ?></p>
        <p><strong>Địa chỉ:</strong>
          <?= $transport['address'] . ", " . $transport['ward'] . ", " . $transport['district'] . ", " . $transport['province'] ?>
        </p>
      </div>
    </div>
    <?php else : ?>
    <p>KHÔNG CÓ ĐƠN HÀNG</p>
    <?php endif ?>
  </div>
</div>