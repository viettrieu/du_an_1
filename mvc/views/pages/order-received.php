<?php
$order = $data["Order"];
$items = $data["Items"];
$transport = $data["Transport"];
?>
<div class="row page-wrapper row-divided yproduct">
  <div class="col medium-12 small-12 large-7 cart-totals">
    <h4 class="text-center">CHI TIẾT ĐƠN HÀNG</h4>
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
              <span class="unit-price"> <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>
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
      <h4 class="text-center">THÔNG TIN THANH TOÁN</h4>
      <p><strong>Họ và tên:</strong> <?= $order['fullName'] ?></p>
      <p><strong>Số điện thoại:</strong> <?= $order['mobile'] ?></p>
      <p><strong>Email:</strong> <?= $order['email'] ?></p>
      <p><strong>Địa chỉ:</strong>
        <?= $transport['address'] . ", " . $transport['ward'] . ", " . $transport['district'] . ", " . $transport['province'] ?>
      </p>
    </div>
  </div>
  <div class="col medium-12 small-12 large-5">
    <div class="is-well">
      <p>
        <strong>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</strong>
      </p>
      <ul>
        <li>Mã đơn hàng: <strong><?= $order['id'] ?></strong></li>
        <li>Ngày: <strong><?= $order['published'] ?></strong></li>
        <li>Tổng cộng: <strong><span class="total"><?= number_format($order['total'], 0, ',', '.'); ?></span>
            <sup>đ</sup></strong></li>
        <li>Trạng thái: <strong><?= $order['status']; ?></strong></li>
      </ul>
    </div>
  </div>
</div>