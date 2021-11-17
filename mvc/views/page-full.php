<!DOCTYPE html>
<html lang="vi">
<?php require_once "./mvc/views/block/head.php"; ?>

<body>
  <div id="wrapper">
    <?php require_once "./mvc/views/block/header.php"; ?>
    <?php require_once "./mvc/views/block/breadcrumb.php"; ?>
    <?php require_once "./mvc/views/pages/" . $data["Page"] . ".php" ?>
    <?php require_once "./mvc/views/block/footer.php" ?>
  </div>
</body>

</html>