<!DOCTYPE html>
<html lang="vi">
<?php require_once "./mvc/views/admin/block/head.php"; ?>

<body>

  <!-- Main Wrapper -->
  <div class="main-wrapper">

    <!-- Header -->
    <?php require_once "./mvc/views/admin/block/header.php"; ?>
    <!-- /Header -->

    <!-- Sidebar -->
    <?php require_once('./mvc/views/admin/block/sidebar.php') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <?php require_once "./mvc/views/admin/pages/" . $data["Page"] . ".php" ?>
    <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->

  <?php require_once "./mvc/views/admin/block/footer.php" ?>

</body>

</html>