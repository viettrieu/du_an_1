<?php
class AddressModel extends DB
{
  public function GetAllProvince()
  {
    $sql = "SELECT * FROM province";
    return $this->pdo_query($sql);
  }
  public function GetDistrict($_province_id = 1)
  {
    $sql = "SELECT * FROM district WHERE _province_id = $_province_id";
    return $this->pdo_query($sql);
  }
  public function GetWard($_district_id = 1)
  {
    $sql = "SELECT * FROM ward WHERE _district_id = $_district_id";
    return $this->pdo_query($sql);
  }
}