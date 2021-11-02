<?php
include_once 'config.php';
if (isset($_POST['action'])) {
  $action = $_POST['action'];
  switch ($action) {
    case  "add_the_cart": {
        addTheCart();
        break;
        exit();
      };
    case  "remove_the_cart": {
        removeTheCart();
        break;
        exit();
      }
    case  "change_uantity": {
        changeQuantity();
        break;
        exit();
      }
    case  "checkout": {
        checkout();
        break;
        exit();
      }
    case  "reviews_product": {
        reviewsPoduct();
        break;
        exit();
      }
    default:
      echo json_encode($action);
  }
}
function addTheCart()
{
  global $conn, $userID;
  $productId = (int)$conn->real_escape_string($_POST['productId']);
  $quantity = (int)$conn->real_escape_string($_POST['quantity']);
  if (isset($userID)) {
    $update = "SELECT * FROM ps_cart_item WHERE (productId='$productId' AND userId= $userID) LIMIT 1";
    $results = $conn->query($update);
    if ($results->num_rows == 1) {
      $cartItem = $results->fetch_assoc();
      $quantity += $cartItem['quantity'];
      $query = "UPDATE ps_cart_item SET quantity = '$quantity' WHERE (productId= $productId AND userId= $userID)";
    } else {
      $query = "INSERT INTO ps_cart_item (productId, quantity, userId)
          VALUES ('$productId','$quantity', '$userID')";
    }
    $conn->query($query);
    $query = "SELECT ps_product.id , ps_product.thumbnail , ps_product.title , ps_product.price , ps_cart_item.quantity  FROM ps_cart_item INNER JOIN ps_product ON ps_product.id = ps_cart_item.productId WHERE userId = $userID";
    $listCart = [];
    $cartItem = $conn->query($query);
    if ($cartItem->num_rows > 0) {
      while ($row = $cartItem->fetch_assoc()) {
        array_push($listCart, $row);
      };
    }
  } else {
    if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
      $_SESSION['cart'][$index]['quantity'] += $quantity;
    } else {
      $query = "SELECT ps_product.id , ps_product.thumbnail , ps_product.title , ps_product.price FROM ps_product WHERE id = $productId";
      $cartItem = $conn->query($query);
      if ($cartItem->num_rows > 0) {
        $row = $cartItem->fetch_assoc();
        $row['quantity'] = $quantity;
        array_push($_SESSION['cart'], $row);
      }
    }
    $listCart = $_SESSION['cart'];
  }
  echo json_encode($listCart);
  exit();
}
function removeTheCart()
{
  global $conn, $userID;
  $productId = (int)$conn->real_escape_string($_POST['productId']);
  if (isset($userID)) {
    $remove = "DELETE FROM ps_cart_item WHERE (productId='$productId' AND userId=$userID) LIMIT 1";
    $conn->query($remove);
    $query = "SELECT ps_product.id , ps_product.thumbnail , ps_product.title , ps_product.price , ps_cart_item.quantity  FROM ps_cart_item INNER JOIN ps_product ON ps_product.id = ps_cart_item.productId WHERE userId = $userID";
    $cartItem = $conn->query($query);
    $listCart = [];
    if ($cartItem->num_rows > 0) {
      $row =  $cartItem->fetch_assoc();
      array_push($listCart, $row);
    }
  } else {
    if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
      array_splice($_SESSION['cart'], $index, 1);
      $listCart = $_SESSION['cart'];
    }
  }
  echo json_encode($listCart);
  exit();
}
function changeQuantity()
{
  global $conn, $userID;
  $productId = (int)$conn->real_escape_string($_POST['productId']);
  $quantity = (int)$conn->real_escape_string($_POST['quantity']);
  if (isset($userID)) {
    $update = "UPDATE ps_cart_item SET quantity='$quantity' WHERE userId = $userID AND productId = $productId";
    $conn->query($update);
    $query = "SELECT ps_product.id , ps_product.thumbnail , ps_product.title , ps_product.price , ps_cart_item.quantity  FROM ps_cart_item INNER JOIN ps_product ON ps_product.id = ps_cart_item.productId WHERE userId = $userID";
    $cartItem = $conn->query($query);
    $listCart = [];
    if ($cartItem->num_rows > 0) {
      while ($row = $cartItem->fetch_assoc()) {
        array_push($listCart, $row);
      }
    }
  } else {
    if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
      $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
      $_SESSION['cart'][$index]['quantity'] = $quantity;
      $listCart = $_SESSION['cart'];
    }
  }
  echo json_encode($listCart);
  exit();
}
function checkout()
{
  global $conn, $userID;
  $fullName = $conn->real_escape_string($_POST['fullName']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $addresss = $conn->real_escape_string($_POST['address']);
  $transaction =  $conn->real_escape_string($_POST['transaction']);
  if (isset($userID)) {
    $query = "SELECT userId, SUM( ps_cart_item.quantity * ps_product.price ) AS 'subTotal' FROM ps_cart_item INNER JOIN ps_product ON ps_product.id = ps_cart_item.productId WHERE userId = $userID GROUP BY userId";
    $subTotal = $conn->query($query);
    if ($subTotal->num_rows > 0) {
      $row = $subTotal->fetch_assoc();
      $ss = $row['subTotal'];
    }
    $update = "INSERT INTO ps_order (userId, fullName, mobile, email, address, subTotal, total, transaction) VALUES ('$userID', '$fullName', '$mobile', '$email', '$addresss', '$ss' , '$ss', '$transaction')";
    if ($conn->query($update) === TRUE) {
      $last_id = $conn->insert_id;
      if ($transaction != 'cod') {
        $query = "UPDATE ps_order SET status = 2 WHERE id = $last_id";
        $conn->query($query);
      }
      $query = "INSERT INTO ps_order_item (orderId, productId, quantity) SELECT $last_id, productId, quantity FROM ps_cart_item WHERE userId = $userID";
      $conn->query($query);
      $query = "DELETE FROM ps_cart_item WHERE userId = $userID";
      $conn->query($query);
    }
  } else {
    $ss = 0;
    foreach ($_SESSION['cart'] as $key => $values) {
      $ss += $_SESSION['cart'][$key]['quantity'] * $_SESSION['cart'][$key]['price'];
    }
    $update = "INSERT INTO ps_order ( fullName, mobile, email, address, subTotal, total, transaction) VALUES ( '$fullName', '$mobile', '$email', '$addresss', '$ss' , '$ss', '$transaction')";
    if ($conn->query($update) === TRUE) {
      $last_id = $conn->insert_id;
      if ($transaction != 'cod') {
        $query = "UPDATE ps_order SET status = 2 WHERE id = $last_id";
        $conn->query($query);
      }
      $query = "INSERT INTO ps_order_item (orderId, productId, quantity) VALUES ";
      $query_parts = array();
      for ($x = 0; $x < count($_SESSION['cart']); $x++) {
        $query_parts[] = "(" . $last_id . ", " . $_SESSION['cart'][$x]['id'] . ", " . $_SESSION['cart'][$x]['quantity'] . ")";
      }
      $query .= implode(',', $query_parts);
      $conn->query($query);
      unset($_SESSION['cart']);
    }
  }
  echo json_encode([$last_id, $ss, $transaction, $fullName, $email]);
  exit();
}

function reviewsPoduct()
{
  global $conn, $userID;
  $productId = (int)$conn->real_escape_string($_POST['productId']);
  $rating = (int)$conn->real_escape_string($_POST['rate']);
  $content = $conn->real_escape_string($_POST['content']);
  $email = $conn->real_escape_string($_POST['email']);
  $fullName = $conn->real_escape_string($_POST['fullName']);
  $reviewsPoduct = array();
  if (isset($userID)) {
    $query = "SELECT avatar FROM ps_users WHERE id= $userID";
    $user = $conn->query($query)->fetch_assoc();
    $avatar = $user['avatar'];
    $query = "INSERT INTO ps_product_review (userId, productId, rating, content, email, fullName) VALUES ('$userID', '$productId', '$rating', '$content', '$email', '$fullName')";
  } else {
    $query = "INSERT INTO ps_product_review (productId, rating, content, email, fullName) VALUES ('$productId', '$rating', '$content', '$email', '$fullName')";
    $avatar = "./assets/img/avatar-default.png";
  }
  if ($conn->query($query)) {
    $content = $_POST['content'];
    $reviewsPoduct = array(
      'avatar' => $avatar,
      'fullName' => $fullName,
      'rating' => $rating,
      'content' => $content,
    );
    echo json_encode($reviewsPoduct);
  } else {
    echo 'Thấp bại';
  }
  exit();
}