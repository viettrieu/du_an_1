<?php

namespace Core;

class GiaoHangTietKiem
{
  /*
     * Host giao hang tiet kiem
     */
  private static $host = 'https://services.giaohangtietkiem.vn';

  /*
     * Token
     */
  private static $token = 'A66178443972ACaDD61fa6473EAc0EdC8e1312Ad';


  /*
     * Tính phí vận chuyển
     * @param : data
     * https://docs.giaohangtietkiem.vn/?php#t-nh-ph-v-n-chuy-n
     */
  public static function shipmentFee($data)
  {
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => self::$host . "/services/shipment/fee?" . http_build_query($data),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
        "Token: " . self::$token,
      ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  /*
     * Trạng thái đơn hàng
     * @param : order_no
     * https://docs.giaohangtietkiem.vn/?php#tr-ng-th-i-n-h-ng
     */
  public static function shipmentOrder($order_no)
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => self::$host . "/services/shipment/v2/" . $order_no,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
        "Token: " . self::$token,
      ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  /*
     * Đăng đơn hàng
     * @param : order
     * https://docs.giaohangtietkiem.vn/?php#ng-n-h-ng
     */
  public static function createShipmentOrder($order)
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => self::$host . "/services/shipment/order",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $order,
      CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Token: " . self::$token,
        "Content-Length: " . strlen($order),
      ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  /*
     * Hủy đơn hàng
     * https://docs.giaohangtietkiem.vn/?php#h-y-n-h-ng
     */
  public static function cancelOrder($order_no)
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => self::$host . "/services/shipment/cancel/" . $order_no,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
        "Token: " . self::$token,
      ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  /*
     * In đơn hàng
     * https://docs.giaohangtietkiem.vn/?php#in-nh-n-n-h-ng
     */
  public static function printOrder($order_no)
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => self::$host . "/services/label/" . $order_no,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
        "Token: " . self::$token,
      ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    // header("Content-Disposition:attachment;filename=" . $order_no . ".pdf");
    echo $response;
  }
  public static function listPick()
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => self::$host . "/services/shipment/list_pick_add",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(
        "Token: " . self::$token,
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  function listStatus()
  {
    $listStatus = array(
      '-1' => 'Hủy đơn hàng',
      '1' => 'Chưa tiếp nhận',
      '2' => 'Đã tiếp nhận',
      '3' => 'Đã lấy hàng/Đã nhập kho',
      '4' => 'Đã điều phối giao hàng/Đang giao hàng',
      '5' => 'Đã giao hàng/Chưa đối soát',
      '6' => 'Đã đối soát',
      '7' => 'Không lấy được hàng',
      '8' => 'Hoãn lấy hàng',
      '9' => 'Không giao được hàng',
      '10' => 'Delay giao hàng',
      '11' => 'Đã đối soát công nợ trả hàng',
      '12' => 'Đã điều phối lấy hàng/Đang lấy hàng',
      '13' => 'Đơn hàng bồi hoàn',
      '20' => 'Đang trả hàng (COD cầm hàng đi trả)',
      '21' => 'Đã trả hàng (COD đã trả xong hàng)',
      '123' => 'Shipper báo đã lấy hàng',
      '127' => 'Shipper (nhân viên lấy/giao hàng) báo không lấy được hàng',
      '128' => 'Shipper báo delay lấy hàng',
      '45' => 'Shipper báo đã giao hàng',
      '49' => 'Shipper báo không giao được giao hàng',
      '410' => 'Shipper báo delay giao hàng',
    );
    return $listStatus;
  }
}