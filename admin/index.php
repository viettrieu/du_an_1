<?php include_once('./config.php');
if (!isset($userID)) {
  header('location: ./login.php');
}
if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
    case 'bang-tin':
      $page = 'bang-tin';
      $title = 'Bảng tin';
      break;
    case 'san-pham':
      $page = 'san-pham';
      $title = 'Sản phẩm';
      break;
    case 'tao-san-pham':
      $page = 'tao-san-pham';
      $title = 'Tạo sản phẩm';
      break;
    case 'sua-san-pham':
      $page = 'sua-san-pham';
      $title = 'Sửa sản phẩm';
      break;
    case 'danh-muc':
      $page = 'danh-muc';
      $title = 'Danh mục';
      break;
    case 'sua-danh-muc':
      $page = 'sua-danh-muc';
      $title = 'Sửa danh mục';
      break;
    case 'tu-khoa':
      $page = 'tu-khoa';
      $title = 'Từ khóa';
      break;
    case 'sua-tu-khoa':
      $page = 'sua-tu-khoa';
      $title = 'Sửa từ khóa';
      break;
    case 'danh-gia':
      $page = 'danh-gia';
      $title = 'Đánh giá';
      break;
    case 'don-hang':
      $page = 'don-hang';
      $title = 'Hóa đơn';
      break;
    case 'tao-don-hang':
      $page = 'tao-don-hang';
      $title = 'Tạo đơn hàng';
      break;
    case 'chi-tiet-don-hang':
      $page = 'chi-tiet-don-hang';
      $title = 'Chi tiết đơn hàng';
      break;
    case 'thanh-vien':
      $page = 'thanh-vien';
      $title = 'Thành viên';
      break;
    case 'tao-thanh-vien':
      $page = 'tao-thanh-vien';
      $title = 'Tạo thành viên';
      break;
    case 'sua-thanh-vien':
      $page = 'sua-thanh-vien';
      $title = 'Sửa thành viên';
      break;
    default:
      $page = 'error-404';
      $title = '404';
      break;
  }
} else {
  $title = 'Bảng tin';
  $page = 'bang-tin';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('./head.php') ?>

<body>

  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <!-- Header -->
    <?php include_once('./header.php') ?>
    <!-- /Header -->

    <!-- Sidebar -->
    <?php include_once('./sidebar.php') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <?php include_once('./' . $page . '.php') ?>
    <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->

  <?php include_once('./footer.php') ?>

</body>

</html>