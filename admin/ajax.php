<?php include_once('./config.php');
if (isset($_POST['action'])) {
  if ($_POST['action'] == "create_product") {
    $title = $conn->real_escape_string($_POST['title']);
    $price = $conn->real_escape_string($_POST['price']);
    $summary = $conn->real_escape_string($_POST['summary']);
    $summary =  $summary == '<p><br></p>' ? NULL : $summary;
    $discount = $conn->real_escape_string($_POST['discount']);
    $content = $conn->real_escape_string($_POST['content']);
    $content =  $content == '<p><br></p>' ? NULL : $content;
    $sku = $conn->real_escape_string($_POST['sku']);
    if (isset($_FILES["thumbnail"]) && !empty($_FILES["thumbnail"]['name'])) {
      move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../assets/img/' . basename($_FILES['thumbnail']['name']));
      $thumbnail = './assets/img/' . basename($_FILES['thumbnail']['name']);
    } else {
      $thumbnail = './assets/img/default-product-image.png';
    }
    $query = "INSERT INTO ps_product( thumbnail, title, price, discount, sku, summary, content) VALUES
    ('$thumbnail','$title', '$price', '$discount', '$sku', '$summary', '$content')";
    $conn->query($query);
    $last_id = $conn->insert_id;
    if (isset($_POST['tag'])) {
      $tag = $_POST['tag'];
      $query = "INSERT INTO ps_tag (title) VALUES ";
      $query_parts = array();
      for ($x = 0; $x < count($tag); $x++) {
        $query_parts[] = "('" . trim($tag[$x]) . "')";
      }
      $query .= implode(',', $query_parts);
      $query .= " ON DUPLICATE KEY UPDATE title = VALUES (title)";
      $conn->query($query);
      $in = '(' . implode(',', $query_parts) . ')';
      $query = "INSERT INTO product_tag (productId, tagId) SELECT $last_id, id FROM ps_tag WHERE title IN " . $in;
      $conn->query($query);
    }
    if (isset($_POST['category'])) {
      $category = $_POST['category'];
      $query = "INSERT INTO ps_category (title) VALUES ";
      $query_parts = array();
      for ($x = 0; $x < count($category); $x++) {
        $query_parts[] = "('" . trim($category[$x]) . "')";
      }
      $query .= implode(',', $query_parts);
      $query .= " ON DUPLICATE KEY UPDATE title = VALUES (title)";
      $conn->query($query);
      $in = '(' . implode(',', $query_parts) . ')';
      $query = "INSERT INTO product_category (productId, categoryId) SELECT $last_id, id FROM ps_category WHERE title IN " . $in;
      $conn->query($query);
    }
    echo json_encode([$last_id, $title]);
  }
  if ($_POST['action'] == "edit_product") {
    $id = $conn->real_escape_string($_POST['id']);
    $title = $conn->real_escape_string($_POST['title']);
    $price = $conn->real_escape_string($_POST['price']);
    // $category = $conn->real_escape_string($_POST['category']);
    $summary = $conn->real_escape_string($_POST['summary']);
    $summary =  $summary == '<p><br></p>' ? NULL : $summary;
    $discount = $conn->real_escape_string($_POST['discount']);
    $content = $conn->real_escape_string($_POST['content']);
    $content =  $content == '<p><br></p>' ? NULL : $content;
    $sku = $conn->real_escape_string($_POST['sku']);
    if (isset($_FILES["thumbnail"]) && !empty($_FILES["thumbnail"]['name'])) {
      move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../assets/img/' . basename($_FILES['thumbnail']['name']));
      $thumbnail = './assets/img/' . basename($_FILES['thumbnail']['name']);
      $query = "UPDATE ps_product SET thumbnail = '$thumbnail' WHERE id = $id";
      $conn->query($query);
    }
    $query = "UPDATE ps_product SET title = '$title', summary = '$summary', sku = '$sku', price = '$price', discount = '$price', content = '$content' WHERE id = $id";
    $conn->query($query);
    $query = "DELETE FROM product_tag WHERE productId = $id";
    $conn->query($query);
    if (isset($_POST['tag'])) {
      $tag = $_POST['tag'];
      $query = "INSERT INTO ps_tag (title) VALUES ";
      $query_parts = array();
      for ($x = 0; $x < count($tag); $x++) {
        $query_parts[] = "('" . trim($tag[$x]) . "')";
      }
      $query .= implode(',', $query_parts);
      $query .= " ON DUPLICATE KEY UPDATE title = VALUES (title)";
      $conn->query($query);
      $in = '(' . implode(',', $query_parts) . ')';
      $query = "INSERT INTO product_tag (productId, tagId) SELECT $id, id FROM ps_tag WHERE title IN " . $in;
      $conn->query($query);
    }
    $query = "DELETE FROM product_category WHERE productId = $id";
    $conn->query($query);
    if (isset($_POST['category'])) {
      $category = $_POST['category'];
      $query = "INSERT INTO ps_category (title) VALUES ";
      $query_parts = array();
      for ($x = 0; $x < count($category); $x++) {
        $query_parts[] = "('" . trim($category[$x]) . "')";
      }
      $query .= implode(',', $query_parts);
      $query .= " ON DUPLICATE KEY UPDATE title = VALUES (title)";
      $conn->query($query);
      $in = '(' . implode(',', $query_parts) . ')';

      $query = "INSERT INTO product_category (productId, categoryId) SELECT $id, id FROM ps_category WHERE title IN " . $in;
      $conn->query($query);
    }
    echo json_encode([$id, $title]);
  }
  if ($_POST['action'] == "delete_product") {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM ps_product WHERE id = $id";
    $conn->query($query);
    echo json_encode('Thành công');
  }
  if ($_POST['action'] == "delete_user") {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM ps_users WHERE id = $id";
    $conn->query($query);
    echo json_encode('Thành công');
  }
  if ($_POST['action'] == "update_status_order") {
    $idOrder = $conn->real_escape_string($_POST['idOrder']);
    $idStatus = $conn->real_escape_string($_POST['idStatus']);
    $query = "UPDATE ps_order SET status = $idStatus WHERE id = $idOrder";
    $conn->query($query);
    echo json_encode('Thành công');
  }

  if ($_POST['action'] == "delete_category") {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM ps_category WHERE id = $id";
    $conn->query($query);
    echo json_encode('Thành công');
  }
  if ($_POST['action'] == "delete_tag") {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM ps_tag WHERE id = $id";
    $conn->query($query);
    echo json_encode('Thành công');
  }
  if ($_POST['action'] == "delete_review") {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM ps_product_review WHERE id = $id";
    $conn->query($query);
    echo json_encode('Thành công');
  }
  if ($_POST['action'] == "accept_review") {
    $idReview = $conn->real_escape_string($_POST['idReview']);
    $query = "UPDATE ps_product_review SET status = 1 WHERE id = $idReview";
    $conn->query($query);
    echo json_encode('Thành công');
  }
}