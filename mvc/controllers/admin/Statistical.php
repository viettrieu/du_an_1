<?php

use Core\GoogleAnalytics;

class Statistical extends Controller
{
  function __construct()
  {
    if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']["admin"] != true) {
      header("Location: " . ADMIN_URL . "/login");
      exit();
    }
  }
  function SayHi()
  {
    $this->view("admin/page-full", [
      "Page" => "statistical",
      "Title" => "Statistical",
    ]);
  }
  function getDaterangeSU()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:Pageviews', 'ga:users', 'ga:Sessions'];
      $dimension =  ['ga:date'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
  }
  function get()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:users', 'ga:Sessions', 'ga:percentNewSessions', 'ga:bounceRate', 'ga:avgSessionDuration', 'ga:pageviewsPerSession', 'ga:Pageviews'];
      $dimension =  [];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
  }
  function DeviceCategory()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:users'];
      $dimension =  ['ga:DeviceCategory', 'ga:date'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension);
    } else {
      echo 'Lỗi';
    }
  }
  function listPageView()
  {
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
      $startDate = $_POST['startDate'];
      $endDate =  $_POST['endDate'];
      $metric =  ['ga:sessions', 'ga:bounceRate', 'ga:Pageviews', 'ga:uniquePageviews', 'ga:avgTimeOnPage', 'ga:exitRate'];
      $dimension =  ['ga:pagepath'];
      $sort =  ['ga:pageviews'];
      GoogleAnalytics::printResults($startDate, $endDate, $metric, $dimension, $sort);
    } else {
      echo 'Lỗi';
    }
  }
}