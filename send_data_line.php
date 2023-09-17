<?php
include('connect.php');
date_default_timezone_set("Asia/Bangkok");
header('Content-Type: application/json;charset=utf-8');
get_include_path();
$urljson = file_get_contents('data/openweathermap.json');
$json = $urljson;

$Temperature = null;
$MeanSeaLevelPressure = null;
$RelativeHumidity = null;
$LandVisibility = null;
$WindSpeed = null;
$Rainfall = null;

$json = json_decode($json);

$temp = $json->current->temp;
$temp = number_format($temp, 1, '.', '');
$MeanSeaLevelPressure_tmd = round($json->current->pressure);
$humidity_tmd = round($json->current->humidity);
$land_visibility_tmd = round(($json->current->visibility)/1000);
$wind_tmd = round($json->current->wind_speed);
$rainfall_tmd = $json->current->weather[0]->description;

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

$url1 = file_get_contents('./data/water_ubon_level.php');
$url2 = file_get_contents('./data/water_ubon_amount.php');
preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
preg_match_all('/<div align=right>  (.*?) /is', $url2, $val2);
$num = count($val2[1])-1;
$val1 = implode("",$val1[1]);
$val2 = ($val2[1][$num]);

$level_water = $val1;
$amount_water = $val2;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
$time_nb = date("d-m-y H:i:s");
$sToken = "pOz45EC2pDB6iS1f0bTWuZKYcH276XU65qB4jFDF3Kq";
$sMessage = "สถานี M7 แม่น้ำมูล\nระดับน้ำ : $level_water ม.(รทก.)\nปริมาณน้ำ : $amount_water ลบ.ม./ว\nอุณหภูมิ : $temp °C \nความชื้น : $humidity_tmd เปอร์เซ็นต์";


$chOne = curl_init();
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $chOne, CURLOPT_POST, 1);
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage);
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $chOne );

//Result error
if(curl_error($chOne))
{
  echo 'error:' . curl_error($chOne);
}
else {
  $result_ = json_decode($result, true);
  //echo "status : ".$result_['status']; 
  //echo "message : ". $result_['message'];
  $json = array(
    "stasus" => $result_['status'],
    "message" => $sMessage
  );
  echo(json_encode($json));
}
curl_close( $chOne );


$conn->close();
?>
