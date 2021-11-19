<?php

namespace Core;

require_once "./mvc/core/config.php";

use Zalo\Zalo;
use Zalo\ZaloEndPoint;

class Zalologin
{
  private static $config = array(
    'app_id' => ZALO_APP_ID,
    'app_secret' => ZALO_APP_SECRET,
    'callback_url' => ZALO_CALLBACK_URL
  );
  public static function loginUrl()
  {
    $zalo = new Zalo(self::$config);
    $helper = $zalo->getRedirectLoginHelper();
    $callbackUrl = self::$config['callback_url'];
    $loginUrl = $helper->getLoginUrl($callbackUrl); // This is login url
    return $loginUrl;
  }
  public static function login()
  {
    if (isset($_GET['code'])) {
      $zalo = new Zalo(self::$config);
      $helper = $zalo->getRedirectLoginHelper();
      $callbackUrl = self::$config['callback_url'];
      $accessToken = $helper->getAccessToken($callbackUrl); // get access token
      if ($accessToken != null) {
        $expires = $accessToken->getExpiresAt(); // get expires time
      }
      $params = ['fields' => 'id,name,birthday,gender,picture'];
      $response = $zalo->get(ZaloEndpoint::API_GRAPH_ME, $accessToken, $params);
      $result = $response->getDecodedBody(); // result
      $social_user = ['social' => 'zalo', 'id' => $result['id'], 'name' => $result['name'], 'avatar' => $result['picture']['data']['url']];;
      setcookie("social_user", base64_encode(json_encode($social_user)), time() + (5 * 60), "/");
      return $social_user;
      exit;
    }
  }
}