<?php
class StatisticalModel extends DB
{
  public function SumOrderByStatus()
  {
    $sql = "SELECT order_status.id, order_status.status, SUM(total) AS 'total' FROM  detailed_order RIGHT JOIN order_status ON detailed_order.status = order_status.id  GROUP BY status ORDER BY order_status.id ASC";
    return $this->pdo_query($sql);
  }
  public function count($table)
  {
    $sql = "SELECT count(*) FROM $table";
    return $this->pdo_query_value($sql);
  }
}
