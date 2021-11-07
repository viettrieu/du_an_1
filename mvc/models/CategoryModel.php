<?php
class CategoryModel extends DB
{
    public $table = "ps_category";
    public function GetAllCategory()
    {
        $sql = "SELECT ps_category.id, ps_category.title, DATE_FORMAT(ps_category.published, '%e/%c/%Y') AS'published', COUNT(product_category.categoryId) AS 'luot' FROM ps_category LEFT JOIN product_category ON product_category.categoryId = ps_category.id GROUP BY ps_category.id";
        return $this->pdo_query($sql);
    }
    public function GetCategorById($id)
    {
        $sql = "SELECT * FROM ps_category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetCategoryByProduct($id)
    {
        $sql = "SELECT id, title FROM ps_category
        INNER JOIN product_category ON categoryId = ps_category.id
        WHERE productId = $id";
        return $this->pdo_query($sql);
    }
    public function InsertCategory($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeleteCategoryById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdateCategorBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}