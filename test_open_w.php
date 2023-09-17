<?php
// header ('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json;charset=utf-8');
         // $url = file_get_contents('https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=2&dam=PMN&sdate=28/3/2565');
         $url = file_get_contents('https://watertele.egat.co.th/pakmun/Report/ajxShowDailyReport.php?data=ajxReportDaily&m2=3&dam=PMN&sdate=27/3/2565');
         // $urljson = file_get_contents('https://api.openweathermap.org/data/2.5/onecall?lat=15.225&lon=104.853&exclude=hourly,daily&appid=20ad3ba1a33ba6e2099f3744c5dee023&lang=th&units=metric');
        // $json = json_decode($urljson);

        // $url = file_get_contents('data/water_ubun_level_list.php');
        $url_list = iconv( 'cp874', 'UTF-8', $url);
        preg_match_all('/<TD class="LabelC NoData" width="8%"> (.*?) <\/TD>/is', $url_list, $val_water);
        print_r($val_water[1]);
        $val_water = implode("",$val_water[1]);

        if($val_water == "ไม่มีข้อมูล"){
          echo "rang";
        }else {
          echo "NO";
        }
        // preg_match_all('/(<div align.*?)<\/div>/is', $url_list, $amount_water);
        // <TD class="LabelC NoData" width="8%">

        // $json = json_decode($json);
            // $temp = $json->current->temp;
            // $pressure = $json->current->pressure;
            // $humidity = $json->current->humidity;
            // $visibility = $json->current->visibility;
            // $wind_speed = $json->current->wind_speed;
            // $description = $json->current->weather[0]->description;
            // echo round($temp)."<br>";
            // echo round($pressure)."<br>";
            // echo round($humidity)."<br>";
            // echo round($visibility/1000)."<br>";
            // echo round($wind_speed)."<br>";
            // echo $description."<br>";
            // echo $url_list;
            // print_r($name_water);
            // print_r($json);







?>
