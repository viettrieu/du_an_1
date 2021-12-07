<?php

use Core\HandleForm;

class Product extends Controller
{
  public $ListProduct;
  public $ListCategory;
  public $ListTag;
  public $ListAuthor;
  function __construct()
  {
    $this->ListProduct = $this->model("ProductModel");
    $this->ListCategory = $this->model("CategoryModel");
    $this->ListTag = $this->model("TagModel");
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
      "ListProduct" => $this->ListProduct->GetByTaxonomy(),
      "Title" => "Sản phẩm",
    ]);
  }
  function Create()
  {
    $errors = array();
    $request = json_decode(json_encode($_POST));

    if (isset($request->create_product)) {
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Vui lòng nhập tên sản phẩm'],
        [$request->price, 'numbers', 'Vui lòng nhập đúng giá sản phẩm'],
        // [$request->discount, 'numbers', 'Vui lòng nhập giá khuyến mãi'],
        [$request->category, 'required', 'Vui lòng chọn danh mục'],
      ]);
      $title = HandleForm::rip_tags($_POST['title']);
      $price = (float)HandleForm::rip_tags($_POST['price']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float)HandleForm::rip_tags($_POST['discount']);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      $category = (int)$request->category;
      $tags = isset($request->tag) ? $request->tag : [];
      $authors = isset($request->author) ? $request->author : [];
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      if ($thumbnail[1] !== NULL) $thumbnail[1] = str_replace('./', '/', $thumbnail[1]);
      $data = array(
        "title" => $title,
        "summary" => $summary,
        "content" => $content,
        "price" => $price,
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
      $errors = HandleForm::validations([
        [$request->title, 'required', 'Vui lòng nhập tên sản phẩm'],
        [$request->price, 'numbers', 'Vui lòng nhập chỉ nhập số vào giá sản phẩm'],
        // [$request->discount, 'numbers', 'Vui lòng nhập chỉ nhập số vào giá khuyến mãi'],
        [$request->category, 'required', 'Vui lòng chọn danh mục'],
      ]);
      $title = HandleForm::rip_tags($_POST['title']);
      $price = (float)HandleForm::rip_tags($_POST['price']);
      $summary = $_POST['summary'] == '<p><br></p>' ? NULL : $_POST['summary'];
      $discount = (float) HandleForm::rip_tags($_POST['discount']);
      $content =  $_POST['content'] == '<p><br></p>' ? NULL : $_POST['content'];
      $thumbnail = HandleForm::upload($_FILES["thumbnail"], ['jpeg', 'jpg', 'png'], 5000000,  "./public/img/");
      $category = (int)$request->category;
      $tags = isset($request->tag) ? $request->tag : [];
      $authors = isset($request->author) ? $request->author : [];
      if (!$thumbnail[0]) {
        $errors[] = ["status" => "ERROR", "message" => $thumbnail[1]];
      }
      $data = array(
        "title" => $title,
        "summary" => $summary,
        "content" => $content,
        "price" => $price,
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