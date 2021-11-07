<?php
class ProductModel extends DB
{
    public $table = "ps_product";
    // public function GetAllProduct()
    // {
    //     $sql = "SELECT product.*, X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id ";
    //     return $this->pdo_query($sql);
    // }
    // public function GetAllProducts()
    // {
    //     $sql = "SELECT * FROM ps_product";
    //     return $this->pdo_query($sql);
    // }
    public function GetSellProduct($limit = 6)
    {
        $sql = "SELECT product.id,product.title, thumbnail, product.price, SUM(orderi.quantity) AS 'quantity', X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id JOIN ps_order_item orderi   ON product.id = orderi.productId GROUP BY orderi.productId ORDER BY quantity DESC LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetHotProduct($limit = 6)
    {
        $sql = "SELECT product.id,product.title, thumbnail,product.price, SUM(orderi.productId) AS 'quantity', X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id  INNER JOIN ps_order_item orderi ON product.id = orderi.productId GROUP BY orderi.productId  ORDER BY orderi.productId DESC LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetViewProduct($limit = 6)
    {
        $sql = "SELECT product.id,product.title, thumbnail,product.price, CAST(mt.content AS int) AS 'view',  X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review  WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id  INNER JOIN ps_product_meta mt ON product.id = mt.productId AND `key` = 'view' ORDER BY view DESC  LIMIT $limit";
        return $this->pdo_query($sql);
    }
    public function GetByTaxonomy($id = 0, $name = 0, $offset = 0, $perPage = 0)
    {
        $sql = "SELECT product.*, X.rating FROM ps_product product LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id ";
        if ($id != 0) {
            if ($name == 'tag') {
                $sql .= "INNER JOIN product_tag tag ON tagId = $id AND product.id = tag.productId";
            }
            if ($name == 'category') {
                $sql .= "INNER JOIN product_category category ON categoryId = $id AND product.id = category.productId";
            }
            if ($name == 'search') {
                $sql .= "WHERE (title LIKE '%$id%' OR summary LIKE '%$id%')";
            }
        }
        if ($offset >= 0 &&  $perPage > 0) $sql .= " LIMIT $offset, $perPage";
        // return  $sql;
        return $this->pdo_query($sql);
    }
    public function GetProductById($id)
    {
        $sql = "SELECT * FROM ps_product WHERE id = $id";
        return $this->pdo_query_one($sql);
    }
    public function SumViewById($id)
    {
        $sql = "SELECT content FROM ps_product_meta WHERE productId = $id AND `key` = 'view'";
        return $this->pdo_query_value($sql);
    }
    public function CountViewById($id)
    {
        $sql = "INSERT INTO ps_product_meta (productId, `key`, content) VALUES ('$id', 'view', 1)  ON DUPLICATE KEY UPDATE content = content + 1";
        return $this->pdo_execute($sql);
    }
    public function GetRelatedProductById($id, $num)
    {
        $sql = "SELECT product.id, thumbnail, product.title, price, X.rating, categoryId FROM ps_product product
        LEFT JOIN (SELECT productId, AVG(rating) AS 'rating' FROM ps_product_review WHERE status = 1 GROUP BY productId) X  ON X.productId = product.id
        LEFT JOIN product_category category ON product.id = category.productId WHERE categoryId IN( SELECT id FROM ps_category INNER JOIN product_category ON categoryId = ps_category.id WHERE productId = $id) AND NOT product.id = $id GROUP BY  product.id ORDER BY RAND() LIMIT $num";
        return $this->pdo_query($sql);
    }
    public function Check($id)
    {
        $sql = "SELECT id FROM ps_product WHERE id = $id";
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
        return $this->insert("product_category", $data);
    }
    public function UpdateProductCategory($data, $cond)
    {
        return $this->update("product_category", $data, $cond);
    }
    public function InsertProductTag($data)
    {
        return $this->insert("product_tag", $data);
    }
    public function DeleteProductById($cond)
    {
        return $this->delete($this->table, $cond);
    }
}