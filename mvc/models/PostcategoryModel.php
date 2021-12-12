<?php
class PostcategoryModel extends DB
{
    public $table = "post_category";
    public function GetAllPostcategory()
    {
        $sql = "SELECT id, title, DATE_FORMAT(published, '%e/%c/%Y') AS 'published' FROM post_category";
        return $this->pdo_query($sql);
    }
    public function GetPostcategorById($id)
    {
        $sql = "SELECT * FROM post_category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function InsertPostcategory($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeletePostcategoryById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdatePostcategorBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}