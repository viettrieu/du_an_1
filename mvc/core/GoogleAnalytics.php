<?php

namespace Core;

use  Google\Client;
use  Google\Service\AnalyticsReporting;
use  Google\Service\AnalyticsReporting\DateRange;
use  Google\Service\AnalyticsReporting\Metric;
use  Google\Service\AnalyticsReporting\GetReportsRequest;
use  Google\Service\AnalyticsReporting\ReportRequest;
use  Google\Service\AnalyticsReporting\Dimension;
use  Google\Service\AnalyticsReporting\OrderBy;

class GoogleAnalytics
{
  private static $viewId = "253111439";
  public static function initializeAnalytics()
  {
    $KEY_FILE_LOCATION = __DIR__ . '/foodo.json';
    $client = new Client();
    $client->setApplicationName("Hello Analytics Reporting");
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new AnalyticsReporting($client);
    return $analytics;
  }
  private static function setDateRange($startDate, $endDate)
  {
    $dateRange = new DateRange();
    $dateRange->setStartDate($startDate);
    $dateRange->setEndDate($endDate);
    return $dateRange;
  }
  private static function setMetric($values)
  {
    $result = array();
    foreach ($values as $key => $value) {
      $metrics[$key] = new Metric();
      $metrics[$key]->setExpression($value);
      $result[] = $metrics[$key];
    }
    return $result;
  }
  private static function setDimension($values)
  {
    $result = array();
    foreach ($values as $key => $value) {
      $dimension[$key] = new Dimension();
      $dimension[$key]->setName($value);
      $result[] = $dimension[$key];
    }
    return $result;
  }

  public static function getReport($startDate, $endDate, $metric, $dimension, $sort = [])
  {
    $VIEW_ID = self::$viewId;
    $analytics = self::initializeAnalytics();
    $dateRange = self::setDateRange($startDate, $endDate);
    $metric = self::setMetric($metric);
    $dimension = self::setDimension($dimension);
    if (count($sort) > 0) {
      $ordering = new OrderBy();
      $ordering->setFieldName($sort[0]);
      $ordering->setOrderType("VALUE");
      $ordering->setSortOrder("DESCENDING");
    }
    // Create the ReportRequest object.
    $request = new ReportRequest();
    $request->setViewId($VIEW_ID);
    $request->setDateRanges($dateRange);
    $request->setMetrics($metric);
    $request->setDimensions($dimension);
    if (count($sort) > 0) {
      $request->setOrderBys($ordering); // note this one!
    }
    $body = new GetReportsRequest();
    $body->setReportRequests(array($request));
    return $analytics->reports->batchGet($body);
  }

  public static function printResults($startDate, $endDate, $metric, $dimension, $sort = [])
  {
    $result = array();
    $reports = self::getReport($startDate, $endDate, $metric, $dimension, $sort);
    for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
      $report = $reports[$reportIndex];
      $header = $report->getColumnHeader();
      $dimensionHeaders = $header->getDimensions();
      $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
      $rows = $report->getData()->getRows();
      for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
        $row = $rows[$rowIndex];
        $dimensions = $row->getDimensions();
        $metrics = $row->getMetrics();
        if (isset($dimensionHeaders)) {
          for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
            $result['dimensions'][$dimensionHeaders[$i]][] = $dimensions[$i];
          }
        }
        for ($j = 0; $j < count($metrics); $j++) {
          $values = $metrics[$j]->getValues();
          for ($k = 0; $k < count($values); $k++) {
            $entry = $metricHeaders[$k];
            $result['metrics'][$entry->getName()][] = $values[$k];
          }
        }
      }
      echo json_encode($result);
    }
  }
}