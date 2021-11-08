<?php

namespace Core;

class loginfb
{
    public static function login()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => '249747897187446',
            'app_secret' => 'eb8c15a323038b973ee5bf2a020244ff',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
        $helper = $fb->getRedirectLoginHelper();
        //   $helper = $fb->getJavaScriptHelper();
        //   $helper = $fb->getCanvasHelper();
        //   $helper = $fb->getPageTabHelper();
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
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

        // $me = $response->getGraphUser();
        // echo 'Logged in as ' . $me->getName();

        $permissions = ['email']; //optional
        if (isset($accessToken)) {
            if (!isset($_SESSION['facebook_access_token'])) {
                //get short-lived access token
                $_SESSION['facebook_access_token'] = (string) $accessToken;

                //OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();

                //Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

                //setting default access token to be used in script
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }


            //redirect the user to the index page if it has $_GET['code']
            if (isset($_GET['code'])) {
                // header('Location: ./');
            }


            try {
                $fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
                $fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

                $fb_user = $fb_response->getGraphUser();
                $picture = $fb_response_picture->getGraphUser();
                $_SESSION['fb_user_id'] = $fb_user->getProperty('id');
                $_SESSION['fb_user_name'] = $fb_user->getProperty('name');
                $_SESSION['fb_user_email'] = $fb_user->getProperty('email');
                $_SESSION['fb_user_pic'] = $picture['url'];
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Facebook API Error: ' . $e->getMessage();
                session_destroy();
                // redirecting user back to app login page
                // header("Location: ./");
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK Error: ' . $e->getMessage();
                exit;
            }
        } else {
            // replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
            $fb_login_url = $helper->getLoginUrl('https://ps17048.com/PHP_FPOLY/du_an_1/login', $permissions);
            return $fb_login_url;
        }
    }
}