<?php
class Error404 extends Controller
{
  function SayHi()
  {
    $this->view("page-full", [
      "Page" => "404",
    ]);
  }
}