<?php
class AuthorModel extends DB
{
    public $table = "author";
    public function GetAllAuthor()
    {
        $sql = "SELECT author.id, author.title, avatar, DATE_FORMAT(author.published, '%e/%c/%Y') AS'published', COUNT(book_author.authorId) AS 'luot' FROM author LEFT JOIN book_author ON book_author.authorId = author.id GROUP BY author.id";
        return $this->pdo_query($sql);
    }
    //cau lenh can sua
    public function GetOneAuthor()
    {
        $sql = "SELECT * FROM `author` WHERE `id` = 16";
        return $this->pdo_query_one($sql);
    }
    public function GetAuthorById($id)
    {
        $sql = "SELECT * FROM author WHERE id = $id";
        return $this->pdo_query_one($sql);
    }

    public function GetAuthorByProduct($id)
    {
        $sql = "SELECT id, title FROM author
        INNER JOIN book_author ON authorId = author.id
        WHERE productId = $id";
        return $this->pdo_query($sql);
    }
    public function InsertAuthor($data)
    {
        return $this->insert($this->table, $data);
    }
    public function DeleteAuthorById($cond)
    {
        return $this->delete($this->table, $cond);
    }
    public function UpdateAuthorBy($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
}