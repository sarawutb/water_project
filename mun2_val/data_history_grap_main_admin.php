<?php
include("../connect.php");
$date = $_GET['date'];
$date_ex = explode("-",$date);
// print_r($date_ex);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y."-".$m;

$m_y_js = $m."-".$y;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.2s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 6px 16px 20px 16px;
  /* background-color: #5cb85c; */
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
</head>
<body>
<div class="users-table table-wrapper" id="update" style="width: 100%;height: 500px;overflow: auto;">
  <table class="posts-table">
    <thead>
      <tr class="users-table-info">
        <!-- <th>
          <label class="users-table__checkbox ms-20">
            <input type="checkbox" class="check-all">
          </label>
        </th> -->
        <th style="text-align: center;">วันที่</th>
        <th style="text-align: center;">ระดับน้ำ ม.(รทก.)</th>
        <!-- <th style="text-align: center;">ระดับน้ำ(2) ม.(รทก.)</th> -->
        <th style="text-align: center;">ปริมาณน้ำ ลบ.ม./ว</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>แรงลม กม/ชม</th>
        <th>ทัศนวิสัย กิโลเมตร</th>
        <th>ความกดอากาศ hPa</th>
        <th>จัดการข้อมูล</th>
        <!-- <th>จัดการ</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
				$date_up = $m."-".$y;

        $num = 1;
        $temp_wather_mun2 = "-";
        $humidity_wather_mun2 = "-";
        $wind_wather_mun2 = "-";
        $date_wather_mun2 = "-";
        $MeanSeaLevelPressure_wather_mun2 = "-";
        $rainfall_wather_mun2 = "-";
        $land_visibility_wather_mun2 = "-";
        $sql = "SELECT * FROM `val_water_mun2` LEFT JOIN val_wather_mun2 on val_water_mun2.date = val_wather_mun2.date_wather_mun2 WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water_mun2`.`date` ASC;";
                      $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $id_water_mun2 =  $row['id_water_mun2'];
                            $level_water_mun2 =  $row['level_water_mun2'];
                            $amount_water_mun2 =  $row['amount_water_mun2'];
                            $date_water_mun2 =  $row['date'];

                            $date_ex = explode("-", $date_water_mun2);
                            $day = $date_ex[2];

                            $id_wather_mun2 =  $row['id_wather_mun2'];
														$temp_wather_mun2 =  $row['temp_wather_mun2'];
														$humidity_wather_mun2 =  $row['humidity_wather_mun2'];
														$wind_wather_mun2 =  $row['wind_wather_mun2'];
														$date_wather_mun2 =  $row['date_wather_mun2'];
														$MeanSeaLevelPressure_wather_mun2 =  $row['MeanSeaLevelPressure_wather_mun2'];
														$rainfall_wather_mun2 =  $row['rainfall_wather_mun2'];
														$land_visibility_wather_mun2 =  $row['land_visibility_wather_mun2'];

      ?>
      <tr class="users-table-info">
        <td style="text-align: center;">
          <?=$day;?>
        </td>
        <td style="text-align: center;"><?=$level_water_mun2;?></td>
        <td style="text-align: center;"><?=$amount_water_mun2;?></td>
        <td style="text-align: center;"><?=$temp_wather_mun2;?></td>
        <td style="text-align: center;"><?=$humidity_wather_mun2;?></td>
        <td style="text-align: center;"><?=$wind_wather_mun2;?></td>
				<td style="text-align: center;"><?=$land_visibility_wather_mun2;?></td>
        <td style="text-align: center;"><?=$MeanSeaLevelPressure_wather_mun2;?></td>
        <!-- <td><button style="border-radius: 5px;padding:4px 8px;background-color:#e69900" type="button"><p style="font-size:13px" class="stat-cards-info__num">แก้ไข</p></button></td> -->
        <td><button id="myBtn<?=$num?>" class="badge-active" type="button">แก้ไข</button></td>
      </tr>
			<div id="myModal<?=$num?>" class="modal">
			  <!-- Modal content -->
			  <div class="main users chart-page">
			      <div class="container">
			        <div class="row">
			          <div class="col-lg-2">
								</div>
			          <div class="col-lg-10">
			            <article class="white-block">
									    <div class="modal-header">
												<span style="color:gray" id="close_header<?=$num?>" class="close">&times;</span>
												<h3 class="stat-cards-info__num" style="font-size:25px">แก้ไขข้อมูล วันที่ <?=$day+0?>/<?=$m+0?>/<?=$y+543?></h3>
									    </div>
											<div class="modal-body">
												<form>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ระดับน้ำ</label>
												    <div class="col-sm-10">
												      <input type="number" name="level_water<?=$num?>" value="<?=$level_water_mun2;?>"/> <span style="margin-left:100px">ม.(รทก.)</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ปริมาณน้ำ</label>
												    <div class="col-sm-10">
												      <input type="number" name="amount_water<?=$num?>" value="<?=$amount_water_mun2;?>"/> <span style="margin-left:100px">ลบ.ม./ว</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">อุณหภูมิ</label>
												    <div class="col-sm-10">
												      <input type="number" name="temp_wather_mun2<?=$num?>" value="<?=$temp_wather_mun2;?>"/> <span style="margin-left:100px">°C</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ความชื้น</label>
												    <div class="col-sm-10">
												      <input type="number" name="humidity_wather_mun2<?=$num?>" value="<?=$humidity_wather_mun2;?>"/> <span style="margin-left:100px">%</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">แรงลม</label>
												    <div class="col-sm-10">
												      <input type="number" name="wind_wather_mun2<?=$num?>" value="<?=$wind_wather_mun2;?>"/> <span style="margin-left:100px">กม/ชม</span>
												    </div>
												  </div>
													<br>
													<div class="form-group row">
												    <label class="col-sm-2 col-form-label">ทัศนวิสัย</label>
												    <div class="col-sm-10">
												      <input type="number" name="land_visibility_wather_mun2<?=$num?>" value="<?=$land_visibility_wather_mun2;?>"/> <span style="margin-left:100px">กิโลเมตร</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ความกดอากาศ</label>
												    <div class="col-sm-10">
												      <input type="number" name="MeanSeaLevelPressure_wather_mun2<?=$num?>" value="<?=$MeanSeaLevelPressure_wather_mun2;?>"/> <span style="margin-left:100px">hPa</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label"></label>
												    <div class="col-sm-10">
															<button style="padding:10px;float:left" class="badge-active" onclick="updateData<?=$num?>()" type="button"><h3 class="stat-cards-info__num" style="font-size:15px">ตกลง</h3></button>
															<button style="padding:10px;float:left;margin-left:5px" class="badge-pending" id="close<?=$num?>" type="button"><h3 class="stat-cards-info__num" style="font-size:15px">ยกเลิก</h3></button>
												    </div>
												  </div>
												</form>
									    </div>
									</article>
			  			</div>
			  		</div>
			  	</div>
				</div>
			</div>
			<script>
			// var date =
			<?php 
			$path = substr($_SERVER['PHP_SELF'] . "/", 15, -1);
			?>
			function updateData<?=$num?>(){
				var date_up = "<?=$m_y_js?>";
				var date_sql = "<?=$date_water_mun2?>";

				var level_water<?=$num?> = document.getElementsByName("level_water<?=$num?>")[0].value;
				var amount_water<?=$num?> = document.getElementsByName("amount_water<?=$num?>")[0].value;

				var temp_wather_mun2<?=$num?> = document.getElementsByName("temp_wather_mun2<?=$num?>")[0].value;
				var humidity_wather_mun2<?=$num?> = document.getElementsByName("humidity_wather_mun2<?=$num?>")[0].value;
				var wind_wather_mun2<?=$num?> = document.getElementsByName("wind_wather_mun2<?=$num?>")[0].value;
				var land_visibility_wather_mun2<?=$num?> = document.getElementsByName("land_visibility_wather_mun2<?=$num?>")[0].value;
				var MeanSeaLevelPressure_wather_mun2<?=$num?> = document.getElementsByName("MeanSeaLevelPressure_wather_mun2<?=$num?>")[0].value;

				modal<?=$num?>.style.display = "none";
				$.ajax({
								url: "manager_sql.php?update3_data", //เรียกใช้งานไฟล์นี้
		 						data: "&level_water="+level_water<?=$num?>+"&amount_water="+amount_water<?=$num?>+"&temp_wather_mun2="+temp_wather_mun2<?=$num?>+"&humidity_wather_mun2="+humidity_wather_mun2<?=$num?>+"&wind_wather_mun2="+wind_wather_mun2<?=$num?>+"&land_visibility_wather_mun2="+land_visibility_wather_mun2<?=$num?>+"&MeanSeaLevelPressure_wather_mun2="+MeanSeaLevelPressure_wather_mun2<?=$num?>+"&date="+date_sql,
		 						type: "GET",
		 						async:false,
								success: function(data, status) {
									$.ajax({
													// url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
							 						// data: "date="+date_up,
													url: "<?=$path?>?", //เรียกใช้งานไฟล์นี้
							 						data: "date="+date_up,
							 						type: "GET",
							 						async:false,
							 						success: function(data, status) {
							 						$("#update").html(data);
							 						},
									 			});
								},
				 			});
			}
		 // Get the modal
		 var modal<?=$num?> = document.getElementById("myModal<?=$num?>");
		 var btn = document.getElementById("myBtn<?=$num?>");
		 var btn_close = document.getElementById("close<?=$num?>");
		 var span = document.getElementById("close_header<?=$num?>");
		 btn.onclick = function() {
		   modal<?=$num?>.style.display = "block";
		 }
		 btn_close.onclick = function() {
		   modal<?=$num?>.style.display = "none";
		 }
		 span.onclick = function() {
		   modal<?=$num?>.style.display = "none";
		 }
		 // window.onclick = function(event<?=$num?>) {
		 //   if (event<?=$num?>.target == modal<?=$num?>) {
		 //     modal<?=$num?>.style.display = "none";
			// 	 console.log(<?=$num?>);
		 //   }
		 // }
		 </script>
      <?php $num++;} ?>
    </tbody>
  </table>
  </div>

 <!-- <button>Open Modal</button> -->

<!-- The Modal -->



</body>
</html>
