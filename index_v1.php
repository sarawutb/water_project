<?php
	 include("connect.php");
	 error_reporting(0);
	 $max_m = null;
	 $maxl_m = null;
	 $sql4 = "SELECT * FROM `val_water`";
								 $result4 = mysqli_query($conn, $sql4);
									 while ($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {
										 // $max_m =  $row4['amount_water'];
										 if($row4['amount_water'] > $max_m){
											 $max_m = $row4['amount_water'];
										 }
										 // $maxl_m =  $row4['level_water'];
										 if($row4['level_water'] > $maxl_m){
											 $maxl_m = $row4['level_water'];
										 }
									 }
									 // echo $maxl_m;
									 // echo "<br>";
//
$result_amount_water = null;
$result_level_water = null;
$arr_amount_water = null;
$arr_level_water = null;
$amount_water_max_m_sql = null;
$amount_level_water_m_sql = null;
$sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
							$result1 = mysqli_query($conn, $sql1);
								while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
									$date_y =  $row1['date_y'];
									$result_amount_water = "";
									$result_level_water = "";
									// $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
									$sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
																$result2 = mysqli_query($conn, $sql2);
																	while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {

																		$date_m =  $row2['date_m'];
																		$zero_num = 2;//จำนวนหลัก
																		$date_m = sprintf("%0".$zero_num."d",$date_m);
									$sql3 = "SELECT MAX(`level_water`) as amount_level_water_m , MAX(`amount_water`) as amount_water_max_m FROM val_water WHERE `date` LIKE '%$date_y-$date_m%'";
																$result3 = mysqli_query($conn, $sql3);
																	while ($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)) {
																		$amount_water_max_m_sql = $row3['amount_water_max_m'];
																		$amount_level_water_m_sql = $row3['amount_level_water_m'];

																		if($amount_water_max_m_sql == "-"){
																			$amount_water_max_m_sql = 0;
																		}

																		if($amount_level_water_m_sql == "-"){
																			$amount_level_water_m_sql = 0;
																		}

																		$amount_water_max_m =  $amount_water_max_m_sql.",";
																		$amount_level_water_m =  $amount_level_water_m_sql.",";
																		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
																		$color = '#1a8'.$rand[rand(0,15)].'ff';
															//	    echo $color;
																	}
																	$result_amount_water = $amount_water_max_m.$result_amount_water;
																	$result_level_water = $amount_level_water_m.$result_level_water;

																}
																$arr_amount = explode(",",$result_amount_water);
																array_pop($arr_amount);
																$result_amount_water = implode(",",$arr_amount);
																$arr_amount_water = $arr_amount_water.$result_amount_water."|";

																$arr_level = explode(",",$result_level_water);
																array_pop($arr_level);
																$result_level_water = implode(",",$arr_level);
																$arr_level_water = $arr_level_water.$result_level_water."|";
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
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
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
                      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                          $level_water =  $row['level_water'];
                          $amount_water =  $row['amount_water'];
                          $amount_water_map =  $row['amount_water'];
      		}
					$sql = "SELECT * FROM `val_nb1` WHERE `date_nb1` = '$date' ORDER BY `val_nb1`.`date_nb1` ASC";
						$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
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
  $url1 = file_get_contents('data/water_ubun_level.php');
  $url2 = file_get_contents('data/water_ubun_amount.php');
  preg_match_all('/<td   width="33%" class="Rsource1"  align=right   style=\'border-top: 1px solid; border-left: 1px solid  \'>(.*?)&nbsp;<\/td>/is', $url1, $val1);
  preg_match_all('/<div align=right>  (.*?) /is', $url2, $val2);
  $num = count($val2[1])-1;
  // echo $num;
  // print_r($num);
  $val1 = implode("",$val1[1]);
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
  <title>ระบบ</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
  <!-- <script src="js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script> -->
  <!-- <script type="text/javascript" src="js/d_y.js"></script> -->
  <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.th.js"></script>

</head>
<style>
#map {
height: 90%;
width: 100%;
}
</style>
<body>

  <div class="layer"></div>
