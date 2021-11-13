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
            <tbody id="show-cart">
                <?php foreach($data['Items'] as $item){ ?>
                <tr class="cart-item" data-id="1">
                    <td class="product-remove">
                        <i class="far fa-times-circle remove" onclick="removeItemFromCartAll(this)"></i>
                    </td>
                    <td class="product-thumbnail">
                        <a href="http://localhost/ASM_MVC//store/product/<?= $item['id']?>">
                            <!-- <img width="90" height="90"
                                src="http://localhost/ASM_MVC//public/img/product-1-600x600.jpg"> -->
                        </a>
                    </td>
                    <td class="product-name">
                        <a href="http://localhost/ASM_MVC//store/product/<?= $item['id']?>">Effects Of Time</a>
                    </td>
                    <td class="product-price" data-title="Giá" data-price="50000">
                        <span class="price">
                            <span> <?= number_format($item['price']) ?></span>
                            <sup>đ</sup>
                        </span>
                    </td>

                    <td class="product-price" data-title="Giá" data-price="50000">
                        <span class="price">
                            <span> <?= number_format($item['quantity']) ?></span>
                            
                        </span>
                    </td>

                    <td>
                        <div class="add-the-cart">
                            <a href="#" class="secondary ">
                                <i class="fas fa-shopping-cart"></i>
                                <i class="fas fa-box"></i>
                                <span>THÊM VÀO GIỎ</span>
                            </a>
                        </div>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

</div>
<div class="row nproduct" style="display: none">
    <div class="col medium-12 large-12 text-center">
        <p>Không có sản phẩm nào trong giỏ</p>
        <a href="<?= SITE_URL ?>/store" class="button primary">
            <span>Quay trở về của hàng</span>
        </a>
    </div>
</div>