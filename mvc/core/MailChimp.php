<?php

namespace Core;

class MailChimp
{
  private static $list_id = 'b76c552a54';
  private static $api_key = 'dc6efba237adca5783eb378560994a33-us20';
  public static function AddSubscriber($email)
  {
    $data_center = substr(self::$api_key, strpos(self::$api_key, '-') + 1);
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . self::$list_id . '/members';
    $json = json_encode([
      'email_address' => $email,
      'status'        => 'subscribed', //pass 'subscribed' or 'pending'
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . self::$api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $result = curl_exec($ch);
    curl_close($ch);
    if (200 == $status_code) {
      echo "The user added successfully to the MailChimp.";
    }
    return $result;
  }
  public static function DeleteSubscriber($email)
  {
    $data_center = substr(self::$api_key, strpos(self::$api_key, '-') + 1);
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . self::$list_id . '/members/' . md5(strtolower($email));

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . self::$api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $result = curl_exec($ch);
    curl_close($ch);
  }
  public static function ListMembers()
  {
    $data_center = substr(self::$api_key, strpos(self::$api_key, '-') + 1);
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . self::$list_id . '/members?offset=0&count=50/';
    try {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_USERPWD, 'user:' . self::$api_key);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      return $result;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }
}