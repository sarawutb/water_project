<?php
session_start();
	 if ($_SESSION['id_user']) {
 			include("connect.php");
 	 }else {
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
	 function rand_c(){
	 	$rand_color = '#'.substr(str_shuffle('ABCDEF0123456789'), 0, 6);
	 	return $rand_color;
	 }

	 $test = "{lat:15.254441843827616,lng:104.86393494289655},{lat:15.24856249228037,lng:104.85642475765485},{lat:15.252620090514537,lng:104.85595268886823}^{lat:15.255849551477576,lng:104.869599768336},{lat:15.253945003581476,lng:104.8710588900401},{lat:15.25419342385141,lng:104.86753983181256}";
   $test2 = explode("^",$test);
	 // $test2 = $test;
	 $count = count($test2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบ</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.css">
  <!-- <script src="js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script> -->
  <!-- <script type="text/javascript" src="js/d_y.js"></script> -->
  <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.th.js"></script>
	<script src='js/fa-icon.js' crossorigin='anonymous'></script>
</head>
	<style>
	select {
// A reset of styles, including removing the default dropdown arrow
background-color: transparent;
border: none;
padding: 0 1em 0 0;
margin: 0;
width: 100%;
font-family: inherit;
font-size: inherit;
cursor: inherit;
line-height: inherit;

// Stack above custom arrow
z-index: 1;

// Remove dropdown arrow in IE10 & IE11
// @link https://www.filamentgroup.com/lab/select-css.html
&::-ms-expand {
	display: none;
}

// Remove focus outline, will add on alternate element
outline: none;
}

.select {
display: grid;
grid-template-areas: "select";
align-items: center;
position: relative;

select,
&::after {
	grid-area: select;
}

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
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="index.php" class="logo-wrapper" title="Home">
                <span class="sr-only">หน้าหลัก</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">ระบบ</span>
                    <span class="logo-subtitle">อุบลราชธานี</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
				<div class="sidebar-body">
            <ul class="sidebar-body-menu">
							<li>
									<a class="" href="index.php"><span class="icon home" aria-hidden="true"></span>หน้าแรก</a>
							</li>
							<li>
									<a class="" href="list_data.php"><span class="icon document" aria-hidden="true"></span>รายงานสถิติข้อมูล</a>
							</li>
							</ul>
							<span class="system-menu__title">ระบบ</span>
	            <ul class="sidebar-body-menu">
								<?php if(isset($_SESSION["status_user"])){ ?>
									<li>
	                    <a class="" href="admin_page1.php"><span class="icon edit" aria-hidden="true"></span>จัดการข้อมูล</a>
											<ul class="cat-sub-menu"></ul>
									</li>
	                <li>
	                    <a class="active" href="admin_page2.php"><span class="icon move" aria-hidden="true"></span>กำหนดจุดพิกัด</a>
									</li>
	                <li>
	                    <a class="" href="admin_page3.php"><span class="icon setting" aria-hidden="true"></span>กำหนดค่าระบบ</a>
									</li>
	                <li>
										<span class="system-menu__title">ออกจากระบบ</span>
	                    <a class="" href="auth/logout_manager.php"><span class="icon settings-line" aria-hidden="true"></span>ออกจากระบบ</a>
									</li>
								<?php }else{ ?>
	                <li>
	                    <a href="login.php"><span class="icon user-3" aria-hidden="true"></span>เข้าสู่ระบบ</a>
									</li>
								<?php } ?>
            </ul>
        </div>
    </div>
</aside>
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


        </div>
      </div>
    </main>
    <!-- ! Footer -->
    <footer class="footer">
  <div class="container footer--flex">
    <div class="footer-start">
      <p>2021 © dashboard <a href="dashboard.com" target="_blank"
          rel="noopener noreferrer">dashboard.com</a></p>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&callback=initMap&v=weekly"async></script>
<script type="text/javascript">
let map;
let infoWindow;
let contentString;

function initMap() {

	let val = "<?=$test?>";

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
	$i=0;
	$sql = "SELECT * FROM `val_map`";
	$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
		 $id = $row["id"];
		 $lat_map = $row["lat_map"];
		 $lng_map = $row["lng_map"];
		 $color_map = $row["color_map"];
		 $name_map = $row["name_map"];
		 $detail_map = $row["detail_map"];

		 $val_lat_lng = "";
		 $arr_lat = explode(",",$lat_map);
		 $arr_lng = explode(",",$lng_map);
			for($arr_i=0;$arr_i<count($arr_lat);$arr_i++){
				$lat_val = $arr_lat[$arr_i];
				$lng_val = $arr_lng[$arr_i];
				$val = "{lat:".$lat_val.",lng:".$lng_val."},";
				$val_lat_lng = $val_lat_lng.$val;
			}
			// $test = $val_lat_lng;
			$pattern = '/\r\n/i';
			$detail_map = preg_replace($pattern, '\n', $detail_map);
  ?>

  const bermudaTriangle<?=$i?> = new google.maps.Polygon({
    map,
    paths: [<?=$val_lat_lng?>],
    strokeColor: "<?=$color_map?>",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "<?=$color_map?>",
    fillOpacity: 0.35,
    draggable: false,
    geodesic: false,
  });

	bermudaTriangle<?=$i?>.setMap(map);
  // Add a listener for the click event.
  bermudaTriangle<?=$i?>.addListener("click", showArrays<?=$i?>);


  // infoWindow = new google.maps.InfoWindow();
  infoWindow<?=$i?> = new google.maps.InfoWindow(); //multi


	function showArrays<?=$i?>(event) {
	   contentString =
	    "<div style='width:200px;color:black'><a class='stat-cards-info__profit warning' style='float:right' href='admin_page_edit.php?id_map=<?=$id?>'>แก้ไข</a>"+
			// "<b>ตำแหน่ที่ <?=$id?></b><br>" +
	    "<b>ชื่อตำแหน่ง <?=$name_map?></b>" +
	    "<pre><?=$detail_map?></pre>" +
	    // "<a class='stat-cards-info__profit warning' href='#'>แก้ไข</a><br>" +
	    "<a class='stat-cards-info__profit danger' style='float:right' href='manager_sql.php?delete_map&id=<?=$id?>'><i style='font-size:24px' class='fa'>&#xf1f8;</i></a>" +
	    // "Clicked location: <br>" +
	    // event.latLng.lat() +
	    // "," +
	    // event.latLng.lng() +
	    "</div><br>";

	  // Replace the info window's content and position.
	  infoWindow<?=$i?>.setContent(contentString);
	  infoWindow<?=$i?>.setPosition(event.latLng);
	  infoWindow<?=$i?>.open(map);

	  // infoWindow<?=$i?>.setContent(contentString);
	  // infoWindow<?=$i?>.setPosition(event.latLng);
	  // infoWindow<?=$i?>.open(map);
		// infowindow.close();

		bermudaTriangle<?=$i?>.addListener('mouseout', function () {
				// infoWindow.open(null);
				infoWindow<?=$i?>.open(null);
		});
	}
  <?php
  $i++;  }
  ?>

}


</script>
</body>

</html>
