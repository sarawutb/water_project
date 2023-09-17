<?php
session_start();
if ($_SESSION['id_user']) {
	include("connect.php");
} else {
	session_destroy();
	header("location:index.php");
}

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
}

// echo $date_amount_water;





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
	<link rel="shortcut icon" href="./img/svg/Logo.svg" type="image/x-icon">
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
	select {
		background-color: transparent;
		border: none;
		padding: 0 1em 0 0;
		margin: 0;
		width: 100%;
		font-family: inherit;
		font-size: inherit;
		cursor: inherit;
		line-height: inherit;
		z-index: 1;
		/* &::-ms-expand {
			display: none;
		} */
	}

	.select {
		display: grid;
		grid-template-areas: "select";
		align-items: center;
		position: relative;

		/* select,
		&::after {
			grid-area: select;
		} */

		min-width: 15ch;
		max-width: 33ch;

		border: 1px solid var(--select-border);
		border-radius: 0.25em;
		padding: 0.25em 0.5em;

		font-size: 1.25rem;
		cursor: pointer;
		line-height: 1.1;
		background-color: #fff;
		background-image: linear-gradient(to top, #f9f9f9, #fff 33%);

	}
</style>

<body>
	<!-- ! Body -->
	<div class="page-flex">
		<!-- ! Sidebar -->
		<?php require './sidebar.php'; ?>
		<div class="main-wrapper">
			<!-- ! Main nav -->
			<nav class="main-nav--bg">
				<div class="container main-nav">
					<div class="main-nav-start">
						<!-- <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input readonly type="text" placeholder="ค้นหา ..." required>
      </div> -->
					</div>
					<div class="main-nav-end">
						<button class="sidebar-toggle transparent-btn" title="Menu" type="button">
							<span class="sr-only">Toggle menu</span>
							<span class="icon menu-toggle--gray" aria-hidden="true"></span>
						</button>

						<div class="notification-wrapper">
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
					<h2 class="main-title">จัดการข้อมูล</h2>
					<div class="select">
						<select id="my_node" onchange="select_node()">
							<!-- <option value="data_history_grap_main_admin.php">สถานีตรวจวัด แม่น้ำมูล (M.7)</option>
							<option value="data_history_grap_main_admin2.php">แม่น้ำมูล เมืองอุบลราชธานี (NB01)</option> -->
							<!-- <option value="adminpage/data_history_grap_main_admin.php">แม่น้ำมูล อ.เมืองอุบลราชธาน (M.7)</option> -->
							<!-- <option <?php if ($node == 2) {
												echo "selected";
											} ?> value="adminpage/data_history_grap_main_admin2.php">แม่น้ำชี อ.มหาชนะชัย</option>
							<option <?php if ($node == 3) {
										echo "selected";
									} ?> value="adminpage/data_history_grap_main_admin3.php">แม่น้ำโขง วัดห้วยสะคาม อ.โขงเจียม</option>
							<option <?php if ($node == 4) {
										echo "selected";
									} ?> value="adminpage/data_history_grap_main_admin4.php">ลำโดมใหญ่ บ้านนาเยีย อ.พิบูลมังสาหาร</option>
							<option <?php if ($node == 5) {
										echo "selected";
									} ?> value="adminpage/data_history_grap_main_admin5.php">แม่น้ำมูล เมืองอุบลราชธานี (NB01)</option> -->
							<!-- <option value="node_main3.php">อ่างเก็บน้ำห้วยวังนอง เมืองอุบลราชธานี (NB02)</option> -->

							<?php
							$data_name_list = [];
							$data_path_list = [];
							$sql = "SELECT * FROM `list_water`";
							$result = mysqli_query($conn, $sql);
							while ($row_water = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$name_water =  $row_water['water_name'];
								$water_path =  $row_water['water_path_history_admin'];
								array_push($data_name_list, $name_water);
								array_push($data_path_list, $water_path);
							}
							$sql = "SELECT * FROM `list_device`";
							$result = mysqli_query($conn, $sql);
							while ($row_device = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$device_name =  $row_device['device_name'];
								$device_path =  $row_device['device_path_history_admin'];
								array_push($data_name_list, $device_name);
								array_push($data_path_list, $device_path);
							}
							foreach ($data_name_list as $key => $value) {
							?>
								<option <?php //if ($node == 1) {
										//echo "selected";
										//} 
										?> value="<?= $data_path_list[$key] ?>"><?= $value ?></option>
							<?php } ?>

						</select>
						<span class="focus"></span>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<article class="white-block">
								<div class="main-nav-start">
									<?php
									date_default_timezone_set("Asia/Bangkok");
									$dm = date("m");
									$y = date("Y");
									$date = $dm . "-" . $y;
									?>
									<!-- <div class="main-nav--bg" style="margin :0px 10px;"> -->
									<div class="" style="margin :0px 10px;">
										<label style="margin-left:10px" class="stat-cards-info__num">
											เลือกเดือน/ปี&nbsp;<input onchange="data_history_grap()" value="<?= $date ?>" placeholder="ดด/ปปปป" id="datepicker" type="text" class="stat-cards" style="margin:20px 0px;width:170px;" />
											<!-- &nbsp; เดือน/ปี -->
										</label>
									</div>
									<div class="col-lg-12" id="show_history_grap">
									</div>
								</div>
								<!-- <div class="chart2">
                <canvas id="myChart" aria-label="Site statistics" role="img"></canvas>
              </div>
              <div class="chart2">
                <canvas id="myChart2" aria-label="Site statistics" role="img"></canvas>
              </div> -->
							</article>


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
	<script src="js/script.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<script type="text/javascript">
		$("#datepicker").datepicker({
			autoclose: true,
			language: 'th-th',
			format: "mm-yyyy",
			startView: "months",
			minViewMode: "months",
			autoclose: true
		});
	</script>
	<script>
		var m_y_date = document.getElementById("datepicker").value;
		$.ajax({
			url: "data_history_grap_main_admin.php?", //เรียกใช้งานไฟล์นี้
			data: "date=" + m_y_date,
			type: "GET",
			async: false,
			success: function(data, status) {
				$("#show_history_grap").html(data);
			},
		});

		function data_history_grap() {
			var i = document.getElementById("my_node").selectedIndex;
			var my_node = document.getElementsByTagName("option")[i].value;
			// submit();
			var m_y_date = document.getElementById("datepicker").value;
			$.ajax({
				url: my_node, //เรียกใช้งานไฟล์นี้
				data: "date=" + m_y_date,
				type: "GET",
				async: true,
				success: function(data, status) {
					$("#show_history_grap").html(data);
				},
			});
		}

		function select_node() {
			var i = document.getElementById("my_node").selectedIndex;
			var my_node = document.getElementsByTagName("option")[i].value;
			$.ajax({
				url: my_node, //เรียกใช้งานไฟล์นี้
				data: "date=" + m_y_date, //ส่งตัวแปร
				type: "GET",
				async: false,
				success: function(data, status) {
					$("#show_history_grap").html(data);
				},
			});
		}
	</script>
</body>

</html>