<?php
define('DB_HOST', 'ps17048.com:3366');
define('DB_SCHEMA', 'ps17048');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT ps_users.id, ps_users.username  FROM ps_users WHERE (username='$username' OR email='$username' OR mobile='$username')LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $displayname = $user['username'];
        $userID = $user['id'];
    }
}


function productList($name = 0, $id = 0, $offset, $perPage)
{
    global $conn;
    $sql = "SELECT product.id, product.title, product.thumbnail, product.price, X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id ";
    if ($id != 0) {
        if ($name == 'tag') {
            $sql .= "INNER JOIN product_tag tag ON tagId = $id AND product.id = tag.productId";
        }
        if ($name == 'category') {
            $sql .= "INNER JOIN product_category category ON categoryId = $id AND product.id = category.productId";
        }
        if ($name == 'search') {
            $sql .= "WHERE (title LIKE '%$id%' OR summary LIKE '%$id%')";
        }
    }
    $sql .= " LIMIT $offset, $perPage";
    $productList = $conn->query($sql);
    return $productList;
}
function totalProduct($name, $id)
{
    global $conn;
    $sql = "SELECT count(*) AS 'count' FROM ps_product ";
    if ($id != 0) {
        if ($name == 'tag' && $name != 0) {
            $sql .= "INNER JOIN product_tag ON tagId = $id AND id = productId";
        }
        if ($name == 'category') {
            $sql .= "INNER JOIN product_category ON categoryId = $id AND id = productId";
        }
        if ($name == 'search') {
            $sql .= "WHERE (title LIKE '%$id%' OR summary LIKE '%$id%')";
        }
    }
    $totalProduct = $conn->query($sql)->fetch_assoc();
    return $totalProduct['count'];
}

function taoLinkPhanTrang($base_url, $totalPost, $page, $perPage)
{
    if ($page <= 0) return "";
    $totalPages = ceil($totalPost / $perPage);
    if ($totalPages <= 1) return "";
    $links = "<nav class='pagination'><ul class='page-numbers nav-pagination links text-center'>";
    if ($page > 1) {
        $first = "<li><a class='page-number' href='{$base_url}&page=1'> << </a></li>";
        $page_prev = $page - 1;
        $prev = "<li><a class='page-number' href='{$base_url}&page={$page_prev}'> < </a></li>";
        $links .= $first . $prev;
    }
    $from = $page - 3;
    $to = $page + 3;
    if ($from < 1) $from  = 1;
    if ($to > $totalPages) $to  = $totalPages;
    for ($i = $from; $i <= $to; $i++) {
        if ($i == $page) {
            $str = "<li><span class='page-number current'>{$i}<span></li>";
        } else {
            $str = "<li><a class='page-number' href='{$base_url}&page={$i}'> {$i} </a></li>";
        }
        $links .= $str;
    }
    if ($page < $totalPages) {
        $page_next = $page + 1;
        $next = "<li><a class='page-number' href='{$base_url}&page={$page_next}'> > </a></li>";
        $last = "<li><a class='page-number' href='{$base_url}&page={$totalPages}'> >> </a></li>";
        $links .= $next . $last;
    }

    $links .= "</ul> </nav>";
    return $links;
}