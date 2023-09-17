<?php
session_start();
if ($_SESSION['id_user']) {
	include("connect.php");
} else {
	session_destroy();
	header("location:index.php");
}

$sql = "SELECT * FROM `setup_system` LIMIT 1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$lat_setup = $row["lat_setup"];
	$lng_setup = $row["lng_setup"];
	$zoom_setup = $row["zoom_setup"];
	$type_setup = $row["type_setup"];
	$key_setup = $row["key_setup"];
}
////////////////////////////////////////////
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
function rand_c()
{
	$rand_color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
	return $rand_color;
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
</head>
<style>
	.imageSlides {
		display: none
	}

	img {
		margin: auto;
		display: block;
		width: 100%;
	}

	/* Our main images-slideshow container */
	.images-slideshow {
		max-width: 612px;
		position: relative;
		margin: auto;
	}

	/*Style for ">" next and "<" previous buttons */
	.slider-btn {
		cursor: pointer;
		position: absolute;
		top: 50%;
		width: auto;
		padding: 8px 16px;
		margin-top: -22px;
		color: rgb(0, 0, 0);
		font-weight: bold;
		font-size: 18px;
		transition: 0.6s ease;
		border-radius: 0 3px 3px 0;
		user-select: none;
		background-color: rgba(255, 255, 255, 0.5);
		border-radius: 50%;
	}

	/* setting the position of the previous button towards left */
	.previous {
		left: 2%;
	}

	/* setting the position of the next button towards right */
	.next {
		right: 2%;
	}

	/* On hover, adding a background color */
	.previous:hover,
	.next:hover {
		color: rgb(255, 253, 253);
		background-color: rgba(0, 0, 0, 0.8);
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
					<h2 class="main-title">
						ตั้งค่าระบบ
					</h2>
					<div class="row">
						<div class="col-lg-12">
							<article class="white-block" style="padding: 20px 5px 0px 5px;">
								<div class="white-block" style="border-radius:5px;">
									<h4>กำหนดจุดศูนย์กลางของแผนที่</h4>
									<br>
									<div class="container" style="padding: 0% 10%;">
										<div class="row">
											<div class="col-md-7 col-ms-12" style="margin-bottom:30px">
												<center>
													<form action="manager_sql.php" method="POST" id="form_setup">
														<div class="row">
															<div class="col-md-6 col-ms-12">
																<label class="form-label-wrapper">
																	<p class="form-label">ละติจูด </p>
																	<input name="lat_setup" disabled type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required value="<?= $lat_setup ?>">
																</label>
																<label class="form-label-wrapper">
																	<p class="form-label">ระยะการซูม</p>
																	<input name="zoom_setup" disabled type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required value="<?= $zoom_setup ?>">
																</label>
																<!-- <label class="form-label-wrapper">
																<p class="form-label">ไอคอนแม่น้ำ</p>
																<input disabled type="text" required>
															</label>
															<label class="form-label-wrapper">
																<p class="form-label">ไอคอนอุปกรณ์</p>
																<input disabled type="text" required>
															</label> -->
															</div>
															<div class="col-md-6">
																<label class="form-label-wrapper">
																	<p class="form-label">ลองจิจูด</p>
																	<input name="lng_setup" disabled type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required value="<?= $lng_setup ?>">
																</label>
																<label class="form-label-wrapper">
																	<p class="form-label">ประเภทการแสดง</p>
																	<select name="select_setup" id="select_setup" disabled class="form-select" id="autoSizingSelect">
																		<option disabled selected>เลือกประเภท</option>
																		<option <?php if ($type_setup == "roadmap") {
																					echo "selected";
																				} ?> value="roadmap">ดาวเทียม</option>
																		<option <?php if ($type_setup == "satellite") {
																					echo "selected";
																				} ?> value="satellite">แผนที่</option>
																		<option <?php if ($type_setup == "hybrid") {
																					echo "selected";
																				} ?> value="hybrid">ป้ายกำกับ</option>
																		<option <?php if ($type_setup == "terrain") {
																					echo "selected";
																				} ?> value="terrain">ภูมิประเทศ</option>

																		<!-- // mapTypeId: "roadmap",
																	mapTypeId: "satellite",
																	// mapTypeId: "hybrid",
																	// mapTypeId: "terrain", -->
																	</select>
																</label>
															</div>

															<div class="col-md-8">
																<label class="form-label-wrapper">
																	<p class="form-label">map key</p>
																	<input name="key_setup" disabled type="text" required value="<?= $key_setup ?>">
																</label>
															</div>
															<div class="col-md-12">
																<center style="margin-top: 20px;">
																	<button style="display: none;" name="save_setup" id="save_setup" class="form-btn primary-default-btn col-md-3">บันทึก</button>
																	<button style="display: none;" type="button" id="cancel_setup" class="form-btn warning-default-btn col-md-3" onclick="btnCancel()">ยกเลิก</button>
																	<button type="button" id="edit_setup" class="form-btn warning-default-btn col-md-3" onclick="btnEdit()">แก้ไข</button>
																</center>
															</div>
														</div>
													</form>
												</center>
											</div>
										</div>
									</div>
									<script>
										var btn_save = document.getElementById('save_setup');
										var btn_edit = document.getElementById('edit_setup');
										var btn_cancel = document.getElementById('cancel_setup');
										var select_setup = document.getElementById('select_setup');

										function btnEdit() {
											// alert('ok');
											btn_edit.style.display = "none";
											btn_save.style.display = "inline-block";
											btn_cancel.style.display = "inline-block";

											var input = document.getElementsByTagName('input');
											for (var i = 0; i < input.length; i++) {
												input[i].disabled = false;
											}
											select_setup.disabled = false;
										}

										function btnCancel() {
											// alert('ok');
											btn_edit.style.display = "block";
											btn_save.style.display = "none";
											btn_cancel.style.display = "none";

											document.getElementById("form_setup").reset();

											var input = document.getElementsByTagName('input');
											for (var i = 0; i < input.length; i++) {
												input[i].disabled = true;
											}
											select_setup.disabled = true;

										}
									</script>

								</div>
							</article>
							<article class="white-block" style="padding: 20px 5px 0px 5px;">
								<div style="height:650px" class="white-block" id="map" style="border-radius: 5px;"></div>
							</article>
							<article class="white-block" style="padding: 5px 5px;">
								<div style="display: inline;">
									<div class="col-lg-4 col-md-6 col-10" style="padding: 10px 0px;">
										<input type="text" id="inputSearch" onkeyup="mySearch()" placeholder="ค้นหา..." style="width: 100%;">
									</div>
								</div>
								<div class="users-table table-wrapper" id="update" style="width: 100%;height: 500px;overflow: auto;">
									<table class="posts-table" id="tbSearch">
										<thead>
											<tr class="users-table-info">
												<th style="text-align: center;width: 10%;">ลำดับ</th>
												<th style="width: 15%;">ชื่อตำแหน่ง</th>
												<th style="width: 15%;">ละติจูด</th>
												<th style="width: 15%;">ลองจิจูด</th>
												<th style="width: 10%;">ระดับเตือนภัย</th>
												<th style="width: 10%;">ระดับวิกฤต</th>
												<th style="text-align: center;width: 10%;">สถานะ</th>
												<th style="text-align: center;width: 20%;">จัดการข้อมูล</th>
												<!-- <th>จัดการ</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$sql = "SELECT * FROM `list_water`";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$id_water  = $row["id_water"];
													$water_name = $row["water_name"];
													$level_water_max1 = $row["level_water_max1"];
													$level_water_max2 = $row["level_water_max2"];
													$water_lat = $row["water_lat"];
													$water_lng = $row["water_lng"];
													$water_status = $row["water_status"];

											?>
													<tr>
														<td style="text-align: center;"><?= $num++ ?></td>
														<td><?= $water_name ?></td>
														<td><?= $water_lat ?></td>
														<td><?= $water_lng ?></td>
														<td><span class="badge-pending"><?= $level_water_max1 ?></span></td>
														<td><span class="badge-trashed"><?= $level_water_max2 ?></span></td>
														<td style="text-align: center;">
															<div class="form-group row">
																<input <?php
																		if ($water_status == 1) {
																			echo "checked";
																		}
																		?> style="margin-left: 25%;" name="status_map" type="checkbox" id="switch<?= $id_water ?>" value="1" /><label id="lbswitch" for="switch<?= $id_water ?>">Toggle</label>
																<b id="status_off<?= $id_water ?>" class="stat-cards-info__profit" style="margin: 5px 0px 0px 10px; font-size: 15px;"> ปิด</b>
																<b id="status_on<?= $id_water ?>" class="stat-cards-info__profit success" style="margin: 5px 0px 0px 10px; font-size: 15px;"> เปิด</b>
															</div>
														</td>
														<td style="text-align: center;">
															<div class="inline" style="display: inline">
																<button id="myBtn<?= $id_water ?>" style="text-align: center;display: inline" class="badge-pending" type="button">แก้ไข</button>
																<!-- <button onclick="deleteMap<?= $id_water ?>()" style="text-align: center;display: inline" class="badge-trashed">ลบ</button> -->
															</div>
														</td>
													</tr>
													<div id="myModal<?= $id_water ?>" class="modal">
														<!-- Modal content -->
														<div class="main users chart-page">
															<div class="container">
																<div class="row">
																	<div class="col-lg-2">
																	</div>
																	<div class="col-lg-10">
																		<article class="white-block">
																			<div class="modal-header">
																				<span style="color:gray" id="close_header<?= $id_water ?>" class="close">&times;</span>
																				<h3 class="stat-cards-info__num" style="font-size:25px">แก้ไขข้อมูล</h3>
																			</div>
																			<div class="modal-body">
																				<form action="manager_sql.php" method="POST">
																					<input hidden type="text" name="water_id" value="<?= $id_water ?>">
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ชื่อตำแหน่ง </label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="water_name" value="<?= $water_name; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ละติจูด </label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="water_lat" value="<?= $water_lat; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ลองจิจูด </label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="water_lng" value="<?= $water_lng; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ระดับเตือนภัย </label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="level_water_max1" value="<?= $level_water_max1; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ระดับวิกฤต </label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="level_water_max2" value="<?= $level_water_max2; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">สถานะ </label>
																						<div class="col-sm-5">
																							<div class="form-group row">
																								<input <?php
																										if ($water_status == 1) {
																											echo "checked";
																										}
																										?> style="margin-left: 20px;" name="water_status" type="checkbox" id="switchTb<?= $id_water ?>" value="1" /><label id="lbswitch" for="switchTb<?= $id_water ?>">Toggle</label>
																								<b id="status_offTb<?= $id_water ?>" class="stat-cards-info__profit" style="margin: 5px 0px 0px 10px; font-size: 15px;"> ปิด</b>
																								<b id="status_onTb<?= $id_water ?>" class="stat-cards-info__profit success" style="margin: 5px 0px 0px 10px; font-size: 15px;"> เปิด</b>
																							</div>
																							<script>
																								if (document.getElementById('switchTb<?= $id_water ?>').checked) {
																									document.getElementById("status_offTb<?= $id_water ?>").style.display = 'none';
																									document.getElementById("status_onTb<?= $id_water ?>").style.display = 'block';
																								} else {
																									document.getElementById("status_offTb<?= $id_water ?>").style.display = 'block';
																									document.getElementById("status_onTb<?= $id_water ?>").style.display = 'none';
																								}
																								$(function() {
																									$('#switchTb<?= $id_water ?>').on('click', function() {
																										if (document.getElementById('switchTb<?= $id_water ?>').checked) {
																											document.getElementById("status_offTb<?= $id_water ?>").style.display = 'none';
																											document.getElementById("status_onTb<?= $id_water ?>").style.display = 'block';
																										} else {
																											document.getElementById("status_offTb<?= $id_water ?>").style.display = 'block';
																											document.getElementById("status_onTb<?= $id_water ?>").style.display = 'none';
																										}

																									});
																								});
																							</script>
																						</div>
																					</div>
																					<br>
																			</div>
																			<div class="form-group row">
																				<label class="col-sm-2 col-form-label"></label>
																				<div class="col-sm-10">
																					<button name="admin_setup_update_water" style="padding:10px;float:left" class="badge-active" type="submit">
																						<h3 class="stat-cards-info__num" style="font-size:15px">บันทึก</h3>
																					</button>
																					<button style="padding:10px;float:left;margin-left:5px" class="badge-pending" id="close<?= $id_water ?>" type="button">
																						<h3 class="stat-cards-info__num" style="font-size:15px">ยกเลิก</h3>
																					</button>
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
		var modal<?= $id_water ?> = document.getElementById("myModal<?= $id_water ?>");
		var btn = document.getElementById("myBtn<?= $id_water ?>");
		var btn_close = document.getElementById("close<?= $id_water ?>");
		var span = document.getElementById("close_header<?= $id_water ?>");
		btn.onclick = function() {
			modal<?= $id_water ?>.style.display = "block";
		}
		btn_close.onclick = function() {
			document.getElementById('switchTb<?= $id_water ?>').checked = false;
			document.getElementById("status_offTb<?= $id_water ?>").style.display = 'block';
			document.getElementById("status_onTb<?= $id_water ?>").style.display = 'none';
			modal<?= $id_water ?>.style.display = "none";
		}
		span.onclick = function() {
			document.getElementById('switchTb<?= $id_water ?>').checked = false;
			document.getElementById("status_offTb<?= $id_water ?>").style.display = 'block';
			document.getElementById("status_onTb<?= $id_water ?>").style.display = 'none';
			modal<?= $id_water ?>.style.display = "none";
		}
		if (document.getElementById('switch<?= $id_water ?>').checked) {
			document.getElementById("status_off<?= $id_water ?>").style.display = 'none';
			document.getElementById("status_on<?= $id_water ?>").style.display = 'block';
		} else {
			document.getElementById("status_off<?= $id_water ?>").style.display = 'block';
			document.getElementById("status_on<?= $id_water ?>").style.display = 'none';
		}
		$(function() {
			$('#switch<?= $id_water ?>').on('click', function() {
				if (document.getElementById('switch<?= $id_water ?>').checked) {
					document.getElementById("status_off<?= $id_water ?>").style.display = 'none';
					document.getElementById("status_on<?= $id_water ?>").style.display = 'block';
					$.ajax({
						url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
						data: "water_status=1&water_id=<?= $id_water ?>&admin_setup_update_water_status=admin_setup_update_water_status",
						type: "POST",
						async: false,
						success: function(data, status) {
							setTimeout(function() {
								window.location.reload();
							}, 250);
						},
					});

				} else {
					document.getElementById("status_off<?= $id_water ?>").style.display = 'block';
					document.getElementById("status_on<?= $id_water ?>").style.display = 'none';
					$.ajax({
						url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
						data: "water_status=0&water_id=<?= $id_water ?>&admin_setup_update_water_status=admin_setup_update_water_status",
						type: "POST",
						async: false,
						success: function(data, status) {
							setTimeout(function() {
								window.location.reload();
							}, 250);
						},
					});
				}

			});
		});
	</script>
	<!-- <script>
		function deleteMap<?= $id_water ?>() {
			Swal.fire({
				title: 'แน่ใจว่าต้องการลบ ?',
				showCancelButton: true,
				showCloseButton: true,
				focusConfirm: false,
				confirmButtonText: 'ใช่',
				cancelButtonText: 'ไม่',
				confirmButtonColor: '#5887ff',
				focusConfirm: false,
				cancelButtonColor: '#f26464',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location = "manager_sql.php?delete_map&id=<?= $id_water ?>";
				} else if (result.isDenied) {
					Swal.fire('Changes are not saved', '', 'info')
				}
			})
		}
	</script> -->
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
<script src="js/sweetalert2@11.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script type="text/javascript">
	let map;
	let infoWindow;
	let contentString;

	function initMap() {
		var centerCords = {
			lat: <?= $lat_setup ?>,
			lng: <?= $lng_setup ?>
		};
		map = new google.maps.Map(document.getElementById("map"), {
			zoom: <?= $zoom_setup ?>,
			center: centerCords,
			// mapTypeId: "roadmap",
			mapTypeId: "<?= $type_setup ?>",
			// mapTypeId: "hybrid",
			// mapTypeId: "terrain",
		});
		<?php
		// for($i=0;$i<$count;$i++){
		$i = 0;
		$sql = "SELECT * FROM `list_water` WHERE water_status = 1";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id_water  = $row["id_water"];
			$water_name = $row["water_name"];
			$level_water_max1 = $row["level_water_max1"];
			$level_water_max2 = $row["level_water_max2"];
			$water_lat = $row["water_lat"];
			$water_lng = $row["water_lng"];
			$water_status = $row["water_status"];
		?>
			const marker<?= $id_water ?> = new google.maps.Marker({
				position: {
					lat: <?= $water_lat ?>,
					lng: <?= $water_lng ?>
				},
				map: map,
				title: '<?= $water_name ?>',
				icon: 'img/mark_map.png',
			});
			var InforObj = [];
			var contentString<?= $id_water ?> = '<div style="height: 200px;width: 300px;color:black;margin-top:5px" id="content">' +
				'<a id="btnEdit<?= $id_water ?>" style="float:right" class="stat-cards-info__profit warning" >แกไข</a><br>' +
				'<b><span class="stat-cards-info__profit fw"><?= $water_name ?></span></b>' +
				'<span class="stat-cards-info__profit mt-1">ละติจูด  : <?= $water_lat ?></span>' +
				'<span class="stat-cards-info__profit mt-1">ลองจิจูด  : <?= $water_lng ?></span>' +
				'<span class="stat-cards-info__profit mt-1">ระดับเตือนภัย  : <?= $level_water_max1 ?></span>' +
				'<span class="stat-cards-info__profit mt-1">ระดับวิกฤต  : <?= $level_water_max2 ?></span>' +
				'<div>' +
				'<span class="stat-cards-info__profit mt-1">สถานะ  : ' +
				'<input <?php if ($water_status == 1) {
							echo "checked";
						} ?> style="margin-left: 5%;" type="checkbox" id="switchMap<?= $id_water ?>" value="1" /><label id="lbswitch" for="switchMap<?= $id_water ?>">Toggle</label></br></br></div>' +
				// '<span class="stat-cards-info__profit">ฝน  : <?= $id_water ?></span><br>'+
				'</div>';
			const infowindow<?= $id_water ?> = new google.maps.InfoWindow({
				content: contentString<?= $id_water ?>,
				maxWidth: 400,
			});
			marker<?= $id_water ?>.addListener('click', function() {
				closeOtherInfo();
				infowindow<?= $id_water ?>.open(marker<?= $id_water ?>.get('map'), marker<?= $id_water ?>);
				InforObj[0] = infowindow<?= $id_water ?>;


			});

			google.maps.event.addListener(map, "click", function(e) {
				closeOtherInfo();
			});


			google.maps.event.addListener(infowindow<?= $id_water ?>, "domready", function(e) {
				$(function() {
					$('#btnEdit<?= $id_water ?>').on('click', function() {
						document.getElementById("myModal<?= $id_water ?>").style.display = "block";
						// alert('ok')
					});
				});
				$(function() {
					$('#switchMap<?= $id_water ?>').on('click', function() {
						$.ajax({
							url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
							data: "water_status=0&water_id=<?= $id_water ?>&admin_setup_update_water_statusMap=admin_setup_update_water_statusMap",
							type: "POST",
							async: false,
							success: function(data, status) {
								setTimeout(function() {
									document.getElementById('switch<?= $id_water ?>').checked = false;
									document.getElementById('switchTb<?= $id_water ?>').checked = false;
									document.getElementById("status_off<?= $id_water ?>").style.display = 'block';
									document.getElementById("status_on<?= $id_water ?>").style.display = 'none';
									document.getElementById("status_offTb<?= $id_water ?>").style.display = 'block';
									document.getElementById("status_onTb<?= $id_water ?>").style.display = 'none';
									marker<?= $id_water ?>.setMap(null);
								}, 250);
							},
						});
					});
				});
			});

		<?php
			$i++;
		}
		?>

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

	}
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
<?php
if (isset($_SESSION['save_success'])) {
	echo "<script>
		Swal.fire({
			position: 'center',
			icon: 'success',
			title: '" . $_SESSION['save_success'] . "',
			showConfirmButton: false,
			timer: 2000
		})
	</script>";
}
unset($_SESSION['save_success']);
unset($_SESSION['status']);
?>