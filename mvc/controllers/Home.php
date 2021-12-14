<?php
class Home extends Controller
{
    public $ListProduct;
    public $ListCategory;
    public $ListAuthor;
    public $ListPost;
    function __construct()
    {
        $this->ListProduct = $this->model("ProductModel");
        $this->ListCategory = $this->model("CategoryModel");
        $this->ListAuthor = $this->model("AuthorModel");
        $this->ListPost = $this->model("PostModel");
    }
    function SayHi()
    {

        $this->view("page-full", [
            "Page" => "home",
            "Title" => "Trang chủ",
            "sell" => $this->ListProduct->GetSellProduct(8),
            "hot"  => $this->ListProduct->GetHotProduct(),
            "view" => $this->ListProduct->GetWishlistProduct(),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListAuthor" => $this->ListAuthor->GetOneAuthor(),
            "ListPost" => $this->ListPost->GetAllPost()
        ]);
    }
    function error404()
    {
        $this->view("page-full", [
            "Page" => "404",
        ]);
    }
}