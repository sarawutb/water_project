<?php
include('connect.php');
date_default_timezone_set("Asia/Bangkok");
//TMDData_API
$temp = $_GET['temp_tmd'];
$humidity_tmd = $_GET['humidity_tmd'];
$wind_tmd = $_GET['wind_tmd'];
$MeanSeaLevelPressure_tmd = $_GET['MeanSeaLevelPressure_tmd'];
$rainfall_tmd = $_GET['rainfall_tmd'];
$land_visibility_tmd = $_GET['land_visibility_tmd'];
$date = date("Y-m-d");

$sql = "SELECT * FROM `val_tmd` WHERE `date_tmd` = '$date'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql = "UPDATE `val_tmd` SET `temp_tmd` = '$temp', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `rainfall_tmd` = '$rainfall_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE `date_tmd` = '$date';";
    $conn->query($sql);
  }
}
else{
    $sql = "INSERT INTO `val_tmd` (`id_tmd`, `temp_tmd`, `humidity_tmd`, `MeanSeaLevelPressure_tmd`, `wind_tmd`, `rainfall_tmd`, `land_visibility_tmd`, `date_tmd`)
    VALUES (NULL, '$temp', '$humidity_tmd', '$MeanSeaLevelPressure_tmd', '$wind_tmd', '$rainfall_tmd', '$land_visibility_tmd', '$date');";
    $conn->query($sql);
}

$amount_water = $_GET['amount_water'];
$level_water = $_GET['level_water'];
$sql = "SELECT * FROM `val_water` WHERE `date` = '$date'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql = "UPDATE `val_water` SET `level_water` = '$level_water', `amount_water` = '$amount_water' WHERE `date` = '$date';";
    $conn->query($sql);
  }
}else{
    $sql = "INSERT INTO `val_water` (`id_water`, `level_water`, `amount_water`, `date`)
    VALUES (NULL, '$level_water', '$amount_water', '$date');";
    $conn->query($sql);
}


$conn->close();
?>
