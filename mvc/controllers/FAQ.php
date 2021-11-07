<?php
class FAQ extends Controller
{

  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "faq",
      "Title" => "Câu Hỏi Thường Gặp",
    ]);
  }
}