<?php
$order = $data["Order"];
$items = $data["Items"];
$transport = $data["Transport"];
?>
<div class="row">
  <div class="col-12 errors">
  </div>
  <div class="col-lg-7">
    <h5 class="text-center">CHI TIẾT ĐƠN HÀNG - <?= $order['id'] ?></h5>
    <table class="order-received">
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
                <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>₫
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
              <span class="subtotal"><?= number_format($order['subTotal'], 0, ',', '.'); ?></span>₫
            </strong>
          </td>
        </tr>
        <?php if (isset($order['coupon'])) : ?>
        <tr class="cart-discount">
          <th>Coupon: <?= $order['coupon']; ?></th>
          <td> <strong>
              <span class="discount">-<?= number_format($order['discount'], 0, ',', '.'); ?></span>₫
              <strong>
          </td>
        </tr>
        <?php endif ?>
        <tr class="shipping-totals shipping">
          <th>Phí vận chuyển</th>
          <td data-title="Shipping">
            <strong>
              <span><?= number_format($order['shipping'], 0, ',', '.'); ?></span>₫
            </strong>
          </td>
        </tr>
        <tr class="order-total">
          <th>Tổng</th>
          <td>
            <strong>
              <span class="total"><?= number_format($order['total'], 0, ',', '.'); ?></span>₫
            </strong>
          </td>
        </tr>
        <tr>
          <th scope="row">Phương thức thanh toán:</th>
          <td><?= $order['transaction']; ?></td>
        </tr>
        <tr>
          <th scope="row">Trạng thái đơn hàng:</th>
          <td class="status"><span class="bg-status-<?= $order['status'][0]; ?>"><?= $order['status'][1]; ?></span>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="col-lg-5">
    <h5 class="text-center">THÔNG TIN THANH TOÁN</h5>
    <p><strong>Họ và tên:</strong> <?= $order['fullName'] ?></p>
    <p><strong>Số điện thoại:</strong> <?= $order['mobile'] ?></p>
    <p><strong>Email:</strong> <?= $order['email'] ?></p>
    <p><strong>Địa chỉ:</strong>
      <?= $transport['address'] . ", " . $transport['ward'] . ", " . $transport['district'] . ", " . $transport['province'] ?>
    </p>

    <h5 class="text-center">GHTK</h5>
    <div class="ghtk"></div>
    <?php if (!isset($transport['tracking_id'])) : ?>
    <a href="javascript:void(0);" class="btn btn-sm btn-white text-success create" data-id="<?= $order['id'] ?>">
      <i class="fas fa-shipping-fast"></i>
      Đăng đơn hàng
    </a>
    <?php else : ?>
    <p><strong>Mã vận đơn:</strong> <?= $transport['tracking_id']; ?></p>
    <p><strong>Ngày lấy hàng:</strong> <?= $transport['tracking_id']; ?></p>
    <p><strong>Ngày giao hàng:</strong> <?= $transport['tracking_id']; ?></p>
    <p><strong>Trạng thái:</strong> <?= $transport['tracking_id']; ?></p>
    <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger cancel" data-id="<?= $order['id'] ?>">
      <i class="fas fa-ban"></i>
      Hủy đơn hàng
    </a>
    <a href="javascript:void(0);" class="btn btn-sm btn-white text-info print"
      data-id="<?= $transport['tracking_id']; ?>">
      <i class="fas fa-print"></i>
      In đơn hàng
    </a>
    <?php endif ?>
  </div>
</div>