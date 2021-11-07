<!DOCTYPE html>
<html lang="vi">
<?php require_once "./mvc/views/block/head.php"; ?>

<body>
  <?php require_once "./mvc/views/block/header.php"; ?>
  <?php require_once "./mvc/views/block/breadcrumb.php"; ?>
  <div class="row page-wrapper">
    <div class="large-3 col sidebar">
      <?php include_once('./mvc/views/block/shop-sidebar.php') ?>
    </div>
    <div class="large-9 col-nop">
      <?php require_once "./mvc/views/pages/" . $data["Page"] . ".php" ?>
    </div>
  </div>
  <?php require_once "./mvc/views/block/footer.php" ?>

</body>

</html>