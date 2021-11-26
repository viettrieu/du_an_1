<?php
class TransportModel extends DB
{
  public $table = "transport";
  public function GetId($id)
  {
    $sql = "SELECT * FROM transport WHERE orderId = $id";
    return $this->pdo_query_one($sql);
  }
  public function insertTransport($data)
  {
    return $this->insert($this->table, $data);
  }
  public function updateTransport($data, $cond)
  {
    return $this->update($this->table, $data, $cond);
  }
}