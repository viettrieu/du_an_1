<?php

namespace Core;

class loginfb
{
    public static function configFB()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => '',
            'app_secret' => '',
            'default_graph_version' => 'v5.0',
            //'default_access_token' => '{access-token}', // optional
        ]);
        return $fb;
    }
    public static function fb_login_url()
    {
        $helper = self::configFB()->getRedirectLoginHelper();
        $permissions = ['email']; //optional
        $fb_login_url = $helper->getLoginUrl('https://ps17048.com/du_an_1/socialauth', $permissions);
        return $fb_login_url;
    }
    public static function login()
    {
        $match = [];
        // session_destroy();
        $fb = self::configFB();
        $helper = $fb->getRedirectLoginHelper();

        try {
            if (isset($_SESSION['facebook_access_token'])) {
                $accessToken = $_SESSION['facebook_access_token'];
            } else {
                $accessToken = $helper->getAccessToken();
            }
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        if (isset($accessToken)) {
            if (!isset($_SESSION['facebook_access_token'])) {
                //get short-lived access token
                $_SESSION['facebook_access_token'] = (string) $accessToken;

                //OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();

                //Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
            }
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            try {
                $fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
                $fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

                $fb_user = $fb_response->getGraphUser();
                $picture = $fb_response_picture->getGraphUser();
                $fb_user_id = $fb_user->getProperty('id');
                $fb_user_name = $fb_user->getProperty('name');
                $fb_user_email = $fb_user->getProperty('email');
                $fb_user_pic = $picture['url'];
                $_SESSION['fb_user'] = ['id' => $fb_user_id, 'name' => $fb_user_name, 'email' => $fb_user_email, 'avatar' => $fb_user_pic];
                unset($_SESSION['facebook_access_token']);
                return $_SESSION['fb_user'];
                exit;
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Facebook API Error: ' . $e->getMessage();
                session_destroy();
                // redirecting user back to app login page
                // header("Location: ./");
                exit;
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK Error: ' . $e->getMessage();
                exit;
            }
        }
    }
}