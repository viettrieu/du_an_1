<?php
include_once('./config.php');
$stats = array();

// $query =  "SELECT ps_category.id, ps_category.title, DATE_FORMAT(ps_category.published, '%e/%c/%Y') AS'published', COUNT(ps_product.id) AS 'luot' FROM ps_category LEFT JOIN ps_product ON ps_category.id = category GROUP BY ps_category.id";
$query = "SELECT ps_order_status.id, ps_order_status.status, SUM(total) AS 'total' FROM  ps_order RIGHT JOIN ps_order_status ON ps_order.status = ps_order_status.id WHERE NOT ps_order.status BETWEEN 1 AND 4  GROUP BY status ORDER BY ps_order_status.id ASC";
$category = $conn->query($query);
$row_title = array();
$row_luot = array();
while ($row = $category->fetch_assoc()) {
  $row_title[]  = $row['status'];
  $row_luot[]   = (int)$row['total'];
}
$query = "SELECT SUM(total) AS 'total' FROM  ps_order WHERE NOT ps_order.status BETWEEN 5 AND 6";
$category = $conn->query($query)->fetch_assoc();
$row_title[]  = 'Đang xử lý';
$row_luot[]   = (int)$category['total'];
array_push($stats, $row_title);
array_push($stats, $row_luot);
echo json_encode($stats);