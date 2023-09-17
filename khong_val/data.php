<?php
include("../connect.php");
error_reporting(0);
session_start();

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_wather_khong` WHERE date_tmd = '$date' ORDER BY `val_wather_khong`.`id_tmd` ASC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $temp_tmd =  $row['temp_tmd'];
  $humidity_tmd =  $row['humidity_tmd'];
  $wind_tmd =  $row['wind_tmd'];
  $date_tmd =  $row['date_tmd'];
  $MeanSeaLevelPressure_tmd =  $row['MeanSeaLevelPressure_tmd'];
  $rainfall_tmd =  $row['rainfall_tmd'];
  $land_visibility_tmd =  $row['land_visibility_tmd'];
}
$sql = "SELECT * FROM `val_water_khong` WHERE date = '$date' ORDER BY `val_water_khong`.`id_water` ASC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $level_water =  $row['level_water'];
  $amount_water =  $row['amount_water'];
  $amount_water_map =  $row['amount_water'];
}

?>
<div class="row stat-cards">
  <div class="col-md-6 col-xl-3">
    <article class="stat-cards-item">
      <div class="col-md-12 col-12 stat-cards-icon-custom primary">
        <i style='font-size:50px' class='fas'>&#xf773;</i>
      </div>
      <div class="stat-cards-info">
        <p class="stat-cards-info__progress" style="margin-bottom: 5px;">
          <span class="stat-cards-info__profit danger" style="font-size:18px;">
            <?php
            // $path = substr($_SERVER['PHP_SELF'] . "/", 15, -1);
            $path = substr($_SERVER['PHP_SELF'] . "/", 1, -1);
            $sql = "SELECT * FROM `list_water` WHERE water_path = '$path'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $level_water_max1 = $row["level_water_max1"];
              $level_water_max2 = $row["level_water_max2"];
            }
            ?>
            ระดับวิกฤต <?= $level_water_max2 ?> <b style="font-size:15px;">&nbsp; ม.(รทก.)</b>
          </span>
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $level_water; ?> <font style="font-size:20px">ม.(รทก.)</font>
        </h1>
        </p>
        <p class="stat-cards-info__num" style="margin-bottom:5px">ระดับน้ำล่าสุด</p>
        <!-- <p style="margin-top:10px"></p>
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $amount_water; ?> <font style="font-size:15px">ลบ.ม./ว</font></h1>
        <p class="stat-cards-info__num">ปริมาณน้ำล่าสุด</p> -->
        <!-- <p class="stat-cards-info__progress">
          <span class="stat-cards-info__profit success">
            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
          </span>
          Last month
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
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $temp_tmd; ?> °C</h1>
        <p class="stat-cards-info__progress">
          <?php
          if ($temp_tmd >= 29) {
            echo '<span class="stat-cards-info__profit danger"><i data-feather="sun" aria-hidden="true"></i>';
          } else if ($temp_tmd >= 23 && $temp_tmd <= 28.9) {
            echo '<span class="stat-cards-info__profit success"><i data-feather="cloud" aria-hidden="true"></i>';
          } else {
            echo '<span class="stat-cards-info__profit primary" style="color:#3399ff;"><i data-feather="trending-up" aria-hidden="true"></i>';
          }
          if ($temp_tmd >= 40) {
            echo "อากาศร้อนจัด";
          } else if ($temp_tmd >= 35 && $temp_tmd <= 39.9) {
            echo "อากาศร้อน";
          } else if ($temp_tmd >= 29 && $temp_tmd <= 34.9) {
            echo "อากาศค่อนข้างร้อน";
          } else if ($temp_tmd >= 23 && $temp_tmd <= 28.9) {
            echo "อากาศปกติ";
          } else if ($temp_tmd >= 18 && $temp_tmd <= 22.9) {
            echo "อากาศเย็น";
          } else if ($temp_tmd >= 16 && $temp_tmd <= 17.9) {
            echo "อากาศค่อนข้างหนาว";
          } else if ($temp_tmd >= 8 && $temp_tmd <= 15.9) {
            echo "อากาศหนาว";
          } else if ($temp_tmd < 8) {
            echo "อากาศหนาวจัด";
          }
          ?>
          </span>
        </p>
        <p class="stat-cards-info__num">อุณหภูมิ</p>
        <p style="margin-top:10px"></p>
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $humidity_tmd; ?> %</h1>
        <p class="stat-cards-info__num">ความชื้น</p>
        <!-- <h1 class="stat-cards-info__num" style="font-size:30px"><?= $humidity_tmd; ?> %</h1>
        <p class="stat-cards-info__num">ความชื้น</p> -->

      </div>
    </article>
  </div>
  <div class="col-md-6 col-xl-3">
    <article class="stat-cards-item">
      <div class="col-md-12 col-12 stat-cards-icon-custom purple">
        <i style='font-size:50px' class='fas'>&#xf72e;</i>
      </div>
      <div class="stat-cards-info">
        <?php
        // if($wind_tmd <= 0){
        //   $wind_tmd = "ลมสงบ";
        // }else{
        // $wind_tmd = $wind_tmd." กม/ชม";
        // }
        ?>
        <?php
        $wind_tmd = $wind_tmd . " กม/ชม";
        ?>
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $wind_tmd; ?> </h1>
        <p <?php
            if ($wind_tmd <= 0) {
              echo "hidden";
            }
            ?> class="stat-cards-info__num">แรงลม</p>
        <p class="stat-cards-info__progress">
          <span class="stat-cards-info__profit success">
            <?php
            if ($wind_tmd <= 0) {
              $wind_tmd_val = "ลมสงบ";
            } else if ($wind_tmd_val <= 10) {
              $wind_tmd_val = "ลมอ่อน";
            } else if ($wind_tmd > 10) {
              $wind_tmd_val = "ลมแรง";
            }
            echo $wind_tmd_val;
            ?>
          </span>
        </p>
        <p style="margin-top:10px"></p>
        <!-- <p class="stat-cards-info__progress">
          ทัศนวิสัย&nbsp;
            <span class="stat-cards-info__profit success">
               <?= $land_visibility_tmd; ?> กิโลเมตร
            </span>
        </p> -->
        <h1 class="stat-cards-info__num" style="font-size:30px"><?= $land_visibility_tmd; ?> กิโลเมตร</h1>
        <p class="stat-cards-info__num">ทัศนวิสัยการมองเห็น</p>
      </div>
    </article>
  </div>
  <div class="col-md-6 col-xl-3">
    <article class="stat-cards-item">
      <div class="col-md-12 col-12 stat-cards-icon-custom success">
        <i style='font-size:50px' class='fas'>&#xf6c4;</i>
      </div>
      <div class="stat-cards-info">
        <p class="stat-cards-info__num" style="font-size:30px"><?= $MeanSeaLevelPressure_tmd; ?> hPa</p>
        <p class="stat-cards-info__progress">
          <span class="stat-cards-info__profit primary" style="color:#0073e6;">
            <!-- <p > -->
            <?= "มี" . $rainfall_tmd; ?>
            <!-- </p> -->
          </span>
        </p>
        <p class="stat-cards-info__num">ความกดอากาศ</p>
        <!-- <p class="stat-cards-info__progress">
          <span class="stat-cards-info__profit warning">
            <i data-feather="trending-up" aria-hidden="true"></i>0.00%
          </span>
          Last month
        </p> -->
        <!-- <p class="stat-cards-info__progress">
          <h1 class="stat-cards-info__num" style="font-size:25px;color:#0073e6;"><?= $rainfall_tmd; ?> </h1>
          <p
          class="stat-cards-info__num">สภาพอากาศ</p>
        </p> -->
      </div>
    </article>
  </div>
</div>