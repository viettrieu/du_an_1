<?php include_once './new.php';
$sql = "SELECT ps_order.id, ps_order.status, fullName, mobile, email, address, total, subTotal, transaction,
  DATE_FORMAT(published, '%e/%c/%Y') AS'published', ps_order.status, ps_order_status.status AS 'textStatus' from ps_order
  INNER JOIN ps_order_status on ps_order.status = ps_order_status.id WHERE ps_order.id = $last_id";
$result = $conn->query($sql)->fetch_assoc();
$transaction = '';
switch ($result['transaction']) {
  case 'cod':
    $transaction = 'Trả tiền mặt khi nhận hàng';
    break;
  case 'bacs':
    $transaction = 'Chuyển khoản ngân hàng';
    break;
  case 'credit':
    $transaction = 'Thanh Toán Thẻ Visa/Master';
    break;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Dale - WooCommerce Email Template</title>
  <meta name="description" content="Email Template for WooCommerce." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style type="text/css">
  @media only screen and (max-width: 480px) {
    body {
      width: 100% !important;
      min-width: 100% !important;
    }

    h1 {
      font-size: 18px !important;
    }

    #templateHeader {
      padding-right: 20px !important;
      padding-left: 20px !important;
    }

    #headerContainer {
      padding-right: 0 !important;
      padding-left: 0 !important;
    }

    #headerTable {
      border-top-left-radius: 0 !important;
      border-top-right-radius: 0 !important;
    }

    #headerTable td {
      padding-top: 30px !important;
    }

    #bodyContainer {
      padding-right: 20px !important;
      padding-left: 20px !important;
    }

    #bodyContent {
      padding-right: 0 !important;
    }

    #footerContent p {
      border-bottom: 1px solid #e5e5e5;
      font-size: 11px !important;
      padding-bottom: 40px !important;
      line-height: 13px !important;
    }

    .utilityLink {
      border-bottom: 1px solid #e5e5e5;
      display: block;
      font-size: 13px !important;
      padding-top: 10px;
      padding-bottom: 10px;
      text-decoration: none !important;
    }

    .mobileHide {
      display: none;
      visibility: hidden;
    }
  }
  </style>
</head>

<body bgcolor="#ffffff" style="
      background-color: #ffffff;
      height: 100%;
      margin: 0;
      padding: 0;
      width: 100%;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    ">
  <center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable"
      bgcolor="#ffffff" style="
          background-color: #ffffff;
          border-collapse: collapse;
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
          height: 100%;
          margin: 0;
          padding: 0;
          width: 100%;
        ">
      <tbody>
        <tr>
          <td align="center" valign="top" id="bodyCell" style="
                mso-line-height-rule: exactly;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                width: 100%;
              ">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="
                  border-collapse: collapse;
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
                  -ms-text-size-adjust: 100%;
                  -webkit-text-size-adjust: 100%;
                ">
              <tbody>
                <tr>
                  <td align="center" bgcolor="#00b8ff" valign="top" id="templateHeader" style="
                        background-color: #00b8ff;
                        padding-right: 30px;
                        padding-left: 30px;
                        mso-line-height-rule: exactly;
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                      ">
                    <!--[if gte mso 9]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="400">
<tr>
<td align="center" valign="top" width="400">
<![endif]-->
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                          max-width: 400px;
                          border-collapse: collapse;
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          -ms-text-size-adjust: 100%;
                          -webkit-text-size-adjust: 100%;
                        " class="emailContainer">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" id="logoContainer" style="
                                padding-top: 30px;
                                padding-bottom: 30px;
                                mso-line-height-rule: exactly;
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                              ">
                            <img src="https://wpfoal.com/assets/img/logo.png" alt="Themes Email" width="120px" style="
                                  padding: 0;
                                  margin: 0;
                                  text-align: center;
                                  border: 0;
                                  display: inline-block;
                                  font-size: 14px;
                                  font-weight: bold;
                                  height: auto;
                                  outline: none;
                                  text-decoration: none;
                                  text-transform: capitalize;
                                  vertical-align: middle;
                                  margin-right: 10px;
                                  -ms-interpolation-mode: bicubic;
                                " data-pagespeed-url-hash="2179177995"
                              onload="pagespeed.CriticalImages.checkImageForCriticality(this);" />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--[if gte mso 9]>
