<?php
class CouponModel extends DB
{
    public $table = "discount_code";
    public function GetAllCoupon()
    {
        $sql = "SELECT * FROM discount_code";
        return $this->pdo_query($sql);
    }
    public function GetCoupon($cond)
    {
        $sql = "SELECT * FROM discount_code WHERE $cond";
        return $this->pdo_query_one($sql);
    }
    public function InsertCoupon($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeleteCoupon($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdateCoupon($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}