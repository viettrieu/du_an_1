<?php
class TagModel extends DB
{
    public $table = "tag";
    public function GetAllTag()
    {
        $sql = "SELECT tag.id, tag.title, DATE_FORMAT(tag.published, '%e/%c/%Y') AS'published', COUNT(book_tag.tagId) AS 'luot' FROM tag LEFT JOIN book_tag ON book_tag.tagId = tag.id GROUP BY tag.id";
        return $this->pdo_query($sql);
    }
    public function GetTagById($id)
    {
        $sql = "SELECT * FROM tag WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function GetTagByProduct($id)
    {
        $sql = "SELECT id, title FROM tag
        INNER JOIN book_tag ON tagId = tag.id
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