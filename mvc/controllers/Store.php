<?php

use Core\HandleForm;
use Core\Helper;

class Store extends Controller
{
    public $ListProduct;
    public $ListCategory;
    public $ListTag;
    public $ListReview;
    public $User;
    public $page;
    public $offset;
    public $ListAuthor;
    public $perPage = 9;
    function __construct()
    {
        $this->page = isset($_GET['page']) ?  $_GET['page'] : 1;
        $this->offset = ($this->page - 1) * $this->perPage;
        $this->ListProduct = $this->model("ProductModel");
        $this->ListCategory = $this->model("CategoryModel");
        $this->ListTag = $this->model("TagModel");
        $this->ListReview = $this->model("ReviewModel");
        $this->User = $this->model("UserModel");
        $this->ListAuthor = $this->model("AuthorModel");
    }
    function SayHi()
    {
        $totalProduct = $this->ListProduct->GetByTaxonomy();
        $base_url = SITE_URL . "/store";
        $this->view("page-left", [
            "Page" => "store",
            "Title" => "Cửa hàng",
            "ListProduct" => $this->ListProduct->GetByTaxonomy(0, "all", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetOneAuthor(),
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }

    function Category($id)
    {
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "category");
        $base_url = SITE_URL . "/store/category";
        $category = $this->ListCategory->GetCategorById($id);
        $this->view("page-left", [
            "Page" => "store",
            "Title" => $category['title'],
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "category", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Tag($id)
    {
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "tag");
        $base_url = SITE_URL . "/store/tag";
        $tag = $this->ListTag->GetTagById($id);
        $this->view("page-left", [
            "Page" => "store",
            "Title" => $tag['title'],
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "tag", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Product($id = false)
    {
        if ($id == "addreview") {
            $productId = (int)$_POST["productId"];
            $rating = (int)$_POST["rate"];
            $content = $_POST["content"];
            $data = array(
                "userId" => (int)$_SESSION["user"]["id"],
                "productId" => $productId,
                "rating" => $rating,
                "content" => $content,
            );
            $result = $this->ListReview->InsertReview($data);
            if ($result) {
                $data["avatar"] = $_SESSION["user"]["avatar"];
                $data["username"] = $_SESSION["user"]["fullName"] ? $_SESSION["user"]["fullName"] : $_SESSION["user"]["username"];
                echo json_encode($data);
            } else {
                echo 'Thấp bại';
            }
            exit();
        }

        if ($id == false || $this->ListProduct->Check($id) == false) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $product =  $this->ListProduct->GetProductById($id);
        // $this->ListProduct->CountViewById($id);
        $UserById = "";
        if (isset($_SESSION['user'])) {
            $UserById = $this->User->GetUserById($_SESSION['user']['username']);
        }
        $ListAuthor =  $this->ListAuthor->GetAuthorByProduct($id);
        foreach ($ListAuthor as $key => $author) {
            $ListAuthor[$key]['listbook'] = $this->ListProduct->GetByTaxonomy($author['id'], "author", 1, 6);
        }
        $this->view("page-full", [
            "Page" => "product",
            "Title" => $product['title'],
            "Product" => $product,
            "ListCategory" => $this->ListCategory->GetCategoryByProduct($id),
            "ListTag" => $this->ListTag->GetTagByProduct($id),
            "ListReview" => $this->ListReview->GetReviewByProduct($id),
            "UserById" => $UserById,
            "AVgitGReview" => $this->ListReview->AVGReviewByProduct($id),
            // "SumView" => $this->ListProduct->SumViewById($id),
            "RelatedProduct" => $this->ListProduct->GetRelatedProductById($id, 3),
            "ListAuthor" => $ListAuthor,
        ]);
    }

    function Search()
    {
        $key = HandleForm::rip_tags($_GET["s"]);
        $this->page = isset($_GET["page"]) ? HandleForm::rip_tags($_GET["page"]) : 1;
        $this->offset = ($this->page - 1) * $this->perPage;
        $totalProduct = $this->ListProduct->GetByTaxonomy($key, "search");
        $base_url = SITE_URL . "/store/search?s=$key";
        $ListProduct = $this->ListProduct->GetByTaxonomy($key, "search", $this->offset, $this->perPage);
        $this->view("page-left", [
            "Page" => "store",
            "Title" => "Từ khóa: " . $key,
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListProduct" => $ListProduct,
            "Key" => $key,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }

    function QuickView()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        if ($id == false || $this->ListProduct->Check($id) == false) {
            echo 'GGG';
            // header("Location: " . SITE_URL . "/store");
            exit();
        }
        $product =  $this->ListProduct->GetProductById($id);
        $this->view("/pages/quick-view", [
            "Product" => $product,
            "ListCategory" => $this->ListCategory->GetCategoryByProduct($id),
            "ListTag" => $this->ListTag->GetTagByProduct($id),
            "AVgitGReview" => $this->ListReview->AVGReviewByProduct($id),
        ]);
    }
}