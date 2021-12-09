<?php
class ProductModel extends DB
{
    public $table = "book";
    public function GetAllProduct()
    {
        $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, X.rating , A.author AS 'author', quantity,publisher.title AS 'publisher' FROM book
        INNER JOIN publisher ON publisher.id = publisherId
        INNER JOIN (SELECT productId, GROUP_CONCAT( DISTINCT author.title SEPARATOR ', ') AS 'author' FROM `author` INNER JOIN book_author ON id = authorId  GROUP BY productId) A ON A.productId =  book.id
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE status = 1 GROUP BY productId) X  ON X.productId = book.id  GROUP BY book.id DESC";
        return $this->pdo_query($sql);
    }
    public function GetAllProducts()
    {
        $sql = "SELECT id as 'objectID', book.* FROM book";
        return $this->pdo_query($sql);
    }
    public function GetSellProduct($limit = 6)
    {
        $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, X.rating , A.author AS 'author', SUM(orderi.quantity) AS 'quantity'  FROM book
        INNER JOIN (SELECT productId, GROUP_CONCAT( DISTINCT author.title SEPARATOR ', ') AS 'author' FROM `author` INNER JOIN book_author ON id = authorId  GROUP BY productId) A ON A.productId =  book.id
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE status = 1 GROUP BY productId) X  ON X.productId = book.id
        INNER JOIN order_item orderi  ON book.id = orderi.productId GROUP BY book.id ORDER BY quantity DESC LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetHotProduct($limit = 6)
    {
        $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, X.rating , A.author AS 'author', COUNT(orderi.quantity) AS 'quantity'  FROM book
        INNER JOIN (SELECT productId, GROUP_CONCAT( DISTINCT author.title SEPARATOR ', ') AS 'author' FROM `author` INNER JOIN book_author ON id = authorId  GROUP BY productId) A ON A.productId =  book.id
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE status = 1 GROUP BY productId) X  ON X.productId = book.id
        INNER JOIN order_item orderi  ON book.id = orderi.productId GROUP BY book.id ORDER BY quantity DESC LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetWishlistProduct($limit = 6)
    {
        $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, X.rating , A.author AS 'author', COUNT(wl.productId) AS 'quantity'  FROM book
        INNER JOIN (SELECT productId, GROUP_CONCAT( DISTINCT author.title SEPARATOR ', ') AS 'author' FROM `author` INNER JOIN book_author ON id = authorId  GROUP BY productId) A ON A.productId =  book.id
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE status = 1 GROUP BY productId) X  ON X.productId = book.id
        INNER JOIN wishlist wl  ON book.id = wl.productId GROUP BY book.id ORDER BY quantity DESC LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetByTaxonomy($id = 0, $name = 0, $offset = 0, $perPage = 0)
    {
        $sql = "SELECT DISTINCT book.id,book.title, thumbnail, book.price, book.discount, X.rating , A.author AS 'author'  FROM book
        INNER JOIN (SELECT productId, GROUP_CONCAT( DISTINCT author.title SEPARATOR ', ') AS 'author' FROM `author` INNER JOIN book_author ON id = authorId  GROUP BY productId) A ON A.productId =  book.id
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE status = 1 GROUP BY productId) X  ON X.productId = book.id";
        if ($id != 0) {
            if ($name == 'tag') {
                $sql .= " WHERE book.id IN (SELECT book_tag.productId FROM book_tag WHERE tagId = $id)";
            }
            if ($name == 'category') {
                $sql .= " WHERE book.id IN (SELECT book_category.productId FROM book_category WHERE categoryId = $id)";
            }
            if ($name == 'author') {
                $sql .= " WHERE book.id IN (SELECT book_author.productId FROM book_author WHERE authorId = $id)";
            }
            if ($name == 'search') {
                $sql .= " WHERE book.title LIKE '%$id%'";
            }
            if ($name == 'rating') {
                $sql .= " WHERE rating >= $id";
            }
            if ($name == 'publisher') {
                $sql .= " WHERE publisherId = $id";
            }
        }
        $sql .= " GROUP BY book.id DESC";

        if ($offset >= 0 &&  $perPage > 0) $sql .= " LIMIT $offset, $perPage";
        // return  $sql;
        return $this->pdo_query($sql);
    }
    public function GetProductById($id)
    {
        $sql = "SELECT book.*, publisher.title AS 'publisher' FROM book INNER JOIN publisher ON publisher.id = publisherId WHERE book.id = $id";
        return $this->pdo_query_one($sql);
    }
    // //
    // public function SumViewById($id)
    // {
    //     $sql = "SELECT content FROM ps_product_meta WHERE productId = $id AND `key` = 'view'";
    //     return $this->pdo_query_value($sql);
    // }
    // //
    // public function CountViewById($id)
    // {
    //     $sql = "INSERT INTO ps_product_meta (productId, `key`, content) VALUES ('$id', 'view', 1)  ON DUPLICATE KEY UPDATE content = content + 1";
    //     return $this->pdo_execute($sql);
    // }
    public function GetRelatedProductById($id, $num)
    {
        $sql = "SELECT book.id, book.thumbnail, book.title, price, discount, X.rating, categoryId, GROUP_CONCAT(author.title SEPARATOR ', ') AS 'author' FROM book
        LEFT JOIN book_author ON book.id = book_author.productId
        LEFT JOIN author ON book_author.authorId = author.id
        LEFT JOIN( SELECT productId, AVG(rating) AS 'rating' FROM book_review WHERE STATUS = 1 GROUP BY productId ) X ON X.productId = book.id
        LEFT JOIN book_category category ON book.id = category.productId WHERE categoryId IN( SELECT id FROM category INNER JOIN book_category ON categoryId = category.id WHERE productId = $id ) AND NOT book.id = $id GROUP BY book.id ORDER BY RAND() LIMIT $num";
        return $this->pdo_query($sql);
    }
    public function Check($id)
    {
        $sql = "SELECT id FROM book WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function InsertProduct($data)
    {
        return $this->insert($this->table, $data);
    }
    public function UpdateProduct($data, $cond)
    {
        return $this->update($this->table, $data, $cond);
    }
    public function InsertProductCategory($data)
    {
        return $this->insert("book_category", $data);
    }
    public function UpdateProductCategory($data, $cond)
    {
        return $this->update("book_category", $data, $cond);
    }
    public function InsertProductTag($data)
    {
        return $this->insert("book_tag", $data);
    }
    public function DeleteProductTag($cond = 1)
    {
        return $this->delete("book_tag", $cond);
    }
    public function InsertProductAuthor($data)
    {
        return $this->insert("book_author", $data);
    }
    public function DeleteProductAuthor($cond = 1)
    {
        return $this->delete("book_author", $cond);
    }
    public function DeleteProductById($cond)
    {
        return $this->delete($this->table, $cond);
    }
}