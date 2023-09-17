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
        <th style="text-align: center;">ระดับน้ำ ม.</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>ค่าความเข้มแสง	lux</th>
        <th>คลื่นสัญญาณ Db</th>
        <th>จัดการข้อมูล</th>
        <!-- <th>จัดการ</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
				$date_up = $m."-".$y;

        $num = 1;
        $tempNb2 = "-";
                $humidNb2 = "-";
                $lightNb2 = "-";
                $distanceNb2 = "-";
                $rssiNb2 = "-";
                $dateNb2 = "-";
                $sql1 = "SELECT * FROM `val_nb2` WHERE `date_nb2` LIKE '%$y_m_sql%' ORDER BY `val_nb2`.`date_nb2` ASC";
                $result1 = mysqli_query($conn, $sql1);
                while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                  $tempNb2 =  $row1['temp_nb2'];
                  $humidNb2 =  $row1['humid_nb2'];
                  $lightNb2 =  $row1['light_nb2'];
                  $distanceNb2 =  $row1['distance_nb2'];
                  $rssiNb2 =  $row1['rssi_nb2'];
                  $dateNb2 =  $row1['date_nb2'];
                  $date_ex = explode("-", $dateNb2);
                  $day = $date_ex[2];

      ?>
      <tr class="users-table-info">
        <td style="text-align: center;">
          <?=$day;?>
        </td>
        <td style="text-align: center;"><?=$distanceNb2;?></td>
        <td style="text-align: center;"><?=$tempNb2;?></td>
        <td style="text-align: center;"><?=$humidNb2;?></td>
        <td style="text-align: center;"><?=$lightNb2;?></td>
        <td style="text-align: center;"><?=$rssiNb2;?></td>
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
												      <input type="number" name="level_water_Nb2<?=$num?>" value="<?=$distanceNb2;?>"/> <span style="margin-left:100px">ม.(รทก.)</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">อุณหภูมิ</label>
												    <div class="col-sm-10">
												      <input type="number" name="temp_Nb2<?=$num?>" value="<?=$tempNb2;?>"/> <span style="margin-left:100px">°C</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ความชื้น</label>
												    <div class="col-sm-10">
												      <input type="number" name="humidity_Nb2<?=$num?>" value="<?=$humidNb2;?>"/> <span style="margin-left:100px">%</span>
												    </div>
												  </div>
													<br>
												  <div class="form-group row">
												    <label class="col-sm-2 col-form-label">ค่าความเข้มแสง</label>
												    <div class="col-sm-10">
												      <input type="number" name="light_Nb2<?=$num?>" value="<?=$lightNb2;?>"/> <span style="margin-left:100px">lux</span>
												    </div>
												  </div>
													<br>
													<div class="form-group row">
												    <label class="col-sm-2 col-form-label">คลื่นสัญญาณ</label>
												    <div class="col-sm-10">
												      <input type="number" name="rssi_Nb2<?=$num?>" value="<?=$rssiNb2;?>"/> <span style="margin-left:100px">Db</span>
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
				var date_sql = "<?=$dateNb2?>";

				var level_water_Nb2<?=$num?> = document.getElementsByName("level_water_Nb2<?=$num?>")[0].value;
				var temp_Nb2<?=$num?> = document.getElementsByName("temp_Nb2<?=$num?>")[0].value;
				var humidity_Nb2<?=$num?> = document.getElementsByName("humidity_Nb2<?=$num?>")[0].value;
				var light_Nb2<?=$num?> = document.getElementsByName("light_Nb2<?=$num?>")[0].value;
				var rssi_Nb2<?=$num?> = document.getElementsByName("rssi_Nb2<?=$num?>")[0].value;

				modal<?=$num?>.style.display = "none";
				$.ajax({
								url: "manager_sql.php?update_nb2_data", //เรียกใช้งานไฟล์นี้
		 						data: "&level_water_Nb2="+level_water_Nb2<?=$num?>+"&temp_Nb2="+temp_Nb2<?=$num?>+"&humidity_Nb2="+humidity_Nb2<?=$num?>+"&light_Nb2="+light_Nb2<?=$num?>+"&rssi_Nb2="+rssi_Nb2<?=$num?>+"&date="+date_sql,
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
