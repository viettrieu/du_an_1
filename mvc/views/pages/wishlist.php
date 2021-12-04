<?php if (($number = count($data['Items'])) > 0) { ?>
<div class="row page-wrapper row-divided yproduct">
  <div class="col medium-12 small-12 large-12">
    <table class="cart table-form shop_table" cellspacing="0">
      <thead>
        <tr>
          <th class="product-remove"></th>
          <th class="product-thumbnail"></th>
          <th class="product-name">Hàng hóa</th>
          <th class="product-price">Đơn giá</th>
          <th class="product-subtotal">Số Lượng</th>
          <th class="add-to-card"></th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['Items'] as $key => $item) { ?>
        <tr class="cart-item" data-id="<?= $item["id"] ?>">
          <td class="product-remove">
            <i class="far fa-times-circle remove" onclick="removeItemFromWishlist(this)"></i>
          </td>
          <td class="product-thumbnail">
            <a href="<?= SITE_URL ?>/store/product/<?= $item["id"] ?>">
              <img width="90" height="90" src="<?= SITE_URL ?><?= $item['thumbnail'] ?>">
            </a>
          </td>
          <td class="product-name">
            <a href="<?= SITE_URL ?>/store/product/<?= $item["id"] ?>"><?= $item['title'] ?></a>
          </td>
          <td class="product-price" data-title="Giá" data-price="<?= $item['price'] ?>">
            <span class="price">
              <span> <?= number_format($item['price']) ?></span>
              <sup>đ</sup>
            </span>
          </td>
          <td class="product-quantity" data-title="Số lượng">
            100
          </td>
          <td>
            <div class="add-the-cart">
              <a href="#" class="secondary" data-id="<?= $item["id"] ?>">
                <i class="fas fa-shopping-cart"></i>
                <i class="fas fa-book"></i>
                <span>THÊM VÀO GIỎ</span>
              </a>
            </div>

          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
<div class="row nproduct" style="display: <?= $number > 0 ? "none" : "flex" ?>">
  <div class="col medium-12 large-12 text-center">
    <p>Chưa có sản phẩm yêu thích</p>
    <a href="<?= SITE_URL ?>/store" class="button primary">
      <span>Quay trở về của hàng</span>
    </a>
  </div>
</div>