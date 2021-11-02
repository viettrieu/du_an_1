<?php
include_once '../config.php';
function order_item()
{
  global $conn, $last_id;
  $sql = "SELECT thumbnail, title , price, ps_order_item.quantity as 'quantity', price * ps_order_item.quantity as 'total' FROM ps_order_item INNER JOIN ps_product ON productId = ps_product.id WHERE orderId = $last_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr class="order_item">
  <td class="td" style="
                                                          text-align: left;
                                                          vertical-align: middle;
                                                          font-family: 'Helvetica Neue',
                                                            Helvetica, Roboto,
                                                            Arial, sans-serif;
                                                          word-wrap: break-word;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                          font-weight: bold;
                                                        ">
    <img width="64" height="64" src="https://wpfoal.com/<?php echo $row['thumbnail']; ?>" class="
                                                            attachment-64x64
                                                            size-64x64
                                                            wp-post-image
                                                          " alt="" style="
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
                                                          " data-pagespeed-url-hash="2075197049"
      onload="pagespeed.CriticalImages.checkImageForCriticality(this);" /><?php echo $row['title']; ?>
  </td>
  <td class="td" style="
                                                          text-align: left;
                                                          vertical-align: middle;
                                                          font-family: 'Helvetica Neue',
                                                            Helvetica, Roboto,
                                                            Arial, sans-serif;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                        ">
    <?php echo $row['quantity']; ?>
  </td>
  <td class="td" style="
                                                          text-align: left;
                                                          vertical-align: middle;
                                                          font-family: 'Helvetica Neue',
                                                            Helvetica, Roboto,
                                                            Arial, sans-serif;
                                                          mso-line-height-rule: exactly;
                                                          -ms-text-size-adjust: 100%;
                                                          -webkit-text-size-adjust: 100%;
                                                          color: #8f8f8f;
                                                          border-bottom: 2px
                                                            solid #f2f2f2;
                                                        ">
    <span class="price">
      <span class="unit-price"> <?php echo number_format($row['total'], 0, ',', '.'); ?></span>
      <sup>đ</sup>
    </span>
  </td>
</tr>

<?php }
  }
}


function ssss()
{
  global $conn;
}