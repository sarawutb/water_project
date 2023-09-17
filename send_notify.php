<?php
include('connect.php');
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_water` WHERE `date` = '$date'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $level_water = $row['level_water'];
    // $sql = "UPDATE `val_tmd` SET `temp_tmd` = '$temp', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `rainfall_tmd` = '$rainfall_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE `date_tmd` = '$date';";
    // $conn->query($sql);
  }
  if($level_water >= 113.34 && $level_water < 113.84){
  // if($level_water < 113.34){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    $time_nb = date("d-m-y H:i:s");
    $sToken = "pOz45EC2pDB6iS1f0bTWuZKYcH276XU65qB4jFDF3Kq";
    $sMessage = "สถานี M7 แม่น้ำมูล\nระดับน้ำ : $level_water ม.(รทก.)\nอยู่ระดับเตือนภัย\n!!!โปรดเฝ้าระวัง!!!";


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
      echo "status : ".$result_['status']; echo "message : ". $result_['message'];
    }
    curl_close( $chOne );
  }else if($level_water > 113.84){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    $time_nb = date("d-m-y H:i:s");
    $sToken = "pOz45EC2pDB6iS1f0bTWuZKYcH276XU65qB4jFDF3Kq";
    $sMessage = "สถานี M7 แม่น้ำมูล\nระดับน้ำ : $level_water ม.(รทก.)\nอยู่ระดับวิกฤตแล้ว!!!\n!!!โปรดช่วยอพยพบ้านเรือนที่อยู่ในพื้นที่เสียง!!!";


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
      echo "status : ".$result_['status']; echo "message : ". $result_['message'];
    }
    curl_close( $chOne );
  }
}
$conn->close();
?>
