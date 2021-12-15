<?php
class Home extends Controller
{
    public $Product;
    public $ListCategory;
    public $ListAuthor;
    public $ListPost;
    function __construct()
    {
        $this->Product = $this->model("ProductModel");
        $this->ListCategory = $this->model("CategoryModel");
        $this->ListAuthor = $this->model("AuthorModel");
        $this->ListPost = $this->model("PostModel");
    }
    function SayHi()
    {
        $this->view("page-full", [
            "Page" => "home",
            "Title" => "Trang chủ",
            "Sell" => $this->Product->GetSellProduct(8),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListAuthor" => $this->ListAuthor->GetOneAuthor(),
            "ListPost" => $this->ListPost->GetAllPost()
        ]);
    }
    function ListProduct($act = "Sell")
    {
        switch ($act) {
            case 'Sell':
                $listProduct = $this->Product->GetSellProduct(8);
                break;
            case 'Wishlist':
                $listProduct = $this->Product->GetWishlistProduct(8);
                break;
            case 'Rating':
                $listProduct = $this->Product->GetRatingProduct(8);
                break;
        }
        $gg = '';
        foreach ($listProduct as $product) {
            $gg .= '<div class="col medium-4 small-6 large-3">
            <div class="col-inner">';
            ob_start();
            require "./mvc/views/block/product.php";
            $gg .= ob_get_clean();
            $gg .= '</div></div>';
        }
        echo json_encode([$gg]);
        exit;
    }
}