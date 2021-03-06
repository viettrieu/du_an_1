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
    public $ListPublisher;
    public $perPage = 12;
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
        $this->ListPublisher = $this->model("PublisherModel");
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
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }

    function Category($id = 0)
    {
        $category = $this->ListCategory->GetCategorById($id);
        if ($category == NULL) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "category");
        $base_url = SITE_URL . "/store/category/$id";
        $this->view("page-left", [
            "Page" => "store",
            "Title" => $category['title'],
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "category", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }

    function Author($id = 0)
    {
        $author = $this->ListAuthor->GetAuthorById($id);
        if ($author == NULL) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "author");
        $base_url = SITE_URL . "/store/author/$id";
        $this->view("page-full", [
            "Page" => "author",
            "Title" => "Tác giả",
            "Author" => $author,
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "author", $this->offset, $this->perPage),
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Rating($id = 0)
    {
        if (!is_numeric($id)) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        if ($id < 3 || $id > 5) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "rating");
        $base_url = SITE_URL . "/store/rating/$id";
        $this->view("page-left", [
            "Page" => "store",
            "Title" => "Theo đánh giá",
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "rating", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Publisher($id = 0)
    {
        $publisher = $this->ListPublisher->GetPublisherById($id);
        if ($publisher == NULL) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "publisher");
        $base_url = SITE_URL . "/store/publisher/$id";
        $this->view("page-left", [
            "Page" => "store",
            "Title" => $publisher['title'],
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "publisher", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Tag($id = 0)
    {
        $tag = $this->ListTag->GetTagById($id);
        if ($tag == NULL) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
        $totalProduct = $this->ListProduct->GetByTaxonomy($id, "tag");
        $base_url = SITE_URL . "/store/tag/$id";
        $this->view("page-left", [
            "Page" => "store",
            "Title" => $tag['title'],
            "ListProduct" => $this->ListProduct->GetByTaxonomy($id, "tag", $this->offset, $this->perPage),
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "id" => $id,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function Product($id = 0)
    {
        if ($id == "addreview" && isset($_SESSION["user"])) {
            if (isset($_POST["productId"])) {
                $userId = (int)$_SESSION["user"]["id"];
                $productId = (int)HandleForm::rip_tags($_POST["productId"]);
                $products = $this->ListReview->check($userId);
                if ($products === NULL) $products  = [];
                $addReview = in_array($productId, array_column($products, "productId"));
                if (!$addReview) {
                    echo json_encode(["type" => "error", "message" => "Bạn phải trải nghiệm sản phẩm trước khi đánh giá"]);
                    exit();
                }
                $rating = (int)HandleForm::rip_tags(isset($_POST["rate"]) ? $_POST["rate"] : 5);
                $content = HandleForm::rip_tags($_POST["content"]);
                $data = array(
                    "userId" => $userId,
                    "productId" => $productId,
                    "rating" => $rating,
                    "content" => $content,
                );
                $result = $this->ListReview->InsertReview($data);
                if ($result) {
                    $data["avatar"] = $_SESSION["user"]["avatar"];
                    $data["username"] = $_SESSION["user"]["fullName"] ? $_SESSION["user"]["fullName"] : $_SESSION["user"]["username"];
                    $result = ["type" => "success", "message" => "Bình luận đã được gửi thành công", "data" => $data];
                } else {
                    $result = ["type" => "error", "message" => "Đã có lỗi trong quá trình gửi bình luận"];
                }
            } else {
                $result = ["type" => "error", "message" => "Đã có lỗi"];
            }
            echo json_encode($result);
            exit();
        }

        $product =  $this->ListProduct->GetProductById($id);
        if ($product == NULL) {
            header("Location: " . SITE_URL . "/store");
            exit();
        }
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
            "ListReview" => Helper::fixUrlImg($this->ListReview->GetReviewByProduct($id), "avatar"),
            "UserById" => $UserById,
            "AVGReview" => $this->ListReview->AVGReviewByProduct($id),
            "RelatedProduct" => $this->ListProduct->GetRelatedProductById($id, 4),
            "ListAuthor" => $ListAuthor,
        ]);
    }

    function Search()
    {
        $key = HandleForm::rip_tags($_GET["s"]);
        $conditions = "";
        $key = HandleForm::rip_tags($_GET["s"]);
        $keyword = explode(" ", $key);
        foreach ($keyword as $word) {
            $conditions .= "book.title LIKE '%" . $word . "%' OR ";
        }
        $conditions = substr($conditions, 0, -4);
        $totalProduct = $this->ListProduct->GetByTaxonomy($conditions, "search");
        $base_url = SITE_URL . "/store/search?s=$key";
        $ListProduct = $this->ListProduct->GetByTaxonomy($conditions, "search", $this->offset, $this->perPage);
        $this->view("page-left", [
            "Page" => "store",
            "Title" => "Từ khóa: " . $key,
            "ListCategory" => $this->ListCategory->GetAllCategory(),
            "ListTag" => $this->ListTag->GetAllTag(),
            "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
            "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
            "ListProduct" => $ListProduct,
            "Key" => $key,
            "Paging" => Helper::Pagination($base_url, count($totalProduct), $this->page, $this->perPage),
        ]);
    }
    function LiveSearch()
    {
        $conditions = "";
        $key = HandleForm::rip_tags($_GET["s"]);
        $keyword = explode(" ", $key);
        foreach ($keyword as $word) {
            $conditions .= "book.title LIKE '%" . $word . "%' OR ";
        }
        $conditions = substr($conditions, 0, -4);
        $ListProduct = $this->ListProduct->GetByTaxonomy($conditions, "search", 0, 5);
        $suggestions = array();
        if (count($ListProduct) > 0) {
            foreach ($ListProduct as $product) {
                $suggestions[] = array(
                    'type'  => 'Page',
                    'id'    => $product['id'],
                    'value' => $product['title'],
                    'img'   => $product['thumbnail'],
                    'price' => $product['price'],
                    'url' => SITE_URL . "/store/product/" . $product['id'],
                );
            }
        } else {
            $suggestions[] = array(
                'value' => "Không có sản phẩm nào.",
            );
        }
        echo json_encode(array("suggestions" => $suggestions));
        exit;
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
            "AVGReview" => $this->ListReview->AVGReviewByProduct($id),
        ]);
    }
    function LoadMore($name, $id = 0, $perPage = 8)
    {
        $total = $this->ListProduct->GetByTaxonomy($id, $name);
        $totalPages = ceil(count($total) / $perPage);
        $page =  $this->page + 1;
        $offset = ($this->page - 1) * $perPage;
        $base_url = SITE_URL . "/store/loadmore/$name/$id";
        $listProduct = $this->ListProduct->GetByTaxonomy($id, $name, $offset, $perPage);
        $gg = '';
        foreach ($listProduct as $product) {
            $gg .= '<div class="col medium-4 small-6 large-3">
            <div class="col-inner">';
            ob_start();
            require "./mvc/views/block/product.php";
            $gg .= ob_get_clean();
            $gg .= '</div></div>';
        }
        $loadMore = "";
        if ($this->page < $totalPages) {
            $loadMore = '<div class="col small-12 large-12"><button data-href="' . $base_url . '&page=' . $page
                . '" class="load-more" data-id="' . $id . '">
            XEM THÊM
        </button></div>';
        }
        echo json_encode([$gg, $loadMore]);
        exit;
    }
}
