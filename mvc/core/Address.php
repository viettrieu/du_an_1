<?php

namespace Core;

class Address
{
  private static $arrContextOptions = array(
    "ssl" => array(
      "verify_peer" => false,
      "verify_peer_name" => false,
    ),
  );
  public static function Province()
  {
    $listProvince = file_get_contents(SITE_URL . "/public/JSON/tinh_tp.json", false, stream_context_create(self::$arrContextOptions));
    return array_column(json_decode($listProvince, true), 'name', 'code');
  }
  public static function District($_province_id = 79)
  {
    $listDistrict = file_get_contents(SITE_URL . "/public/JSON/quan-huyen/$_province_id.json", false, stream_context_create(self::$arrContextOptions));
    return array_column(json_decode($listDistrict, true), 'name_with_type', 'code');
  }
  public static function Ward($_district_id = 760)
  {
    $ListWard = file_get_contents(SITE_URL . "/public/JSON/xa-phuong/$_district_id.json", false, stream_context_create(self::$arrContextOptions));
    return array_column(json_decode($ListWard, true), 'name_with_type', 'code');
  }
}