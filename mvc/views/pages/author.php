<?php $author = $data['Author'] ?>
<div class="row page-wrapper" style="justify-content: center">
  <div class="col medium-6 small-12 large-5">
    <div class="author-avatar">
      <img src="<?= SITE_URL ?><?= $author['avatar'] ?>">
    </div>
  </div>
  <div class="col medium-6 small-12 large-5">
    <div class="author-info">
      <h4 class="text-center" href="https://auteur.g5plus.net/product-author/shia-ung/" title="Shia Ung">
        <?= $author['title'] ?></a>
      </h4>
      <div class="author-quote">" <?= $author['quote'] ?>"</div>
      <ul class="social-media">
        <li>
          <a class="facebook" href="<?= $author['fblink'] ?>" target="blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a class="twitter" href="<?= $author['twitterlink'] ?>" target="blank">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a class="youtube" href="<?= $author['youtubelink'] ?>" target="blank">
            <i class="fab fa-youtube"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <?php
  $ListProduct =  $data['ListProduct'];
  if (count($ListProduct) > 0) {
    foreach ($ListProduct as $product) { ?>
  <div class="col medium-4 small-12 large-3">
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