<!-- ! Body -->
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="" class="logo-wrapper" title="Home">
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
									<a class="active" href="index.php"><span class="icon home" aria-hidden="true"></span>หน้าแรก</a>
							</li>
							<li>
									<a class="" href="list_data.php"><span class="icon document" aria-hidden="true"></span>รายงานสถิติข้อมูล</a>
							</li>
                <!-- <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Posts
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="posts.html">All Posts</a>
                        </li>
                        <li>
                            <a href="new-post.html">Add new post</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon folder" aria-hidden="true"></span>Categories
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="categories.html">All categories</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Media
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="media-01.html">Media-01</a>
                        </li>
                        <li>
                            <a href="media-02.html">Media-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon paper" aria-hidden="true"></span>Pages
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="pages.html">All pages</a>
                        </li>
                        <li>
                            <a href="new-page.html">Add new page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="comments.html">
                        <span class="icon message" aria-hidden="true"></span>
                        Comments
                    </a>
                    <span class="msg-counter">7</span>
                </li> -->
            </ul>
            <span class="system-menu__title">ระบบ</span>
            <ul class="sidebar-body-menu">
                <!-- <li>
                    <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Appearance</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Extentions
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="extention-01.html">Extentions-01</a>
                        </li>
                        <li>
                            <a href="extention-02.html">Extentions-02</a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>ผู้ใช้งาน
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="users-01.html">Users-01</a>
                        </li>
                        <li>
                            <a href="users-02.html">Users-02</a>
                        </li>
                    </ul>
                </li> -->
                <li>
                    <!-- <a href="##"><span class="icon setting" aria-hidden="true"></span>เข้าสู่ระบบ</a> -->
                    <a href="login.php"><span class="icon user-3" aria-hidden="true"></span>เข้าสู่ระบบ</a>
										<ul class="cat-sub-menu">
                        <!-- <li>
                            <a href="users-01.html">Users-01</a>
                        </li>
                        <li>
                            <a href="users-02.html">Users-02</a>
                        </li> -->
                    </ul>
								</li>
            </ul>
        </div>
    </div>
    <!-- <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">Nafisa Sh.</span>
                <span class="sidebar-user__subtitle">Support manager</span>
            </div>
        </a>
    </div> -->
</aside>
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
      <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input readonly type="text" placeholder="ค้นหา ..." required>
      </div>
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
        <ul class="users-item-dropdown notification-dropdown dropdown">
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">System just updated</span>
                <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                  here.</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon danger">
                <i data-feather="info" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">The cache is full!</span>
                <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                  interfere ...</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">New Subscriber here!</span>
                <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
              </div>
            </a>
          </li>
          <li>
            <a class="link-to-page" href="##">Go to Notifications page</a>
          </li>
        </ul>
      </div>
      <!-- <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">ข้อมูลผู้ใช้งาน</span>
          <span class="nav-user-img">
            <picture><source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="##">
              <i data-feather="user" aria-hidden="true"></i>
              <span>โปรไฟล์</span>
            </a></li> -->
          <!-- <li><a href="##">
              <i data-feather="settings" aria-hidden="true"></i>
              <span>Account settings</span>
            </a></li> -->
          <!-- <li><a class="danger" href="auth/logout_manager.php">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>ออกจากระบบ</span>
            </a></li>
        </ul>
      </div> -->
    </div>
  </div>
