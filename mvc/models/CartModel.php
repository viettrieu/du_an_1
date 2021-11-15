<?php
class CartModel extends DB
{
    public function addTheCart($productId, $quantity)
    {
        if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
            $_SESSION['cart']['item'][$index]['quantity'] += $quantity;
        } else {
            $query = "SELECT book.id , book.thumbnail , book.title , book.price FROM book WHERE id = $productId";
            $cartItem = $this->pdo_query_one($query);
            $cartItem['quantity'] = $quantity;
            array_push($_SESSION['cart']['item'], $cartItem);
        }
        $listCart = $_SESSION['cart']['item'];
        return $listCart;
    }
    public function removeTheCart($productId)
    {
        if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
            array_splice($_SESSION['cart']['item'], $index, 1);
            $listCart = $_SESSION['cart']['item'];
        }
        echo json_encode($listCart);
        exit();
    }
    function changeQuantity($productId, $quantity)
    {
        if (in_array($productId, array_column($_SESSION['cart']['item'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart']['item'], 'id'));
            $_SESSION['cart']['item'][$index]['quantity'] = $quantity;
            $listCart = $_SESSION['cart']['item'];
        }
        echo json_encode($listCart);
        exit();
    }
}