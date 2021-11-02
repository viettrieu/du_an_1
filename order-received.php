<?php require_once("./vnpay_php/vnpay_ipn.php"); ?>
<?php
if (isset($_GET['orderId']) || isset($_GET['vnp_TxnRef'])) {
  $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : $_GET['vnp_TxnRef'];
  $sql = "SELECT  title , price, ps_order_item.quantity as 'quantity', price * ps_order_item.quantity as 'total' FROM ps_order_item INNER JOIN ps_product ON productId = ps_product.id WHERE orderId = $orderId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
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
        <?php while ($row = $result->fetch_assoc()) { ?>
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
        <?php $sql = "SELECT ps_order.id, ps_order.status, fullName, mobile, email, address, total, subTotal, transaction, DATE_FORMAT(published, '%e/%c/%Y') AS'published', ps_order.status, ps_order_status.status AS 'textStatus' from ps_order INNER JOIN ps_order_status on ps_order.status = ps_order_status.id WHERE  ps_order.id = $orderId";
            $result = $conn->query($sql)->fetch_assoc();
            $transaction = '';
            switch ($result['transaction']) {
              case 'cod':
                $transaction = 'Trả tiền mặt khi nhận hàng';
                break;
              case 'bacs':
                $transaction = 'Chuyển khoản ngân hàng';
                break;
              case 'credit':
                $transaction = 'Thanh Toán Thẻ Visa/Master';
                break;
            }
            ?>
        <tr class="cart-subtotal">
          <th>Tạm tính</th>
          <td>
            <strong>
              <span class="subtotal"><?php echo number_format($result['subTotal'], 0, ',', '.'); ?> </span>
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
              <span class="total"><?php echo number_format($result['total'], 0, ',', '.'); ?></span>
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
      <h4 class="text-center">THÔNG TIN THANH TOÁN</h4>
      <p><strong>Họ và tên:</strong> <?php echo $result['fullName'] ?></p>
      <p><strong>Số điện thoại:</strong> <?php echo $result['mobile'] ?></p>
      <p><strong>Email:</strong> <?php echo $result['email'] ?></p>
      <p><strong>Địa chỉ:</strong> <?php echo $result['address'] ?></p>
    </div>
  </div>
  <div class="col medium-12 small-12 large-5">
    <div class="is-well">
      <p>
        <strong>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</strong>
      </p>
      <ul>
        <li>Mã đơn hàng: <strong><?php echo $result['id'] ?></strong></li>
        <li>Ngày: <strong><?php echo $result['published'] ?></strong></li>
        <li>Tổng cộng: <strong><span class="total"><?php echo number_format($result['total'], 0, ',', '.'); ?></span>
            <sup>đ</sup></strong></li>
        <li>Trạng thái: <strong><?php echo $result['textStatus']; ?></strong></li>
      </ul>
    </div>
  </div>
</div>
</div>
<?php } else {
    echo ("<script>location.href = './index.php?action=cua-hang';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=cua-hang';</script>");
}
?>