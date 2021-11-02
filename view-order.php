<?php
if (!isset($userID)) {
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  echo ("<script>location.href = './index.php?action=dang-nhap';</script>");
}
?>
<?php
$sql = "select * from ps_users where id='$userID'";
$result = $conn->query($sql)->fetch_assoc();
?>
<div class="row vertical-tabs row-divided">
  <div class="large-3 col" style=" padding-right: 0;">

    <div class="account-user">
      <span class="image">
        <img alt="" src="<?php echo $result['avatar'] == null ? './assets/img/avatar-default.png' : $result['avatar']; ?>" height="70" width="70">
      </span>
      <span class="user-name">
        <?php echo $result['username']; ?>
      </span>

    </div>
    <ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">

      <li class="mycccount-navigation-link">
        <a href="./index.php?action=tai-khoan">Trang tài khoản</a>
      </li>
      <li class="mycccount-navigation-link active">
        <a href="./index.php?action=don-hang">Đơn hàng</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=doi-mat-khau">Đổi mật khẩu</a>
      </li>
      <li class="mycccount-navigation-link">
        <a href="./index.php?action=tai-khoan&logout">Thoát</a>
      </li>
    </ul>
  </div>

  <div class="large-9 col">

    <?php
    if (isset($_GET['orderId'])) {
      $orderId = $_GET['orderId'];
      $sql = "SELECT  title , price, ps_order_item.quantity as 'quantity', price * ps_order_item.quantity as 'total' FROM ps_order_item INNER JOIN ps_product ON productId = ps_product.id WHERE orderId = $orderId";
      $orderitem = $conn->query($sql);
      if ($orderitem->num_rows > 0) {
        $query = "SELECT ps_order.id, ps_order.status, fullName, mobile, email, address, total, subTotal, transaction, DATE_FORMAT(published, '%e/%c/%Y') AS'published', ps_order.status, ps_order_status.status AS 'textStatus' from ps_order INNER JOIN ps_order_status on ps_order.status = ps_order_status.id WHERE userId = $userID AND ps_order.id = $orderId";
        $order = $conn->query($query)->fetch_assoc();
        $transaction = '';
        switch ($order['transaction']) {
          case 'cod':
            $transaction = 'Trả tiền mặt khi nhận hàng';
            break;
          case 'bacs':
            $transaction = 'Chuyển khoản ngân hàng';
            break;
          case 'credit':
            $transaction = 'Thanh Toán Thẻ Visa/Master';
            break;
        } ?>
        <p>
          Đơn hàng #<mark class="order-number"><?php echo $order['id'] ?></mark> đã được đặt lúc <mark class="order-date"><?php echo $order['published'] ?></mark> và hiện tại là <mark class="order-status"><?php echo $order['textStatus'] ?></mark>.</p>
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
              <?php
              while ($row = $orderitem->fetch_assoc()) { ?>
                <tr class="cart_item">
                  <td class="product-name"> <?php echo $row['title']; ?>
                    <strong class="product-quantity">× <?php echo $row['quantity']; ?></strong>
                  </td>
                  <td class="product-total">
                    <span class="price">
                      <span class="unit-price"> <?php echo number_format($row['total'], 0, ',', '.'); ?></span>
                      <sup>đ</sup>
                    </span>
                  </td>
                </tr>
              <?php  } ?>
            </tbody>
            <tfoot>
              <tr class="cart-subtotal">
                <th>Tạm tính</th>
                <td>
                  <strong>
                    <span class="subtotal"><?php echo number_format($order['subTotal'], 0, ',', '.'); ?> </span>
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
                    <span class="total"><?php echo number_format($order['total'], 0, ',', '.'); ?></span>
                    <sup>đ</sup>
                  </strong>
                </td>
              </tr>
              <tr>
                <th scope="row">Phương thức thanh toán:</th>
                <td><?php echo $transaction; ?></td>
              </tr>
            </tfoot>
          </table>
          <div class="customer-details">
            <h5>THÔNG TIN THANH TOÁN</h5>
            <p><strong>Họ và tên:</strong> <?php echo $order['fullName'] ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $order['mobile'] ?></p>
            <p><strong>Email:</strong> <?php echo $order['email'] ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $order['address'] ?></p>
          </div>
        </div>
    <?php  } else {
        echo 'chưa có đơn hàng';
      }
    }
    ?>
  </div>
</div>