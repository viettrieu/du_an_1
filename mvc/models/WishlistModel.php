<?php
class WishlistModel extends DB
{
  private $table = "wishlist";
  public function GetWishlistBy($id)
  {
    $sql = "SELECT book.* FROM wishlist INNER JOIN book ON id = productId WHERE userId = $id";
    return $this->pdo_query($sql);
  }
  public function InsertWishlist($data)
  {
    return $this->insert($this->table, $data);
  }
  public function DeleteWishlist($cond)
  {
    return $this->delete($this->table, $cond);
  }
}