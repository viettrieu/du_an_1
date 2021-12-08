<?php
class PublisherModel extends DB
{
    public $table = "publisher";
    public function GetAllPublisher()
    {
        $sql = "SELECT id, title, DATE_FORMAT(publisher.published, '%e/%c/%Y') AS'published' FROM publisher";
        return $this->pdo_query($sql);
    }
    public function GetPublisherById($id)
    {
        $sql = "SELECT * FROM publisher WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    // public function GetPublisherByProduct($id)
    // {
    //     $sql = "SELECT id, title FROM publisher
    //     INNER JOIN book_publisher ON publisherId = publisher.id
    //     WHERE productId = $id";
    //     return $this->pdo_query($sql);
    // }
    public function InsertPublisher($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeletePublisherById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdatePublisherBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}