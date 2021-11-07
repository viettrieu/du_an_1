<?php
class Home extends Controller
{
    public $ListProduct;
    function __construct()
    {
        $this->ListProduct = $this->model("ProductModel");
    }
    function SayHi()
    {
        $this->view("page-full", [
            "Page" => "home",
            "Title" => "Trang chủ",
            "sell" => $this->ListProduct->GetSellProduct(8),
            "hot"  => $this->ListProduct->GetHotProduct(),
            "view" => $this->ListProduct->GetViewProduct()
        ]);
    }
    function error404()
    {
        $this->view("page-full", [
            "Page" => "404",
        ]);
    }
}