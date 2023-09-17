<?php
include("../connect.php");
$date = $_GET['date'];
$date_ex = explode("-", $date);
// print_r($date_ex);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y . "-" . $m;
// echo $y_m_sql;


$result_amount_water = "";
$result_level_water = "";
$max1_level_water  = "";
$date_amount_water = "";
$cout = 0;
$sum = 0;
$max = null;
$maxl = null;
$sql1 = "SELECT * FROM `val_water_mun2` WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water_mun2`.`date` DESC";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
  // 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
  $amount_water_arr =  $row1['amount_water_mun2'] . ",";
  $amount_level_arr =  $row1['level_water_mun2'] . ",";
  $result_amount_water = $amount_water_arr . $result_amount_water;
  $result_level_water = $amount_level_arr . $result_level_water;
  $path = substr($_SERVER['PHP_SELF'] . "/", 15, -1);
  $sql = "SELECT * FROM `list_water` WHERE water_path_history = '$path'";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $level_water_max1 = $row["level_water_max1"];
    $level_water_max2 = $row["level_water_max2"];
  }
  $max1_level_water = $level_water_max1 . "," . $max1_level_water;

  $date_water_arr =  $row1['date'];
  $strDate = explode("-", $date_water_arr);
  $cout++;
  $sum = $sum + $row1['amount_water_mun2'];

  if ($row1['amount_water_mun2'] > $max) {
    $max = $row1['amount_water_mun2'];
  }
  if ($row1['level_water_mun2'] > $maxl) {
    $maxl = $row1['level_water_mun2'];
  }
  $date_water_arr = "'" . $strDate[2] . "',";
  $date_amount_water = $date_water_arr . $date_amount_water;
}
$min = null;
$minl = null;
$sql2 = "SELECT MIN(amount_water_mun2) AS min,MIN(level_water_mun2) AS minl FROM `val_water_mun2` WHERE `date` LIKE '%$y_m_sql%'";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
  $min = $row2['min'];
  $minl = $row2['minl'];
}
$min = $min - 10;
$max = $max + 10;
?>

<div class="users-table table-wrapper" style="width: 100%;height: 500px;overflow: auto;">
  <table class="posts-table">
    <thead>
      <tr class="users-table-info">
        <th style="text-align: center;">วันที่</th>
        <th style="text-align: center;">ระดับน้ำ ม.(รทก.)</th>
        <th style="text-align: center;">ปริมาณน้ำ ลบ.ม./ว</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>แรงลม กม/ชม</th>
        <th>ทัศนวิสัย กิโลเมตร</th>
        <th>ความกดอากาศ hPa</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      $temp_wather_mun2 = "-";
      $humidity_wather_mun2 = "-";
      $wind_wather_mun2 = "-";
      $date_wather_mun2 = "-";
      $MeanSeaLevelPressure_wather_mun2 = "-";
      $rainfall_wather_mun2 = "-";
      $land_visibility_wather_mun2 = "-";
      $sql = "SELECT * FROM `val_water_mun2` WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water_mun2`.`date` ASC";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $level_water =  $row['level_water_mun2'];
        $amount_water =  $row['amount_water_mun2'];
        $date_water =  $row['date'];

        $date_ex = explode("-", $date_water);
        $day = $date_ex[2];

        $sql1 = "SELECT * FROM `val_wather_mun2` WHERE date_wather_mun2 = '$date_water'";
        $result1 = mysqli_query($conn, $sql1);
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
          $temp_wather_mun2 =  $row1['temp_wather_mun2'];
          $humidity_wather_mun2 =  $row1['humidity_wather_mun2'];
          $wind_wather_mun2 =  $row1['wind_wather_mun2'];
          $date_wather_mun2 =  $row1['date_wather_mun2'];
          $MeanSeaLevelPressure_wather_mun2 =  $row1['MeanSeaLevelPressure_wather_mun2'];
          $rainfall_wather_mun2 =  $row1['rainfall_wather_mun2'];
          $land_visibility_wather_mun2 =  $row1['land_visibility_wather_mun2'];

          // $sql = "SELECT * FROM `list_water` WHERE db_water = 'val_wather_mun2' ";
          // $result = mysqli_query($conn, $sql);
          // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          //   $max2_level_water = $max2_level_water . $row['level_water_max1'] . ",";
          // }
        }
      ?>
        <tr class="users-table-info">
          <td style="text-align: center;">
            <?= $day; ?>
          </td>
          <td style="text-align: center;"><?= $level_water; ?></td>
          <td style="text-align: center;"><?= $amount_water; ?></td>
          <td><span class="badge-pending"><?= $temp_wather_mun2; ?></span></td>
          <td><span class="badge-active"><?= $humidity_wather_mun2; ?></span></td>
          <td><span class="badge-success"><?= $wind_wather_mun2; ?></span></td>
          <td><span class="badge-success"><?= $land_visibility_wather_mun2; ?></span></td>
          <td><span class="badge-success"><?= $MeanSeaLevelPressure_wather_mun2; ?></span></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="chart1">
  <canvas id="myChart1" height="180px"></canvas>
