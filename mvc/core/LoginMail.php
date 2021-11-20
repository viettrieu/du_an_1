<?php

namespace Core;

use  Google\Client;
use  Google\Service\Oauth2;


class LoginMail
{
    public static function configLoginMail()
    {
        $KEY_FILE_LOCATION = __DIR__ . '/gmail.json';
        $client = new Client();
        $client->setApplicationName("Hello Analytics Reporting");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setAccessType("offline");
        $client->addScope('email');
        $client->addScope('profile');
        if (isset($_GET['code'])) {
            $authCode = $_GET["code"];
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);
        }
        return  $client;
    }
    public static function loginUrl()
    {
        $client = self::configLoginMail();
        return $client->createAuthUrl();
    }
    public static function login()
    {
        if (isset($_GET['code'])) {
            $client = self::configLoginMail();
            $service = new Oauth2($client);
            $results = $service->userinfo->get();
            $social_user =  ['social' => 'gmail', 'id' => $results['id'], 'name' => $results['name'], 'email' => $results['email'], 'avatar' => $results['picture']];
            setcookie("social_user", base64_encode(json_encode($social_user)), time() + (5 * 60), "/");
            return $social_user;
        }
    }
}