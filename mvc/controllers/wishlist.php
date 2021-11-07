<?php
class wishlist extends Controller
{

  function __construct()
  {
  }
  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "wishlist",
      "Title" => "Wishlist",
    ]);
  }
}