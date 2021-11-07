<?php $title = isset($data['Title']) ? $data['Title'] : "404" ?>
<?php if ($data["Page"] != "home") {
  if ($data["Page"] != "product") { ?>
<div class="breadcrumbs">
  <div class="container flex-row">
    <div class="flex-col flex-left">
      <h1 class="breadcrumb-heading"><?= $title ?></h1>
    </div>
    <div class="flex-col hide-for-medium flex-right">
      <nav>
        <a href="<?= SITE_URL ?>">Trang chủ</a>
        <span class="divider">/</span>
        <?= $title ?>
      </nav>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="breadcrumbs single-product">
  <div class="container">
    <nav>
      <a href="<?= SITE_URL ?>">Trang chủ</a>
      <span class="divider">/</span>
      <a href="<?= SITE_URL ?>/store">Của hàng</a>
      <span class="divider">/</span>
      <?= $title ?>
    </nav>
  </div>
</div>

<?php }
} ?>