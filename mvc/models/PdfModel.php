<?php
class PdfModel extends DB{
    public $table = "detailed_order";
    public function countProduct($orderId){
        $sql="SELECT o.quantity ,b.title,b.price,d.shipping,d.content FROM detailed_order as d ,order_item as o,book as b WHERE d.id = '$orderId' 
        AND d.id = o.orderId  and o.productId = b.id ";
        return $this->pdo_query($sql);
    }
    
}