<?php
class About extends Controller
{

    function SayHi()
    {
        $this->view("page-full", [
            "Page" => "about",
            "Title" => "Giới thiệu",
        ]);
    }
}