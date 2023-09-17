<?php
include('connect.php');
date_default_timezone_set("Asia/Bangkok");
header('Content-Type: application/json;charset=utf-8');
$date = date("Y-m-d");
// $urljson = file_get_contents('data/tmd_data.json');
insert_wather_ubon();
insert_wather_sirinton();
insert_wather_khong();
insert_wather_lamdom();
insert_wather_mun2();
insert_water_ubon1($date, $conn);
insert_water_ubon2($date, $conn);
insert_water_ubon3($date, $conn);
insert_water_ubon4($date, $conn);
insert_water_ubon5($date, $conn);

function insert_wather_ubon()
{
  include('connect.php');
  $urljson = file_get_contents('data/openweathermap.json');
  $json = json_decode($urljson);
  $temp = $json->current->temp;
  $temp = number_format($temp, 1, '.', '');
  $MeanSeaLevelPressure_tmd = round($json->current->pressure);
  $humidity_tmd = round($json->current->humidity);
  $land_visibility_tmd = round(($json->current->visibility) / 1000);
  $wind_tmd = round($json->current->wind_speed);
  $rainfall_tmd = $json->current->weather[0]->description;

  $date = date("Y-m-d");

  $sql = "SELECT * FROM `val_tmd` WHERE `date_tmd` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_tmd` SET `temp_tmd` = '$temp', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `rainfall_tmd` = '$rainfall_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE `date_tmd` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_tmd` (`id_tmd`, `temp_tmd`, `humidity_tmd`, `MeanSeaLevelPressure_tmd`, `wind_tmd`, `rainfall_tmd`, `land_visibility_tmd`, `date_tmd`)
      VALUES (NULL, '$temp', '$humidity_tmd', '$MeanSeaLevelPressure_tmd', '$wind_tmd', '$rainfall_tmd', '$land_visibility_tmd', '$date');";
    $conn->query($sql);
  }
}
function insert_wather_khong()
{
  include('connect.php');
  $urljson = file_get_contents('data/openweathermap3.json');
  $json = json_decode($urljson);
  $temp = $json->current->temp;
  $temp = number_format($temp, 1, '.', '');
  $MeanSeaLevelPressure_tmd = round($json->current->pressure);
  $humidity_tmd = round($json->current->humidity);
  $land_visibility_tmd = round(($json->current->visibility) / 1000);
  $wind_tmd = round($json->current->wind_speed);
  $rainfall_tmd = $json->current->weather[0]->description;

  $date = date("Y-m-d");

  $sql = "SELECT * FROM `val_wather_khong` WHERE `date_tmd` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_wather_khong` SET `temp_tmd` = '$temp', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `rainfall_tmd` = '$rainfall_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE `date_tmd` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_wather_khong` (`id_tmd`, `temp_tmd`, `humidity_tmd`, `MeanSeaLevelPressure_tmd`, `wind_tmd`, `rainfall_tmd`, `land_visibility_tmd`, `date_tmd`)
      VALUES (NULL, '$temp', '$humidity_tmd', '$MeanSeaLevelPressure_tmd', '$wind_tmd', '$rainfall_tmd', '$land_visibility_tmd', '$date');";
    $conn->query($sql);
  }
}
function insert_wather_lamdom()
{
  include('connect.php');
  $urljson = file_get_contents('data/openweathermap4.json');
  $json = json_decode($urljson);
  $temp = $json->current->temp;
  $temp = number_format($temp, 1, '.', '');
  $MeanSeaLevelPressure_tmd = round($json->current->pressure);
  $humidity_tmd = round($json->current->humidity);
  $land_visibility_tmd = round(($json->current->visibility) / 1000);
  $wind_tmd = round($json->current->wind_speed);
  $rainfall_tmd = $json->current->weather[0]->description;

  $date = date("Y-m-d");

  $sql = "SELECT * FROM `val_wather_lamdom` WHERE `date_tmd` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_wather_lamdom` SET `temp_tmd` = '$temp', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `rainfall_tmd` = '$rainfall_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE `date_tmd` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_wather_lamdom` (`id_tmd`, `temp_tmd`, `humidity_tmd`, `MeanSeaLevelPressure_tmd`, `wind_tmd`, `rainfall_tmd`, `land_visibility_tmd`, `date_tmd`)
      VALUES (NULL, '$temp', '$humidity_tmd', '$MeanSeaLevelPressure_tmd', '$wind_tmd', '$rainfall_tmd', '$land_visibility_tmd', '$date');";
    $conn->query($sql);
  }
}

