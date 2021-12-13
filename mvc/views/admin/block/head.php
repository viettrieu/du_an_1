<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title><?php echo $data["Title"]; ?> | ADMIN FOODO</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= SITE_URL ?>/public/admin/img/favicon.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/fontawesome/css/all.min.css">

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/select2/css/select2.min.css">

  <!-- Datepicker CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/css/bootstrap-datetimepicker.min.css">

  <!-- daterangepicker CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin//plugins/daterangepicker/daterangepicker.css">

  <!-- quill CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/quill/css/quill.snow.css">

  <!-- Datatables CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/datatables/datatables.min.css">
  <!-- sweetalert2 CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/plugins/sweetalert2/sweetalert2.min.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/public/admin/css/style.css">

  <!--[if lt IE 9]>
			<script src="<?= SITE_URL ?>/public/admin/js/html5shiv.min.js"></script>
			<script src="<?= SITE_URL ?>/public/admin/js/respond.min.js"></script>
		<![endif]-->
  <!-- jQuery -->
  <script src="<?= SITE_URL ?>/public/admin/js/jquery-3.5.1.min.js"></script>
  <script>
  <?php
    echo "let ADMIN_URL = '" . ADMIN_URL . "';";
    echo "let SITE_URL = '" . SITE_URL . "';";
    ?>
  </script>
</head>