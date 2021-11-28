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
    $pick_money = $status == 3 ? 0 : $total;
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
        "pick_money": $pick_money,
        "note": "$content",
        "value": $total,
        "transport": "$method",
        "pick_option": "cod",
        "deliver_option" : "none",
        "tags": []
    }
}
HTTP_BODY;
    $result = json_decode(GiaoHangTietKiem::createShipmentOrder($order), true);
    if ($result["success"]) {
      $this->Order->UpdateOrderBy(["status" => 4], "id = " . (int)$orderId);
      $this->Transport->updateTransport(["tracking_id" => $result["order"]["tracking_id"]], "orderId = $orderId");
    }
    $result["message"] = "Đơn hàng $orderId của bạn đã được gửi lên hệ thống GHTK";
    echo json_encode($result);
  }

  function cancelOrder($orderId)
  {
    $result = json_decode(GiaoHangTietKiem::cancelOrder("partner_id:" . $orderId), true);
    if ($result["success"]) {
      $this->Order->UpdateOrderBy(["status" => 6], "id = " . (int)$orderId);
      $this->Transport->updateTransport(["status" => -1], "orderId = " . (int)$orderId);
    }
    echo json_encode($result);
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