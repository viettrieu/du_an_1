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
      <li class="mycccount-navigation-link active">
        <a href="<?= SITE_URL ?>/account/orders">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link">
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

    <?php
    $orders = $data["Orders"];
    if (count($orders) > 0) { ?>
    <table class="my_account_orders">
      <thead>
        <tr>
          <th class="table__header-order-number">
            <span class="nobr">Đơn hàng</span>
          </th>
          <th class="table__header-order-date">
            <span class="nobr">Ngày</span>
          </th>
          <th class="table__header-order-status">
            <span class="nobr">Tình trạng</span>
          </th>
          <th class="table__header-order-total">
            <span class="nobr">Tổng</span>
          </th>
          <th class="table__header-order-actions">
            <span class="nobr">Các thao tác</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order) : ?>
        <tr class="table__row order">
          <td class="table__cell-order-number" data-title="Đơn hàng">
            <a href="<?= SITE_URL ?>/account/vieworder/<?= $order['id']; ?>"> #<?= $order['id']; ?> </a>
          </td>
          <td class="table__cell-order-date" data-title="Ngày">
            <span><?= $order['published']; ?></span>
          </td>
          <td class="table__cell-order-status status-<?= $order['status'] ?>" data-title="Tình trạng">
            <span><?= $order['textStatus']; ?></span>

          </td>
          <td class="table__cell-order-total" data-title="Tổng">
            <span class="price">
              <span class="unit-price">
                <?php echo number_format($order['total'], 0, ',', '.'); ?>
              </span>₫
            </span>
          </td>
          <td class="table__cell-order-actions" data-title="Các thao tác">
            <a href="<?= SITE_URL ?>/account/vieworder/<?= $order['id']; ?>" class="button">Xem</a>
          </td>
        </tr>
        <?php endforeach  ?>
      </tbody>
    </table>
    <?php  } else {
      echo 'chưa có đơn hàng';
    } ?>
  </div>
</div>