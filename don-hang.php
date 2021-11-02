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
    $sql = "SELECT ps_order.id, ps_order.status, ps_order.userId, DATE_FORMAT(ps_order.published, '%e/%c/%Y') AS 'published', ps_order.total,ps_order.status, ps_order_status.status AS 'textStatus' from ps_order INNER JOIN ps_order_status on ps_order.status = ps_order_status.id WHERE ps_order.userId = '$userID' ORDER BY ps_order.id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { ?>
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
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr class="table__row order">
              <td class="table__cell-order-number" data-title="Đơn hàng">
                <a href="./index.php?action=view-order&orderId=<?php echo $row['id']; ?>"> #<?php echo $row['id']; ?> </a>
              </td>
              <td class="table__cell-order-date" data-title="Ngày">
                <span><?php echo $row['published']; ?></span>
              </td>
              <td class="table__cell-order-status status-<?php echo $row['status'] ?>" data-title="Tình trạng">
                <span><?php echo $row['textStatus']; ?></span>

              </td>
              <td class="table__cell-order-total" data-title="Tổng">
                <span class="price">
                  <span class="unit-price">
                    <?php echo number_format($row['total'], 0, ',', '.'); ?>
                  </span> <sup>đ</sup>
                </span>
              </td>
              <td class="table__cell-order-actions" data-title="Các thao tác">
                <a href="./index.php?action=view-order&orderId=<?php echo $row['id']; ?>" class="button">Xem</a>
              </td>
            </tr>
          <?php   } ?>
        </tbody>
      </table>
    <?php  } else {
      echo 'chưa có đơn hàng';
    } ?>
  </div>
</div>