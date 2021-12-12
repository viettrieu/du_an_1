<?php
class PostModel extends DB
{
    public $table = "post";
    public function GetAllPost()
    {
        $sql = "SELECT id, title,thumbnail, DATE_FORMAT(published, '%e/%c/%Y') AS'published' FROM post";
        return $this->pdo_query($sql);
    }
    public function GetPostById($id)
    {
        $sql = " SELECT * FROM post WHERE id = $id ";
        return $this->pdo_query_one($sql);
    }
    public function GetPostByCategory($id)
    {
        $sql = " SELECT * FROM post WHERE id_category = $id ";
        return $this->pdo_query_one($sql);
    }
    public function GetPostByUser($id)
    {
        $sql = "SELECT * FROM post WHERE id_user = $id";
        return $this->pdo_query_one($sql);
    }
    public function InsertPost($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeletePostById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdatePostBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}