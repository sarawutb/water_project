<?php
date_default_timezone_set("Asia/Bangkok");
$dm = date("d/m");
$y = date("Y") + 543;
$date = $dm . "/" . $y;

$time_check = date('Hm');
if($time_check <= 2330){
// $url = 'https://data.tmd.go.th/api/Weather3Hours/V1/?type=json';
// $file = "data/tmd_data.json";
// $src = fopen($url, 'r');
// $dest = fopen($file, 'w');
// echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=15.225&lon=104.853&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric';
$file = "data/openweathermap.json";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
//เขื่อนสิรินธร
$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=15.205582815271105&lon=105.43017479728458&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric';
$file = "data/openweathermap2.json";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=15.333419113503242&lon=105.47536519417388&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric';
$file = "data/openweathermap3.json";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=15.071231788507392&lon=105.0675199974246&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric';
$file = "data/openweathermap4.json";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
//TS17หน้าเขื่อนปากมูล
$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=15.282451918106943&lon=105.46825981276895&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric';
$file = "data/openweathermap5.json";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

$url = 'https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=2&dam=PMN&sdate=' . $date;
$url_get = file_get_contents($url);
$url_list = iconv('cp874', 'UTF-8', $url_get);
preg_match_all('/<TD class="LabelC NoData" width="8%"> (.*?) <\/TD>/is', $url_list, $val_water);
$val_water = implode("", $val_water[1]);

if ($val_water == "ไม่มีข้อมูล") {
  echo "data/water_ubon_level_list.php NO SAVE <br>";
} else {
  $file = "data/water_ubon_level_list.php";
  $src = fopen($url, 'r');
  $dest = fopen($file, 'w');
  echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
}

$url = 'https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=3&dam=PMN&sdate=' . $date;
$url_get = file_get_contents($url);
$url_list = iconv('cp874', 'UTF-8', $url_get);
preg_match_all('/<TD class="LabelC NoData" width="8%"> (.*?) <\/TD>/is', $url_list, $val_water1);
$val_water1 = implode("", $val_water1[1]);
if ($val_water1 == "ไม่มีข้อมูล") {
  echo "data/water_ubon_amount.php NO SAVE <br>";
} else {
  $file = "data/water_ubon_amount.php";
  $src = fopen($url, 'r');
  $dest = fopen($file, 'w');
  echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
}

// $url = 'https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=2&dam=PMN&sdate='.$date;
// $url_get = file_get_contents($url);
// $url_list = iconv( 'cp874', 'UTF-8', $url_get);
// preg_match_all('/<TD class="LabelC NoData" width="8%"> (.*?) <\/TD>/is', $url_list, $val_water);
// $val_water = implode("",$val_water[1]);
// if($val_water == "ไม่มีข้อมูล"){
//   echo "data/water_ubon_level_data.php NO SAVE <br>";
// }else {
//     $file = "data/water_ubon_amount.php";
//     $src = fopen($url, 'r');
//     $dest = fopen($file, 'w');
//     echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
// }

$url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=16';
$file = "data/water_ubon_level_ts16.php";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " สถานีTS16 แม่น้ำมูล เมืองอุบลราชธานี (M.7) จ.อุบลราชธานี.\n";
$url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=17';
$file = "data/water_ubon_level_ts17.php";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " สถานีTS17 หน้าเขื่อนปากมูล จ.อุบลราชธานี.\n";
$url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=6';
$file = "data/water_ubon_level_ts6.php";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " สถานีTS6 แม่น้ำโขง วัดห้วยสะคาม จ.อุบลราชธานี.\n";
$url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=14';
$file = "data/water_ubon_level_ts14.php";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " สถานีTS14 เขื่อนสิรินธร จ.อุบลราชธานี.\n";
$url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=7';
$file = "data/water_ubon_level_ts7.php";
$src = fopen($url, 'r');
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " สถานีTS7 ลำโดมใหญ่ บ้านนาเยีย จ.อุบลราชธานี	.\n";

//แม่น้ำชี
// $url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_right.php?stationSI=1';
// $file = "data/water_ubon_see_level.php";
// $src = fopen($url, 'r');
// $dest = fopen($file, 'w');
// echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

// $url = 'https://watertele.egat.co.th/pakmun/dataStation/ajx_teledata_down.php?stationSI=16';
// $file = "data/water_ubon2.php";
// $src = fopen($url, 'r');
// $dest = fopen($file, 'w');
// echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

// $url = 'https://watertele.egat.co.th/pakmun/dataStation/cross_section.php?stationSI=16';
// $file = "data/water_ubon3.php";
// $src = fopen($url, 'r');
// $dest = fopen($file, 'w');
// echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";
}else{
  echo "No save All";
}
