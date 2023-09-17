<?php
include("../connect.php");
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_nb2` WHERE `date_nb2` = '$date'";
              $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $temp_nb2 = $row['temp_nb2'];
                    $humid_nb2 = $row['humid_nb2'];
                    $light_nb2 = $row['light_nb2'];
                    $distance_nb2 = $row['distance_nb2'];
                    $rssi_nb2 = $row['rssi_nb2'];
                    $date_nb2 = $row['date_nb2'];
                  }
                }else{
                  $temp_nb2 = 0;
                  $humid_nb2 = 0;
                  $light_nb2 = 0;
                  $distance_nb2 = 0;
                  $rssi_nb2 = 0;
                  $date_nb2 = 0;
                }
?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- <h2 class="main-title">สถานีตรวจวัด อ่างเก็บน้ำห้วยวังนอง(NB01)</h2> -->
  <div class="row stat-cards">
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom primary">
        <i style='font-size:50px' class='fas'>&#xf773;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"> <font style="font-size:30px"><?=$distance_nb2?> เมตร</font></h1>
          <p class="stat-cards-info__num">ระดับน้ำจากตลิ่ง</p>
          <p class="stat-cards-info__progress">
            <span class="stat-cards-info__profit success">
              <!-- <i data-feather="trending-up" aria-hidden="true"></i> -->
              จากอุปกรณ์ IOT
            </span>
          </p>
          <!-- <h1 class="stat-cards-info__num" style="font-size:30px"> <font style="font-size:30px">98</font><font style="font-size:15px"> ลบ.ม./ว</font></h1>
          <p class="stat-cards-info__num">ปริมาณน้ำ</p> -->
          <!-- <p class="stat-cards-info__progress">
            <span class="stat-cards-info__profit success">
              จากอุปกรณ์ nb-IOT
            </span>
          </p> -->
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom warning">
        <i style='font-size:50px' class='fas'>&#xf769;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$temp_nb2?> °C</h1>
          <p class="stat-cards-info__num">อุณหภูมิ</p>
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$humid_nb2?> %</h1>
          <p class="stat-cards-info__num">ความชื้น</p>
          <!-- <p class="stat-cards-info__progress">
            <span class="stat-cards-info__profit success">
              <i data-feather="trending-up" aria-hidden="true"></i>0.24%
            </span>
            Last month
          </p> -->
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom success">
        <i style='font-size:50px' class='fas'>&#xf72e;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$light_nb2?> lux</h1>
          <p class="stat-cards-info__num">ค่าความเข้มแสง</p>
          <!-- <p class="stat-cards-info__progress">
            <span class="stat-cards-info__profit success">
              <i data-feather="trending-up" aria-hidden="true"></i>0.24%
            </span>
            Last month
          </p> -->
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="col-md-12 col-12 stat-cards-icon-custom success">
        <i style='font-size:50px' class='fas'>&#xf6c4;</i>
      </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$rssi_nb2?> DB</h1>
          <p class="stat-cards-info__num">คลื่นสัญญาณ</p>
        </div>
      </article>
    </div>
    <!-- <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon warning">
          <i data-feather="sun" aria-hidden="true"></i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"> lux</h1>
          <p class="stat-cards-info__num">ค่าความเข้มแสง</p>
        </div>
      </article>
    </div> -->
    <!-- <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon success">
          <i data-feather="rss" aria-hidden="true"></i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px">  DB</h1>
          <p class="stat-cards-info__num">คลื่นสัญญาณ</p>
        </div>
      </article>
    </div> -->
  </div>
