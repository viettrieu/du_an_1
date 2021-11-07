<?php
class StatisticalModel extends DB
{
  public function SumOrderByStatus()
  {
    $sql = "SELECT ps_order_status.id, ps_order_status.status, SUM(total) AS 'total' FROM  ps_order RIGHT JOIN ps_order_status ON ps_order.status = ps_order_status.id  GROUP BY status ORDER BY ps_order_status.id ASC";
    return $this->pdo_query($sql);
  }
  public function count($table)
  {
    $sql = "SELECT count(*) FROM $table";
    return $this->pdo_query_value($sql);
  }
}