function insert_wather_mun2()
{
  include('connect.php');
  $urljson = file_get_contents('data/openweathermap5.json');
  $json = json_decode($urljson);
  $temp = $json->current->temp;
  $temp = number_format($temp, 1, '.', '');
  $MeanSeaLevelPressure_wather_mun2 = round($json->current->pressure);
  $humidity_wather_mun2 = round($json->current->humidity);
  $land_visibility_wather_mun2 = round(($json->current->visibility) / 1000);
  $wind_wather_mun2 = round($json->current->wind_speed);
  $rainfall_wather_mun2 = $json->current->weather[0]->description;

  $date = date("Y-m-d");

  $sql = "SELECT * FROM `val_wather_mun2` WHERE `date_wather_mun2` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_wather_mun2` SET `temp_wather_mun2` = '$temp', `humidity_wather_mun2` = '$humidity_wather_mun2', `MeanSeaLevelPressure_wather_mun2` = '$MeanSeaLevelPressure_wather_mun2', `wind_wather_mun2` = '$wind_wather_mun2', `rainfall_wather_mun2` = '$rainfall_wather_mun2', `land_visibility_wather_mun2` = '$land_visibility_wather_mun2' WHERE `date_wather_mun2` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_wather_mun2` (`id_wather_mun2`, `temp_wather_mun2`, `humidity_wather_mun2`, `MeanSeaLevelPressure_wather_mun2`, `wind_wather_mun2`, `rainfall_wather_mun2`, `land_visibility_wather_mun2`, `date_wather_mun2`)
      VALUES (NULL, '$temp', '$humidity_wather_mun2', '$MeanSeaLevelPressure_wather_mun2', '$wind_wather_mun2', '$rainfall_wather_mun2', '$land_visibility_wather_mun2', '$date');";
    $conn->query($sql);
  }
}
function insert_wather_sirinton()
{
  include('connect.php');
  $urljson = file_get_contents('data/openweathermap2.json');
  $json = json_decode($urljson);
  $temp = $json->current->temp;
  $temp = number_format($temp, 1, '.', '');
  $MeanSeaLevelPressure_wather_sirinton = round($json->current->pressure);
  $humidity_wather_sirinton = round($json->current->humidity);
  $land_visibility_wather_sirinton = round(($json->current->visibility) / 1000);
  $wind_wather_sirinton = round($json->current->wind_speed);
  $rainfall_wather_sirinton = $json->current->weather[0]->description;

  $date = date("Y-m-d");

  $sql = "SELECT * FROM `val_wather_sirinton` WHERE `date_wather_sirinton` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_wather_sirinton` SET `temp_wather_sirinton` = '$temp', `humidity_wather_sirinton` = '$humidity_wather_sirinton', `MeanSeaLevelPressure_wather_sirinton` = '$MeanSeaLevelPressure_wather_sirinton', `wind_wather_sirinton` = '$wind_wather_sirinton', `rainfall_wather_sirinton` = '$rainfall_wather_sirinton', `land_visibility_wather_sirinton` = '$land_visibility_wather_sirinton' WHERE `date_wather_sirinton` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_wather_sirinton` (`id_wather_sirinton`, `temp_wather_sirinton`, `humidity_wather_sirinton`, `MeanSeaLevelPressure_wather_sirinton`, `wind_wather_sirinton`, `rainfall_wather_sirinton`, `land_visibility_wather_sirinton`, `date_wather_sirinton`)
      VALUES (NULL, '$temp', '$humidity_wather_sirinton', '$MeanSeaLevelPressure_wather_sirinton', '$wind_wather_sirinton', '$rainfall_wather_sirinton', '$land_visibility_wather_sirinton', '$date');";
    $conn->query($sql);
  }
}

function insert_water_ubon1($date, $conn)
{

  $dateTHArray = explode("/", date('d/m/Y'));
  $dateTH = $dateTHArray[0] . '/' . $dateTHArray[1] . '/' . ($dateTHArray[2] + 543);
  $url1 = file_get_contents('data/water_ubon_level_ts16.php');
  $urlData = 'https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=3&dam=PMN&sdate=' . $dateTH;
  $url2 = file_get_contents($urlData);
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  preg_match_all('/<div align=right>  (.*?) /is', $url2, $val2);
  // $num = count($val2[1]) - 1;
  if (count($val2[1]) > 66) {
    $num = count($val2[1]) - 66;
  } else {
    $num = 66 - count($val2[1]);
  }
  $val1 = implode("", $val1[1]);
  // $val2 = 5545;
  $val2 = ($val2[1][$num]);
  $sql = "SELECT * FROM `val_water` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  $amount_water_sql = null;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $amount_water_sql = $row['amount_water'];
    }
  }
  $data1 = $amount_water_sql;
  $data2 = $val2;
  //กรณีปรมาณน้ำหักล้างเกิน 100
  // if (($data1 - $data2) > 100) {
  //   $val3 = $amount_water_sql;
  // } else {
    $val3 = $val2;
  // }
  $level_water = $val1;
  $amount_water = $val3;
  $sql = "SELECT * FROM `val_water` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_water` SET `level_water` = '$level_water', `amount_water` = '$amount_water' WHERE `date` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_water` (`id_water`, `level_water`, `amount_water`, `date`)
    VALUES (NULL, '$level_water', '$amount_water', '$date');";
    $conn->query($sql);
  }
}
function insert_water_ubon2($date, $conn)
{
  $url1 = file_get_contents('data/water_ubon_level_ts17.php');
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  $val1 = implode("", $val1[1]);
  $level_water = $val1;
  $sql = "SELECT * FROM `val_water_mun2` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_water_mun2` SET `level_water_mun2` = '$level_water', `amount_water_mun2` = '0' WHERE `date` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_water_mun2` (`id_water_mun2`, `level_water_mun2`, `amount_water_mun2`, `date`)
    VALUES (NULL, '$level_water', '0', '$date');";
    $conn->query($sql);
  }
}

