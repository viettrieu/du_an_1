<?php

use Core\HandleForm;

class Product extends Controller
{
  public $ListProduct;
  public $ListCategory;
  public $ListTag;
  public $ListAuthor;
  public $ListPublisher;
  function __construct()
  {
    $this->ListProduct = $this->model("ProductModel");
    $this->ListCategory = $this->model("CategoryModel");
    $this->ListTag = $this->model("TagModel");
    $this->ListPublisher = $this->model("PublisherModel");
    $this->ListAuthor = $this->model("AuthorModel");
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "product",
      "ListProduct" => $this->ListProduct->GetAllProduct(),
      "Title" => "Sản phẩm",
    ]);
  }
  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));

    if (isset($request->create_product)) {
      $title = HandleForm::rip_tags($_POST['title']);
      $price = (float)HandleForm::rip_tags($_POST['price']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float)HandleForm::rip_tags($_POST['discount']);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      $category = (int)$request->category;
      $tags = isset($request->tag) ? $request->tag : [];
      $publisher = (int)$request->publisher;
      $authors = isset($request->author) ? $request->author : [];
      $errors = HandleForm::validations([
        [$title, 'required', 'Vui lòng nhập tên sản phẩm'],
        [$price, 'numbers', 'Vui lòng nhập đúng giá sản phẩm'],
        [$category, 'required', 'Vui lòng chọn danh mục'],
        [$publisher, 'required', 'Vui lòng chọn NXB'],
        [$authors, 'required', 'Vui lòng chọn tác giả'],
        [$discount, 'Nmax:' . $price, 'Giá khuyến mãi phải nhỏ hơn giá thường'],
      ]);
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      if ($thumbnail[1] !== NULL) $thumbnail[1] = str_replace('./', '/', $thumbnail[1]);
      $data = array(
        "title" => $title,
        "summary" => $summary,
        "content" => $content,
        "price" => $price,
        "publisherId" => $publisher,
        "discount" => !empty($discount) ? $discount : NULL,
        "thumbnail" => $thumbnail[1],
      );
      if (count($errors) == 0) {
        $InsertProduct = $this->ListProduct->InsertProduct($data);
        $ProducpId  = $this->ListProduct->lastInsertId();
        $this->ListProduct->InsertProductCategory(["productId" => $ProducpId, "categoryId" => $category]);
        foreach ($tags as $tag) {
          $this->ListProduct->InsertProductTag(["productId" => $ProducpId, "tagId" => (int)$tag]);
        }
        foreach ($authors as $author) {
          $this->ListProduct->InsertProductAuthor(["productId" => $ProducpId, "authorId" => (int)$author]);
        }
        if ($InsertProduct) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công sản phẩm <strong>" . $title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }
    $this->view("admin/page-full", [
      "Page" => "create-product",
      "Title" => "Tạo sản phẩm mới",
      "ListCategory" => $this->ListCategory->GetAllCategory(),
      "ListTag" => $this->ListTag->GetAllTag(),
      "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
      "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
      "Errors" => $errors,
    ]);
  }
  function Edit($id = 0)
  {
    $product = $this->ListProduct->GetProductById($id);
    if ($product == NULL) {
      header("Location: " . ADMIN_URL . "/product");
      exit();
    }
    $errors = array();
    $request = json_decode(json_encode($_POST));
    if (isset($request->edit_product)) {
      $title = HandleForm::rip_tags($_POST['title']);
      $price = (float)HandleForm::rip_tags($_POST['price']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float) HandleForm::rip_tags($_POST['discount']);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      $category = (int)$request->category;
      $tags = isset($request->tag) ? $request->tag : [];
      $publisher = (int)$request->publisher;
      $authors = isset($request->author) ? $request->author : [];
      $errors = HandleForm::validations([
        [$title, 'required', 'Vui lòng nhập tên sản phẩm'],
        [$price, 'numbers', 'Vui lòng nhập đúng giá sản phẩm'],
        [$category, 'required', 'Vui lòng chọn danh mục'],
        [$publisher, 'required', 'Vui lòng chọn NXB'],
        [$authors, 'required', 'Vui lòng chọn tác giả'],
        [$discount, 'Nmax:' . $price, 'Giá khuyến mãi phải nhỏ hơn giá thường'],
      ]);
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      if ($thumbnail[1] !== NULL) $thumbnail[1] = str_replace('./', '/', $thumbnail[1]);
      $data = array(
        "title" => $title,
        "summary" => $summary,
        "content" => $content,
        "price" => $price,
        "publisherId" => $publisher,
        "discount" => !empty($discount) ? $discount : NULL,
        "thumbnail" => $thumbnail[1] == NULL ? $product["thumbnail"] : $thumbnail[1],
      );
      if (count($errors) == 0) {
        $InsertProduct = $this->ListProduct->UpdateProduct($data, "id = " . $id);
        $this->ListProduct->UpdateProductCategory(["categoryId" => $category], "productId = " . $id);
        $this->ListProduct->DeleteProductTag("productId = " . $id);
        foreach ($tags as $tag) {
          $this->ListProduct->InsertProductTag(["productId" => $id, "tagId" => (int)$tag]);
        }
        $this->ListProduct->DeleteProductAuthor("productId = " . $id);
        foreach ($authors as $author) {
          $this->ListProduct->InsertProductAuthor(["productId" => $id, "authorId" => (int)$author]);
        }
        if ($InsertProduct) {
          $errors[] = ["status" => "OK", "message" => "Bạn đã thêm thành công sản phẩm <strong>" . $title . "</strong>"];
        } else {
          $errors[] = ["status" => "ERROR", "message" => "Đã có lỗi khi đăng vui lòng thử lại"];
        }
      }
    }
    $categorys = $this->ListCategory->GetCategoryByProduct($id);
    $tags = $this->ListTag->GetTagByProduct($id);
    // $publisher = $this->ListPublisher->GetPublisherByProduct($id);
    $author = $this->ListAuthor->GetAuthorByProduct($id);
    $this->view("admin/page-full", [
      "Page" => "edit-product",
      "Title" => "Chỉnh sửa sản phẩm",
      "Product" => $this->ListProduct->GetProductById($id),
      "ListCategory" => $this->ListCategory->GetAllCategory(),
      "ListTag" => $this->ListTag->GetAllTag(),
      "ListAuthor" => $this->ListAuthor->GetAllAuthor(),
      "Categorys" => array_column($categorys, "title"),
      "Tags" => array_column($tags, "title"),
      "ListPublisher" => $this->ListPublisher->GetAllPublisher(),
      "Author" => array_column($author, "title"),
      "Errors" => $errors,
    ]);
  }

  function Delete($id = 0)
  {
    $cond = "id = '$id'";
    $result =  $this->ListProduct->DeleteProductById($cond);
    if ($result) {
      echo json_encode($result);
    }
    exit();
  }
}
