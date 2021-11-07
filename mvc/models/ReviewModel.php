<?php
class ReviewModel extends DB
{
    public $table = "ps_product_review";
    public function GetAllReview()
    {
        $sql = "SELECT review.id, avatar, ps_users.fullName, username,  rating , review.content, title , DATE_FORMAT(review.published, '%e/%c/%Y') AS 'published', status FROM ps_product_review review LEFT JOIN ps_users ON userId  = ps_users.id INNER JOIN ps_product ON productId = ps_product.id";
        return $this->pdo_query($sql);
    }
    public function GetReviewByRank($id)
    {
        $sql = "SELECT id, title FROM ps_category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function AVGReviewByProduct($id)
    {
        $sql = "SELECT AVG(rating) AS 'rating' FROM ps_product_review WHERE productId = $id";
        return $this->pdo_query_value($sql);
    }
    public function GetReviewByProduct($id)
    {
        $sql = "SELECT  ps_users.fullName, ps_users.username, rating , content, avatar FROM ps_product_review review LEFT JOIN ps_users ON userId  = ps_users.id WHERE productId = $id AND status = 1  ORDER BY published DESC";
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
        return  $this->delete($this->table, $cond);
    }
}