<?php
class StatisticalModel extends DB
{
  public function SumOrderByStatus($cond = 1)
  {
    $sql = "SELECT order_status.id, order_status.status, SUM(total) AS 'total' FROM  detailed_order RIGHT JOIN order_status ON detailed_order.status = order_status.id WHERE $cond GROUP BY status ORDER BY order_status.id ASC";
    return $this->pdo_query($sql);
  }
  public function GetHotProduct($cond, $sd, $ed, $limit = 6)
  {
    $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, detailed_order.published,COUNT(orderi.quantity) AS 'quantity'  FROM book INNER JOIN order_item orderi  ON book.id = orderi.productId INNER JOIN detailed_order ON detailed_order.id = orderi.orderId WHERE book.id IN (SELECT book_category.productId FROM book_category WHERE $cond) AND
    detailed_order.published between '$sd' and '$ed' GROUP BY book.id ORDER BY quantity DESC LIMIT $limit";
    return $this->pdo_query($sql);
  }
  public function GetWishlistProduct($cond, $limit = 6)
  {
    $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, COUNT(wl.productId) AS 'quantity'  FROM book INNER JOIN wishlist wl  ON book.id = wl.productId WHERE book.id IN (SELECT book_category.productId FROM book_category WHERE $cond) GROUP BY book.id ORDER BY quantity DESC LIMIT $limit";
    return $this->pdo_query($sql);
  }
  public function cc()
  {
    $sql = "SELECT title,  COUNT(O.productId) FROM order_item O INNER JOIN book_category BC ON BC.productId = O.productId INNER JOIN category C ON categoryId = C.id  GROUP BY categoryId";
  }
  public function count($table, $cond = 1)
  {
    $sql = "SELECT count(*) FROM $table WHERE $cond";
    return $this->pdo_query_value($sql);
  }
}