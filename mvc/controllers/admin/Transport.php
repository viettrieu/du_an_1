<?php

use Core\GiaoHangTietKiem;

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
  function createShipmentOrder($orderId)
  {
    if (!$this->Order->GetOrderById($orderId)) {
      echo json_encode(['success' => false, 'message' => 'Không tìm thấy đơn hàng']);
      exit();
    }
    extract($this->Order->GetOrderById($orderId));
    $products = $this->Order->GetOrderItemById($orderId);
    extract($this->listPick());
    if (!$this->Transport->GetId($orderId)) {
      echo json_encode(['success' => false, 'message' => 'Đơn hàng thiếu thông tin cần thiết']);
      exit();
    }
    extract($this->Transport->GetId($orderId));
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
        "id": "$orderId",
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
    $result = json_decode(GiaoHangTietKiem::createShipmentOrder($order), true);
    if ($result["success"]) {
      $this->Transport->updateTransport(["label" => $result["order"]["label"]], "orderId = $orderId");
    }
    echo json_encode($result);
  }

  function cancelOrder($orderId)
  {
    echo GiaoHangTietKiem::cancelOrder("partner_id:" . $orderId);
  }
  function listPick()
  {
    $listPick = json_decode(GiaoHangTietKiem::listPick(), true);
    return $listPick['data'][0];
  }
  function printOrder($orderId)
  {
    echo GiaoHangTietKiem::printOrder($orderId);
  }
}