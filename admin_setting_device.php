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

	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- Include Moment.js CDN -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<!-- Include Bootstrap DateTimePicker CDN -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
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

	.list-unstyles {
		/* margin-left: 100px;
		z-index: 1000; */
		/* margin: 0; */
		background-color: red;
		/* width: 10%; */
		/* overflow-x: scroll; */
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
						ตั้งค่าอุปกรณ์
					</h2>
					<div class="row">
						<div class="col-lg-12">
							<article class="white-block" style="padding: 20px 5px 0px 5px;">
								<div style="height:650px" class="white-block" id="map" style="border-radius: 5px;">
								</div>
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
												<th style="width: 20%;">ชื่ออุปกรณ์</th>
												<th style="width: 20%;">ละติจูด</th>
												<th style="width: 20%;">ลองจิจูด</th>
												<th style="text-align: center;width: 10%;">สถานะ</th>
												<th style="text-align: center;width: 20%;">จัดการข้อมูล</th>
												<!-- <th>จัดการ</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$num = 1;
											$sum_lsit = 0;
											$avglat = 0;
											$avglng = 0;
											$sql = "SELECT * FROM `list_device` ORDER BY `device_id` ASC";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$device_id = $row["device_id"];
													$device_name = $row["device_name"];
													$device_lat = $row["device_lat"];
													$device_lng = $row["device_lng"];
													$device_status = $row["device_status"];
													$avglat += $device_lat;
													$avglng += $device_lng;
													$sum_lsit++;
											?>
													<tr>
														<td style="text-align: center;">
															<?= $num++ ?>
														</td>
														<td>
															<?= $device_name ?>
														</td>
														<td>
															<?= $device_lat ?>
														</td>
														<td>
															<?= $device_lng ?>
														</td>
														<td style="text-align: center;">
															<div class="form-group row">
																<input <?php
																		if ($device_status == 1) {
																			echo "checked";
																		}
																		?> style="margin-left: 25%;" name="status_map" type="checkbox" id="switch<?= $device_id ?>" value="1" /><label id="lbswitch" for="switch<?= $device_id ?>">Toggle</label>
																<b id="status_off<?= $device_id ?>" class="stat-cards-info__profit" style="margin: 5px 0px 0px 10px; font-size: 15px;"> ปิด</b>
																<b id="status_on<?= $device_id ?>" class="stat-cards-info__profit success" style="margin: 5px 0px 0px 10px; font-size: 15px;"> เปิด</b>
															</div>
														</td>
														<td style="text-align: center;">
															<div class="inline" style="display: inline">
																<button id="myBtn<?= $device_id ?>" style="text-align: center;display: inline" class="badge-pending" type="button">แก้ไข</button>
																<!-- <button onclick="deleteMap<?= $device_id ?>()" style="text-align: center;display: inline" class="badge-trashed">ลบ</button> -->
															</div>
														</td>
													</tr>
													<div id="myModal<?= $device_id ?>" class="modal">
														<!-- Modal content -->
														<div class="main users chart-page">
															<div class="container">
																<div class="row">
																	<div class="col-lg-2">
																	</div>
																	<div class="col-lg-10">
																		<article class="white-block">
																			<div class="modal-header">
																				<span style="color:gray" id="close_header<?= $device_id ?>" class="close">&times;</span>
																				<h3 class="stat-cards-info__num" style="font-size:25px">แก้ไขข้อมูล</h3>
																			</div>
																			<div class="modal-body">
																				<form action="manager_sql.php" method="POST">
																					<input hidden type="text" name="device_id" value="<?= $device_id ?>">
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ชื่อตำแหน่ง
																						</label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="device_name" value="<?= $device_name; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ละติจูด
																						</label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="device_lat" value="<?= $device_lat; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ลองจิจูด
																						</label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="device_lng" value="<?= $device_lng; ?>" />
																						</div>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ระดับเตือนภัย
																						</label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="device_lng" value="" />
																						</div>
																						<span>เมตร</span>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ระดับวิกฤต
																						</label>
																						<div class="col-sm-5">
																							<input class="" style="width: 100%;" type="text" name="device_lng" value="" />
																						</div>
																						<span>เมตร</span>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">ตั้งเวลาเตือน
																						</label>
																						<div class="col-sm-5">
																							<input class="datepicker" style="width: 100%;" type="text" name="device_lng" value="" />
																						</div>
																						<span>นาฬิกา</span>
																					</div>
																					<br>
																					<div class="form-group row">
																						<label class="col-sm-2 col-form-label">สถานะ
																						</label>
																						<div class="col-sm-5">
																							<div class="form-group row">
																								<input <?php
																										if ($device_status == 1) {
																											echo "checked";
																										}
																										?> style="margin-left: 20px;" name="device_status" type="checkbox" id="switchTb<?= $device_id ?>" value="1" /><label id="lbswitch" for="switchTb<?= $device_id ?>">Toggle</label>
																								<b id="status_offTb<?= $device_id ?>" class="stat-cards-info__profit" style="margin: 5px 0px 0px 10px; font-size: 15px;">
																									ปิด</b>
																								<b id="status_onTb<?= $device_id ?>" class="stat-cards-info__profit success" style="margin: 5px 0px 0px 10px; font-size: 15px;">
																									เปิด</b>
																							</div>
																							<script>
																								if (document.getElementById('switchTb<?= $device_id ?>').checked) {
																									document.getElementById("status_offTb<?= $device_id ?>").style.display = 'none';
																									document.getElementById("status_onTb<?= $device_id ?>").style.display = 'block';
																								} else {
																									document.getElementById("status_offTb<?= $device_id ?>").style.display = 'block';
																									document.getElementById("status_onTb<?= $device_id ?>").style.display = 'none';
																								}
																								$(function() {
																									$('#switchTb<?= $device_id ?>').on('click', function() {
																										if (document.getElementById('switchTb<?= $device_id ?>').checked) {
																											document.getElementById("status_offTb<?= $device_id ?>").style.display = 'none';
																											document.getElementById("status_onTb<?= $device_id ?>").style.display = 'block';
																										} else {
																											document.getElementById("status_offTb<?= $device_id ?>").style.display = 'block';
																											document.getElementById("status_onTb<?= $device_id ?>").style.display = 'none';
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
																					<button name="admin_setup_update2_water" style="padding:10px;float:left" class="badge-active" type="submit">
																						<h3 class="stat-cards-info__num" style="font-size:15px">บันทึก</h3>
																					</button>
																					<button style="padding:10px;float:left;margin-left:5px" class="badge-pending" id="close<?= $device_id ?>" type="button">
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
		var modal<?= $device_id ?> = document.getElementById("myModal<?= $device_id ?>");
		var btn = document.getElementById("myBtn<?= $device_id ?>");
		var btn_close = document.getElementById("close<?= $device_id ?>");
		var span = document.getElementById("close_header<?= $device_id ?>");
		btn.onclick = function() {
			modal<?= $device_id ?>.style.display = "block";
		}
		btn_close.onclick = function() {
			document.getElementById('switchTb<?= $device_id ?>').checked = false;
			document.getElementById("status_offTb<?= $device_id ?>").style.display = 'block';
			document.getElementById("status_onTb<?= $device_id ?>").style.display = 'none';
			modal<?= $device_id ?>.style.display = "none";
		}
		span.onclick = function() {
			document.getElementById('switchTb<?= $device_id ?>').checked = false;
			document.getElementById("status_offTb<?= $device_id ?>").style.display = 'block';
			document.getElementById("status_onTb<?= $device_id ?>").style.display = 'none';
			modal<?= $device_id ?>.style.display = "none";
		}
		if (document.getElementById('switch<?= $device_id ?>').checked) {
			document.getElementById("status_off<?= $device_id ?>").style.display = 'none';
			document.getElementById("status_on<?= $device_id ?>").style.display = 'block';
		} else {
			document.getElementById("status_off<?= $device_id ?>").style.display = 'block';
			document.getElementById("status_on<?= $device_id ?>").style.display = 'none';
		}
		$(function() {
			$('#switch<?= $device_id ?>').on('click', function() {
				if (document.getElementById('switch<?= $device_id ?>').checked) {
					document.getElementById("status_off<?= $device_id ?>").style.display = 'none';
					document.getElementById("status_on<?= $device_id ?>").style.display = 'block';
					$.ajax({
						url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
						data: "device_status=1&device_id=<?= $device_id ?>&admin_setup_update_device2_status=admin_setup_update_device2_status",
						type: "POST",
						async: false,
						success: function(data, status) {
							setTimeout(function() {
								window.location.reload();
							}, 250);
						},
					});

				} else {
					document.getElementById("status_off<?= $device_id ?>").style.display = 'block';
					document.getElementById("status_on<?= $device_id ?>").style.display = 'none';
					$.ajax({
						url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
						data: "device_status=0&device_id=<?= $device_id ?>&admin_setup_update_device2_status=admin_setup_update_device2_status",
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
		function deleteMap<?= $device_id ?>() {
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
					window.location = "manager_sql.php?delete_map&id=<?= $device_id ?>";
				} else if (result.isDenied) {
					Swal.fire('Changes are not saved', '', 'info')
				}
			})
		}
	</script> -->
<?php }
											} ?>
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
			<p>2021 © dashboard <a href="dashboard.com" target="_blank" rel="noopener noreferrer">dashboard.com</a>
			</p>
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

	<?php
	$avglat_list = $avglat / $sum_lsit;
	$avglng_list = $avglng / $sum_lsit;
	?>

	function initMap() {
		var centerCords = {
			lat: <?= $avglat_list ?>,
			lng: <?= $avglng_list ?>
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
		$sql = "SELECT * FROM `list_device` WHERE device_status = 1";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$device_id = $row["device_id"];
			$device_name = $row["device_name"];
			$device_lat = $row["device_lat"];
			$device_lng = $row["device_lng"];
			$device_status = $row["device_status"];
		?>
			const marker<?= $device_id ?> = new google.maps.Marker({
				position: {
					lat: <?= $device_lat ?>,
					lng: <?= $device_lng ?>
				},
				map: map,
				title: '<?= $device_name ?>',
				icon: 'img/mark_map_nb.png',
			});
			var InforObj = [];
			var contentString<?= $device_id ?> = '<div style="width: 300px;color:black;margin-top:5px" id="content">' +
				'<a id="btnEdit<?= $device_id ?>" style="float:right" class="stat-cards-info__profit warning" >แกไข</a><br>' +
				'<b><span class="stat-cards-info__profit fw"><?= $device_name ?></span></b>' +
				'<span class="stat-cards-info__profit mt-1">ละติจูด  : <?= $device_lat ?></span>' +
				'<span class="stat-cards-info__profit mt-1">ลองจิจูด  : <?= $device_lng ?></span>' +
				'<div>' +
				'<span class="stat-cards-info__profit mt-1">สถานะ  : ' +
				'<input <?php if ($device_status == 1) {
							echo "checked";
						} ?> style="margin-left: 5%;" type = "checkbox" id = "switchMap<?= $device_id ?>" value = "1" /> <label id="lbswitch" for="switchMap<?= $device_id ?>">Toggle</label></br ></br ></div > ' +
				// '<span class="stat-cards-info__profit">ฝน  : <?= $device_id ?></span><br>'+
				'</div>';
			const infowindow<?= $device_id ?> = new google.maps.InfoWindow({
				content: contentString<?= $device_id ?>,
				maxWidth: 400,
			});
			marker<?= $device_id ?>.addListener('click', function() {
				closeOtherInfo();
				infowindow<?= $device_id ?>.open(marker<?= $device_id ?>.get('map'), marker<?= $device_id ?>);
				InforObj[0] = infowindow<?= $device_id ?>;


			});

			google.maps.event.addListener(map, "click", function(e) {
				closeOtherInfo();
			});


			google.maps.event.addListener(infowindow<?= $device_id ?>, "domready", function(e) {
				$(function() {
					$('#btnEdit<?= $device_id ?>').on('click', function() {
						document.getElementById("myModal<?= $device_id ?>").style.display = "block";
						// alert('ok')
					});
				});
				$(function() {
					$('#switchMap<?= $device_id ?>').on('click', function() {
						$.ajax({
							url: "manager_sql.php?", //เรียกใช้งานไฟล์นี้
							data: "device_status=0&device_id=<?= $device_id ?>&admin_setup_update_device2_statusMap=admin_setup_update_device2_statusMap",
							type: "POST",
							async: false,
							success: function(data, status) {
								setTimeout(function() {
									document.getElementById('switch<?= $device_id ?>').checked = false;
									document.getElementById('switchTb<?= $device_id ?>').checked = false;
									document.getElementById("status_off<?= $device_id ?>").style.display = 'block';
									document.getElementById("status_on<?= $device_id ?>").style.display = 'none';
									document.getElementById("status_offTb<?= $device_id ?>").style.display = 'block';
									document.getElementById("status_onTb<?= $device_id ?>").style.display = 'none';
									marker<?= $device_id ?>.setMap(null);
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
	var defaults = {
		calendarWeeks: true,
		showClear: true,
		showClose: true,
		allowInputToggle: false,
		useCurrent: false,
		ignoreReadonly: true,
		minDate: new Date(),
		toolbarPlacement: 'bottom',
		// locale: 'nl',
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-angle-up',
			down: 'fa fa-angle-down',
			previous: 'fa fa-angle-left',
			next: 'fa fa-angle-right',
			today: 'fa fa-dot-circle-o',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	};
	var optionsTime = $.extend({}, defaults, {
		format: 'HH:mm'
	});

	$('.datepicker').datetimepicker(optionsTime);
	// $(".datepicker").datetimepicker({
	// 	format: "HH:mm:ss",
	// 	icons: {
	// 		time: "fa fa-clock-o",
	// 		date: "fa fa-calendar",
	// 		up: "fa fa-arrow-up",
	// 		down: "fa fa-arrow-down"
	// 	}
	// });
	// $(".datepicker").datepicker({
	// 	autoclose: true,
	// 	language: 'th-th',
	// 	format: "dd-mm-yyyy",
	// 	// startView: "months",
	// 	// minViewMode: "months",
	// 	autoclose: true
	// });
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