</nav>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">สถานีตรวจวัด แม่น้ำมูล(M.7)</h2>
        <!-- <div id="show">
      /////แสดงtmd
          </div> -->
        <!-- //////////////////////////////////// -->
        <div class="row stat-cards">
					<div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="droplet" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <h1 class="stat-cards-info__num" style="font-size:30px"><?=$level_water;?> <font style="font-size:15px">ม.(รทก.)</font></h1>
								<p class="stat-cards-info__progress">
									<span class="stat-cards-info__profit warning">
										ระดับเตือนภัย 113.34 ม.(รทก.)
									</span>
								</p>
								<p class="stat-cards-info__progress">
									<span class="stat-cards-info__profit danger">
										ระดับวิกฤต 113.84 ม.(รทก.)
									</span>
								</p>
								<p class="stat-cards-info__num">ระดับน้ำล่าสุด</p>
                <h1 class="stat-cards-info__num" style="font-size:30px"><?=$amount_water;?> <font style="font-size:15px">ลบ.ม./ว</font></h1>
                <p class="stat-cards-info__num">ปริมาณน้ำล่าสุด</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                  </span>
                  Last month
                </p> -->
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="thermometer" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <h1 class="stat-cards-info__num" style="font-size:30px"><?=$temp_tmd;?> °C</h1>
                <p class="stat-cards-info__num">อุณหภูมิ</p>
								<p class="stat-cards-info__progress">

                    <?php
                    if($temp_tmd >29){
                      echo '<span class="stat-cards-info__profit danger"><i data-feather="sun" aria-hidden="true"></i>';
                    }else if($temp_tmd >= 23 && $temp_tmd <= 28.9){
                      echo '<span class="stat-cards-info__profit success"><i data-feather="cloud" aria-hidden="true"></i>';
                    }else{
                      echo '<span class="stat-cards-info__profit primary"><i data-feather="trending-up" aria-hidden="true"></i>';
                    }
                    if($temp_tmd >= 40 ){
                      echo "อากาศร้อนจัด";
                    }else if($temp_tmd >= 35 && $temp_tmd <= 39.9){
                      echo "อากาศร้อน";
                    }else if($temp_tmd >= 29 && $temp_tmd <= 34.9){
                      echo "อากาศค่อนข้างร้อน";
                    }else if($temp_tmd >= 23 && $temp_tmd <= 28.9){
                      echo "อากาศปกติ";
                    }else if($temp_tmd >= 18 && $temp_tmd <= 22.9){
                      echo "อากาศเย็น";
                    }else if($temp_tmd >= 16 && $temp_tmd <= 17.9){
                      echo "อากาศค่อนข้างหนาว";
                    }else if($temp_tmd >= 8 && $temp_tmd <= 15.9){
                      echo "อากาศหนาว";
                    }else if($temp_tmd < 8){
                      echo "อากาศหนาวจัด";
                    }
                    ?>
                  </span>
                </p>
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$humidity_tmd;?> %</h1>
                <p class="stat-cards-info__num">ความชื้น</p>
								<!-- <h1 class="stat-cards-info__num" style="font-size:30px"><?=$humidity_tmd;?> %</h1>
                <p class="stat-cards-info__num">ความชื้น</p> -->

              </div>
            </article>
          </div>

          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon purple">
                <i data-feather="wind" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <?php
                // if($wind_tmd <= 0){
                //   $wind_tmd = "ลมสงบ";
                // }else{
                  // $wind_tmd = $wind_tmd." กม/ชม";
                // }
                ?>
								<?php
									$wind_tmd = $wind_tmd." กม/ชม";
								?>
                <h1 class="stat-cards-info__num" style="font-size:30px"><?=$wind_tmd;?> </h1>
								<p class="stat-cards-info__progress">
										<span class="stat-cards-info__profit success">
											<?php
											if($wind_tmd <= 0){
												$wind_tmd_val = "ลมสงบ";
											}else if($wind_tmd_val <= 10 ){
												$wind_tmd_val = "ลมอ่อน";
											}else if($wind_tmd > 10 ){
												$wind_tmd_val = "ลมแรง";
											}
											echo $wind_tmd_val;
											?>
										</span>
								</p>
								<p
								<?php
								if($wind_tmd <= 0){
									echo "hidden";
								}
								?>
								class="stat-cards-info__num">แรงลม</p>
                <!-- <p class="stat-cards-info__progress">
                  ทัศนวิสัย&nbsp;
                    <span class="stat-cards-info__profit success">
                       <?=$land_visibility_tmd;?> กิโลเมตร
                    </span>
                </p> -->
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$land_visibility_tmd;?> กิโลเมตร</h1>
                <p class="stat-cards-info__num">ทัศนวิสัยการมองเห็น</p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="sunrise" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num" style="font-size:30px"><?=$MeanSeaLevelPressure_tmd;?> hPa</p>
                <p class="stat-cards-info__num">ความกดอากาศ</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit warning">
                    <i data-feather="trending-up" aria-hidden="true"></i>0.00%
                  </span>
                  Last month
                </p> -->

								<p class="stat-cards-info__progress">

									<?php
									// if($rainfall_tmd <= 0){
									// 	$rainfall_tmd = "ไม่มีฝน";
									// }else{
									// 	$rainfall_tmd = $rainfall_tmd." มม.";
									// }
									?>
									<h1 class="stat-cards-info__num" style="font-size:27px"><?=$rainfall_tmd;?> </h1>
									<p
									<?php
									if($rainfall_tmd <= 0){
										// echo "hidden";
									}
									// ?>
									class="stat-cards-info__num">สภาพอากาศ</p>
                  <!-- </span> -->
                </p>
              </div>
            </article>
          </div>
        </div>
			<h2 class="main-title">สถานีตรวจวัด อ่างเก็บน้ำห้วยวังนอง(NB01)</h2>
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
								<i class="fa-regular fa-droplet"></i>
                <i data-feather="droplet" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <h1 class="stat-cards-info__num" style="font-size:30px"><?=$distance_nb1/100;?> <font style="font-size:30px"> เมตร</font></h1>
                <p class="stat-cards-info__num">ระดับตลิ่งน้ำ</p>
                <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <!-- <i data-feather="trending-up" aria-hidden="true"></i> -->
                    จากอุปกรณ์ nb-IOT
                  </span>
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="thermometer" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$temp_nb1;?> °C</h1>
                <p class="stat-cards-info__num">อุณหภูมิ</p>
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$humid_nb1;?> %</h1>
                <p class="stat-cards-info__num">ความชื้น</p>
                <!-- <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>0.24%
                  </span>
                  Last month
                </p> -->
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="sun" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$light_nb1;?> lux</h1>
                <p class="stat-cards-info__num">ค่าความเข้มแสง</p>
              </div>
            </article>
          </div>
					<div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="rss" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
								<h1 class="stat-cards-info__num" style="font-size:30px"><?=$rssi_nb1;?>  DB</h1>
                <p class="stat-cards-info__num">คลื่นสัญญาณ</p>
              </div>
            </article>
          </div>
        </div>

        <!-- ////////////////////////////////////////// -->
        <div class="row">
          <div class="col-lg-9">
						<article class="white-block">
							<div id="map" style="width: 100%; height: 400px;"></div>
						</article>


            <article class="white-block">
              <div class="chart2">
                <canvas id="myChart" height="230" aria-label="Site statistics" role="img"></canvas>
              </div>
              <div class="chart2">
                <canvas id="myChart2" height="250" aria-label="Site statistics" role="img"></canvas>
              </div>
            </article>
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
                    $y = date("Y")+543;
                    $date = $dm."/".$y;
                ?>
                <p>วันที่ <?=$date;?></p>
              </div>
              <?php
                $url = file_get_contents('data/water_ubun_level_list.php');
                $url_list = iconv( 'cp874', 'UTF-8', $url);
                preg_match_all('/title="(.*?)"/is', $url_list, $name_water);
                preg_match_all('/(<div align.*?)<\/div>/is', $url_list, $amount_water);
              ?>
              <ul class="top-cat-list">
                <li>
                    <div class="top-cat-list__title">
                      <div class="col-lg-8">
                        สถานี
                      </div>
                      <div class="col-lg-4">
                       <p style="text-align: right;">ระดับน้ำ</p>
                      </div>
                    </div>
                    <?php
                    // for($i=1;$i<=13;$i++){
                    ?>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=1&code=TS1"><?php print_r($name_water[1][0]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][312]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=2&code=TS2"><?php print_r($name_water[1][1]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][313]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=3&code=TS3"><?php print_r($name_water[1][2]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][314]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=4&code=TS4"><?php print_r($name_water[1][3]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][315]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=5&code=TS5"><?php print_r($name_water[1][4]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][316]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=6&code=TS6"><?php print_r($name_water[1][5]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][317]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=7&code=TS7"><?php print_r($name_water[1][6]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][318]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=12&code=TS12"><?php print_r($name_water[1][7]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][319]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=14&code=TS14"><?php print_r($name_water[1][8]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][320]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=15&code=TS15"><?php print_r($name_water[1][9]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][321]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=16&code=TS16"><?php print_r($name_water[1][10]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][322]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <div class="top-cat-list__subtitle">
                      <div class="col-lg-8">
                        <a href="https://watertele.egat.co.th/srdpm/dataStation/StationData.php?stationSI=17&code=TS17"><?php print_r($name_water[1][11]);?></a>
                      </div>
                      <div class="col-lg-4">
                        <?php print_r($amount_water[1][323]);?>
                      </div>
                      </div>
                    </div>
                    <br>
                    <br>

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
      <p>2021 © Elegant Dashboard - <a href="elegant-dashboard.com" target="_blank"
          rel="noopener noreferrer">elegant-dashboard.com</a></p>
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
    $(document).ready(function(){
    var dataget;
          $.ajax({
   // url: 'getxml.php',
   url: 'getxml.php',
   data: {
      format: 'json'
   },
   error: function() {
      alert("ไม่สามารถดึงข้อมูลได้");
   },
   dataType: 'json',
   success: function(data) {


    // console.log(data.Stations[0]);

   dataget = data.Stations;

// 	 var obj = [
//   {"name": "Afghanistan", "code": "AF"},
//   {"name": "Åland Islands", "code": "AX"},
//   {"name": "Albania", "code": "AL"},
//   {"name": "Algeria", "code": "DZ"}
// ];

// var WmoNumber = '48407';
var Province = 'อุบลราชธานี';
var indexselect;
for (var i = 0; i < dataget.length; i++){
  if (dataget[i].Province == Province){
		indexselect = i;
  }
}
                var newhtml = '';
                newhtml += '<p>สถานนีรายงานอากาศ : '+dataget[indexselect]['StationNameTh']+'</p>';
                newhtml += '<p>จังหวัด : '+dataget[indexselect]['Province']+'</p>';
                newhtml += '<p>ละติจดู (N)  : '+dataget[indexselect]['Latitude'].Value+'</p>';
                newhtml += '<p>ลองติจูด(E)  : '+dataget[indexselect]['Longitude'].Value+'</p>';
                newhtml += '<p>วันที่ตรวจวัด  : '+dataget[indexselect]['Observe'].Time+'</p>';
                newhtml += '<p>อุณหภูมอากาศปัจจุบัน(องศาเซลซียส)  : '+dataget[indexselect]['Observe']['Temperature'].Value+'</p>';
                newhtml += '<p>ความชื้อในอากาศ   : '+dataget[indexselect]['Observe']['RelativeHumidity'].Value+'</p>';
                newhtml += '<p>แรงลม   : '+dataget[indexselect]['Observe']['WindSpeed'].Value+'</p>';
                newhtml += '<p> ค่าเฉลี่ยความชื้นสัมพทธั ์(เปอร์เซ็นต์)    : '+dataget[indexselect]['Observe']['RelativeHumidity'].Value+'</p>';
                newhtml += '<p> ปริมาณน้ำฝน(มิลลิเมตร)    : '+dataget[indexselect]['Observe']['Rainfall'].Value+'</p>';
                newhtml += '<p> ทัศนวิสัย(กิโลเมตร)    : '+dataget[indexselect]['Observe']['LandVisibility'].Value+'</p>';

                $("#show").html(newhtml);

                $(document).ready(function () {
                  var Rainfall = dataget[indexselect]['Observe']['Rainfall'].Value;
                  var Temperature = dataget[indexselect]['Observe']['Temperature'].Value;
                  var RelativeHumidity = dataget[indexselect]['Observe']['RelativeHumidity'].Value;
                  var WindSpeed = dataget[indexselect]['Observe']['WindSpeed'].Value;
                  var MeanSeaLevelPressure = dataget[indexselect]['Observe']['MeanSeaLevelPressure'].Value;
                  var LandVisibility = dataget[indexselect]['Observe']['LandVisibility'].Value;
                  var level_water = <?=$val1;?>;
                  var amount_water = <?=$val2;?>;
                                        ajax_call = function() {
                                            $.ajax({ //create an ajax request to load_page.php
                                                type: "GET",
                                                url: "xinsert_data.php?level_water="+level_water+"&amount_water="+amount_water+"&land_visibility_tmd="+LandVisibility+"&rainfall_tmd="+Rainfall+"&temp_tmd="+Temperature+"&humidity_tmd="+RelativeHumidity+"&wind_tmd="+WindSpeed+"&MeanSeaLevelPressure_tmd="+MeanSeaLevelPressure,  //ส่งตัวแปร,
                                                dataType: "html", //expect html to be returned
                                                success: function (response) {
                                                    $("#show1").html(response);
                                                }
                                            });
                                        };
                                        var interval = 1000;
                                        setInterval(ajax_call, interval);
                                    });


    // $.ajax({
    //     url: "insert_data.php?", //เรียกใช้งานไฟล์นี้
    //     data: "level_water="+level_water+"&amount_water="+amount_water+"&rainfall_tmd="+Rainfall+"&temp_tmd="+Temperature+"&humidity_tmd="+RelativeHumidity+"&wind_tmd="+WindSpeed+"&MeanSeaLevelPressure_tmd="+MeanSeaLevelPressure,  //ส่งตัวแปร
    //     type: "GET",
    //     async:false,
    //     success: function(data, status) {
    //     $("#show_subject_std").html(data);
    //     },
    //  });
     $.each(data.Stations,function(i){

  });

   },
   type: 'GET'
    });
   });
	 $(document).ready(function () {
	 												ajax_call = function() {
	 														$.ajax({ //create an ajax request to load_page.php
	 																type: "GET",
	 																url: "xinsert_data_netpie.php",  //ส่งตัวแปร,
	 																dataType: "html", //expect html to be returned
	 																success: function (response) {
	 																		$("#show1").html(response);
	 																}
	 														});
	 												};
	 												var interval = 30000;
	 												setInterval(ajax_call, interval);
	 										});

   // $(document).ready(function () {
   //                         ajax_call = function() {
                               $.ajax({ //create an ajax request to load_page.php
                                   type: "GET",
                                   url: "save_data_water_ubon.php?",
                                   dataType: "html", //expect html to be returned
                                   success: function (response) {
                                       $("#show2").html(response);
                                   }
                               });
                       //     };
                       //     var interval = 1000;
                       //     setInterval(ajax_call, interval);
                       // });
  </script>

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
  $("#datepicker").datepicker( {
    autoclose: true,
    language:'th-th',
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
  <script>
  $(function () {
  var ctx = document.getElementById('myChart');
	var maxl_m = <?=$maxl_m;?>;
	let arr_level_water = "<?=$arr_level_water;?>";
	let myArray = arr_level_water.split("|");
	let myArray2 = myArray[0].split(",");
	 const text = myArray[0];
  if (ctx) {
    var myCanvas = ctx.getContext('2d');
    var myChart = new Chart(myCanvas, {
      type: 'line',
      data: {
			        labels: ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
			        datasets: [
								{
								label: 'ระดับเตือนภัย',
								data: [113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34 ,113.34],
								cubicInterpolationMode: 'monotone',
								tension: 0.4,
								backgroundColor: ['#ff9900'],
								borderColor: ['#ff9900'],
								borderWidth: 3,
								radius: 0
							},
							{
							label: 'ระดับวิกฤต',
							data: [113.84,113.84,113.84,113.84,113.84,113.84,113.84,113.84,113.84,113.84,113.84,113.84],
							cubicInterpolationMode: 'monotone',
							tension: 0.4,
							backgroundColor: ['#ff0000'],
							borderColor: ['#ff0000'],
							borderWidth: 3,
							radius: 0.1,

						},
					<?php
					$result_amount = "";
					$i = 0;
					$sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
					              $result1 = mysqli_query($conn, $sql1);
					                while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
					                  $date_y =  $row1['date_y'];
					                  $result_amount = "";
					                  // $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
					                  $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
					                                $result2 = mysqli_query($conn, $sql2);
					                                  while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {

					                                    $date_m =  $row2['date_m'];
					                                    $zero_num = 2;//จำนวนหลัก
					                                    $date_m = sprintf("%0".$zero_num."d",$date_m);
					                  $sql3 = "SELECT  MAX(`amount_water`) as amount_water_max_m FROM  val_water WHERE `date` LIKE '%$date_y-$date_m%'";
					                                $result3 = mysqli_query($conn, $sql3);
					                                  while ($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)) {
					                                    $amount_water_max_m =  $row3['amount_water_max_m'].",";
																							//$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
																					    //$color = '#1a'.$rand[rand(0,15)].$rand[rand(0,15)].'ff';

																					 	 $color = '#'.dechex(rand(0x000000, 0xFFFFFF));
																					 	 //echo $color;
																				//	    echo $color;
					                                  }
					                                  $result_amount = $amount_water_max_m.$result_amount;
																					}
														// 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
														//	$amount_water_arr =  $row2['amount_water'].",";
															//$result_amount_water = $amount_water_arr.$result_amount_water;
															//
															// $date_water_arr =  $row1['date'];
															// $strDate = explode("-", $date_water_arr);
															// $date_water_arr = "'".$strDate[2]."/".$strDate[1]."',";
														//	$date_amount_water = $date_water_arr.$date_amount_water;
					?>
					{
          label: 'ระดับน้ำปี '+<?=$date_y+543;?>,
          data: myArray[<?=$i++;?>].split(","),
          cubicInterpolationMode: 'monotone',
          tension: 0.4,
          backgroundColor: ['<?=$color;?>'],
          borderColor: ['<?=$color;?>'],
          borderWidth: 2
        },
				<?php } ?>
			]
      },
      options: {

					scales: {
		        y: {
		          // min: 105,
		          // max: maxl_m,
		          // ticks: {
		          //   stepSize: 1
		          // },
		          grid: {
		            color: '#EEEEEE'
		          }
		        },
		        x: {
		          grid: {
		            color: '#EEEEEE'
		          }
		        }
		      },
        elements: {
          point: {
            radius: 2
          }
        },
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: {
              boxWidth: 8,
              boxHeight: 8,
              usePointStyle: true,
              font: {
                size: 12,
                weight: '500'
              }
            }
          },
          title: {
            display: true,
            text: ['ระดับน้ำแม่น้ำมูล เมืองอุบลราชธานี', 'หน่วย : ม.(รทก.)'],
            align: 'start',
            color: '#909090',
            font: {
              size: 16,
              family: 'Inter',
              weight: '600',
              lineHeight: 1.4
            }
          }
        },
        tooltips: {
          mode: 'index',
          intersect: false
        },
        hover: {
          mode: 'nearest',
          intersect: true
        }
      }
    });
    // charts.visitors = myChart;
  }
});

