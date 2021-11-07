<?php
class News extends Controller
{
  public $ListCategory;
  public $ListTag;
  function __construct()
  {
    $this->ListCategory = $this->model("CategoryModel");
    $this->ListTag = $this->model("TagModel");
  }
  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "newss",
      "Title" => "Tin tức",
      "ListCategory" => $this->ListCategory->GetAllCategory(),
      "ListTag" => $this->ListTag->GetAllTag(),
    ]);
  }
}