<?php
include("connect.php");
error_reporting(0);
$max_m = null;
$maxl_m = null;
$sql4 = "SELECT * FROM `val_water`";
$result4 = mysqli_query($conn, $sql4);
while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
	// $max_m =  $row4['amount_water'];
	if ($row4['amount_water'] > $max_m) {
		$max_m = $row4['amount_water'];
	}
	// $maxl_m =  $row4['level_water'];
	if ($row4['level_water'] > $maxl_m) {
		$maxl_m = $row4['level_water'];
	}
}
$result_amount_water = null;
$result_level_water = null;
$arr_amount_water = null;
$arr_level_water = null;
$amount_water_max_m_sql = null;
$amount_level_water_m_sql = null;
$sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	$date_y =  $row1['date_y'];
	$result_amount_water = "";
	$result_level_water = "";
	// $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
	$sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
	$result2 = mysqli_query($conn, $sql2);
	while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

		$date_m =  $row2['date_m'];
		$zero_num = 2; //จำนวนหลัก
		$date_m = sprintf("%0" . $zero_num . "d", $date_m);
		$sql3 = "SELECT MAX(`level_water`) as amount_level_water_m , MAX(`amount_water`) as amount_water_max_m FROM val_water WHERE `date` LIKE '%$date_y-$date_m%'";
		$result3 = mysqli_query($conn, $sql3);
		while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			$amount_water_max_m_sql = $row3['amount_water_max_m'];
			$amount_level_water_m_sql = $row3['amount_level_water_m'];

			if ($amount_water_max_m_sql == "-") {
				$amount_water_max_m_sql = 0;
			}

			if ($amount_level_water_m_sql == "-") {
				$amount_level_water_m_sql = 0;
			}

			$amount_water_max_m =  $amount_water_max_m_sql . ",";
			$amount_level_water_m =  $amount_level_water_m_sql . ",";
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			$color = '#1a8' . $rand[rand(0, 15)] . 'ff';
			//	    echo $color;
		}
		$result_amount_water = $amount_water_max_m . $result_amount_water;
		$result_level_water = $amount_level_water_m . $result_level_water;
	}
	$arr_amount = explode(",", $result_amount_water);
	array_pop($arr_amount);
	$result_amount_water = implode(",", $arr_amount);
	$arr_amount_water = $arr_amount_water . $result_amount_water . "|";

	$arr_level = explode(",", $result_level_water);
	array_pop($arr_level);
	$result_level_water = implode(",", $arr_level);
	$arr_level_water = $arr_level_water . $result_level_water . "|";
	// print_r($arr_level_water);
}

session_start();
// if ($_SESSION['id_user']) {

//   $id_user = $_SESSION["id_user"];
//   $email_user = $_SESSION["email_user"];
//   $status_user = $_SESSION["status_user"];
//   $id_session = $_SESSION["id_session"];
//echo $status;

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");

// $sql = "SELECT * FROM `user_water` WHERE id_user = $id_user";
//                 $result = mysqli_query($conn, $sql);
//                 while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
//                     $name_user =  $row['name_user'];
//                     $email_user =  $row['email_user'];
// 			}
$sql = "SELECT * FROM `val_tmd` WHERE date_tmd = '$date' ORDER BY `val_tmd`.`id_tmd` ASC";
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
$sql = "SELECT * FROM `val_water` WHERE date = '$date' ORDER BY `val_water`.`id_water` ASC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$level_water =  $row['level_water'];
	$amount_water =  $row['amount_water'];
	$amount_water_map =  $row['amount_water'];
}
$sql = "SELECT * FROM `val_nb1` WHERE `date_nb1` = '$date' ORDER BY `val_nb1`.`date_nb1` ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$temp_nb1 =	$row["temp_nb1"];
		$humid_nb1 =	$row["humid_nb1"];
		$light_nb1 =	$row["light_nb1"];
		$distance_nb1 =	$row["distance_nb1"];
		$rssi_nb1 =	$row["rssi_nb1"];
	}
}

// $result_amount_water = "";

//echo  $data_id;
// }else {
// session_destroy();
//   header("location:login.php");
// }

//water
$url1 = file_get_contents('data/water_ubon_level.php');
$url2 = file_get_contents('data/water_ubon_amount.php');
preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
preg_match_all('/<div align=right>  (.*?) /is', $url2, $val2);
$num = count($val2[1]) - 1;
// echo $num;
// print_r($num);
$val1 = implode("", $val1[1]);
$val2 = ($val2[1][$num]);
// echo $val1;
// echo "<br>";
// echo $val2;


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UBONWLM</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
	<!-- Custom styles -->
	<link rel="stylesheet" href="./css/style.css">
	<!-- <script src="js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script> -->
	<!-- <script type="text/javascript" src="js/d_y.js"></script> -->
	<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.th.js"></script>
	<script src='js/fa-icon.js' crossorigin='anonymous'></script>
</head>
<style>
	#map {
		width: 100%;
		height: 600px;
	}

	/* @media only screen and (max-width: 400px) {
		#myChart {
			height: 1000px;
		} */
</style>

