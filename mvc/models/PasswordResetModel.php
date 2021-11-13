<?php
class PasswordResetModel extends DB
{
    public $table = "password_reset";

    public function checkValidToken($token)
    {
        $sql = "SELECT * FROM {$this->table} WHERE token = '$token'";
        return $this->pdo_query_one($sql);        
    }
}