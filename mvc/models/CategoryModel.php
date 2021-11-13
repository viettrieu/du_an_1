<?php
class CategoryModel extends DB
{
    public $table = "category";
    public function GetAllCategory()
    {
        $sql = "SELECT category.id, category.title, DATE_FORMAT(category.published, '%e/%c/%Y') AS'published', COUNT(book_category.categoryId) AS 'luot' FROM category LEFT JOIN book_category ON book_category.categoryId = category.id GROUP BY category.id";
        return $this->pdo_query($sql);
    }
    public function GetCategorById($id)
    {
        $sql = "SELECT * FROM category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetCategoryByProduct($id)
    {
        $sql = "SELECT id, title FROM category
        INNER JOIN book_category ON categoryId = category.id
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