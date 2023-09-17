<?php
include("../connect.php");
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$sql = "SELECT * FROM `val_nb2` WHERE date_nb2 = '$date' ORDER BY `val_nb2`.`id` ASC";
            $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  $temp_nb2 =  $row['temp_nb2'];
                  $humid_nb2 =  $row['humid_nb2'];
                  $light_nb2 =  $row['light_nb2'];
                  $distance_nb2 =  $row['distance_nb2'];
                  $rssi_nb2 =  $row['rssi_nb2'];
                  $date_nb2 =  $row['date_nb2'];
  }
?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<h2 class="main-title">รายงานสถิติข้อมูล NB01 จ.อุบลราชธานี</h2>
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
           url: "node_nb/node_data_history_grap2.php?", //เรียกใช้งานไฟล์นี้
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
                 url: "node_nb/node_data_history_grap2.php?", //เรียกใช้งานไฟล์นี้
                 data: "date="+m_y_date,
                 type: "GET",
                 async:true,
                 success: function(data, status) {
                 $("#show_history_grap").html(data);
                 },
              });
           }
   </script>
