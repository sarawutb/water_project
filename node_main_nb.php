<?php
include("connect.php");
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
<h2 class="main-title">รายงานสถิติข้อมูล แม่น้ำมูล เมืองอุบลราชธานี (NB01)</h2>
<!-- <h2 class="main-title">สถานีตรวจวัด อ่างเก็บน้ำห้วยวังนอง(NB01)</h2> -->
  <!-- <div class="row stat-cards">
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon primary">
          <i style='font-size:24px' class='fas'>&#xf773;</i>
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
        <div class="stat-cards-icon warning">
          <i style='font-size:24px' class='fas'>&#xf769;</i>
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
        <div class="stat-cards-icon success">
          <i style='font-size:24px' class='fas'>&#xf72e;</i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$light_nb1?> lux</h1>
          <p class="stat-cards-info__num">ค่าความเข้มแสง</p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon success">
          <i style='font-size:24px' class='fas'>&#xf6c4;</i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$rssi_nb1?> DB</h1>
          <p class="stat-cards-info__num">คลื่นสัญญาณ</p>
        </div>
      </article>
    </div>
  </div> -->

  <article class="white-block">
    <div class="main-nav-start">
            <?php
            date_default_timezone_set("Asia/Bangkok");
            $dm = date("m");
            $y = date("Y");
            $date = $dm."-".$y;
            ?>
          <!-- <div class="main-nav--bg" style="margin :0px 10px;"> -->
          <div class="" style="margin :0px 10px;">
            <label style="margin-left:10px" class="stat-cards-info__num">
                เลือกเดือน/ปี&nbsp;<input onchange="data_history_grap()" value="<?=$date?>" placeholder="ดด/ปปปป" id="datepicker" type="text" class="stat-cards" style="margin:20px 0px;width:170px;"/>
                <!-- &nbsp; เดือน/ปี -->
            </label>
          </div>
        <div class="col-lg-12" id="show_history_grap">
        </div>
    </div>
 </article>


   <script type="text/javascript">
   $("#datepicker").datepicker( {
     autoclose: true,
     language:'th-th',
     format: "mm-yyyy",
     startView: "months",
     minViewMode: "months",
     autoclose: true
   });
   </script>
   <script>
       var m_y_date = document.getElementById("datepicker").value;
       $.ajax({
           url: "data_history_grap_main_nb.php?", //เรียกใช้งานไฟล์นี้
           data: "date="+m_y_date,
           type: "GET",
           async:false,
           success: function(data, status) {
           $("#show_history_grap").html(data);
           },
        });
           function data_history_grap(){
             // submit();
             var m_y_date = document.getElementById("datepicker").value;
             $.ajax({
                 url: "data_history_grap_main_nb.php?", //เรียกใช้งานไฟล์นี้
                 data: "date="+m_y_date,
                 type: "GET",
                 async:true,
                 success: function(data, status) {
                 $("#show_history_grap").html(data);
                 },
              });
           }
   </script>