$(function () {
var ctx = document.getElementById('myChart2');

var max_m = <?=$max_m;?>;
let arr_amount_water = "<?=$arr_amount_water;?>";
let myArray = arr_amount_water.split("|");
let myArray2 = myArray[0].split(",");
 const text = myArray[0];
 // const text = ["Banana", "Orange", "Apple", "Mango"];

// document.getElementById("demo").innerHTML = myArray2;
if (ctx) {
  var myCanvas = ctx.getContext('2d');
  var myChart = new Chart(myCanvas, {
    type: 'line',
    data:
		{
      labels: ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
      datasets: [
				<?php
				$result_amount = "";
				$i = 0;
				$sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
				              $result1 = mysqli_query($conn, $sql1);
				                while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
				                  $date_y =  $row1['date_y'];
				                  $result_amount = "";
				                  // $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
				                  $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
				                                $result2 = mysqli_query($conn, $sql2);
				                                  while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {

				                                    $date_m =  $row2['date_m'];
				                                    $zero_num = 2;//จำนวนหลัก
				                                    $date_m = sprintf("%0".$zero_num."d",$date_m);
				                  $sql3 = "SELECT  MAX(`amount_water`) as amount_water_max_m FROM  val_water WHERE `date` LIKE '%$date_y-$date_m%'";
				                                $result3 = mysqli_query($conn, $sql3);
				                                  while ($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)) {
				                                    $amount_water_max_m =  $row3['amount_water_max_m'].",";
																						$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
																				    $color = '#1a'.$rand[rand(0,15)].$rand[rand(0,15)].'ff';
																						$color = '#'.dechex(rand(0x000000, 0xFFFFFF));
																			//	    echo $color;
				                                  }
				                                  $result_amount = $amount_water_max_m.$result_amount;
																				}
													// 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
													//	$amount_water_arr =  $row2['amount_water'].",";
														//$result_amount_water = $amount_water_arr.$result_amount_water;
														//
														// $date_water_arr =  $row1['date'];
														// $strDate = explode("-", $date_water_arr);
														// $date_water_arr = "'".$strDate[2]."/".$strDate[1]."',";
													//	$date_amount_water = $date_water_arr.$date_amount_water;
				?>
				//for (let i = 0; i < 5; i++) {
				{
        label: 'ปริมาณน้ำปี '+<?=$date_y+543?> +' ',
        data: myArray[<?=$i++;?>].split(","),
        cubicInterpolationMode: 'monotone',
        tension: 0.4,
        backgroundColor: ['<?=$color;?>'],
        borderColor: ['<?=$color;?>'],
        borderWidth: 2
			},
	//	}

			<?php
		}
			?>
		]
    },
    options: {
      scales: {
        y: {
          // min: 0,
          // max: max_m+100,
          // ticks: {
          //   stepSize: 1000
          // },
          grid: {
            color: '#EEEEEE'
          }
        },
        x: {
					// min: 0,
          // max: max_m+100,
          // ticks: {
          //   stepSize: 1000
          // },
          grid: {
            color: '#EEEEEE'
          }
        }
      },
      elements: {
        point: {
          radius: 2
        }
      },
      plugins: {
        legend: {
          position: 'top',
          align: 'end',
          labels: {
            boxWidth: 8,
            boxHeight: 8,
            usePointStyle: true,
            font: {
              size: 12,
              weight: '500'
            }
          }
        },
        title: {
          display: true,
          text: ['ปริมาณน้ำสูงสุดแม่น้ำมูล เมืองอุบลราชธานีรายปี', 'หน่วย : (ลบ.ม./ว)'],
          align: 'start',
          color: '#909090',
          font: {
            size: 16,
            family: 'Inter',
            weight: '600',
            lineHeight: 1.4
          }
        }
      },
      tooltips: {
        mode: 'index',
        intersect: false
      },
      hover: {
        mode: 'nearest',
        intersect: true
      }
    }
  });
  // charts.visitors = myChart;
}
});
  </script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&libraries=
	places&callback=initAutocomplete"
	async defer></script> -->
	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&callback=initMap&v=weekly"
      async
    ></script>
	<script>
			var map;
			var InforObj = [];
			var centerCords = {
					lat: 15.2434614,
					lng: 104.8593945
			};
			var markersOnMap = [{
							placeName: "อ่างเก็บน้ำห้วยวังนอง",
							LatLng: [{
									lat: 15.248999,
									lng: 104.881926
							}]
					},
					{
							placeName: "อ่างเก็บน้ำห้วยม่วง",
							LatLng: [{
									lat: 15.279431,
									lng: 104.808524
							}]
					},
					{
							placeName: "สถานีสะพานเสรีประชาธิปไตย ( M.7 ) แม่น้ำมูล",
							LatLng: [{
									lat: 15.223535,
									lng: 104.857506
							}]
					}
			];

			window.onload = function () {
					initMap();
			};

			function addMarkerInfo() {
				const monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
		    const dateObj = new Date();
		    const month = monthNames[dateObj.getMonth()];
		    const day = String(dateObj.getDate()).padStart(2, '0');
		    const year = dateObj.getFullYear();
		    const date = day  + '\n'+ month  + '\n' + (year+543);
					// for (var i = 0; i < markersOnMap.length; i++) {
							var contentString = '<div style="height: 200px;" id="content">'+
							'<h3>' + markersOnMap[2].placeName +'</h3><br>'+
							'<span class="stat-cards-info__profit">วันที่ : '+date+'</span>'+
							'<span class="stat-cards-info__profit">ระดับน้ำ : <?=$level_water?> ม.(รทก.)</span>'+
							'<span class="stat-cards-info__profit">ปริมาณน้ำ  : <?=$amount_water_map?> ลบ.ม./ว</span>'+
							'<span class="stat-cards-info__profit">อุณหภูมิ  : <?=$temp_tmd?> °C</span>'+
							'<span class="stat-cards-info__profit">ความชื้น  : <?=$humidity_tmd?> %</span>'+
							'<span class="stat-cards-info__profit">ความกดอากาศ  : <?=$MeanSeaLevelPressure_tmd?> hPa</span>'+
							'<span class="stat-cards-info__profit">แรงลม  : <?=$land_visibility_tmd?> กม/ชม</span>'+
							'<span class="stat-cards-info__profit">ฝน  : <?=$rainfall_tmd?></span><br>'+
							'<a class="stat-cards-info__profit success" href="list_data.php">ดูรายละเอียด</a></div>';

							const marker = new google.maps.Marker({
									position: markersOnMap[2].LatLng[0],
									map: map,
									title: markersOnMap[2].placeName,
									icon: 'img/mark_map.png',
							});

							const infowindow = new google.maps.InfoWindow({
									content: contentString,
									maxWidth: 400,
							});

							marker.addListener('click', function () {
									closeOtherInfo();
									infowindow.open(marker.get('map'), marker);
									InforObj[0] = infowindow;
							});

							var contentString = '<div style="height: 150px;" id="content">'+
							'<h3>' + markersOnMap[0].placeName +'</h3><br>'+
							'<span class="stat-cards-info__profit">วันที่ : '+date+'</span>'+
							'<span class="stat-cards-info__profit">ระดับน้ำ : <?=$distance_nb1/100?> เมตร</span>'+
							'<span class="stat-cards-info__profit">อุณหภูมิ  : <?=$temp_nb1?> °C</span>'+
							'<span class="stat-cards-info__profit">ความชื้น  : <?=$humid_nb1?> %</span>'+
							'<br><a class="stat-cards-info__profit success" href="#">ดูรายละเอียด</a></div>';

							const marker1 = new google.maps.Marker({
									position: markersOnMap[0].LatLng[0],
									map: map,
									title: markersOnMap[0].placeName,
									icon: 'img/mark_map.png',
							});

							const infowindow1 = new google.maps.InfoWindow({
									content: contentString,
									maxWidth: 400
							});

							marker1.addListener('click', function () {
									closeOtherInfo();
									infowindow1.open(marker1.get('map'), marker1);
									InforObj[0] = infowindow1;
							});
							// marker.addListener('mouseover', function () {
							//     closeOtherInfo();
							//     infowindow.open(marker.get('map'), marker);
							//     InforObj[0] = infowindow;
							// });
							// marker.addListener('mouseout', function () {
							//     closeOtherInfo();
							//     infowindow.close();
							//     InforObj[0] = infowindow;
							// });
					// }
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

			function initMap() {
					map = new google.maps.Map(document.getElementById('map'), {
							zoom: 12.2,
							center: centerCords
					});
					addMarkerInfo();
			}
	</script>
</body>

</html>
