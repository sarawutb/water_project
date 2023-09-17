<?php
include("../connect.php");
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_nb1` WHERE `date_nb1` = '$date'";
              $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $temp_nb1 = $row['temp_nb1'];
                    $humid_nb1 = $row['humid_nb1'];
                    $light_nb1 = $row['light_nb1'];
                    $distance_nb1 = $row['distance_nb1'];
                    $rssi_nb1 = $row['rssi_nb1'];
                    $date_nb1 = $row['date_nb1'];
                  }
                }else{
                  $temp_nb1 = 0;
                  $humid_nb1 = 0;
                  $light_nb1 = 0;
                  $distance_nb1 = 0;
                  $rssi_nb1 = 0;
                  $date_nb1 = 0;
                }
?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <div class="row stat-cards">
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom primary">
        <i style='font-size:50px' class='fas'>&#xf773;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"> <font style="font-size:30px"><?=$distance_nb1?> เมตร</font></h1>
          <p class="stat-cards-info__num">ระดับน้ำจากตลิ่ง</p>
          <p class="stat-cards-info__progress">
            <span class="stat-cards-info__profit success">
              จากอุปกรณ์ IOT
            </span>
          </p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom warning">
        <i style='font-size:50px' class='fas'>&#xf769;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$temp_nb1?> °C</h1>
          <p class="stat-cards-info__num">อุณหภูมิ</p>
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$humid_nb1?> %</h1>
          <p class="stat-cards-info__num">ความชื้น</p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom success">
        <i style='font-size:50px' class='fas'>&#xf72e;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$light_nb1?> lux</h1>
          <p class="stat-cards-info__num">ค่าความเข้มแสง</p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom success">
        <i style='font-size:50px' class='fas'>&#xf6c4;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$rssi_nb1?> DB</h1>
          <p class="stat-cards-info__num">คลื่นสัญญาณ</p>
        </div>
      </article>
    </div>
  </div>

