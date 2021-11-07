<?php
$order = $data["Order"];
$items = $data["Items"];
?>

<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Đơn hàng</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active"><?= $data["Title"] ?></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <?php if ($data["Order"] != false) : ?>
    <div class="row">

      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-center">CHI TIẾT ĐƠN HÀNG</h5>
          </div>
          <div class="card-body">

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
                <tr class="shipping-totals shipping">
                  <th>Phí vận chuyển</th>
                  <td data-title="Shipping">
                    <strong>
                      <span>0 </span>
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

          </div>
          <div class="card-footer">
            <h5 class="card-title text-center">THÔNG TIN THANH TOÁN</h5>
            <p><strong>Họ và tên:</strong> <?= $order['fullName'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $order['mobile'] ?></p>
            <p><strong>Email:</strong> <?= $order['email'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $order['address'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <p>
              <strong>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</strong>
            </p>
            <ul>
              <li>Mã đơn hàng: <strong><?= $order['id'] ?></strong></li>
              <li>Ngày: <strong><?= $order['published'] ?></strong></li>
              <li>Tổng cộng: <strong>
                  <span class="total"><?= number_format($order['total'], 0, ',', '.'); ?></span>
                  <sup>đ</sup></strong></li>
              <li>Trạng thái: <strong><?= $order['status']; ?></strong></li>
            </ul>


          </div>
        </div>
      </div>
    </div>
    <?php else : ?>
    <p>KHÔNG CÓ ĐƠN HÀNG</p>
    <?php endif ?>
  </div>
</div>