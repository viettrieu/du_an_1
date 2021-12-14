<?php
class CommentModel extends DB
{
  public $table = "comment";
  public function GetAllComment()
  {
    $sql = "SELECT b.id, avatar, u.fullName, username, b.content, parent_id,status, title , DATE_FORMAT(b.published, '%e/%c/%Y') AS 'published' FROM comment as b  LEFT JOIN users as u ON b.userId  = u.id INNER JOIN post ON b.PostId = post.id";
    return $this->pdo_query($sql);
  }
  public function GetCommentByPost($id)
  {
    $sql = "SELECT comment.id, users.fullName, users.username, parent_id, content, avatar FROM comment LEFT JOIN users ON userId  = users.id WHERE postId = $id AND status = 1 ORDER BY published DESC";
    return $this->pdo_query($sql);
  }
  public function InsertComment($data)
  {
    return $this->insert($this->table, $data);
  }
  public function UpdateComment($data, $cond)
  {
    return $this->update($this->table, $data, $cond);
  }
  public function DeleteCommentById($cond)
  {
    return $this->delete($this->table, $cond);
  }
}