<body>
	<!-- ! Body -->
	<div class="page-flex">
		<!-- ! Sidebar -->
		<?php require './sidebar.php'; ?>
		<br>
		<div class="main-wrapper">
			<!-- ! Main nav -->
			<nav class="main-nav--bg">
				<div class="container main-nav">
					<div class="main-nav-start">
						<!-- <h1>อุบลราชธานี</h1> -->
						<!-- <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input readonly type="text"required>อุบลราชธานี</input>
      </div> -->
					</div>
					<div class="main-nav-end">
						<button class="sidebar-toggle transparent-btn" title="Menu" type="button">
							<span class="sr-only">Toggle menu</span>
							<span class="icon menu-toggle--gray" aria-hidden="true"></span>
						</button>
						<!-- <div class="lang-switcher-wrapper">
        <button class="lang-switcher transparent-btn" type="button">
          EN
          <i data-feather="chevron-down" aria-hidden="true"></i>
        </button>
        <ul class="lang-menu dropdown">
          <li><a href="##">English</a></li>
          <li><a href="##">French</a></li>
          <li><a href="##">Uzbek</a></li>
        </ul>
      </div> -->
						<div class="notification-wrapper">
							<!-- <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
          <span class="sr-only">To messages</span>
          <span class="icon notification active" aria-hidden="true"></span>
        </button> -->
							<button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
								<span class="sr-only">เปลี่ยนธีม</span>
								<i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
								<i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>
			</nav>
			<!-- ! Main -->
			<main class="main users chart-page" id="skip-target">
				<div class="container">
					<!-- <h2 class="main-title">สถานีตรวจวัด แม่น้ำมูล(M.7)</h2> -->
					<div class="select">
						<select id="my_node" onchange="select_node()">
							<?php
							$data_name_list = [];
							$data_name_list_water = [];
							$data_name_list_device = [];
							$data_path_list = [];
							$data_path_chart = [];
							$data_lat = [];
							$data_lng = [];
							$data_lat_device = [];
							$data_lng_device = [];
							$sql = "SELECT * FROM `list_water` WHERE water_status = 1";
							$result = mysqli_query($conn, $sql);
							while ($row_water = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$name_water =  $row_water['water_name'];
								$water_path =  $row_water['water_path'];
								$water_path_chart =  $row_water['water_path_chart_main'];
								$water_lat =  $row_water['water_lat'];
								$water_lng =  $row_water['water_lng'];
								array_push($data_name_list, $name_water);
								array_push($data_name_list_water, $name_water);
								array_push($data_path_list, $water_path);
								array_push($data_path_chart, $water_path_chart);
								array_push($data_lat, $water_lat);
								array_push($data_lng, $water_lng);
							}
							$sql = "SELECT * FROM `list_device` WHERE device_status = 1";
							$result = mysqli_query($conn, $sql);
							while ($row_device = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$device_name =  $row_device['device_name'];
								$device_path =  $row_device['device_path'];
								$device_path_chart =  $row_device['device_path_chart_main'];
								$device_path_chart =  $row_device['device_path_chart_main'];
								$device_lat =  $row_device['device_lat'];
								$device_lng =  $row_device['device_lng'];
								array_push($data_name_list, $device_name);
								array_push($data_name_list_device, $device_name);
								array_push($data_path_list, $device_path);
								array_push($data_path_chart, $device_path_chart);
								array_push($data_lat_device, $device_lat);
								array_push($data_lng_device, $device_lng);
							}
							foreach ($data_name_list as $key => $value) {

							?>

								<!-- <option <?php if ($node == 1) {
													echo "selected";
												} ?> value="mun_val/data01.php"><?= $data_path_list[0] ?></option>
								<option <?php if ($node == 2) {
											echo "selected";
										} ?> value="see_val/data02.php">แม่น้ำชี อ.มหาชนะชัย</option>
								<option <?php if ($node == 3) {
											echo "selected";
										} ?> value="khong_val/data03.php">แม่น้ำโขง วัดห้วยสะคาม อ.โขงเจียม</option>
								<option <?php if ($node == 4) {
											echo "selected";
										} ?> value="lamdom_val/data04.php">ลำโดมใหญ่ บ้านนาเยีย อ.พิบูลมังสาหาร</option>
								<option <?php if ($node == 5) {
											echo "selected";
										} ?> value="data_node_nb.php">แม่น้ำมูล เมืองอุบลราชธานี (NB01)</option> -->
								<option <?php if ($node == 1) {
											echo "selected";
										} ?> value="<?= $data_path_list[$key] ?>"><?= $value ?></option>
							<?php } ?>

						</select>
						<span class="focus"></span>
					</div>
					<br>
					<!-- <div id="show">
      /////แสดงtmd
          </div> -->
					<!-- //////////////////////////////////// -->
					<div id="show_data">

					</div>
					<article class="white-block" style="padding: 5px 5px;">
						<div class="white-block" id="map" style="border-radius: 5px;"></div>
					</article>
					<!-- ////////////////////////////////////////// -->
					<div class="row">
						<div class="col-lg-9">
							<!-- <article class="white-block" style="padding: 5px 5px;">
							<div class="white-block" id="map" style="border-radius: 5px;"></div>
						</article> -->


							<div id="show_chart">

							</div>
						</div>
						<div class="col-lg-3">
							<!-- <article class="customers-wrapper"> -->
							<!-- <canvas id="customersChart" aria-label="Customers statistics" role="img"></canvas> -->
							<!--              <p class="customers__title">New Customers <span>+958</span></p>
              
							<p class="customers__date">28 Daily Avg.</p>
              
							<picture><source srcset="./img/svg/customers.svg" type="image/webp"><img src="./img/svg/customers.svg" alt=""></picture> -->
							<!-- </article> -->
							<article class="white-block">
								<div class="top-cat-title">
									<h3>ระดับน้ำเฉลี่ย เขื่อนปากมูล จ.อุบลราชธานี</h3>
									<?php
									date_default_timezone_set("Asia/Bangkok");
									$dm = date("d/m");
									$y = date("Y") + 543;
									$date = $dm . "/" . $y;
									?>
									<p>วันที่ <?= $date; ?></p>
								</div>
								<?php
								$url = file_get_contents('data/water_ubon_level_list.php');
								$url_list = iconv('cp874', 'UTF-8', $url);
								preg_match_all('/title="(.*?)"/is', $url_list, $name_water);
								preg_match_all('/(<div align.*?)<\/div>/is', $url_list, $amount_water);
								?>
								<ul class="top-cat-list">
									<li>
										<div class="top-cat-list__title">
											<div class="col-lg-7">
												สถานี
											</div>
											<div class="col-lg-5">
												<p style="text-align:right;">ระดับน ม.(รทก.)</p>
											</div>
										</div>
										<?php
										// for($i=1;$i<=13;$i++){
										?>
										<div class="top-cat-list__subtitle">
											<div class="col-lg-8">
												<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=1&code=TS1"><?php print_r($name_water[1][0]); ?></a>
											</div>
											<div class="col-lg-4">
												<?php print_r($amount_water[1][312]); ?>
											</div>
										</div>
						</div>
						<br>
						<div class="top-cat-list__subtitle">
							<div class="col-lg-8">
								<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=2&code=TS2"><?php print_r($name_water[1][1]); ?></a>
							</div>
							<div class="col-lg-4">
								<?php print_r($amount_water[1][313]); ?>
							</div>
						</div>
					</div>
					<br>

					<div class="top-cat-list__subtitle">
						<div class="col-lg-8">
							<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=3&code=TS3"><?php print_r($name_water[1][2]); ?></a>
						</div>
						<div class="col-lg-4">
							<?php print_r($amount_water[1][314]); ?>
						</div>
					</div>
				</div>
				<br>
				<div class="top-cat-list__subtitle">
					<div class="col-lg-8">
						<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=4&code=TS4"><?php print_r($name_water[1][3]); ?></a>
					</div>
					<div class="col-lg-4">
						<?php print_r($amount_water[1][315]); ?>
					</div>
				</div>
		</div>
		<br>
		<div class="top-cat-list__subtitle">
			<div class="col-lg-8">
				<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=5&code=TS5"><?php print_r($name_water[1][4]); ?></a>
			</div>
			<div class="col-lg-4">
				<?php print_r($amount_water[1][316]); ?>
			</div>
		</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=6&code=TS6"><?php print_r($name_water[1][5]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][317]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=7&code=TS7"><?php print_r($name_water[1][6]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][318]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=12&code=TS12"><?php print_r($name_water[1][7]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][319]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=14&code=TS14"><?php print_r($name_water[1][8]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][320]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=15&code=TS15"><?php print_r($name_water[1][9]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][321]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=16&code=TS16"><?php print_r($name_water[1][10]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][322]); ?>
		</div>
	</div>
	</div>
	<br>
	<div class="top-cat-list__subtitle">
		<div class="col-lg-8">
			<a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=17&code=TS17"><?php print_r($name_water[1][11]); ?></a>
		</div>
		<div class="col-lg-4">
			<?php print_r($amount_water[1][323]); ?>
		</div>
	</div>
	</div>
	</li>

	</ul>
	</article>
	</div>
	</div>
	</div>
	</main>
	<!-- ! Footer -->
	<footer class="footer">
		<div class="container footer--flex">
			<div class="footer-start">
				<p>2021 © dashboard <a href="dashboard.com" target="_blank" rel="noopener noreferrer">dashboard.com</a></p>
			</div>
			<ul class="footer-end">
				<li><a href="##">About</a></li>
				<li><a href="##">Support</a></li>
				<li><a href="##">Puchase</a></li>
			</ul>
		</div>
	</footer>
	</div>
	</div>
	<!-- Chart library -->
	<script src="./plugins/chart.min.js"></script>
	<!-- Icons library -->
	<script src="plugins/feather.min.js"></script>
	<!-- Custom scripts -->
	<!-- <script src="js/script.js"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


	<script type="text/javascript">
		// $("#datepicker").datepicker({
		//   monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],
		//   autoclose: true,
		//   changeMonth: true,
		//   changeYear: true,
		//   dateFormat: "yy-mm",
		//   showButtonPanel: true,
		//   currentText: "เดือนนี้",
		//   onChangeMonthYear: function (year, month, inst) {
		//       $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month - 1, 1)));
		//   },
		//   onClose: function(dateText, inst) {
		//       var month = $(".ui-datepicker-month :selected").val();
		//       var year = $(".ui-datepicker-year :selected").val();
		//       $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
		//   }
		// }).focus(function () {
		//   $(".ui-datepicker-calendar").hide();
		// })
		$("#datepicker").datepicker({
			autoclose: true,
			language: 'th-th',
			format: "mm-yyyy",
			startView: "months",
			minViewMode: "months",
			autoclose: true
		});
	</script>
	<!-- <script>
      var m_y_date = document.getElementById("datepicker").value;
      $.ajax({
          url: "data_history_grap.php?", //เรียกใช้งานไฟล์นี้
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
                url: "data_history_grap.php?", //เรียกใช้งานไฟล์นี้
                data: "date="+m_y_date,
                type: "GET",
                async:true,
                success: function(data, status) {
                $("#show_history_grap").html(data);
                },
             });
          }
          // $(document).ready(function(){
          //     // $.fn.datepicker.defaults.language = 'th';
          //     // $('.datepicker').datepicker({language:'th-th',format:'dd/mm/yyyy'});
          //     // autoclose: true
          //     $("#datepicker").datepicker({
          //         language:'th-th',
          //         format:'dd/mm/yyyy',
          //         autoclose: true
          //     });
          // });
  </script> -->

	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&libraries=
	places&callback=initAutocomplete"
	async defer></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $key_setup ?>&callback=initMap&v=weekly" async></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		var map;
		var InforObj = [];
		var centerCords = {
			lat: <?= $lat_setup ?>,
			lng: <?= $lng_setup ?>
		};

		var water_lat = [];
		var water_lng = [];
		var water_lat_device = [];
		var water_lng_device = [];

		<?php foreach ($data_lat as $key => $value) { ?>
			water_lat.push(<?= $value; ?>);
			water_lng.push(<?= $data_lng[$key]; ?>);
			// var_dump($value);
		<?php } ?>
		<?php foreach ($data_lat_device as $key => $value) { ?>
			water_lat_device.push(<?= $value; ?>);
			water_lng_device.push(<?= $data_lng_device[$key]; ?>);
			// var_dump($value);
		<?php } ?>
		// console.log(water_lat_device);
		// console.log(water_lng_device);


		var markersOnMapWater = [
			<?php foreach ($data_lat as $key => $value) { ?> {
					placeName: "<?= $data_name_list_water[$key] ?>",
					LatLng: {
						lat: <?= $value ?>,
						lng: <?= $data_lng[$key] ?>,
					}
				},

			<?php } ?>
		];
		var markersOnMapDevice = [
			<?php foreach ($data_lat_device as $key => $value) { ?> {
					placeName: "<?= $data_name_list_device[$key] ?>",
					LatLng: {
						lat: <?= $value ?>,
						lng: <?= $data_lng_device[$key] ?>,
					}
				},

			<?php
				array_push($data_lat, $data_lat_device);
			}

			?>
		];

		var markersOnMap = markersOnMapWater.concat(markersOnMapDevice);

		// console.log(markersOnMap);

		window.onload = function() {
			initMap();
		};

		function addMarkerInfo() {
			const monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
			const dateObj = new Date();
			const month = monthNames[dateObj.getMonth()];
			const day = String(dateObj.getDate()).padStart(2, '0');
			const year = dateObj.getFullYear();
			const date = day + '\n' + month + '\n' + (year + 543);
			// for (var i = 0; i < markersOnMap.length; i++) {
			<?php foreach ($data_lat as $key => $value) {
				$date = date("Y-m-d");

				if ($data_path_list[$key] == "mun_val/data.php") {
					$sql = "SELECT * FROM val_water INNER JOIN val_tmd on val_tmd.date_tmd = val_water.date WHERE val_water.date = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water'];
						$amount_water = $row['amount_water'];
						$temp_water = $row['temp_tmd'];
						$humidity_water = $row['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row['land_visibility_tmd'];
						$rainfall_water = $row['rainfall_tmd'];
					}
				} else if ($data_path_list[$key] == "khong_val/data.php") {
					$sql = "SELECT * FROM val_water_khong INNER JOIN val_wather_khong on val_wather_khong.date_tmd = val_water_khong.date WHERE val_water_khong.date = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water'];
						$amount_water = $row['amount_water'];
						$temp_water = $row['temp_tmd'];
						$humidity_water = $row['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row['land_visibility_tmd'];
						$rainfall_water = $row['rainfall_tmd'];
					}
				} else if ($data_path_list[$key] == "mun2_val/data.php") {
					$sql = "SELECT * FROM val_water_mun2 INNER JOIN val_wather_mun2 on val_wather_mun2.date_wather_mun2 = val_water_mun2.date WHERE val_water_mun2.date = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water_mun2'];
						$amount_water = $row['amount_water_mun2'];
						$temp_water = $row['temp_wather_mun2'];
						$humidity_water = $row['humidity_wather_mun2'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_wather_mun2'];
						$land_visibility_water = $row['land_visibility_wather_mun2'];
						$rainfall_water = $row['rainfall_wather_mun2'];
					}
				} else if ($data_path_list[$key] == "sirinton_val/data.php") {
					$sql = "SELECT * FROM val_water_sirinton INNER JOIN val_wather_sirinton on val_wather_sirinton.date_wather_sirinton = val_water_sirinton.date WHERE val_water_sirinton.date = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water_sirinton'];
						$amount_water = $row['amount_water_sirinton'];
						$temp_water = $row['temp_wather_sirinton'];
						$humidity_water = $row['humidity_wather_sirinton'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_wather_sirinton'];
						$land_visibility_water = $row['land_visibility_wather_sirinton'];
						$rainfall_water = $row['rainfall_wather_sirinton'];
					}
				} else if ($data_path_list[$key] == "lamdom_val/data.php") {
					$sql = "SELECT * FROM val_water_lamdom INNER JOIN val_wather_lamdom on val_wather_lamdom.date_tmd = val_water_lamdom.date WHERE val_water_lamdom.date = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water'];
						$amount_water = $row['amount_water'];
						$temp_water = $row['temp_tmd'];
						$humidity_water = $row['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row['land_visibility_tmd'];
						$rainfall_water = $row['rainfall_tmd'];
					}
				}

				if ($data_path_list[$key] == 'node_nb/data_node_nb1.php') {
					$sql = "SELECT * FROM `val_nb1` WHERE date_nb1 = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$temp_nb = $row['temp_nb1'];
						$humid_nb = $row['humid_nb1'];
						$light_nb = $row['light_nb1'];
						$distance_nb = $row['distance_nb1'];
						$rssi_nb = $row['rssi_nb1'];
						$date_nb = $row['date_nb1'];
					}
				} else if ($data_path_list[$key] == 'node_nb/data_node_nb2.php') {
					$sql = "SELECT * FROM `val_nb2` WHERE date_nb2 = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$temp_nb = $row['temp_nb2'];
						$humid_nb = $row['humid_nb2'];
						$light_nb = $row['light_nb2'];
						$distance_nb = $row['distance_nb2'];
						$rssi_nb = $row['rssi_nb2'];
						$date_nb = $row['date_nb2'];
					}
				} else if ($data_path_list[$key] == 'node_nb/data_node_nb3.php') {
					$sql = "SELECT * FROM `val_nb3` WHERE date_nb3 = '$date'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$temp_nb = $row['temp_nb3'];
						$humid_nb =    $row['humid_nb3'];
						$light_nb = $row['light_nb3'];
						$distance_nb = $row['distance_nb3'];
						$rssi_nb = $row['rssi_nb3'];
						$date_nb = $row['date_nb3'];
					}
				}

				if (
					$data_path_list[$key] == "mun_val/data.php" ||
					$data_path_list[$key] == "khong_val/data.php" ||
					$data_path_list[$key] == "mun2_val/data.php" ||
					$data_path_list[$key] == "sirinton_val/data.php" ||
					$data_path_list[$key] == "lamdom_val/data.php"
				) {
			?>
					var contentString<?= $key ?> = '<div style="height: 300px;color:black;margin-top:5px" id="content">' +
						'<h3 class="stat-cards-info__profit">' + markersOnMap[<?= $key ?>].placeName + '</h3><br>' +
						'<span class="stat-cards-info__profit mt-1">วันที่ : ' + date + '</span>' +
						'<span class="stat-cards-info__profit mt-1">ระดับน้ำ : <?= $level_water ?> ม.(รทก.)</span>' +
						'<span class="stat-cards-info__profit mt-1">ปริมาณน้ำ : <?= $amount_water ?> ลบ.ม./ว</span>' +
						'<span class="stat-cards-info__profit mt-1">อุณหภูมิ : <?= $temp_water ?> °C</span>' +
						'<span class="stat-cards-info__profit mt-1">ความชื้น : <?= $humidity_water ?> %</span>' +
						'<span class="stat-cards-info__profit mt-1">ความกดอากาศ : <?= $MeanSeaLevelPressure_water ?> hPa</span>' +
						'<span class="stat-cards-info__profit mt-1">แรงลม : <?= $land_visibility_water ?> กม/ชม</span><br>' +
						// '<span class="stat-cards-info__profit mt-1">ฝน  : <?= $rainfall_water ?></span><br>'+
						'<a class="stat-cards-info__profit mt-1 success" href="list_data.php">ดูรายละเอียด</a></div>';
				<?php } else if (
					$data_path_list[$key] == "node_nb/data_node_nb1.php" ||
					$data_path_list[$key] == "node_nb/data_node_nb2.php" ||
					$data_path_list[$key] == "node_nb/data_node_nb3.php"
				) { ?>
					var contentString<?= $key ?> = '<div style="color:black;margin-top:5px" id="content">' +
						'<h3 class="stat-cards-info__profit">' + markersOnMap[<?= $key ?>].placeName + '</h3><br>' +
						'<span class="stat-cards-info__profit mt-1">วันที่ : ' + date + '</span>' +
						'<span class="stat-cards-info__profit mt-1">ระดับน้ำ : <?= $distance_nb ?> เมตร</span>' +
						'<span class="stat-cards-info__profit mt-1">อุณหภูมิ : <?= $temp_nb ?> °C</span>' +
						'<span class="stat-cards-info__profit mt-1">ความชื้น : <?= $humid_nb ?> %</span>' +
						'<span class="stat-cards-info__profit mt-1">ค่าความเข้มแสง : <?= $light_nb ?> lux</span>' +
						'<span class="stat-cards-info__profit mt-1">คลื่นสัญญาณ : <?= $rssi_nb ?> DB</span><br>' +
						// '<span class="stat-cards-info__profit mt-1">ฝน  : <?= $rainfall_water ?></span><br>'+
						'<a class="stat-cards-info__profit mt-1 success" href="list_data.php">ดูรายละเอียด</a></div>';
				<?php } ?>
				const marker<?= $key ?> = new google.maps.Marker({
					position: markersOnMap[<?= $key ?>].LatLng,
					map: map,
					title: markersOnMap[<?= $key ?>].placeName,
					icon: <?php
							if (
								$data_path_list[$key] == "mun_val/data.php" ||
								$data_path_list[$key] == "khong_val/data.php" ||
								$data_path_list[$key] == "mun2_val/data.php" ||
								$data_path_list[$key] == "sirinton_val/data.php" ||
								$data_path_list[$key] == "lamdom_val/data.php"
							) {
							?> 'img/mark_map.png'
				<?php } else if (
								$data_path_list[$key] == "node_nb/data_node_nb1.php" ||
								$data_path_list[$key] == "node_nb/data_node_nb2.php" ||
								$data_path_list[$key] == "node_nb/data_node_nb3.php"
							) { ?> 'img/mark_map_nb.png'
				<?php } ?>,
				});
				// console.log(markersOnMap[<?= $key ?>].LatLng);
				const infowindow<?= $key ?> = new google.maps.InfoWindow({
					content: contentString<?= $key ?>,
					maxWidth: 400
				});
				marker<?= $key ?>.addListener('click', function() {
					closeOtherInfo();
					infowindow<?= $key ?>.open(marker<?= $key ?>.get('map'), marker<?= $key ?>);
					InforObj[0] = infowindow<?= $key ?>;
				});

				google.maps.event.addListener(map, "click", function(e) {
					infoWindow.open(null);
					closeOtherInfo();
				});
			<?php } ?>
		}

		function closeOtherInfo() {
			if (InforObj.length > 0) {
				/* detach the info-window from the marker ... undocumented in the API docs */
				InforObj[0].set("marker", null);
				/* and close it */
				InforObj[0].close();
				/* blank the array */
				InforObj.length = 0;
			}
		}

		function area_map() {
			<?php
			// for($i=0;$i<$count;$i++){
			$i = 0;
			$file_map = [];
			$sql = "SELECT * FROM `val_map` WHERE status_map = 1;";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$lat_map = $row["lat_map"];
				$lng_map = $row["lng_map"];
				$color_map = $row["color_map"];
				$name_map = $row["name_map"];
				$detail_map = $row["detail_map"];
				$file_map = explode(",", $row["file_path_map"]);

				$val_lat_lng = "";
				$arr_lat = explode(",", $lat_map);
				$arr_lng = explode(",", $lng_map);
				for ($arr_i = 0; $arr_i < count($arr_lat); $arr_i++) {
					$lat_val = $arr_lat[$arr_i];
					$lng_val = $arr_lng[$arr_i];
					$val = "{lat:" . $lat_val . ",lng:" . $lng_val . "},";
					$val_lat_lng = $val_lat_lng . $val;
				}
				// $test = $val_lat_lng;
				$pattern = '/\r\n/i';
				$detail_map = preg_replace($pattern, '\n', $detail_map);

				if ($row["list_water_map"] == "mun_val/admin_list_data.php") {
					$sql2 = "SELECT * FROM val_water INNER JOIN val_tmd on val_tmd.date_tmd = val_water.date WHERE val_water.date = '$row[value_water_map]'";
					$result2 = mysqli_query($conn, $sql2);
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						$level_water = $row2['level_water'];
						$amount_water = $row2['amount_water'];
						$temp_water = $row2['temp_tmd'];
						$humidity_water = $row2['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row2['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row2['land_visibility_tmd'];
						$rainfall_water = $row2['rainfall_tmd'];
					}
				} else if ($row["list_water_map"]  == "khong_val/admin_list_data.php") {
					$sql2 = "SELECT * FROM val_water_khong INNER JOIN val_wather_khong on val_wather_khong.date_tmd = val_water_khong.date WHERE val_water_khong.date = '$row[value_water_map]'";
					$result2 = mysqli_query($conn, $sql2);
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						$level_water = $row2['level_water'];
						$amount_water = $row2['amount_water'];
						$temp_water = $row2['temp_tmd'];
						$humidity_water = $row2['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row2['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row2['land_visibility_tmd'];
						$rainfall_water = $row2['rainfall_tmd'];
					}
				} else if ($row["list_water_map"]  == "mun2_val/admin_list_data.php") {
					$sql2 = "SELECT * FROM val_water_mun2 INNER JOIN val_wather_mun2 on val_wather_mun2.date_wather_mun2 = val_water_mun2.date WHERE val_water_mun2.date = '$row[value_water_map]'";
					$result2 = mysqli_query($conn, $sql2);
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						$level_water = $row2['level_water_mun2'];
						$amount_water = $row2['amount_water_mun2'];
						$temp_water = $row2['temp_wather_mun2'];
						$humidity_water = $row2['humidity_wather_mun2'];
						$MeanSeaLevelPressure_water = $row2['MeanSeaLevelPressure_wather_mun2'];
						$land_visibility_water = $row2['land_visibility_wather_mun2'];
						$rainfall_water = $row2['rainfall_wather_mun2'];
					}
				} else if ($row["list_water_map"]  == "sirinton_val/admin_list_data.php") {
					$sql = "SELECT * FROM val_water_sirinton INNER JOIN val_wather_sirinton on val_wather_sirinton.date_wather_sirinton = val_water_sirinton.date WHERE val_water_sirinton.date = '$row[value_water_map]'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$level_water = $row['level_water_sirinton'];
						$amount_water = $row['amount_water_sirinton'];
						$temp_water = $row['temp_wather_sirinton'];
						$humidity_water = $row['humidity_wather_sirinton'];
						$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_wather_sirinton'];
						$land_visibility_water = $row['land_visibility_wather_sirinton'];
						$rainfall_water = $row['rainfall_wather_sirinton'];
					}
				} else if ($row["list_water_map"]  == "lamdom_val/admin_list_data.php") {
					$sql2 = "SELECT * FROM val_water_lamdom INNER JOIN val_wather_lamdom on val_wather_lamdom.date_tmd = val_water_lamdom.date WHERE val_water_lamdom.date = " . $row['value_water_map'];
					$result2 = mysqli_query($conn, $sql2);
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						$level_water = $row2['level_water'];
						$amount_water = $row2['amount_water'];
						$temp_water = $row2['temp_tmd'];
						$humidity_water = $row2['humidity_tmd'];
						$MeanSeaLevelPressure_water = $row2['MeanSeaLevelPressure_tmd'];
						$land_visibility_water = $row2['land_visibility_tmd'];
						$rainfall_water = $row2['rainfall_tmd'];
					}
				}
			?>

				const bermudaTriangle<?= $i ?> = new google.maps.Polygon({
					map,
					paths: [<?= $val_lat_lng ?>],
					strokeColor: "<?= $color_map ?>",
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: "<?= $color_map ?>",
					fillOpacity: 0.35,
					draggable: false,
					geodesic: false,
				});

				bermudaTriangle<?= $i ?>.setMap(map);
				// Add a listener for the click event.
				bermudaTriangle<?= $i ?>.addListener("click", showarays<?= $i ?>);


				infoWindow = new google.maps.InfoWindow();
				// infoWindow<?= $i ?> = new google.maps.InfoWindow(); //multi

				<?php
				$dateList = explode("-", $row['value_water_map']);
				$monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
				$date = $dateList[2] . " " . $monthNames[$dateList[1] - 1] . " " . ($dateList[0] + 543);
				?>

				function showarays<?= $i ?>(event) {
					contentString =
						"<div style='width:400px;color:black;'>" +
						// "<b>ตำแหน่ที่ <?= $id ?></b><br>" +
						"<h3 style='font-size:20px' class='tat-cards-info__profit fw'><?= $name_map ?></h3>" +
						"<pre style='font-size:17px'><?php if ($detail_map != null) {
															echo "รายละเอียด : ";
														} ?><?= $detail_map ?></pre>" +
						"<h3 style='font-size:20px'>ประวัติการบันทึก</h3><br>" +
						// '<h3>' + markersOnMap[5].placeName + '</h3><br>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติ ณ วันที่ : <?= $date ?></span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติระดับน้ำ : <?= $level_water ?> ม.(รทก.)</span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติปริมาณน้ำ  : <?= $amount_water ?> ลบ.ม./ว</span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติอุณหภูมิ  : <?= $temp_water ?> °C</span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติความชื้น  : <?= $humidity_water ?> %</span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติความกดอากาศ  : <?= $MeanSeaLevelPressure_water ?> hPa</span>' +
						'<span class="stat-cards-info__profit mt-1" style="font-size:17px">ประวัติแรงลม  : <?= $rainfall_water ?> กม/ชม</span><br>' +
						'<h3 style="font-size: 20px;<?php if ($file_map[0] == null) {
														echo ';display:none';
													} ?>">รูปภาพอ้างอิง</h3><br>' +
						'<button <?php if ($file_map[0] == null) {
										echo 'style="display:none"';
									} ?> onclick="img_map<?= $i ?>()"><img class="box img1" src="./uploads/<?= $file_map[0] ?>" alt="" style="width:300px;"></button><button style="margin-top:10px;background-color: white;color:#3399ff;<?php if ($file_map[0] == null) {
																																																												echo ';display:none';
																																																											} ?>" class="stat-cards-info__profit" onclick="img_map<?= $i ?>()">ดูรูปภาพเพิ่มเติม</button>' +
						"</div><br>";

					// Replace the info window's content and position.
					infoWindow.setContent(contentString);
					infoWindow.setPosition(event.latLng);
					infoWindow.open(map);

					// infoWindow<?= $i ?>.setContent(contentString);
					// infoWindow<?= $i ?>.setPosition(event.latLng);
					// infoWindow<?= $i ?>.open(map);
					// infowindow.close();

					// bermudaTriangle<?= $i ?>.addListener('mouseout', function() {
					// 	infoWindow.open(null);
					// 	// infoWindow<?= $i ?>.open(null);
					// });
				}
			<?php
				$i++;
			}
			?>
		}

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				// zoom: 12.3,
				zoom: <?= $zoom_setup ?>,
				center: centerCords,
				mapTypeId: "<?= $type_setup ?>",
			});
			addMarkerInfo();
			area_map();
		}
	</script>
	<script>
		<?php
		$i = 0;
		$sql = "SELECT * FROM `val_map` INNER JOIN list_water on list_water.water_path_list_add = val_map.list_water_map WHERE status_map = 1";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dateList = explode("-", $row['value_water_map']);
			$monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
			$dateList = $dateList[2] . " " . $monthNames[$dateList[1] - 1] . " " . ($dateList[0] + 543);

			$data_map = "ข้อมูล " . $row['water_name'] . " ณ วันที่ " . $dateList;
			$img_path = explode(",", $row["file_path_map"]);
			if ($row["list_water_map"] == "mun_val/admin_list_data") {
				$sql = "SELECT * FROM val_water INNER JOIN val_tmd on val_tmd.date_tmd = val_water.date WHERE val_water.date = " . $row['value_water_map'];
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$level_water = $row['level_water'];
					$amount_water = $row['amount_water'];
					$temp_water = $row['temp_tmd'];
					$humidity_water = $row['humidity_tmd'];
					$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
					$land_visibility_water = $row['land_visibility_tmd'];
					$rainfall_water = $row['rainfall_tmd'];
				}
			} else if ($row["list_water_map"]  == "khong_val/admin_list_data") {
				$sql = "SELECT * FROM val_water_khong INNER JOIN val_wather_khong on val_wather_khong.date_tmd = val_water_khong.date WHERE val_water_khong.date = " . $row['value_water_map'];
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$level_water = $row['level_water'];
					$amount_water = $row['amount_water'];
					$temp_water = $row['temp_tmd'];
					$humidity_water = $row['humidity_tmd'];
					$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
					$land_visibility_water = $row['land_visibility_tmd'];
					$rainfall_water = $row['rainfall_tmd'];
				}
			} else if ($row["list_water_map"]  == "mun2_val/admin_list_data") {
				$sql = "SELECT * FROM val_water_mun2 INNER JOIN val_wather_mun2 on val_wather_mun2.date_wather_mun2 = val_water_mun2.date WHERE val_water_mun2.date = " . $row['value_water_map'];
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$level_water = $row['level_water_mun2'];
					$amount_water = $row['amount_water_mun2'];
					$temp_water = $row['temp_wather_mun2'];
					$humidity_water = $row['humidity_wather_mun2'];
					$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_wather_mun2'];
					$land_visibility_water = $row['land_visibility_wather_mun2'];
					$rainfall_water = $row['rainfall_wather_mun2'];
				}
			} else if ($row["list_water_map"]  == "sirinton_val/admin_list_data") {
				$sql = "SELECT * FROM val_water_sirinton INNER JOIN val_wather_sirinton on val_wather_sirinton.date_wather_sirinton = val_water_sirinton.date WHERE val_water_sirinton.date = " . $row['value_water_map'];
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$level_water = $row['level_water_sirinton'];
					$amount_water = $row['amount_water_sirinton'];
					$temp_water = $row['temp_wather_sirinton'];
					$humidity_water = $row['humidity_wather_sirinton'];
					$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_wather_sirinton'];
					$land_visibility_water = $row['land_visibility_wather_sirinton'];
					$rainfall_water = $row['rainfall_wather_sirinton'];
				}
			} else if ($row["list_water_map"]  == "lamdom_val/admin_list_data") {
				$sql = "SELECT * FROM val_water_lamdom INNER JOIN val_wather_lamdom on val_wather_lamdom.date_tmd = val_water_lamdom.date WHERE val_water_lamdom.date = " . $row['value_water_map'];
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$level_water = $row['level_water'];
					$amount_water = $row['amount_water'];
					$temp_water = $row['temp_tmd'];
					$humidity_water = $row['humidity_tmd'];
					$MeanSeaLevelPressure_water = $row['MeanSeaLevelPressure_tmd'];
					$land_visibility_water = $row['land_visibility_tmd'];
					$rainfall_water = $row['rainfall_tmd'];
				}
			}
		?>

			function img_map<?= $i ?>() {
				Swal.fire({
					title: 'รูปภาพเพิ่มเติม',
					// imageUrl: './uploads/file_16659029430.png',
					html: '<h3><?= $data_map ?></h3><br><div class="images-slideshow">' +
						<?php foreach ($img_path as $key => $value) { ?> '<div class="imageSlides fade">' +
							'<img src="./uploads/<?= $value ?>">' +
							'</div>' + <?php } ?> '<a class="slider-btn previous" onclick="setSlides(-1)">❮</a>' +
						'<a class="slider-btn next" onclick="setSlides(1)">❯</a>' +
						'</div>',
					// imageWidth: 400,
					// imageHeight: 500,
					width: 800,
					hight: 800,
					imageAlt: 'Custom image',
					confirmButtonText: 'ตกลง',
					confirmButtonColor: '#5887ff',
				})
				var currentIndex = 1;
				displaySlides(currentIndex);

				function setSlides(num) {
					displaySlides(currentIndex += num);
				}

				function displaySlides(num) {
					var x;
					var slides = document.getElementsByClassName("imageSlides");
					if (num > slides.length) {
						currentIndex = 1
					}
					if (num < 1) {
						currentIndex = slides.length
					}
					for (x = 0; x < slides.length; x++) {
						slides[x].style.display = "none";
					}
					slides[currentIndex - 1].style.display = "block";
				}
			}
			var currentIndex = 1;
			displaySlides(currentIndex);

			function setSlides(num) {
				displaySlides(currentIndex += num);
			}

			function displaySlides(num) {
				var x;
				var slides = document.getElementsByClassName("imageSlides");
				if (num > slides.length) {
					currentIndex = 1
				}
				if (num < 1) {
					currentIndex = slides.length
				}
				for (x = 0; x < slides.length; x++) {
					slides[x].style.display = "none";
				}
				if (slides.length > 0) {
					slides[currentIndex - 1].style.display = "block";
				}

			}
		<?php $i++;
		} ?>
	</script>

	<script type="text/javascript">
		var i = document.getElementById("my_node").selectedIndex;
		var my_node = document.getElementsByTagName("option")[i].value;
		// console.log(my_node);
		$.ajax({
			url: my_node, //เรียกใช้งานไฟล์นี้
			data: "", //ส่งตัวแปร
			type: "GET",
			async: false,
			success: function(data, status) {
				$("#show_data").html(data);
				// var chart_path = document.getElementById("my_node").value;
				var chart_path = [];
				var chart_path_main = [];
				var path_result = null;
				<?php foreach ($data_path_list as $key => $value) { ?>
					chart_path.push('<?= $value ?>');
					chart_path_main.push('<?= $data_path_chart[$key] ?>');
				<?php } ?>

				chart_path.forEach((data, index) => {
					if (data == my_node) {
						path_result = chart_path_main[index];
					}
				});

				// console.log(path_result);
				$.ajax({
					url: path_result, //เรียกใช้งานไฟล์นี้
					data: "", //ส่งตัวแปร
					type: "GET",
					async: false,
					success: function(data, status) {
						$("#show_chart").html(data);
					},
				});
			},
		});

		function select_node() {

			var i = document.getElementById("my_node").selectedIndex;
			var my_node = document.getElementsByTagName("option")[i].value;
			// console.log(my_node);
			$.ajax({
				url: my_node, //เรียกใช้งานไฟล์นี้
				data: "", //ส่งตัวแปร
				type: "GET",
				async: false,
				success: function(data, status) {
					$("#show_data").html(data);
					// var chart_path = document.getElementById("my_node").value;
					var chart_path = [];
					var chart_path_main = [];
					var path_result = null;
					<?php foreach ($data_path_list as $key => $value) { ?>
						chart_path.push('<?= $value ?>');
						chart_path_main.push('<?= $data_path_chart[$key] ?>');
					<?php } ?>

					chart_path.forEach((data, index) => {
						if (data == my_node) {
							path_result = chart_path_main[index];
						}
					});

					// console.log(path_result);
					$.ajax({
						url: path_result, //เรียกใช้งานไฟล์นี้
						data: "", //ส่งตัวแปร
						type: "GET",
						async: false,
						success: function(data, status) {
							$("#show_chart").html(data);
						},
					});
				},
			});
		}
	</script>
</body>

</html>