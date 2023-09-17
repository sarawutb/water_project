<?php
include("../connect.php");
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_water_mun2` WHERE date = '$date' ORDER BY `val_water_mun2`.`id_water_mun2` ASC";
            $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  $level_water =  $row['level_water_mun2'];
                  $amount_water =  $row['amount_water_mun2'];
                  $amount_water_map =  $row['amount_water_mun2'];
  }
  $sql = "SELECT * FROM `val_wather_mun2` WHERE `date_wather_mun2` = '$date' ORDER BY `val_wather_mun2`.`date_wather_mun2` ASC";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $temp_wather_mun2 =	$row["temp_wather_mun2"];
          $humidity_wather_mun2 =	$row["humidity_wather_mun2"];
          $wind_wather_mun2 =	$row["wind_wather_mun2"];
          $land_visibility_wather_mun2 =	$row["land_visibility_wather_mun2"];
          $MeanSeaLevelPressure_wather_mun2 =	$row["MeanSeaLevelPressure_wather_mun2"];
        }
      }
?>
<!-- <link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.th.js"></script> -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<h2 class="main-title">รายงานสถิติข้อมูล หน้าเขื่อนปากมูล จ.อุบลราชธานี</h2>
<!-- <h2 class="main-title">สถานีตรวจวัด อ่างเก็บน้ำห้วยวังนอง(NB01)</h2> -->
  <!-- <div hidden class="row stat-cards">
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon primary">
          <i style='font-size:24px' class='fas'>&#xf773;</i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"> <font style="font-size:30px"><?=$level_water?></font><font style="font-size:15px"> ม.(รทก.)</font></h1>
          <p class="stat-cards-info__num">ระดับน้ำ</p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon warning">
          <i style='font-size:24px' class='fas'>&#xf769;</i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$temp_mun2?> °C</h1>
          <p class="stat-cards-info__num">อุณหภูมิ</p>
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$humidity_mun2?> %</h1>
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
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$wind_mun2?> กม/ชม</h1>
          <p class="stat-cards-info__num">แรงลม</p>
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$land_visibility_mun2?> กิโลเมตร</h1>
          <p class="stat-cards-info__num">ทัศนวิสัยการมองเห็น</p>
        </div>
      </article>
    </div>
    <div class="col-md-6 col-xl-3">
      <article class="stat-cards-item">
        <div class="stat-cards-icon success">
          <i style='font-size:24px' class='fas'>&#xf6c4;</i>
        </div>
        <div class="stat-cards-info">
          <h1 class="stat-cards-info__num" style="font-size:30px"><?=$MeanSeaLevelPressure_mun2?> hPa</h1>
          <p class="stat-cards-info__num">ความกดอากาศ</p>
        </div>
      </article>
    </div> -->
  </div>
  <!-- <div id="show_main">
  </div> -->
  <article class="white-block">
    <div class="main-nav-start">
            <?php
            date_default_timezone_set("Asia/Bangkok");
            $dm = date("m");
            $y = date("Y");
            $date = $dm."-".$y;
            ?>
          <div class="" style="margin :0px 10px;">
            <label style="margin-left:10px" class="stat-cards-info__num">
                เลือกเดือน/ปี&nbsp;<input onchange="data_history_grap()" value="<?=$date?>" placeholder="ดด/ปปปป" id="datepicker" type="text" class="stat-cards" style="margin:20px 0px;width:170px;"/>
                &nbsp; เดือน/ปี
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
           url: "mun2_val/data_history_grap_main.php?", //เรียกใช้งานไฟล์นี้
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
                 url: "mun2_val/data_history_grap_main.php?", //เรียกใช้งานไฟล์นี้
                 data: "date="+m_y_date,
                 type: "GET",
                 async:true,
                 success: function(data, status) {
                 $("#show_history_grap").html(data);
                 },
              });
           }
   </script>
