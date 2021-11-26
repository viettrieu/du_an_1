<?php
class Test extends Controller
{
  public $AddressModel;
  function __construct()
  {
    $this->AddressModel = $this->model("AddressModel");
  }
  function SayHi()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/label/S1031988.BO.MB2.B4.3.895152275",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(
        "Token: A66178443972ACaDD61fa6473EAc0EdC8e1312Ad",
      ),
    ));
    $order_no = 'ssss';
    $response = curl_exec($curl);
    curl_close($curl);
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/pdf");
    header("Content-Disposition:attachment;filename=" . $order_no . ".pdf");
    header("Content-Transfer-Encoding: binary");
    echo 'Response: ' . $response;
  }
}