</td>
</tr>
</table>
<![endif]-->
                  </td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#00b8ff" valign="top" id="headerContainer" style="
                        background-color: #00b8ff;
                        padding-right: 30px;
                        padding-left: 30px;
                        mso-line-height-rule: exactly;
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                      ">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                          border-collapse: collapse;
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          -ms-text-size-adjust: 100%;
                          -webkit-text-size-adjust: 100%;
                        ">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="
                                mso-line-height-rule: exactly;
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                              ">
                            <!--[if gte mso 9]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="640">
<tr>
<td align="center" valign="top" width="640">
<![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                                  max-width: 640px;
                                  border-collapse: collapse;
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                " class="emailContainer">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" style="
                                        mso-line-height-rule: exactly;
                                        -ms-text-size-adjust: 100%;
                                        -webkit-text-size-adjust: 100%;
                                      ">
                                    <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                                      width="100%" id="headerTable" style="
                                          background-color: #ffffff;
                                          border-collapse: separate;
                                          border-top-left-radius: 5px;
                                          border-top-right-radius: 5px;
                                          mso-table-lspace: 0pt;
                                          mso-table-rspace: 0pt;
                                          -ms-text-size-adjust: 100%;
                                          -webkit-text-size-adjust: 100%;
                                        ">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" width="100%" style="
                                                padding-top: 40px;
                                                padding-bottom: 0;
                                                mso-line-height-rule: exactly;
                                                -ms-text-size-adjust: 100%;
                                                -webkit-text-size-adjust: 100%;
                                              "></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!--[if gte mso 9]>
</td>
</tr>
</table>
<![endif]-->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" valign="top" id="templateBody" bgcolor="#ffffff" style="
                        background-color: #ffffff;
                        mso-line-height-rule: exactly;
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                      ">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                          border-collapse: collapse;
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          -ms-text-size-adjust: 100%;
                          -webkit-text-size-adjust: 100%;
                        ">
                      <tbody>
                        <tr>
                          <td align="center" valign="top" style="
                                mso-line-height-rule: exactly;
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                              ">
                            <!--[if gte mso 9]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="700">
<tr>
<td align="center" valign="top" width="700">
<![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                                  max-width: 700px;
                                  border-collapse: collapse;
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                " class="emailContainer">
                              <tbody>
                                <tr>
                                  <td valign="top" width="100%" style="
                                        padding-right: 70px;
                                        padding-left: 70px;
                                        padding-bottom: 20px;
                                        mso-line-height-rule: exactly;
                                        -ms-text-size-adjust: 100%;
                                        -webkit-text-size-adjust: 100%;
                                      " id="bodyContainer">
                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                                          border-collapse: collapse;
                                          mso-table-lspace: 0pt;
                                          mso-table-rspace: 0pt;
                                          -ms-text-size-adjust: 100%;
                                          -webkit-text-size-adjust: 100%;
                                        ">
                                      <tbody>
                                        <tr>
                                          <td id="emailcontent" align="left" valign="top" style="
                                                color: #737373;
                                                font-family: Helvetica, Arial,
                                                  sans-serif;
                                                font-size: 13px;
                                                font-weight: 400;
                                                line-height: 16px;
                                                padding: 10px;
                                                margin: 0;
                                                text-align: left;
                                                mso-line-height-rule: exactly;
                                                -ms-text-size-adjust: 100%;
                                                -webkit-text-size-adjust: 100%;
                                              ">
                                            <!-- Here Goes Content: Start -->
                                            <p style="
                                                  margin: 10px 0;
                                                  padding: 0;
                                                  mso-line-height-rule: exactly;
                                                  -ms-text-size-adjust: 100%;
                                                  -webkit-text-size-adjust: 100%;
                                                ">
                                              Đơn đặt hàng của bạn đã được
                                              tiếp nhận và hiện đang được xử
                                              lý. Chi tiết đơn hàng của bạn
                                              được hiển thị bên dưới để bạn
                                              tham khảo:
                                            </p>

                                            <h2 style="
                                                  color: #00b8ff;
                                                  display: block;
                                                  font-family: 'Open Sans',
                                                    'Helvetica Neue', Helvetica,
                                                    Arial, sans-serif;
                                                  font-size: 16px;
                                                  font-weight: bold;
                                                  line-height: 130%;
                                                  margin: 0 0 10px;
                                                  text-align: left;
                                                ">
                                              Order #<strong><?php echo $result['id'] ?></strong>
                                              (<?php echo $result['published'] ?>)
                                            </h2>

                                            <div style="margin-bottom: 40px">
                                              <table class="td" cellspacing="0" cellpadding="6" style="
                                                    width: 100%;
                                                    font-family: 'Helvetica Neue',
                                                      Helvetica, Roboto, Arial,
                                                      sans-serif;
                                                    border-collapse: collapse;
                                                    mso-table-lspace: 0pt;
                                                    mso-table-rspace: 0pt;
                                                    -ms-text-size-adjust: 100%;
                                                    -webkit-text-size-adjust: 100%;
                                                    color: #8f8f8f;
                                                    vertical-align: middle;
                                                  ">
                                                <thead>
                                                  <tr>
                                                    <th class="td" scope="col" style="
                                                          text-align: left;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                        ">
                                                      Product
                                                    </th>
                                                    <th class="td" scope="col" style="
                                                          text-align: left;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                        ">
                                                      Quantity
                                                    </th>
                                                    <th class="td" scope="col" style="
                                                          text-align: left;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                        ">
                                                      Price
                                                    </th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php echo order_item(); ?>
                                                </tbody>
                                                <tfoot style="
                                                      background-color: #fafafa;
                                                    ">
                                                  <tr>
                                                    <th class="td" scope="row" colspan="2" style="
                                                          text-align: right;
                                                          border-top-width: 0px;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      Tạm tính:
                                                    </th>
                                                    <td class="td" style="
                                                          text-align: left;
                                                          border-top-width: 0px;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      <strong><span><?php echo number_format($result['subTotal'], 0, ',', '.'); ?></span>
                                                        <sup>đ</sup></strong>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <th class="td" scope="row" colspan="2" style="
                                                          text-align: right;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      Phí vận chuyển:
                                                    </th>
                                                    <td class="td" style="
                                                          text-align: left;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      <strong>
                                                        <span>0 </span>
                                                        <sup>đ</sup>
                                                      </strong>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <th class="td" scope="row" colspan="2" style="
                                                          text-align: right;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      Tổng:
                                                    </th>
                                                    <td class="td" style="
                                                          text-align: left;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          vertical-align: middle;
                                                          padding-top: 8px !important;
                                                          padding-bottom: 8px !important;
                                                        ">
                                                      <strong><span><?php echo number_format($result['total'], 0, ',', '.'); ?></span>
                                                        <sup>đ</sup></strong>
                                                    </td>
                                                  </tr>

                                                </tfoot>
                                              </table>
                                            </div>

                                            <table id="addresses" cellspacing="0" cellpadding="0" style="
                                                  width: 100%;
                                                  vertical-align: top;
                                                  margin-bottom: 40px;
                                                  padding: 0;
                                                  border-collapse: collapse;
                                                  mso-table-lspace: 0pt;
                                                  mso-table-rspace: 0pt;
                                                  -ms-text-size-adjust: 100%;
                                                  -webkit-text-size-adjust: 100%;
                                                " border="0">
                                              <tr>
                                                <td style="
                                                      text-align: left;
                                                      font-family: 'Helvetica Neue',
                                                        Helvetica, Roboto, Arial,
                                                        sans-serif;
                                                      border: 0;
                                                      padding: 0;
                                                      mso-line-height-rule: exactly;
                                                      -ms-text-size-adjust: 100%;
                                                      -webkit-text-size-adjust: 100%;
                                                    " valign="top" width="50%">
                                                  <h2 style="
                                                        color: #00b8ff;
                                                        display: block;
                                                        font-family: 'Open Sans',
                                                          'Helvetica Neue',
                                                          Helvetica, Arial,
                                                          sans-serif;
                                                        font-size: 16px;
                                                        font-weight: bold;
                                                        line-height: 130%;
                                                        margin: 0 0 10px;
                                                        text-align: left;
                                                      ">
                                                    THÔNG TIN THANH TOÁN
                                                  </h2>
                                                  <p><strong>Họ và tên:</strong> <?php echo $result['fullName'] ?></p>
                                                  <p><strong>Số điện thoại:</strong> <?php echo $result['mobile'] ?></p>
                                                  <p><strong>Email:</strong> <?php echo $result['email'] ?></p>
                                                  <p><strong>Địa chỉ:</strong> <?php echo $result['address'] ?></p>
                                                  <p><strong>Phương thức thanh toán:</strong>
                                                    <?php echo $transaction; ?>
                                                  </p>
                                                </td>
                                              </tr>
                                            </table>

                                            <!-- Here Goes Content: End -->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!--[if gte mso 9]>
</td>
</tr>
</table>
<![endif]-->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="center" valign="top" id="templateFooter" style="
                        padding-right: 30px;
                        padding-left: 30px;
                        mso-line-height-rule: exactly;
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                      ">
                    <!--[if gte mso 9]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="640">
<tr>
<td align="center" valign="top" width="640">
<![endif]-->
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="
                          max-width: 640px;
                          border-collapse: collapse;
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          -ms-text-size-adjust: 100%;
                          -webkit-text-size-adjust: 100%;
                        " class="emailContainer">
                      <tbody>
                        <tr>
                          <td id="footerContent" valign="top" style="
                                border-top-width: 2px;
                                border-top-color: #f2f2f2;
                                border-top-style: solid;
                                color: #b7b7b7;
                                font-family: Helvetica, Arial, sans-serif;
                                font-size: 12px;
                                font-weight: 400;
                                line-height: 24px;
                                padding-top: 40px;
                                padding-bottom: 20px;
                                text-align: center;
                                mso-line-height-rule: exactly;
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                              ">
                            <p style="
                                  color: #b7b7b7;
                                  font-family: Helvetica, Arial, sans-serif;
                                  font-size: 12px;
                                  font-weight: 400;
                                  line-height: 24px;
                                  padding: 0;
                                  margin: 0;
                                  text-align: center;
                                  mso-line-height-rule: exactly;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                ">
                              725 First Avenue, Sunnyvale, CA 94089 USA
                            </p>
                            <a href="https://themes.email/magento.html" target="_blank" style="
                                  color: #b7b7b7 !important;
                                  text-decoration: underline;
                                  font-weight: normal;
                                  mso-line-height-rule: exactly;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                " class="utilityLink">Magento</a>
                            <span class="mobileHide"> • </span>
                            <a href="https://themes.email/prestashop.html" target="_blank" style="
                                  color: #b7b7b7 !important;
                                  text-decoration: underline;
                                  font-weight: normal;
                                  mso-line-height-rule: exactly;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                " class="utilityLink">Prestashop</a>
                            <span class="mobileHide"> • </span>
                            <a href="https://themes.email/woocommerce.html" target="_blank" style="
                                  color: #b7b7b7 !important;
                                  text-decoration: underline;
                                  font-weight: normal;
                                  mso-line-height-rule: exactly;
                                  -ms-text-size-adjust: 100%;
                                  -webkit-text-size-adjust: 100%;
                                " class="utilityLink">WooCommerce</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--[if gte mso 9]>
</td>
</tr>
</table>
<![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </center>
</body>

</html>