</div>
<div class="chart1">
  <canvas id="myChart3" height="180px"></canvas>
</div>
<script>
  $(function() {
    var ctx = document.getElementById('myChart1');
    const monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
    const dateObj = new Date();
    const month = monthNames[dateObj.getMonth()];

    if (ctx) {
      var myCanvas = ctx.getContext('2d');
      var myChart = new Chart(myCanvas, {
        type: 'line',
        data: {
          labels: [<?= $date_amount_water; ?>],
          datasets: [{
              label: 'ระดับวิกฤต',
              data: [<?= $max1_level_water ?>],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#ff0000'],
              borderColor: ['#ff0000'],
              borderWidth: 1,
              radius: 0.1,
            },
            {
              label: 'ระดับน้ำ',
              data: [<?= $result_level_water; ?>],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#1a75ff'],
              borderColor: ['#1a75ff'],
              borderWidth: 2
            },
          ]
        },
        options: {
          scales: {
            y: {
              min: <?= $minl - ($level_water_max1 % 15) ?>,
              max: <?= $level_water_max1 + ($level_water_max1 % 15) ?>,
              ticks: {
                stepSize: 0.25
              },
              grid: {
                display: true
              }
            },
            x: {
              grid: {
                color: '#909090'
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
                  size: 14,
                  weight: '500',
                  family: "'IBM Plex Sans Thai', sans-serif",
                }
              }
            },
            title: {
              display: true,
              text: ['ระดับน้ำหน้าเขื่อนปากมูล จ.อุบลราชธานี', 'เดือน ' + monthNames[<?= $m - 1 ?>] + " " + <?= $y + 543 ?>],
              align: 'start',
              color: '#909090',
              font: {
                size: 16,
                family: "'IBM Plex Sans Thai', sans-serif",
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

<script>
  $(function() {
    <?php
    $max_m = null;
    $maxl_m = null;
    $sql4 = "SELECT * FROM `val_water_mun2`";
    $result4 = mysqli_query($conn, $sql4);
    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
      if ($row4['amount_water_mun2'] > $max_m) {
        $max_m = $row4['amount_water_mun2'];
      }
      if ($row4['level_water_mun2'] > $maxl_m) {
        $maxl_m = $row4['level_water_mun2'];
      }
    }
    $result_amount_water_mun2 = null;
    $result_level_water_mun2 = null;
    $arr_amount_water_mun2 = null;
    $arr_level_water_mun2 = null;
    $amount_water_mun2_max_m_sql = null;
    $amount_level_water_mun2_m_sql = null;
    $sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water_mun2 ORDER BY YEAR(date) ASC";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
      $date_y =  $row1['date_y'];
      $result_amount_water_mun2 = "";
      $result_level_water_mun2 = "";
      // $sql2 = "SELECT * FROM `val_water_mun2` WHERE `date` LIKE '%$date_y%'";
      $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water_mun2` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
      $result2 = mysqli_query($conn, $sql2);
      while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $date_m =  $row2['date_m'];
        $zero_num = 2; //จำนวนหลัก
        $date_m = sprintf("%0" . $zero_num . "d", $date_m);
        $sql3 = "SELECT MAX(`level_water_mun2`) as amount_level_water_mun2_m , MAX(`amount_water_mun2`) as amount_water_mun2_max_m FROM val_water_mun2 WHERE `date` LIKE '%$date_y-$date_m%'";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
          $amount_water_mun2_max_m_sql = $row3['amount_water_mun2_max_m'];
          $amount_level_water_mun2_m_sql = $row3['amount_level_water_mun2_m'];
          if ($amount_water_mun2_max_m_sql == "-") {
            $amount_water_mun2_max_m_sql = 0;
          }
          if ($amount_level_water_mun2_m_sql == "-") {
            $amount_level_water_mun2_m_sql = 0;
          }

          $amount_water_mun2_max_m =  $amount_water_mun2_max_m_sql . ",";
          $amount_level_water_mun2_m =  $amount_level_water_mun2_m_sql . ",";
          $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
          $color = '#1a8' . $rand[rand(0, 15)] . 'ff';
        }
        $result_amount_water_mun2 = $amount_water_mun2_max_m . $result_amount_water_mun2;
        $result_level_water_mun2 = $amount_level_water_mun2_m . $result_level_water_mun2;
      }
      $arr_amount = explode(",", $result_amount_water_mun2);
      array_pop($arr_amount);
      $result_amount_water_mun2 = implode(",", $arr_amount);
      $arr_amount_water_mun2 = $arr_amount_water_mun2 . $result_amount_water_mun2 . "|";
      $arr_level = explode(",", $result_level_water_mun2);
      array_pop($arr_level);
      $result_level_water_mun2 = implode(",", $arr_level);
      $arr_level_water_mun2 = $arr_level_water_mun2 . $result_level_water_mun2 . "|";
    }
    ?>
    var ctx = document.getElementById('myChart3');
    var maxl_m = <?= $maxl_m; ?>;
    let arr_level_water_mun2 = "<?= $arr_level_water_mun2; ?>";
    let myArray = arr_level_water_mun2.split("|");
    let myArray2 = myArray[0].split(",");
    const text = myArray[0];
    if (ctx) {
      Chart.defaults.color = "#909090";
      var myCanvas = ctx.getContext('2d');
      var myChart = new Chart(myCanvas, {
        type: 'line',
        data: {
          labels: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
          datasets: [{
              label: 'ระดับวิกฤต',
              data: [110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44, 110.44],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#ff0000'],
              borderColor: ['#ff0000'],
              borderWidth: 1,
              radius: 0.1,

            },
            <?php
            $result_amount = "";
            $i = 0;
            $sql = "SELECT COUNT(DISTINCT YEAR(date)) AS max_year FROM val_water_mun2 ORDER BY YEAR(date) ASC;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $max_year = $row['max_year'];
            }
            $sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water_mun2 ORDER BY YEAR(date) ASC";
            $result1 = mysqli_query($conn, $sql1);
            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
              $date_y =  $row1['date_y'];
              $result_amount = "";
              // $sql2 = "SELECT * FROM `val_water_mun2` WHERE `date` LIKE '%$date_y%'";
              $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water_mun2` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
              $result2 = mysqli_query($conn, $sql2);
              while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

                $date_m =  $row2['date_m'];
                $zero_num = 2; //จำนวนหลัก
                $date_m = sprintf("%0" . $zero_num . "d", $date_m);
                $sql3 = "SELECT  MAX(`amount_water_mun2`) as amount_water_mun2_max_m FROM  val_water_mun2 WHERE `date` LIKE '%$date_y-$date_m%'";
                $result3 = mysqli_query($conn, $sql3);
                while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  $amount_water_mun2_max_m =  $row3['amount_water_mun2_max_m'] . ",";
                  $color = '#' . dechex(rand(0x000000, 0xFFFFFF));
                }
                $result_amount = $amount_water_mun2_max_m . $result_amount;
              }
            ?> {
                label: 'ระดับน้ำปี ' + <?= $date_y + 543; ?>,
                data: myArray[<?= $i++; ?>].split(","),
                cubicInterpolationMode: 'monotone',
                tension: 0.4,
                backgroundColor: ['<?= $color; ?>'],
                borderColor: ['<?= $color; ?>'],
                <?php if ($i == $max_year) {
                  echo  "borderWidth: 2,";
                } else {
                  echo "borderWidth: 0.7,";
                } ?>
              },
            <?php } ?>
          ]
        },
        options: {

          scales: {
            y: {
              // min: 105,
              // max: maxl_m,
              ticks: {
                stepSize: 10
              },
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
                  size: 14,
                  weight: '500',
                  family: "'IBM Plex Sans Thai', sans-serif",
                }
              }
            },
            title: {
              display: true,
              text: ['ระดับน้ำหน้าเขื่อนปากมูล จ.อุบลราชธานี', 'หน่วย : ม.(รทก.)'],
              align: 'start',
              color: '#909090',
              font: {
                size: 16,
                family: "'IBM Plex Sans Thai', sans-serif",
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