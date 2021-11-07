<?php
class TagModel extends DB
{
    public $table = "ps_tag";
    public function GetAllTag()
    {
        $sql = "SELECT ps_tag.id, ps_tag.title, DATE_FORMAT(ps_tag.published, '%e/%c/%Y') AS'published', COUNT(product_tag.tagId) AS 'luot' FROM ps_tag LEFT JOIN product_tag ON product_tag.tagId = ps_tag.id GROUP BY ps_tag.id";
        return $this->pdo_query($sql);
    }
    public function GetTagById($id)
    {
        $sql = "SELECT * FROM ps_tag WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetTagByProduct($id)
    {
        $sql = "SELECT id, title FROM ps_tag
        INNER JOIN product_tag ON tagId = ps_tag.id
        WHERE productId = $id";
        return $this->pdo_query($sql);
    }
    public function InsertTag($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeleteTagById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdateTagBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}