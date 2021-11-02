<?php include_once('./config.php'); ?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM `ps_order` WHERE id = $id";
  $user = $conn->query($query)->fetch_assoc();
  if ($user == NULL) {
    echo ("<script>location.href = './index.php?action=don-hang';</script>");
  }
} else {
  echo ("<script>location.href = './index.php?action=don-hang';</script>");
}
?>

<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Đơn hàng</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <?php if (isset($_GET['id'])) {
      $orderId = $_GET['id'];
      $sql = "SELECT  title , price, ps_order_item.quantity as 'quantity', price * ps_order_item.quantity as 'total' FROM ps_order_item INNER JOIN ps_product ON productId = ps_product.id WHERE orderId = $orderId";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) { ?>

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

          </div>
          <div class="card-footer">
            <h5 class="card-title text-center">THÔNG TIN THANH TOÁN</h5>
            <p><strong>Họ và tên:</strong> <?php echo $result['fullName'] ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $result['mobile'] ?></p>
            <p><strong>Email:</strong> <?php echo $result['email'] ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $result['address'] ?></p>
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
              <li>Mã đơn hàng: <strong><?php echo $result['id'] ?></strong></li>
              <li>Ngày: <strong><?php echo $result['published'] ?></strong></li>
              <li>Tổng cộng: <strong><span
                    class="total"><?php echo number_format($result['total'], 0, ',', '.'); ?></span>
                  <sup>đ</sup></strong></li>
              <li>Trạng thái: <strong><?php echo $result['textStatus']; ?></strong></li>
            </ul>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php }
    }
?>