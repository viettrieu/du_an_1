<?php

use Core\GiaoHangTietKiem;
use Core\Address;

class Transport extends Controller
{
  public $Order;
  public $Transport;
  function __construct()
  {
    $this->Order = $this->model("OrderModel");
    $this->Transport = $this->model("TransportModel");
  }
  function SayHi()
  {
  }
  function Province()
  {
    echo json_encode(Address::Province());
  }
  function District($_province_id = 79)
  {
    echo json_encode(Address::District($_province_id));
  }
  function Ward($_district_id = 760)
  {
    echo json_encode(Address::Ward($_district_id));
  }


  function shipmentFee()
  {
    $province = $_POST['province'];
    $district = $_POST['district'];
    $weight  = $_SESSION['cart']['weight'];
    $subTotal  = $_SESSION['cart']['subTotal'];
    $data = array(
      "pick_address_id" => "2500809",
      "pick_province" =>  "TP. Hồ Chí Minh",
      "pick_district" =>  "Thành phố Thủ Đức",
      "province" => $province,
      "district" => $district,
      "weight" => $weight,
      "value" => $subTotal,
      "deliver_option" => "none",
    );
    $transports = ["road", "fly"];
    $shipment = [];
    foreach ($transports as $key => $transport) {
      $data["transport"] = $transport;
      $ship = GiaoHangTietKiem::shipmentFee($data);
      $ship = json_decode($ship, true);
      if ($ship['success']) {
        if (isset($shipment[0]) && $shipment[0]['fee'] == $ship['fee']['ship_fee_only']) {
          break;
        }
        $shipment[$key] = array(
          "fee" => $ship['fee']['ship_fee_only'],
          "transport" => $transport,
          "text" => $transport == "fly" ?  "Nhanh" : "Tiêu chuẩn",
        );
      }
    }
    $_SESSION['cart']['shipment'] = $shipment[0];
    $_SESSION['shipment'] = $shipment;
    echo json_encode($shipment);
    exit();
  }
  function Fee()
  {
    $transport = $_POST['transport'];
    $index = array_search($transport, array_column($_SESSION['shipment'], 'transport'));
    $_SESSION['cart']['shipment'] = $_SESSION['shipment'][$index];
    echo json_encode($_SESSION['cart']['shipment']);
  }


  function createShipmentOrder($IdOrder)
  {
    extract($this->Order->GetOrderById($IdOrder));
    $products = $this->Order->GetOrderItemById($IdOrder);
    extract($this->listPick());
    extract($this->Transport->GetId($IdOrder));
    $products = array_map(function ($product) {
      return array(
        'name' => $product['title'],
        'weight' => 0.2,
        'quantity' => (int)$product['quantity'],
        'price' => (int)$product['price'],
      );
    }, $products);
    $products = json_encode($products);
    $order = <<<HTTP_BODY
{
    "products": $products,
    "order": {
        "id": "$IdOrder",
        "pick_address_id": "$pick_address_id",
        "pick_name": "$pick_name",
        "pick_address": "306/9 Võ Văn Hát",
        "pick_province": "TP. Hồ Chí Minh",
        "pick_district": "Thành phố Thủ Đức",
        "pick_tel": "$pick_tel",
        "tel": "$mobile",
        "name": "$fullName",
        "address": "$address",
        "province": "$province",
        "district": "$district",
        "ward": "$ward",
        "hamlet": "$address",
        "is_freeship": "1",
        "pick_money": $total ,
        "note": "$content",
        "value": $total,
        "transport": "road",
        "pick_option":"cod",
        "deliver_option" : "none",
        "tags": []
    }
}
HTTP_BODY;

    echo GiaoHangTietKiem::createShipmentOrder($order);
  }

  function cancelOrder($IdOrder)
  {
    echo (GiaoHangTietKiem::cancelOrder("partner_id:" . $IdOrder));
  }
  function listPick()
  {
    $listPick = json_decode(GiaoHangTietKiem::listPick(), true);
    return $listPick['data'][0];
  }
  function shipmentOrder($IdOrder)
  {
    echo GiaoHangTietKiem::shipmentOrder($IdOrder);
  }
}