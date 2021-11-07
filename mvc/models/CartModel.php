<?php
class CartModel extends DB
{
    public function addTheCart($productId, $quantity)
    {
        if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
            $_SESSION['cart'][$index]['quantity'] += $quantity;
        } else {
            $query = "SELECT ps_product.id , ps_product.thumbnail , ps_product.title , ps_product.price FROM ps_product WHERE id = $productId";
            $cartItem = $this->pdo_query($query);
            $cartItem[0]['quantity'] = $quantity;
            $row = $cartItem[0];
            array_push($_SESSION['cart'], $row);
        }
        $listCart = $_SESSION['cart'];
        return $listCart;
    }
    public function removeTheCart($productId)
    {
        if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
            array_splice($_SESSION['cart'], $index, 1);
            $listCart = $_SESSION['cart'];
        }
        echo json_encode($listCart);
        exit();
    }
    function changeQuantity($productId, $quantity)
    {
        if (in_array($productId, array_column($_SESSION['cart'], 'id'))) {
            $index =  array_search($productId, array_column($_SESSION['cart'], 'id'));
            $_SESSION['cart'][$index]['quantity'] = $quantity;
            $listCart = $_SESSION['cart'];
        }
        echo json_encode($listCart);
        exit();
    }
}