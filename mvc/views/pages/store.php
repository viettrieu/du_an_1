<div class="row">
  <?php
  $ListProduct =  $data['ListProduct'];
  if (count($ListProduct) > 0) {
    foreach ($ListProduct as $key => $product) { ?>
  <div class="col medium-6 small-12 large-4" data-aos="fade-up" data-aos-delay="<?= $key * 200 ?>">
    <div class="col-inner">
      <?php require "./mvc/views/block/product.php" ?>
    </div>
  </div>
  <?php }
  } else { ?>
  <div class="container">
    Không có sản phẩm phù hợp
  </div>
  <?php } ?>
</div>
<div class="container">
  <?= $data["Paging"] ?>
</div>