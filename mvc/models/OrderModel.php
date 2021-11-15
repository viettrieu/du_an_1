<?php
class OrderModel extends DB
{
    public $table = "detailed_order";
    public function GetAllOrder()
    {
        $sql = "SELECT detailed_order.id, avatar, detailed_order.fullName, username, detailed_order.mobile, detailed_order.email, DATE_FORMAT(published, '%e/%c/%Y') AS'published', detailed_order.status, order_status.status AS 'textStatus', total FROM detailed_order LEFT JOIN ps_users on detailed_order.userId = ps_users.id INNER JOIN order_status on detailed_order.status = order_status.id";
        return $this->pdo_query($sql);
    }
    public function GetOrderById($id)
    {
        $sql = "SELECT * FROM detailed_order WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetOrderItemById($id)
    {
        $sql = "SELECT book.title, order_item.price, order_item.quantity FROM order_item  INNER JOIN book ON productId = book.id WHERE orderId = $id";
        return $this->pdo_query($sql);
    }
    public function GetOrderByUser($id)
    {
        $sql = "SELECT detailed_order.id, detailed_order.status, detailed_order.userId, DATE_FORMAT(detailed_order.published, '%e/%c/%Y') AS 'published', detailed_order.total,detailed_order.status, order_status.status AS 'textStatus' from detailed_order INNER JOIN order_status on detailed_order.status = order_status.id WHERE detailed_order.userId = '$id' ORDER BY detailed_order.id DESC";
        return $this->pdo_query($sql);
    }
    public function GetOrderStatus($cond = 1)
    {
        $sql = "SELECT * FROM order_status WHERE $cond";
        return $this->pdo_query($sql);
    }

    public function InsertOrder($data)
    {
        return $this->insert("detailed_order", $data);
    }
    public function InsertOrderItem($data)
    {
        return $this->insert("order_item", $data);
    }
    public function UpdateOrderBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}