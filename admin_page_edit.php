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

if (isset($_GET['id_map'])) {
	$id_map = $_GET['id_map'];
	$sql = "SELECT * FROM `val_map` WHERE `id` = $id_map ";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$id = $row["id"];
		$lat_map = $row["lat_map"];
		$lng_map = $row["lng_map"];
		$color_map = $row["color_map"];
		$name_map = $row["name_map"];
		$detail_map = $row["detail_map"];
		$type_map = $row["type_map"];
		$list_water_map = $row["list_water_map"];
		$value_water_map = $row["value_water_map"];
		$file_path_map = $row["file_path_map"];
		$status_map = $row["status_map"];

		$val_lat_lng = "";
		$arr_lat = explode(",", $lat_map);
		$arr_lng = explode(",", $lng_map);
		for ($arr_i = 0; $arr_i < count($arr_lat); $arr_i++) {
			$lat_val = $arr_lat[$arr_i];
			$lng_val = $arr_lng[$arr_i];
			$val = "{lat:" . $lat_val . ",lng:" . $lng_val . "},";
			$val_lat_lng = $val_lat_lng . $val;
		}
	}
}

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
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
	/* The Modal (background) */
	.modal {
		display: none;
		/* Hidden by default */
		position: fixed;
		/* Stay in place */
		z-index: 1;
		/* Sit on top */
		padding-top: 100px;
		/* Location of the box */
		left: 0;
		top: 0;
		width: 100%;
		/* Full width */
		height: 100%;
		/* Full height */
		overflow: auto;
		/* Enable scroll if needed */
		background-color: rgb(0, 0, 0);
		/* Fallback color */
		background-color: rgba(0, 0, 0, 0.4);
		/* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		width: 80%;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		-webkit-animation-name: animatetop;
		-webkit-animation-duration: 0.4s;
		animation-name: animatetop;
		animation-duration: 0.2s
	}

	/* Add Animation */
	@-webkit-keyframes animatetop {
		from {
			top: -300px;
			opacity: 0
		}

		to {
			top: 0;
			opacity: 1
		}
	}

	@keyframes animatetop {
		from {
			top: -300px;
			opacity: 0
		}

		to {
			top: 0;
			opacity: 1
		}
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

	.modal-body {
		padding: 2px 16px;
	}

	.modal-footer {
		padding: 2px 16px;
		background-color: #5cb85c;
		color: white;
	}

	select {
		/* background-color: transparent; */
		/* border: none; */
		border-radius: 5px;
		padding: 10px 10px;
		/* margin: 0;
		width: 100%;
		font-family: inherit;
		font-size: inherit;
		cursor: inherit;
		line-height: inherit;
		z-index: 1;
		&::-ms-expand {
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

	input[type=checkbox] {
		height: 0;
		width: 0;
		visibility: hidden;
	}

	#lbswitch {
		cursor: pointer;
		text-indent: -9999px;
		width: 50px;
		height: 28px;
		background: grey;
		display: block;
		border-radius: 100px;
		position: relative;
	}

	#lbswitch:after {
		content: '';
		position: absolute;
		top: 2px;
		left: 1px;
		width: 25px;
		height: 25px;
		background: #fff;
		border-radius: 25px;
		transition: 0.3s;
	}

	input:checked+#lbswitch {
		background: #5887ff;
	}

	input:checked+#lbswitch:after {
		left: calc(100% - 5px);
		transform: translateX(-80%);
	}

	#lbswitch:active:after {
		width: 30px;
	}

	#switch {
		margin-left: 10px;
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
					<h2 class="main-title">กำหนดจุดพิกัด</h2>
					<div class="row">
						<div class="col-lg-12">
							<article class="white-block" style="padding: 15px 5px 5px 5px;">
								<center>
									<h3 class="main-title">เลือกพิกัดตำแหน่ง</h3>
								</center>
								<div style="height:650px" class="white-block" id="map" style="border-radius: 5px;"></div>
								<?php $rand_color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>
								<article class="white-block">
									<form action="manager_sql.php" method="post" id="form_map" enctype="multipart/form-data">
										<input hidden name="id" type="text" value="<?= $id; ?>" />
										<input hidden name="area_lat_map" style="width:100%" type="text" id="map_location1" required />
										<input hidden name="area_lng_map" style="width:100%" type="text" id="map_location2" required />
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">ชื่อตำแหน่ง</label>
											<div class="col-sm-10">
												<input name="name_map" style="width:100%" type="text" name="detail_val" value="<?php if (isset($_GET['id_map'])) {
																																	echo $name_map;
																																} ?>" required />
											</div>
										</div>
										</br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">เลือกตำแหน่ง</label>
											<div class="col-sm-10">
												<select id="my_node" name="water_list_map" style="background-color: #eff0f6;" onchange="selectWater()">
													<?php
													$data_name_list = [];
													$path_list_add = [];
													$sql = "SELECT * FROM `list_water`";
													$result = mysqli_query($conn, $sql);
													while ($row_water = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
														$name_water =  $row_water['water_name'];
														$water_path_list_add =  $row_water['water_path_list_add'];
														array_push($data_name_list, $name_water);
														array_push($path_list_add, $water_path_list_add);
													}
													$sql = "SELECT * FROM `list_device`";
													$result = mysqli_query($conn, $sql);
													while ($row_device = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
														$device_name =  $row_device['device_name'];
														$water_path_list_add =  $row_device['device_path_list_add'];
														array_push($data_name_list, $device_name);
														array_push($path_list_add, $water_path_list_add);
													}
													foreach ($data_name_list as $key => $value) {

													?>
														<option <?php if (isset($_GET['id_map'])) {
																	if ($list_water_map == $path_list_add[$key]) {
																		echo "selected";
																	};
																} ?> value="<?= $path_list_add[$key] ?>"><?= $value ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										</br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">ชุดข้อมูล</label>
											<div class="col-sm-10">
												<?php
												$sql = "SELECT * FROM `val_map` INNER JOIN list_water on list_water.water_path_list_add = val_map.list_water_map WHERE val_map.id = '$id_map'";
												$result = mysqli_query($conn, $sql);
												while ($row_water = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
													$name_water = $row_water['water_name'];
													$date_value = $row_water['value_water_map'];
												}
												?> <input readonly id="myBtn" type="text" placeholder="<?= "(ชุดข้อมูล)" . $name_water . " ณ วันที่ " . $date_value ?>" style="width:100%">
												<input hidden name="date_data_map" id="myData" type="text" style="width:100%" value="<?= $date_value ?>" required>
												<!-- <input name="water_map" type="text" id="water_map" value="" /> -->


												<div id="myModal" class="modal">
													<!-- Modal content -->
													<div class="main users chart-page">
														<div class="container">
															<div class="row">
																<div class="col-lg-2">
																</div>
																<div class="col-lg-10">
																	<article class="white-block">
																		<div class="modal-body">
																			<div class="row">
																				<div class="col-lg-12">
																					<span style="color:gray" id="close_header" class="close">&times;</span>

																					<center>
																						<h3 class="stat-cards-info__num" style="font-size:25px">เลือกรายการข้อมูล <b id="name_water"> </b></h3>
																					</center>

																					<article class="white-block">
																						<div class="main-nav-start">
																							<?php
																							date_default_timezone_set("Asia/Bangkok");
																							$dm = date("m");
																							$y = date("Y");
																							$date = $dm . "-" . $y;
																							?>
																							<div class="" style="margin :0px 10px;">
																								<label style="margin-left:10px" class="stat-cards-info__num">
																									เลือกเดือน/ปี&nbsp;<input onchange="data_history_grap()" value="<?= $date ?>" placeholder="ดด/ปปปป" id="datepicker" type="text" class="stat-cards" style="margin:20px 0px;width:170px;" />
																									<!-- &nbsp; เดือน/ปี -->
																								</label>
																							</div>
																							<div class="col-lg-12" id="show_history_grap">
																							</div>
																						</div>
																					</article>
																				</div>
																			</div>

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

													// Get the modal
													var modal = document.getElementById("myModal");
													var btn = document.getElementById("myBtn");
													var btn_close = document.getElementById("close_header");
													var span = document.getElementById("close_header");
													btn.onclick = function() {
														modal.style.display = "block";
													}
													btn_close.onclick = function() {
														modal.style.display = "none";
													}
													span.onclick = function() {
														modal.style.display = "none";
													}
													// window.onclick = function(event) {
													//   if (event.target == modal) {
													//     modal.style.display = "none";
													// 	 console.log();
													//   }
													// }
												</script>




											</div>
										</div>
										</br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">แนบไฟล์อ้างอิง</label>
											<div class="col-sm-10">
												<!-- <input name="file_map" type="file" id="file" value="" /> -->
												<?php
												$dir = './uploads';
												$files1 = scandir($dir);


												$file_path_map = explode(",", $file_path_map);
												// $file_path_map = $file_path_map[1];
												// print_r($files1);
												// print_r($file_path_map);
												$file_list = [];
												foreach ($file_path_map as $key1 => $value1) {
													foreach ($files1 as $key2 => $value2) {
														if ($value2 == $value1) {
															array_push($file_list, $value2);
														}
													}
												}
												$file_list_data =	implode(",", $file_list);
												?>
												<div class="upload">
													<input type="button" class="uploadButton" value="เลือกไฟล์" />
													<input type="file" name="file_map[]" accept="image/*" id="fileUpload" multiple />
													<span class="fileName"> <?php if (isset($_GET['id_map'])) {
																				echo "จำนวนไฟล์ที่เลือก (" . count($file_path_map) . " ไฟล์)";;
																			} else {
																				echo "กรุณาเลือกไฟล์แนบ";
																			}  ?></span>

												</div>
												<input hidden type="text" name="file_map_list" value="<?= $file_list_data ?>" />
												<script>
													$('input[type=file]').change(function(e) {
														var namefile = [];
														$in = $(this);
														var numFiles = $(this).get(0).files
														if (numFiles[0].type.split('/')[0] === 'image') {
															// console.log('the file is image');
															for (var i = 0; i < numFiles.length; ++i) {
																var name = numFiles.item(i).name;
																// alert("here is a file name: " + name);
																namefile.push(name);
															}
															// alert(numFiles);
															$in.next().html("จำนวนไฟล์ที่เลือก (" + numFiles.length + " ไฟล์)");
														} else {
															Swal.fire({
																icon: 'error',
																title: 'ไฟล์ไม่ถูกต้อง',
																confirmButtonText: 'ตกลง',
																confirmButtonColor: '#5887ff',
															})
														}
													});
												</script>
											</div>
										</div>
										</br>
										<div class="form-group row">
											<!-- <input type="text" id="date_sql" value="<?= $date_water; ?>"> -->
											<label class="col-sm-2 col-form-label">กำหนดสีพิกัดตำแหน่ง</label>
											<div class="col-sm-10">
												<input name="color_map" type="color" id="color" value="<?php if (isset($_GET['id_map'])) {
																											echo $color_map;
																										} ?>" />
											</div>
										</div>
										<br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">สถานะ</label>
											<!-- <div class="col-sm-10"> -->
											<input name="status_map" <?php if (isset($_GET['id_map'])) {
																			if ($status_map == 1) {
																				echo "checked";
																			};
																		} ?> type="checkbox" id="switch" value="1" /><label id="lbswitch" for="switch">Toggle</label>
											<!-- </div> -->
											<label id="status_off" class="col-sm-2 col-form-label stat-cards-info__profit danger" style="margin-top: 5px; font-size: 15px;"> ปิดแสดงสาธารณะ</label>
											<label id="status_on" class="col-sm-2 col-form-label stat-cards-info__profit success" style="margin-top: 5px; font-size: 15px;"> เปิดปิดแสดงสาธารณะ</label>
											<script>
												if (document.getElementById('switch').checked) {
													document.getElementById("status_off").style.display = 'none';
													document.getElementById("status_on").style.display = 'block';
												} else {
													document.getElementById("status_off").style.display = 'block';
													document.getElementById("status_on").style.display = 'none';
												}
												$(function() {
													$('#switch').on('click', function() {
														if (document.getElementById('switch').checked) {
															document.getElementById("status_off").style.display = 'none';
															document.getElementById("status_on").style.display = 'block';
														} else {
															document.getElementById("status_off").style.display = 'block';
															document.getElementById("status_on").style.display = 'none';
														}

													});
												});
											</script>
										</div>
										<br>
										<br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">รายละเอียด</label>
											<div class="col-sm-10">
												<textarea name="detail_map" style="width:100%" rows="10" type="text"><?php if (isset($_GET['id_map'])) {
																															echo $detail_map;
																														} ?></textarea>
											</div>
										</div>
										</br>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label"></label>
											<div class="col-sm-10">
												<button name="edit_area_map" style="padding:10px;float:left" onclick="btn_submit()" class="badge-active" type="submit">
													<h3 class="stat-cards-info__num" style="font-size:15px">บันทึก</h3>
												</button>
												<button style="padding:10px;float:left;margin-left:5px" onclick="history.back()" class="badge-pending" type="button">
													<h3 class="stat-cards-info__num" style="font-size:15px">ย้อนกลับ</h3>
												</button>
											</div>
										</div>
									</form>
								</article>
								<script type="text/javascript">
									let colorInput = document.getElementById('color');
									// document.getElementById('get_color').value = colorInput.value;
									colorInput.addEventListener('input', () => {
										document.getElementById('get_color').value = colorInput.value;
									});
								</script>
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
	<script>
		var i = document.getElementById("my_node").selectedIndex;
		var my_node = document.getElementsByTagName("option")[i].value;

		var data_name_list = [];
		var path_list_add = [];
		var name_water;
		<?php foreach ($data_name_list as $key => $value) { ?>
			data_name_list.push('<?= $value ?>');
		<?php } ?>
		<?php foreach ($path_list_add as $key => $value) { ?>
			path_list_add.push('<?= $value ?>');
		<?php } ?>

		path_list_add.forEach((element, index) => {
			if (element == my_node) {
				document.getElementById("name_water").innerHTML = data_name_list[index];
				name_water = data_name_list[index];

			}
		});
		var m_y_date = document.getElementById("datepicker").value;
		$.ajax({
			url: my_node, //เรียกใช้งานไฟล์นี้
			data: "date=" + m_y_date + "&data=" + name_water,
			type: "GET",
			async: false,
			success: function(data, status) {
				$("#show_history_grap").html(data);
			},
		});

		function data_history_grap() {
			// alert(my_node);
			// submit();
			var m_y_date = document.getElementById("datepicker").value;
			$.ajax({
				url: my_node, //เรียกใช้งานไฟล์นี้
				data: "date=" + m_y_date + "&data=" + name_water,
				type: "GET",
				async: true,
				success: function(data, status) {
					$("#show_history_grap").html(data);
				},
			});
		}

		function selectWater() {
			var i = document.getElementById("my_node").selectedIndex;
			var my_node = document.getElementsByTagName("option")[i].value;

			var data_name_list = [];
			var path_list_add = [];
			var name_water;
			<?php foreach ($data_name_list as $key => $value) { ?>
				data_name_list.push('<?= $value ?>');
			<?php } ?>
			<?php foreach ($path_list_add as $key => $value) { ?>
				path_list_add.push('<?= $value ?>');
			<?php } ?>

			path_list_add.forEach((element, index) => {
				if (element == my_node) {
					document.getElementById("name_water").innerHTML = data_name_list[index];
					name_water = data_name_list[index];
				}
			});

			var m_y_date = document.getElementById("datepicker").value;
			$.ajax({
				url: my_node, //เรียกใช้งานไฟล์นี้
				data: "date=" + m_y_date + "&data=" + name_water,
				type: "GET",
				async: false,
				success: function(data, status) {
					$("#show_history_grap").html(data);
				},
			});

			function data_history_grap() {
				alert(my_node);
				// submit();
				var m_y_date = document.getElementById("datepicker").value;
				$.ajax({
					url: my_node, //เรียกใช้งานไฟล์นี้
					data: "date=" + m_y_date + "&data=" + name_water,
					type: "GET",
					async: true,
					success: function(data, status) {
						$("#show_history_grap").html(data);
					},
				});
			}
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $key_setup ?>&callback=initMap&v=weekly" async></script>
	<script type="text/javascript">
		var lat_arr = [];
		var lng_arr = [];
		var poly;
		var map;
		var markers = new Array();
		var path;
		var marker = [];
		var position_sql = [];
		var position_sql_val_lat = "";
		var position_sql_val_lng = "";

		var position_sql_arr_lat = [];
		var position_sql_arr_lng = [];

		var test = [];

		var centerCords = {
			lat: 15.2434614,
			lng: 104.8593945
		};
		const map_sql = [<?= $val_lat_lng; ?>];

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 13.2,
				center: centerCords, // Center the map on Pakistan.
				// mapTypeId: "roadmap",
				mapTypeId: "satellite",
				// mapTypeId: "hybrid",
				// mapTypeId: "terrain",
			});


			poly = new google.maps.Polyline({
				path: map_sql,
				strokeColor: '#EA4335',
				strokeOpacity: 1.0,
				strokeWeight: 3
			});
			poly.setMap(map);
			// path = test;
			path = poly.getPath();
			// console.log(path.length);

			for (let i = 0; i < map_sql.length; i++) {
				marker[i] = new google.maps.Marker({
					// position: event.latLng,
					position: map_sql[i],
					// title: '#' + path.getLength(),
					map: map,
					id: new Date()
				});
				markers.push(marker[i]);
				// console.log(marker[i]);
				google.maps.event.addListener(marker[i], 'click', function(event) {
					if (markers[0].id == marker[i].id && path.length > 2) {
						// console.log("001");
						poly.getPath().setAt(markers.length, event.latLng);
						// console.log(path[1]);
					} else {
						removePoint(marker[i]);
						// console.log(marker[i]);
					}
				});
				//position
				position_sql.push(markers[i].position);
				// console.log(position_sql);
			}

			poly.getPath().setAt(markers.length, markers[0].position);
			// var taet = [];
			for (let i = 0; i < position_sql.length; i++) {
				position_sql_val_lat = position_sql[i].lat() + "," + position_sql_val_lat;
				position_sql_val_lng = position_sql[i].lng() + "," + position_sql_val_lng;
				// console.log(position_sql[i].lat());
				// var taet = [];
				position_sql_arr_lat.push(position_sql[i].lat());
				position_sql_arr_lng.push(position_sql[i].lng());
			}

			// console.log(position_sql_arr_lat.toString());
			document.getElementById('map_location1').value = position_sql_arr_lat.toString();
			document.getElementById('map_location2').value = position_sql_arr_lng.toString();
			// Add a listener for the click event
			showMapSql();
			map.addListener('click', addLatLng);
		}

		// Handles click events on a map, and adds a new point to the Polyline.
		function addLatLng(event, path = false) {
			// console.log("event", event);
			path = poly.getPath();
			// path.push(event.latLng);

			var marker = new google.maps.Marker({
				position: event.latLng,
				title: '#' + path.getLength(),
				map: map,
				id: new Date()
			});

			markers.push(marker);


			var location = event.latLng;
			var lat_val = location.lat();
			var lng_val = location.lng();

			position_sql_arr_lat = [];
			position_sql_arr_lng = [];
			for (let i = 0; i < position_sql.length; i++) {
				position_sql_arr_lat.push(position_sql[i].lat());
				position_sql_arr_lng.push(position_sql[i].lng());
			}
			document.getElementById('map_location1').value = position_sql_arr_lat.toString() + "," + lat_val;
			document.getElementById('map_location2').value = position_sql_arr_lng.toString() + "," + lng_val;
			// document.getElementById('map_location1').value = lat_arr;
			// document.getElementById('map_location2').value = lng_arr;
			position_sql.push(marker.position);
			console.log(position_sql);

			poly.getPath().setAt(markers.length - 1, event.latLng);
			google.maps.event.addListener(marker, 'click', function(event) {
				if (markers[0].id == marker.id && path.length > 2) {
					poly.getPath().setAt(markers.length, event.latLng);
					// console.log(path[1]);
				} else {
					removePoint(marker);
				}
			});
		}

		function showMapSql() {
			<?php
			// for($i=0;$i<$count;$i++){
			$i = 0;
			$sql = "SELECT * FROM `val_map` WHERE NOT `id` = $id";
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$lat_map = $row["lat_map"];
				$lng_map = $row["lng_map"];
				$color_map = $row["color_map"];
				$name_map = $row["name_map"];
				$detail_map = $row["detail_map"];

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
			<?php
				$i++;
			}
			?>
		}

		function removePoint(marker) {
			for (var i = 0; i < markers.length; i++) {
				if (markers[i].id === marker.id) {
					markers[i].setMap(null);
					markers.splice(i, 1);
					position_sql.splice(i, 1);
					position_sql_arr_lat = [];
					position_sql_arr_lng = [];
					for (let x = 0; x < position_sql.length; x++) {
						position_sql_arr_lat.push(position_sql[x].lat());
						position_sql_arr_lng.push(position_sql[x].lng());
					}
					document.getElementById('map_location1').value = position_sql_arr_lat.toString();
					document.getElementById('map_location2').value = position_sql_arr_lng.toString();
					// console.log(position_sql.toString());
					poly.getPath().removeAt(i);
				}
				// console.log(markers);
			}

			// console.log(markers.length);

		}
	</script>
	<script>
		function btn_submit() {
			var form = document.getElementById('form_map');
			for (var i = 0; i < form.elements.length; i++) {
				if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
					Swal.fire({
						icon: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						confirmButtonText: 'ตกลง',
						confirmButtonColor: '#5887ff',
					})
					return false;
				} else {}
			}
			form.submit();
		};
	</script>
</body>

</html>