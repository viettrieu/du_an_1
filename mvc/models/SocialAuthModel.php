<?php
class SocialAuthModel extends DB
{
  public function Get($cond)
  {
    $sql = "select userId from social_auth where $cond";
    return $this->pdo_query_value($sql);
  }
  public function Check($id)
  {
    $sql = "SELECT id, username, avatar, fullName, `admin` FROM users WHERE id = $id";
    return $this->pdo_query_one($sql);
  }
}