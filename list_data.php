<?php
session_start();
include("connect.php");
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


// echo $date_amount_water;





//echo  $data_id;
// }else {
// session_destroy();
//   header("location:login.php");
// }

if (isset($_GET['node'])) {
  $node = $_GET['node'];
} else {
  $node = 1;
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  #myChart1 {
    width: 380px;
    height: 700px;
  }

  @media (max-width: 400px) {
    #myChart1 {
      width: 160px;
      height: 600px;
    }
  }

  #myChart2 {
    width: 380px;
    height: 700px;
  }

  @media (max-width: 400px) {
    #myChart2 {
      width: 160px;
      height: 600px;
    }
  }

  @media (max-width: 400px) {
    #myChart3 {
      width: 110px;
      height: 600px;
    }
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
          <div class="select">
            <select id="my_node" onchange="select_node()">
              <?php
              $data_name_list = [];
              $data_path_list = [];
              $sql = "SELECT * FROM `list_water` WHERE water_status = 1";
              $result = mysqli_query($conn, $sql);
              while ($row_water = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name_water =  $row_water['water_name'];
                $water_path =  $row_water['water_path_list'];
                array_push($data_name_list, $name_water);
                array_push($data_path_list, $water_path);
              }
              $sql = "SELECT * FROM `list_device` WHERE device_status = 1";
              $result = mysqli_query($conn, $sql);
              while ($row_device = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $device_name =  $row_device['device_name'];
                $device_path =  $row_device['device_path_list'];
                array_push($data_name_list, $device_name);
                array_push($data_path_list, $device_path);
              }
              foreach ($data_name_list as $key => $value) {

              ?>
                <option <?php if ($node == $key + 1) {
                          echo "selected";
                        } ?> value="<?= $data_path_list[$key] ?>"><?= $value ?></option>
              <?php } ?>
            </select>
            <span class="focus"></span>
          </div>
          <br>
          <div id="show_main1">
          </div>
          <!-- <div id="show_main">
				</div> -->
          <!-- <div id="show">
      /////แสดงtmd
          </div> -->
          <!-- //////////////////////////////////// -->

          <!-- ////////////////////////////////////////// -->
          <!--   <div class="row">
          <div class="col-lg-12">
            <article class="white-block">
              <div class="chart2">
                <canvas id="myChart" aria-label="Site statistics" role="img"></canvas>
              </div>
              <div class="chart2">
                <canvas id="myChart2" aria-label="Site statistics" role="img"></canvas>
              </div>
            </article>


        </div>
      </div>-->
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

    // $.ajax({
    //   url: "chart_data01.php", //เรียกใช้งานไฟล์นี้
    //   data: "", //ส่งตัวแปร
    //   type: "GET",
    //   async: false,
    //   success: function(data, status) {
    //     $("#show_main").html(data);
    //   },
    // });
    $.ajax({
      url: my_node, //เรียกใช้งานไฟล์นี้
      data: "", //ส่งตัวแปร
      type: "GET",
      async: false,
      success: function(data, status) {
        $("#show_main1").html(data);
      },
    });

    function select_node() {
      var i = document.getElementById("my_node").selectedIndex;
      var my_node = document.getElementsByTagName("option")[i].value;
      $.ajax({
        url: my_node, //เรียกใช้งานไฟล์นี้
        data: "", //ส่งตัวแปร
        type: "GET",
        async: false,
        success: function(data, status) {
          $("#show_main1").html(data);
        },
      });
    }
  </script>
</body>

</html>