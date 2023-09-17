<?php
include('connect.php');
date_default_timezone_set("Asia/Bangkok");
insert_nb01($conn);
insert_nb02($conn);
insert_nb03($conn);
function insert_nb01($conn)
{
  $date = date("Y-m-d");
  $urljson = file_get_contents('https://api.netpie.io/feed/FeedDataNB1?apikey=RqV9VEwuNgJoUIBLeW0uaBflvqP9PE93&granularity=1seconds&since=1hours&filter=temp,humid,light');
  $urljson1 = file_get_contents('https://api.netpie.io/feed/FeedDataNB2?apikey=KSaHQDxS4syLBn3psQdE438AHaoYwdj7&granularity=1seconds&since=1hours&filter=distance');
  $urljson2 = file_get_contents('https://api.netpie.io/feed/FeedDataNB3?apikey=CNh4F8SyrKLmXiPxiNug7hhMOOviZJva&granularity=1seconds&since=1hours&filter=rssi');
  $json = $urljson;
  $json1 = $urljson1;
  $json2 = $urljson2;

  $json = json_decode($json);
  $json1 = json_decode($json1);
  $json2 = json_decode($json2);
  $count_distance  = count($json1->data[0]->values);
  $count_rssi = count($json2->data[0]->values);
  $arr1 = ($json->data[0]->values);
  $arr2 = ($json->data[1]->values);
  $arr3 = ($json->data[2]->values);
  $count1 = count($arr1);
  $count2 = count($arr2);
  $count3 = count($arr3);
  if (!empty($json->data[0]->values)) {
    $humid = $json->data[0]->values[$count1 - 1][1];
  } else {
    $humid = 0;
  }
  if (!empty($json->data[1]->values)) {
    $light = $json->data[1]->values[$count2 - 1][1];
  } else {
    $light = 0;
  }
  if (!empty($json->data[2]->values)) {
    $temp = $json->data[2]->values[$count3 - 1][1];
  } else {
    $temp = 0;
  }
  if (!empty($json->data[2]->values)) {
    $distance = $json1->data[0]->values[$count_distance - 1][1];
  } else {
    $distance = 0;
  }
  if (!empty($json->data[2]->values)) {
    $rssi = $json2->data[0]->values[$count_rssi - 1][1];
  } else {
    $rssi = 0;
  }
  $sql = "SELECT * FROM `val_nb1` WHERE `date_nb1` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_nb1` SET `temp_nb1` = '$temp', `humid_nb1` = '$humid', `light_nb1` = '$light', `distance_nb1` = '$distance', `rssi_nb1` = '$rssi' WHERE `date_nb1` = '$date'";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_nb1` (`id`, `temp_nb1`, `humid_nb1`, `light_nb1`, `distance_nb1`, `rssi_nb1`, `date_nb1`)
       VALUES (NULL, '$temp', '$humid', '$light', '$distance', '$rssi', '$date');";
    $conn->query($sql);
  }
}
function insert_nb02($conn)
{
  $date = date("Y-m-d");
  $urljson = file_get_contents('https://api.netpie.io/feed/FeedDataNB1node2?apikey=K7vBAnsFq4Ex6VirUZOwVwODsSNrfF3n&granularity=1seconds&since=1hours&filter=temp,humid,light');
  $urljson1 = file_get_contents('https://api.netpie.io/feed/FeedDataNB2node2?apikey=0uSGm9ZSDezpTuphwketn4aPSwjeQHUS&granularity=1seconds&since=1hours&filter=distance');
  $urljson2 = file_get_contents('https://api.netpie.io/feed/FeedDataNB3node2?apikey=LaSn7wJsrsLyj0x4Bef4mNosixQzvZLZ&granularity=1seconds&since=1hours&filter=rssi');
  $json = $urljson;
  $json1 = $urljson1;
  $json2 = $urljson2;

  $json = json_decode($json);
  $json1 = json_decode($json1);
  $json2 = json_decode($json2);
  $count_distance  = count($json1->data[0]->values);
  $count_rssi = count($json2->data[0]->values);
  $arr1 = ($json->data[0]->values);
  $arr2 = ($json->data[1]->values);
  $arr3 = ($json->data[2]->values);
  $count1 = count($arr1);
  $count2 = count($arr2);
  $count3 = count($arr3);
  if (!empty($json->data[0]->values)) {
    $humid = $json->data[0]->values[$count1 - 1][1];
  } else {
    $humid = 0;
  }
  if (!empty($json->data[1]->values)) {
    $light = $json->data[1]->values[$count2 - 1][1];
  } else {
    $light = 0;
  }
  if (!empty($json->data[2]->values)) {
    $temp = $json->data[2]->values[$count3 - 1][1];
  } else {
    $temp = 0;
  }
  if (!empty($json->data[2]->values)) {
    $distance = $json1->data[0]->values[$count_distance - 1][1];
  } else {
    $distance = 0;
  }
  if (!empty($json->data[2]->values)) {
    $rssi = $json2->data[0]->values[$count_rssi - 1][1];
  } else {
    $rssi = 0;
  }
  $sql = "SELECT * FROM `val_nb2` WHERE `date_nb2` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_nb2` SET `temp_nb2` = '$temp', `humid_nb2` = '$humid', `light_nb2` = '$light', `distance_nb2` = '$distance', `rssi_nb2` = '$rssi' WHERE `date_nb2` = '$date'";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_nb2` (`id`, `temp_nb2`, `humid_nb2`, `light_nb2`, `distance_nb2`, `rssi_nb2`, `date_nb2`)
         VALUES (NULL, '$temp', '$humid', '$light', '$distance', '$rssi', '$date');";
    $conn->query($sql);
  }
}
function insert_nb03($conn)
{
  $date = date("Y-m-d");
  $urljson = file_get_contents('https://api.netpie.io/feed/FeedDataNB1node3?apikey=9x4BKZMzmXDmP40dV1hovmm6IlbZjBjt&granularity=1seconds&since=1hours&filter=temp,humid,light');
  $urljson1 = file_get_contents('https://api.netpie.io/feed/FeedDataNB2node3?apikey=YQkigAiSCTLml5D8KJhmBegaiQKjZt0V&granularity=1seconds&since=1hours&filter=distance');
  $urljson2 = file_get_contents('https://api.netpie.io/feed/FeedDataNB3node3?apikey=qRFnCIXnxWwj2yPKLNXN8josoPulPI1r&granularity=1seconds&since=1hours&filter=rssi');
  $json = $urljson;
  $json1 = $urljson1;
  $json2 = $urljson2;

  $json = json_decode($json);
  $json1 = json_decode($json1);
  $json2 = json_decode($json2);
  $count_distance  = count($json1->data[0]->values);
  $count_rssi = count($json2->data[0]->values);
  $arr1 = ($json->data[0]->values);
  $arr2 = ($json->data[1]->values);
  $arr3 = ($json->data[2]->values);
  $count1 = count($arr1);
  $count2 = count($arr2);
  $count3 = count($arr3);
  if (!empty($json->data[0]->values)) {
    $humid = $json->data[0]->values[$count1 - 1][1];
  } else {
    $humid = 0;
  }
  if (!empty($json->data[1]->values)) {
    $light = $json->data[1]->values[$count2 - 1][1];
  } else {
    $light = 0;
  }
  if (!empty($json->data[2]->values)) {
    $temp = $json->data[2]->values[$count3 - 1][1];
  } else {
    $temp = 0;
  }
  if (!empty($json->data[2]->values)) {
    $distance = $json1->data[0]->values[$count_distance - 1][1];
  } else {
    $distance = 0;
  }
  if (!empty($json->data[2]->values)) {
    $rssi = $json2->data[0]->values[$count_rssi - 1][1];
  } else {
    $rssi = 0;
  }
  $sql = "SELECT * FROM `val_nb3` WHERE `date_nb3` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_nb3` SET `temp_nb3` = '$temp', `humid_nb3` = '$humid', `light_nb3` = '$light', `distance_nb3` = '$distance', `rssi_nb3` = '$rssi' WHERE `date_nb3` = '$date'";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_nb3` (`id`, `temp_nb3`, `humid_nb3`, `light_nb3`, `distance_nb3`, `rssi_nb3`, `date_nb3`)
         VALUES (NULL, '$temp', '$humid', '$light', '$distance', '$rssi', '$date');";
    $conn->query($sql);
  }
}
