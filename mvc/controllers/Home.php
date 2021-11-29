<?php
class Home extends Controller
{
    public $ListProduct;
    function __construct()
    {
        $this->ListProduct = $this->model("ProductModel");
        $this->ListCategory = $this->model("CategoryModel");
        $this->ListAuthor = $this->model("AuthorModel");
    }
    function SayHi()
    {

        $this->view("page-full", [
            "Page" => "home",
            "Title" => "Trang chủ",
            "sell" => $this->ListProduct->GetSellProduct(8),
            "hot"  => $this->ListProduct->GetHotProduct(),
            "view" => $this->ListProduct->GetViewProduct(),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListAuthor" => $this->ListAuthor->GetOneAuthor()


        ]);
    }
    function error404()
    {
        $this->view("page-full", [
            "Page" => "404",
        ]);
    }
}