<?php
class ReviewModel extends DB
{
    public $table = "book_review";
    public function GetAllReview()
    {
        $sql = "SELECT b.id, avatar, u.fullName, username,  rating , b.content, title , DATE_FORMAT(b.published, '%e/%c/%Y') AS 'published', status FROM book_review as b   LEFT JOIN users as u ON b.userId  = u.id INNER JOIN book ON b.productId = book.id";
        return $this->pdo_query($sql);
    }
    public function GetReviewByRank($id)
    {
        $sql = "SELECT id, title FROM ps_category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function AVGReviewByProduct($id)
    {
        $sql = "SELECT AVG(rating) AS 'rating' FROM book_review WHERE productId = $id";
        return $this->pdo_query_value($sql);
    }
    public function GetReviewByProduct($id)
    {
        $sql = "SELECT  users.fullName, users.username, rating , content, avatar FROM book_review LEFT JOIN users ON userId  = users.id WHERE productId = $id AND status = 1  ORDER BY published DESC";
        return $this->pdo_query($sql);
    }
    public function InsertReview($data)
    {
        return $this->insert($this->table, $data);
    }
    public function UpdateReview($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
    public function DeleteReviewById($cond)
    {
        return $this->delete($this->table, $cond);
    }

    public function check($userId)
    {
        $sql = "SELECT productId FROM order_item INNER JOIN detailed_order ON detailed_order.id = orderId  WHERE status = 5 AND orderId IN (SELECT id FROM detailed_order WHERE userId = $userId)";
        return $this->pdo_query($sql);
    }

    public function GetOrderId($id, $check)
    {
        if ($check) {
            $sql = "SELECT id FROM detailed_order WHERE id not in (
                SELECT orderId FROM book_review as b
                where b.userId = 1 and b.productId = 1
            ) and userId = 1";
            echo $sql;
        } else {
            $sql = "SELECT id FROM detailed_order WHERE userId = $id ORDER BY published ASC";
        }
        return $this->pdo_query_one($sql);
    }
}