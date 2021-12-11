<form action="" method="POST" id="checkout-form" class="needs-validation" novalidate>
  <div class=" row page-wrapper row-divided yproduct">
    <div class="col medium-12 small-12 large-7">
      <?php
      $fullName = $email = $mobile = $address = "";
      if (isset($data["UserById"])) {
        $UserById = $data["UserById"];
        $fullName = $UserById['fullName'];
        $email = $UserById['email'];
        $mobile = $UserById['mobile'];
        $address = $UserById['address'];
      }
      $listProvince = $data['Province'];
      $listDistrict = $data['District'];
      $listWard = $data['Ward'];
      ?>
      <?php foreach ($data["Errors"] as $error) :
        $class = $error["status"] == "ERROR" ? "alert-danger" : "alert-success";
      ?>
      <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
        <?= $error["message"] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php endforeach ?>
      <h3 class="container text-center">THÔNG TIN THANH TOÁN</h3>
      <div class="row">
        <div class="col small-12 large-12">
          <div class="form-group">
            <label for="fullname">
              Họ và tên <span class="required">*</span>
            </label>
            <input id="fullName" class="form-control" name="fullName" type="text" value="<?= $fullName; ?>" size="30"
              required />
          </div>
          <div class="form-group">
            <label for="email">
              Email
            </label>
            <input id="email" class="form-control" name="email" type="email" value="<?= $email; ?>" />
          </div>
          <div class="form-group phone">
            <label for="mobile">
              Số điện thoại <span class="required">*</span>
            </label>
            <!-- <div class="input-group"> -->
            <input id="mobile" class="form-control" name="mobile" type="tel" value="<?= $mobile; ?>" size="30" required
              pattern="(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})">
            <!-- <button type="button" class="button primary" id="btnsubmit" onclick="onPhoneAuth()">
            Nhận OTP
          </button> -->
            <!-- </div> -->
          </div>
          <!-- <div class="form-group otp none">
        <label for="phone">
          Vui Lòng Nhập Mã Xác Minh
          <span class="required">*</span>
        </label>
        <div class="input-group">
          <input id="vericode" name="phone" type="tel" value="" size="30" required />
          <button type="button" class="button secondary" id="authsmsbtn">
            Xác minh
          </button>
        </div>
      </div> -->
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="province">
              Tỉnh/Thành phố <span class="required">*</span>
            </label>
            <select id="province" class=" custom-select select2" name="province" required>
              <option value=""></option>
              <?php foreach ($listProvince as $key => $province) : ?>
              <?= $selected = $key == $UserById['province'] ? 'selected' : "" ?>
              <option data-province="<?= $key ?>" value="<?= $province ?>" <?= $selected ?>><?= $province ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group district">
            <label for="district">
              Quận/Huyện <span class="required">*</span>
            </label>
            <select id="district" name="district" class=" custom-select select2" required>
              <?php foreach ($listDistrict as $key =>  $district) : ?>
              <?= $selected = $key == $UserById['district'] ? 'selected' : "" ?>
              <option data-district="<?= $key ?>" value="<?= $district ?>" <?= $selected ?>><?= $district ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group ward">
            <label for="ward">
              Xã/Phường/Thị trấn <span class="required">*</span>
            </label>
            <select id="ward" name="ward" class=" custom-select select2" required>
              <?php foreach ($listWard as $key =>  $ward) : ?>
              <?= $selected = $key == $UserById['ward'] ? 'selected' : "" ?>
              <option data-ward="<?= $key ?>" value="<?= $ward ?>" <?= $selected ?>><?= $ward ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col medium-6 small-12 large-6">
          <div class="form-group">
            <label for="address">
              Địa chỉ nhận hàng <span class="required">*</span>
            </label>
            <input id="address" class="form-control" name="address" type="text" value="<?= $address; ?>" required
              autocomplete="off" />
            <!-- <p id="current-position">Đặt vị trí hiện tại</p>
            <div class="map-wrapper">
              <div id="map" style="height: 350px; width: 100%"></div>
              <div class="shippingtime_box" style="display: none">
                Khoảng cách:
                <span class="distance" style="font-weight: 700"></span><br />
                Thời gian giao hàng:
                <span class="duration" style="white-space: nowrap; font-weight: 700"></span>
              </div>
            </div> -->
          </div>
        </div>

        <div class="col small-12 large-12">
          <div class="form-group">
            <label for="comments">
              <h5>Thông tin bổ sung</h5>
            </label>
            <textarea id="comments" class="form-control" name="comments" cols="45" rows="8" maxlength="1000"
              placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="col medium-12 small-12 large-5">
      <div class="cart-totals">
        <h3 class="text-center">ĐƠN HÀNG CỦA BẠN</h3>
        <table class="shop_table checkout-review-table">
          <thead>
            <tr>
              <th class="product-name">Sản phẩm</th>
              <th class="product-total">Tổng</th>
            </tr>
          </thead>
          <tbody id="show-checkout"></tbody>
          <tfoot>
            <tr class="cart-subtotal">
              <th>Tạm tính</th>
              <td>
                <strong>
                  <span class="subtotal"></span>₫
                </strong>
              </td>
            </tr>
            <tr class="shipping">
              <th>Phí vận chuyển</th>
              <td data-title="Shipping" id="transport">
                Chưa xác định
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
          </tfoot>
        </table>
        <div class="checkout-payment">
          <ul>
            <li class="payment_method">
              <input id="payment_method_cod" type="radio" class="input-radio" name="transaction" value="cod"
                checked="checked" data-order_button_text="" />
              <label for="payment_method_cod"> Trả tiền mặt khi nhận hàng </label>
              <div class="payment_box">
                <p>Trả tiền mặt khi giao hàng</p>
              </div>
            </li>
            <li class="payment_method">
              <input id="payment_method_bacs" type="radio" class="input-radio" name="transaction" value="bacs"
                data-order_button_text="" />
              <label for="payment_method_bacs">Chuyển khoản ngân hàng</label>
              <div class="payment_box" style=" display: none; ">
                <ul class="cardList clearfix">
                  <li>
                    <input type="radio" value="NCB" id="NCB" name="bankcode" checked />
                    <label for="NCB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/ncb_logo.png" width="200" height="40"
                        alt="NCB" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="VIETCOMBANK" id="VIETCOMBANK" name="bankcode" />
                    <label for="VIETCOMBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/vietcombank_logo.png" width="200"
                        height="40" alt="VIETCOMBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="VIETINBANK" id="VIETINBANK" name="bankcode" />
                    <label for="VIETINBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/vietinbank_logo.png" width="200"
                        height="40" alt="VIETINBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="BIDV" id="BIDV" name="bankcode" />
                    <label for="BIDV">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/bidv_logo.png" width="200"
                        height="40" alt="BIDV" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="AGRIBANK" id="AGRIBANK" name="bankcode" />
                    <label for="AGRIBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/agribank_logo.png" width="200"
                        height="40" alt="AGRIBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="SACOMBANK" id="SACOMBANK" name="bankcode" />
                    <label for="SACOMBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/sacombank_logo.png" width="200"
                        height="40" alt="SACOMBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="TECHCOMBANK" id="TECHCOMBANK" name="bankcode" />
                    <label for="TECHCOMBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/techcombank_logo.png" width="200"
                        height="40" alt="TECHCOMBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="MBBANKHP" id="MBBANKHP" name="bankcode" />
                    <label for="MBBANKHP">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/mbb_logo.png" width="200" height="40"
                        alt="MBBANKHP" />
                    </label>
                  </li>

                  <li>
                    <input type="radio" value="ACB" id="ACB" name="bankcode" />
                    <label for="ACB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/acb_logo.png" width="200" height="40"
                        alt="ACB" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="VPBANK" id="VPBANK" name="bankcode" />
                    <label for="VPBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/vpbank_logo.png" width="200"
                        height="40" alt="VPBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="SHB" id="SHB" name="bankcode" />
                    <label for="SHB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/shb_logo.png" width="200" height="40"
                        alt="SHB" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="DONGABANK" id="DONGABANK" name="bankcode" />
                    <label for="DONGABANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/dongabank_logo.png" width="200"
                        height="40" alt="DONGABANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="EXIMBANK" id="EXIMBANK" name="bankcode" />
                    <label for="EXIMBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/eximbank_logo.png" width="200"
                        height="40" alt="EXIMBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="TPBANK" id="TPBANK" name="bankcode" />
                    <label for="TPBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/tpbank_logo.png" width="200"
                        height="40" alt="TPBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="MSBANK" id="MSBANK" name="bankcode" />
                    <label for="MSBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/msbank_logo.png" width="200"
                        height="40" alt="MSBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="HDBANK" id="HDBANK" name="bankcode" />
                    <label for="HDBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/hdbank_logo.png" width="200"
                        height="40" alt="HDBANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="NAMABANK" id="NAMABANK" name="bankcode" />
                    <label for="NAMABANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/namabank_logo.png" width="200"
                        height="40" alt="NAMABANK" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="OCB" id="OCB" name="bankcode" />
                    <label for="OCB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/ocb_logo.png" width="200" height="40"
                        alt="OCB" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="SCB" id="SCB" name="bankcode" />
                    <label for="SCB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/scb_logo.png" width="200" height="40"
                        alt="SCB" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="IVB" id="IVB" name="bankcode" />
                    <label for="IVB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/ivb_logo.png" width="200" height="40"
                        alt="IVB" />
                    </label>
                  </li>

                  <li>
                    <input type="radio" value="GPBANK" id="GPBANK" name="bankcode" />
                    <label for="GPBANK">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/gpbank_logo.png" width="200"
                        height="40" alt="GPBANK" />
                    </label>
                  </li>
                </ul>
              </div>
            </li>
            <li class="payment_method">
              <input id="payment_method_credit" type="radio" class="input-radio" name="transaction" value="credit"
                data-order_button_text="" />
              <label for="payment_method_credit">Thanh Toán Thẻ Visa/Master</label>
              <div class="payment_box" style=" display: none; ">
                <ul class="cardList clearfix">
                  <li>
                    <input type="radio" value="VISA" id="VISA" name="bankcode" />
                    <label for="VISA">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/visa_logo.png" width="200"
                        height="40" alt="VISA" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="MASTERCARD" id="MASTERCARD" name="bankcode" />
                    <label for="MASTERCARD">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/mastercard_logo.png" width="200"
                        height="40" alt="MASTERCARD" />
                    </label>
                  </li>
                  <li>
                    <input type="radio" value="JCB" id="JCB" name="bankcode" />
                    <label for="JCB">
                      <img src="https://sandbox.vnpayment.vn/paymentv2/images/bank/jcb_logo.png" width="200" height="40"
                        alt="JCB" />
                    </label>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
        <div class="privacy-policy-text">
          <p>
            Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn đặt hàng, hỗ
            trợ trải nghiệm của bạn trên toàn bộ trang web này và cho các mục
            đích khác được mô tả trong
            <a href="./chinh-sach.html" target="_blank">
              chính sách bảo mật
            </a>
            của chúng tôi
          </p>
        </div>
        <div class="proceed-to-checkout">
          <button type="submit" name="create_order" class="button secondary checkout-button">
            THANH TOÁN
          </button>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="row nproduct" style="display: none">
  <div class="col medium-12 large-12 text-center">
    <p>Không có sản phẩm nào trong giỏ</p>
    <a href="./index.php?action=cua-hang" class="button primary">
      <span>Quay trở về của hàng</span>
    </a>
  </div>
</div>