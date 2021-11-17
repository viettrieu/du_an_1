<?php
class WishlistModel extends DB
{
  public $table = "wishlist";

  public function allBy($table, $cond = '')
    {
        $condQuery = '';

        if (!empty($cond)) {
            if (is_array($cond)) {
                $condQuery = 'WHERE ' . implode('=', $cond);
            } else {
                $condQuery = 'WHERE ' . $cond;
            }
        }

        $sql = "SELECT * FROM $table $condQuery";
        return $this->pdo_query($sql);
    }

    public function firstBy($table, $cond = '')
    {
        $condQuery = '';

        if (!empty($cond)) {
            if (is_array($cond)) {
                $condQuery = 'WHERE ' . implode('=', $cond);
            } else {
                $condQuery = 'WHERE ' . $cond;
            }
        }

        $sql = "SELECT * FROM $table $condQuery";
        return $this->pdo_query_one($sql);
    }
}