function insert_water_ubon3($date, $conn)
{
  $url1 = file_get_contents('data/water_ubon_level_ts6.php');
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  $val1 = implode("", $val1[1]);
  $level_water = $val1;
  $sql = "SELECT * FROM `val_water_khong` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_water_khong` SET `level_water` = '$level_water', `amount_water` = '0' WHERE `date` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_water_khong` (`id_water`, `level_water`, `amount_water`, `date`)
    VALUES (NULL, '$level_water', '0', '$date');";
    $conn->query($sql);
  }
}

function insert_water_ubon4($date, $conn)
{
  $url1 = file_get_contents('data/water_ubon_level_ts14.php');
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  $val1 = implode("", $val1[1]);
  $level_water = $val1;
  $sql = "SELECT * FROM `val_water_sirinton` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_water_sirinton` SET `level_water_sirinton` = '$level_water', `amount_water_sirinton` = '0' WHERE `date` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_water_sirinton` (`id_water_sirinton`, `level_water_sirinton`, `amount_water_sirinton`, `date`)
    VALUES (NULL, '$level_water', '0', '$date');";
    $conn->query($sql);
  }
}

function insert_water_ubon5($date, $conn)
{
  $url1 = file_get_contents('data/water_ubon_level_ts7.php');
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  $val1 = implode("", $val1[1]);
  $level_water = $val1;
  $sql = "SELECT * FROM `val_water_lamdom` WHERE `date` = '$date'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sql = "UPDATE `val_water_lamdom` SET `level_water` = '$level_water', `amount_water` = '0' WHERE `date` = '$date';";
      $conn->query($sql);
    }
  } else {
    $sql = "INSERT INTO `val_water_lamdom` (`id_water`, `level_water`, `amount_water`, `date`)
      VALUES (NULL, '$level_water', '0', '$date');";
    $conn->query($sql);
  }
}

// $url2 = file_get_contents('data/water_ubon_level_list.php');
// preg_match_all('/<div align=right>  (.*?) /is', $url2, $val_2);
// $num_see = count($val_2[1])-10;
// $num_khong = count($val_2[1])-6;
// $num_lamdom = count($val_2[1])-5;

// $see = ($val_2[1][$num_see]);
// $khong = ($val_2[1][$num_khong]);
// $lamdom = ($val_2[1][$num_lamdom]);

// $sql = "SELECT * FROM `val_water_see` WHERE `date` = '$date'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     $sql = "UPDATE `val_water_see` SET `level_water` = '$see', `amount_water` = '0' WHERE `date` = '$date';";
//     $conn->query($sql);
//   }
// }else{
//     $sql = "INSERT INTO `val_water_see` (`id_water`, `level_water`, `amount_water`, `date`)
//     VALUES (NULL, '$see', '0', '$date');";
//     $conn->query($sql);
// }

// $sql = "SELECT * FROM `val_water_khong` WHERE `date` = '$date'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     $sql = "UPDATE `val_water_khong` SET `level_water` = '$khong', `amount_water` = '0' WHERE `date` = '$date';";
//     $conn->query($sql);
//   }
// }else{
//     $sql = "INSERT INTO `val_water_khong` (`id_water`, `level_water`, `amount_water`, `date`)
//     VALUES (NULL, '$khong', '0', '$date');";
//     $conn->query($sql);
// }

// $sql = "SELECT * FROM `val_water_lamdom` WHERE `date` = '$date'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     $sql = "UPDATE `val_water_lamdom` SET `level_water` = '$lamdom', `amount_water` = '0' WHERE `date` = '$date';";
//     $conn->query($sql);
//   }
// }else{
//     $sql = "INSERT INTO `val_water_lamdom` (`id_water`, `level_water`, `amount_water`, `date`)
//     VALUES (NULL, '$lamdom', '0', '$date');";
//     $conn->query($sql);
// }
$conn->close();
