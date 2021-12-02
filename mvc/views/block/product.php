<div class="product has-hover">
    <div class="box-image">
        <div class="product-actions">
            <ul>
                <li class="add-the-cart">
                    <a href="#" data-id="<?= $product["id"] ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <i class="fas fa-box"></i>
                    </a>
                    <span class="tooltiptext tooltip-left">Thêm vào giỏ</span>
                </li>
                <li>
                    <a href=""><i class="far fa-heart"></i></a>
                    <span class="tooltiptext tooltip-left">Yêu thích</span>
                </li>
                <li>
                    <a href=""><i class="fas fa-search"></i></a>
                    <span class="tooltiptext tooltip-left">Xem nhanh</span>
                </li>
            </ul>
        </div>
        <a href="<?= SITE_URL ?>/store/product/<?= $product["id"] ?>">
            <span class="on-sale product-flash">Sale</span>
            <span class="on-featured product-flash">Hot</span>
            <img src="<?= SITE_URL ?>/<?= $product["thumbnail"] ?>" alt="<?= $product["title"] ?>">
            <?php if ($product["rating"] != NULL) : ?>
                <div class="star-rating">
                    <div class="star-ratings-css">
                        <div class="star-ratings-inner" style="width: <?= $product["rating"] * 20 ?>%"></div>
                    </div>
                </div>
            <?php endif ?>
        </a>
    </div>
    <div class="box-textx text-center">
        <span class="price" data-price="<?= $product["price"] ?>">
            <span class="unit-price"><?= number_format($product["price"], 0, ',', '.') ?></span>
            <sup>đ</sup>
        </span>
        <h4 class="product-title">
            <a href="<?= SITE_URL ?>/store/product/<?= $product["id"] ?>"><?= $product["title"] ?></a>
        </h4>
        <div class="product-author"><span>By</span><a href="#" rel="tag">John Walker</a></div>
    </div>
</div>