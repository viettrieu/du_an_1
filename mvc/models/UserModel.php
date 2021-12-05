<?php
class UserModel extends DB
{
  public $table = "users";

  public function GetAllUser()
  {
    $sql = "SELECT id, admin, username, fullName, mobile, email, avatar, registeredAt ,verify FROM users";
    return $this->pdo_query($sql);
  }
  public function CheckLogin($username, $password)
  {
    $password = md5($password);
    $sql = "SELECT id, username, avatar, fullName, admin, GROUP_CONCAT(productId) as wishlist FROM users LEFT JOIN wishlist ON id = userId WHERE (username='$username' OR email='$username' OR mobile='$username') AND passwordHash='$password' LIMIT 1";
    return $this->pdo_query_one($sql);
  }
  public function GetUserById($username = 0, $email = 0, $mobile = 0, $cond = 1)
  {
    $sql = "select * from users where (username = '$username' OR email = '$email' OR mobile = '$mobile') AND $cond";
    return $this->pdo_query_one($sql);
  }
  public function InsertUser($data)
  {
    return $this->insert($this->table, $data);
  }
  public function UpdateUserBy($data, $cond)
  {
    return $this->update($this->table, $data, $cond);
  }
  public function DeleteUserById($cond)
  {
    return  $this->delete($this->table, $cond);
  }

  public function GetUserByEmail($email, $select = '*')
  {
    $sql = "select $select from users where email = '$email'";
    return $this->pdo_query_one($sql);
  }
}