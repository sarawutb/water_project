<?php
session_start();
if ($_SESSION['id_user']) {
	include("connect.php");
} else {
	session_destroy();
	header("location:index.php");
}

// $sql = "SELECT * FROM `val_map` LIMIT 1";
// $result = $conn->query($sql);
//   while($row = $result->fetch_assoc()) {
// 	$lat_map = $row["lat_map"];
// 	$lng_map = $row["lng_map"];
// 	$color_map = $row["color_map"];
// 	$name_map = $row["name_map"];
// 	$detail_map = $row["detail_map"];
//
// 	$val_lat_lng = "";
// 	$arr_lat = explode(",",$lat_map);
// 	$arr_lng = explode(",",$lng_map);
// 	 for($arr_i=0;$arr_i<count($arr_lat);$i++){
// 		 $lat_val = $arr_lat[$arr_i];
// 		 $lng_val = $arr_lng[$arr_i];
// 		 $val = "{lat:".$lat_val.",lng:".$lng_val."},";
// 		 $val_lat_lng = $val_lat_lng.$val;
// 	 }
// 	 $test = $val_lat_lng;
// 	 // echo $val_lat_lng;
// }
////////////////////////////////////////////
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
function rand_c()
{
	$rand_color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
	return $rand_color;
}

$test = "{lat:15.254441843827616,lng:104.86393494289655},{lat:15.24856249228037,lng:104.85642475765485},{lat:15.252620090514537,lng:104.85595268886823}^{lat:15.255849551477576,lng:104.869599768336},{lat:15.253945003581476,lng:104.8710588900401},{lat:15.25419342385141,lng:104.86753983181256}";
$test2 = explode("^", $test);
// $test2 = $test;
$count = count($test2);

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
					<h2 class="main-title">
						จัดการพิกัดตำแหน่ง
					</h2>
					<div class="row">
						<div class="col-lg-12">
							<article class="white-block" style="padding: 5px 5px;">
								<a href="admin_page_add.php">
									<button style="float:right;border-radius: 5px;padding:7px 5px;width:200px;margin:5px 5px 10px 0px" type="button">
										<h3 class="stat-cards-info__num" style="font-size:15px;color:black">
											กำหนดจุดพิกัด
											<i style="font-size:24px" class="fa">&#xf124;</i>
										</h3>
									</button>
								</a>
								<div style="height:650px" class="white-block" id="map" style="border-radius: 5px;"></div>
							</article>
							<article class="white-block" style="padding: 5px 5px;">
								<div style="display: inline;">
									<a href="admin_page_add.php">
										<button style="float:right;border-radius: 5px;padding:7px 5px;width:200px;margin:5px 5px 10px 0px" type="button">
											<h3 class="stat-cards-info__num" style="font-size:15px;color:black">
												กำหนดจุดพิกัด
												<i style="font-size:24px" class="fa">&#xf124;</i>
											</h3>
										</button>
									</a>
									<div class="col-lg-4 col-md-6 col-10" style="padding: 10px 0px;">
										<input type="text" id="inputSearch" onkeyup="mySearch()" placeholder="ค้นหา..." style="width: 100%;">
									</div>
								</div>
								<div class="users-table table-wrapper" id="update" style="width: 100%;height: 500px;overflow: auto;">
									<table class="posts-table" id="tbSearch">
										<thead>
											<tr class="users-table-info">
												<th style="text-align: center;width: 10%;">ลำดับ</th>
												<th style="width: 10%;">ชื่อตำแหน่ง</th>
												<th style="width: 15%;">ตำแหน่ง</th>
												<th style="width: 25%;">ละติจูด,ลองจิจูด</th>
												<th style="text-align: center;width: 10%;">สีพิกัดตำแหน่ง</th>
												<th style="text-align: center;width: 10%;">สถานะ</th>
												<th style="text-align: center;width: 20%;">จัดการข้อมูล</th>
												<!-- <th>จัดการ</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$sql = "SELECT * FROM `val_map`";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$id = $row["id"];
													$lat_map = $row["lat_map"];
													$lng_map = $row["lng_map"];
													$color_map = $row["color_map"];
													$name_map = $row["name_map"];
													$detail_map = $row["detail_map"];
													$list_water_map = $row["list_water_map"];
													$value_water_map = $row["value_water_map"];
													$status_map = $row["status_map"];

											?>
													<tr>
														<td style="text-align: center;"><?= $num++ ?></td>
														<td><?= $name_map ?></td>
														<td><?php
															$sql1 = "SELECT * FROM `list_water` WHERE water_path_list_add = '$list_water_map'";
															$result1 = $conn->query($sql1);
															while ($row1 = $result1->fetch_assoc()) {
																$name_water_list = $row1['water_name'];
															}
															echo $name_water_list;
															?></td>
														<td>
															<?php
															$lat_map = explode(",", $lat_map);
															$val_lat = 0;
															foreach ($lat_map as $key => $value) {
																$val_lat += $value;
															}
															$lng_map = explode(",", $lng_map);
															$val_lng = 0;
															foreach ($lng_map as $key => $value) {
																$val_lng += $value;
															}
															$val_lat = $val_lat / count($lat_map);
															$val_lng = $val_lng / count($lng_map);
															echo $val_lat . "," . $val_lng;
															?>
														</td>
														<td style="text-align: center;">
															<button style="padding: 10px 20px;background-color:<?= $color_map ?>"></button>
														</td>
														<td style="text-align: center;">
															<?php if ($status_map  == 1) { ?>
																<button style="text-align: center;display: inline" class="badge-success" type="button">เปิด</button>
															<?php } elseif ($status_map == 0) { ?>
																<button style="text-align: center;display: inline" class="badge-offline" type="button">ปิด</button>
															<?php } ?>
														</td>
														<td style="text-align: center;">
															<div class="inline" style="display: inline">
																<a href='admin_page_edit.php?id_map=<?= $id ?>'><button style="text-align: center;display: inline" class="badge-pending" type="button">แก้ไข</button></a>
																<button onclick="deleteMap<?= $id ?>()" style="text-align: center;display: inline" class="badge-trashed">ลบ</button>
															</div>
														</td>
													</tr>
													<script>
														function deleteMap<?= $id ?>() {
															Swal.fire({
																title: 'แน่ใจว่าต้องการลบ ?',
																showCancelButton: true,
																showCloseButton: true,
																focusConfirm: false,
																confirmButtonText: 'ใช่',
																cancelButtonText: 'ไม่',
																confirmButtonColor: '#5887ff',
																cancelButtonColor: '#f26464',
															}).then((result) => {
																if (result.isConfirmed) {
																	window.location = "manager_sql.php?delete_map&id=<?= $id ?>";
																} else if (result.isDenied) {
																	Swal.fire('Changes are not saved', '', 'info')
																}
															})
														}
													</script>
											<?php	 }
											}	?>
										</tbody>
									</table>


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
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $key_setup ?>&callback=initMap" async></script>
	<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" async></script> -->
	<!-- Chart library -->
	<script src="./plugins/chart.min.js"></script>
	<!-- Icons library -->
	<script src="plugins/feather.min.js"></script>
	<!-- Custom scripts -->
	<script src="js/script.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<script type="text/javascript">
		let map;
		let infoWindow;
		let contentString;

		function initMap() {

			let val = "<?= $test ?>";

			var centerCords = {
				lat: 15.2434614,
				lng: 104.8593945
			};
			map = new google.maps.Map(document.getElementById("map"), {
				zoom: 13.2,
				center: centerCords,
				// mapTypeId: "roadmap ",
				// mapTypeId: "satellite",
				mapTypeId: "hybrid",
				// mapTypeId: "terrain",
			});
			<?php
			// for($i=0;$i<$count;$i++){
			$i = 0;
			$file_map = [];
			$sql = "SELECT * FROM `val_map`";
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
					strokeOpacity: 1,
					strokeWeight: 2,
					fillColor: "<?= $color_map ?>",
					fillOpacity: 0.35,
					draggable: false,
					geodesic: false,
				});

				bermudaTriangle<?= $i ?>.setMap(map);
				// Add a listener for the click event.
				bermudaTriangle<?= $i ?>.addListener("click", showArrays<?= $i ?>);


				// infoWindow = new google.maps.InfoWindow();
				infoWindow<?= $i ?> = new google.maps.InfoWindow(); //multi


				function showArrays<?= $i ?>(event) {
					contentString =
						"<div style='width:400px;color:black;'><a class='stat-cards-info__profit warning' style='float:right' href='admin_page_edit.php?id_map=<?= $id ?>'>แก้ไข</a>" +
						// "<b>ตำแหน่ที่ <?= $id ?></b><br>" +
						"<h3 style='font-size:20px'><?= $name_map ?></h3>" +
						"<pre style='font-size:17px'><?= $detail_map ?></pre>" +
						"<h3 style='font-size:20px'>ประวัติการบันทึก</h3><br>" +
						// '<h3>' + markersOnMap[5].placeName + '</h3><br>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติ ณ วันที่ : <?= $date ?></span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติระดับน้ำ : <?= $level_water ?> ม.(รทก.)</span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติปริมาณน้ำ  : <?= $amount_water ?> ลบ.ม./ว</span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติอุณหภูมิ  : <?= $temp_water ?> °C</span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติความชื้น  : <?= $humidity_water ?> %</span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติความกดอากาศ  : <?= $MeanSeaLevelPressure_water ?> hPa</span>' +
						'<span class="stat-cards-info__profit" style="font-size:17px">ประวัติแรงลม  : <?= $rainfall_water ?> กม/ชม</span><br>' +
						'<h3 style="font-size: 20px;<?php if ($file_map[0] == null) {
														echo ';display:none';
													} ?>">รูปภาพอ้างอิง</h3><br>' +
						'<button <?php if ($file_map[0] == null) {
										echo 'style="display:none"';
									} ?> onclick="img_map<?= $i ?>()"><img class="box img1" src="./uploads/<?= $file_map[0] ?>" alt="" style="width:300px;"></button><button style="margin-top:10px;background-color: white;color:#3399ff;<?php if ($file_map[0] == null) {
																																																												echo ';display:none';
																																																											} ?>" class="stat-cards-info__profit" onclick="img_map<?= $i ?>()">ดูรูปภาพเพิ่มเติม</button>' +
						'<a onclick="deleteMap<?= $id ?>()" class="stat-cards-info__profit danger" style="float:right"><i style="font-size:24px" class="fa">&#xf1f8;</i></a>' +
						"</div><br>";
					// contentString =
					// 	"<div style='width:200px;color:black'><a class='stat-cards-info__profit warning' style='float:right' href='admin_page_edit.php?id_map=<?= $id ?>'>แก้ไข</a>" +
					// 	// "<b>ตำแหน่ที่ <?= $id ?></b><br>" +
					// 	"<b>ชื่อตำแหน่ง <?= $name_map ?></b>" +
					// 	"<pre><?= $detail_map ?></pre>" +
					// 	// "<a class='stat-cards-info__profit warning' href='#'>แก้ไข</a><br>" +
					// 	"<a onclick='deleteMap<?= $id ?>()' class='stat-cards-info__profit danger' style='float:right'><i style='font-size:24px' class='fa'>&#xf1f8;</i></a>" +
					// 	// "Clicked location: <br>" +
					// 	// event.latLng.lat() +
					// 	// "," +
					// 	// event.latLng.lng() +
					// 	"</div><br>";

					// Replace the info window's content and position.
					infoWindow<?= $i ?>.setContent(contentString);
					infoWindow<?= $i ?>.setPosition(event.latLng);
					infoWindow<?= $i ?>.open(map);

					// infoWindow<?= $i ?>.setContent(contentString);
					// infoWindow<?= $i ?>.setPosition(event.latLng);
					// infoWindow<?= $i ?>.open(map);
					// infowindow.close();

					// bermudaTriangle<?= $i ?>.addListener('mouseout', function() {
					// 	// infoWindow.open(null);
					// 	infoWindow<?= $i ?>.open(null);
					// });

					google.maps.event.addListener(map, "click", function(e) {
						// infoWindow.open(null);
						infoWindow<?= $i ?>.open(null);
					});
				}


				function deleteMap<?= $id ?>() {
					Swal.fire({
						title: 'แน่ใจว่าต้องการลบ ?',
						showCancelButton: true,
						showCloseButton: true,
						focusConfirm: false,
						confirmButtonText: 'ใช่',
						cancelButtonText: 'ไม่',
						confirmButtonColor: '#5887ff',
						cancelButtonColor: '#f26464',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location = "manager_sql.php?delete_map&id=<?= $id ?>";
						} else if (result.isDenied) {
							Swal.fire('Changes are not saved', '', 'info')
						}
					})
				}

			<?php
				$i++;
			}
			?>

		}
	</script>
	<script>
		<?php
		$i = 0;
		$sql = "SELECT * FROM `val_map` INNER JOIN list_water on list_water.water_path_list_add = val_map.list_water_map;";
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
				แ

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
				slides[currentIndex - 1].style.display = "block";
			}
		<?php $i++;
		} ?>
	</script>
	<script>
		function mySearch() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("inputSearch");
			filter = input.value.toUpperCase();
			table = document.getElementById("tbSearch");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[i];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
</body>

</html>