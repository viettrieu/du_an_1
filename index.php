<?php
include_once 'config.php';
include_once 'action.php';
?>
<!DOCTYPE html>
<html lang="vi">
<?php include_once './head.php'; ?>

<body>
  <?php include_once './header.php'; ?>
  <?php if (!($page == 'trang-chu' || $page == 'san-pham' ||  $page == 'bai-viet' || $page == '404' || $page == 'danh-muc' || $page == 'tu-khoa' || $page == 'search')) {
    include_once './breadcrumb.php';
  }
  ?>
  <?php include_once './' . $page . '.php' ?>
  <?php include_once 'footer.php' ?>
</body>

</html>