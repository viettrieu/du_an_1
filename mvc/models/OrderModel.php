<?php
class OrderModel extends DB
{
    public $table = "ps_order";
    public function GetAllOrder()
    {
        $sql = "SELECT ps_order.id, avatar, ps_order.fullName, username, ps_order.mobile, ps_order.email, DATE_FORMAT(published, '%e/%c/%Y') AS'published', ps_order.status, ps_order_status.status AS 'textStatus', total FROM ps_order LEFT JOIN ps_users on ps_order.userId = ps_users.id INNER JOIN ps_order_status on ps_order.status = ps_order_status.id";
        return $this->pdo_query($sql);
    }
    public function GetOrderById($id)
    {
        $sql = "SELECT * FROM ps_order WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetOrderItemById($id)
    {
        $sql = "SELECT ps_product.title, ps_order_item.price, ps_order_item.quantity FROM ps_order_item  INNER JOIN ps_product ON productId = ps_product.id WHERE orderId = $id";
        return $this->pdo_query($sql);
    }
    public function GetOrderByUser($id)
    {
        $sql = "SELECT ps_order.id, ps_order.status, ps_order.userId, DATE_FORMAT(ps_order.published, '%e/%c/%Y') AS 'published', ps_order.total,ps_order.status, ps_order_status.status AS 'textStatus' from ps_order INNER JOIN ps_order_status on ps_order.status = ps_order_status.id WHERE ps_order.userId = '$id' ORDER BY ps_order.id DESC";
        return $this->pdo_query($sql);
    }
    public function GetOrderStatus($cond = 1)
    {
        $sql = "SELECT * FROM ps_order_status WHERE $cond";
        return $this->pdo_query($sql);
    }

    public function InsertOrder($data)
    {
        return $this->insert("ps_order", $data);
    }
    public function InsertOrderItem($data)
    {
        return $this->insert("ps_order_item", $data);
    }
    public function UpdateOrderBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}