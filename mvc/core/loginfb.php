<?php

namespace Core;

require_once "./mvc/core/config.php";
class loginfb
{
    public static function configFB()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v5.0',
            //'default_access_token' => '{access-token}', // optional
        ]);
        return $fb;
    }
    public static function loginUrl()
    {
        $helper = self::configFB()->getRedirectLoginHelper();
        $permissions = ['email']; //optional
        $fb_login_url = $helper->getLoginUrl(FB_CALLBACK_URL, $permissions);
        return $fb_login_url;
    }
    public static function login()
    {
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
                $social_user =  ['social' => 'facebook', 'id' => $fb_user_id, 'name' => $fb_user_name, 'email' => $fb_user_email, 'avatar' => $fb_user_pic];
                setcookie("social_user", base64_encode(json_encode($social_user)), time() + (5 * 60), "/");
                unset($_SESSION['facebook_access_token']);
                return $social_user;
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