<div class="row page-wrapper row-divided yproduct">
  <div class="col medium-12 small-12 large-8">
    <table class="cart table-form shop_table" cellspacing="0">
      <thead>
        <tr>
          <th class="product-thumbnail"></th>
          <th class="product-name">Hàng hóa</th>
          <th class="product-price">Đơn giá</th>
          <th class="product-quantity">Số lượng</th>
          <th class="product-subtotal">Thành tiền</th>
          <th class="product-remove"></th>
        </tr>
      </thead>
      <tbody id="show-cart">
      </tbody>
    </table>
  </div>
  <div class="col medium-12 small-12 large-4">
    <div class="cart-totals">
      <h3>TỔNG BẢNG GIÁ</h3>
      <table cellspacing="0" class="shop_table shop_table_responsive">
        <tbody>
          <tr class="cart-subtotal">
            <th>Tạm tính</th>
            <td>
              <strong>
                <span class="subtotal"></span>₫
              </strong>
            </td>
          </tr>
          <tr class="order-total">
            <th>Tổng</th>
            <td>
              <strong>
                <span class="total"></span>₫
              </strong>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="proceed-to-checkout">
        <a href="<?= SITE_URL ?>/checkout" class="checkout-button button secondary">
          ĐẶT HÀNG
        </a>
      </div>

      <div class="coupon">
        <form action="" method="post" id="add_coupon">
          <div id="info"></div>
          <div class="form-group">
            <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="Coupon code" />
          </div>
          <button type="submit" class="button primary" name="apply_coupon">
            ÁP DỤNG
          </button>
        </form>
      </div>
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