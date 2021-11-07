<?php
class Contact extends Controller
{

  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "contact",
      "Title" => "Liên hệ",
    ]);
  }
}