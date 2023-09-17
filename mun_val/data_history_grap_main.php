<?php
include("../connect.php");
$date = $_GET['date'];
$date_ex = explode("-", $date);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y . "-" . $m;

$result_amount_water = "";
$sum_amount_water = 0;
$sum_num = 0;
$result_level_water = "";
$max1_level_water = "";
$max2_level_water = "";
$date_amount_water = "";
$cout = 0;
$sum = 0;
$max = null;
$maxl = null;
$sql1 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water`.`date` DESC";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
  // 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
  $amount_water_arr =  $row1['amount_water'] . ",";
  $amount_level_arr =  $row1['level_water'] . ",";
  $result_amount_water = $amount_water_arr . $result_amount_water;
  $sum_amount_water += $row1['amount_water'];
  $sum_num++;
  $result_level_water = $amount_level_arr . $result_level_water;
  $path = substr($_SERVER['PHP_SELF'] . "/", 15, -1);
  $sql = "SELECT * FROM `list_water` WHERE water_path_history = '$path'";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $level_water_max1 = $row["level_water_max1"];
    $level_water_max2 = $row["level_water_max2"];
  }
  $max1_level_water = $level_water_max1 . "," . $max1_level_water;
  $max2_level_water = $level_water_max2 . "," . $max2_level_water;

  $date_water_arr =  $row1['date'];
  $strDate = explode("-", $date_water_arr);
  $cout++;
  $sum = $sum + $row1['amount_water'];

  if ($row1['amount_water'] > $max) {
    $max = $row1['amount_water'];
  }
  if ($row1['level_water'] > $maxl) {
    $maxl = $row1['level_water'];
  }
  $date_water_arr = "'" . $strDate[2] . "',";
  $date_amount_water = $date_water_arr . $date_amount_water;
}

$avg_amount_water = $sum_amount_water <= 0 ? 0 : ($sum_amount_water / $sum_num) % 50;

$min = null;
$minl = null;
$sql2 = "SELECT MIN(amount_water) AS min,MIN(level_water) AS minl FROM `val_water` WHERE `date` LIKE '%$y_m_sql%'";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
  $min = $row2['min'];
  $minl = $row2['minl'];
}
$min = $min - 10;
$max = $max + 10;
// echo $min;
// echo "<br>";
// echo $max;

?>

<div class="users-table table-wrapper" style="width: 100%;height: 500px;overflow: auto;">
  <table class="posts-table">
    <thead>
      <tr class="users-table-info">
        <!-- <th>
          <label class="users-table__checkbox ms-20">
            <input type="checkbox" class="check-all">
          </label>
        </th> -->
        <th style="text-align: center;">วันที่</th>
        <th style="text-align: center;">ระดับน้ำ ม.(รทก.)</th>
        <!-- <th style="text-align: center;">ระดับน้ำ(2) ม.(รทก.)</th> -->
        <th style="text-align: center;">ปริมาณน้ำ ลบ.ม./ว</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>แรงลม กม/ชม</th>
        <th>ทัศนวิสัย กิโลเมตร</th>
        <th>ความกดอากาศ hPa</th>
        <!-- <th>จัดการ</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      $temp_tmd = "-";
      $humidity_tmd = "-";
      $wind_tmd = "-";
      $date_tmd = "-";
      $MeanSeaLevelPressure_tmd = "-";
      $rainfall_tmd = "-";
      $land_visibility_tmd = "-";
      $sql = "SELECT * FROM `val_water` WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water`.`date` ASC";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $level_water =  $row['level_water'];
        $amount_water =  $row['amount_water'];
        $date_water =  $row['date'];

        $date_ex = explode("-", $date_water);
        $day = $date_ex[2];

        $sql1 = "SELECT * FROM `val_tmd` WHERE date_tmd = '$date_water'";
        $result1 = mysqli_query($conn, $sql1);
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
          $temp_tmd =  $row1['temp_tmd'];
          $humidity_tmd =  $row1['humidity_tmd'];
          $wind_tmd =  $row1['wind_tmd'];
          $date_tmd =  $row1['date_tmd'];
          $MeanSeaLevelPressure_tmd =  $row1['MeanSeaLevelPressure_tmd'];
          $rainfall_tmd =  $row1['rainfall_tmd'];
          $land_visibility_tmd =  $row1['land_visibility_tmd'];
        }
      ?>
        <tr class="users-table-info">
          <!-- <td>
          <label class="users-table__checkbox">
            <input type="checkbox" class="check">
          </label>
        </td> -->
          <td style="text-align: center;">
            <?= $day; ?>
          </td>
          <td style="text-align: center;"><?= $level_water; ?></td>
          <!-- <td style="text-align: center;"><?= "-"; ?></td> -->
          <td style="text-align: center;"><?= $amount_water; ?></td>
          <td><span class="badge-pending"><?= $temp_tmd; ?></span></td>
          <td><span class="badge-active"><?= $humidity_tmd; ?></span></td>
          <td><span class="badge-success"><?= $wind_tmd; ?></span></td>
          <td><span class="badge-success"><?= $land_visibility_tmd; ?></span></td>
          <td><span class="badge-success"><?= $MeanSeaLevelPressure_tmd; ?></span></td>
          <!-- <td>
          <span class="p-relative">
            <button class="dropdown-btn transparent-btn" type="button" title="More info">
              <div class="sr-only">More info</div>
              <i data-feather="more-horizontal" aria-hidden="true"></i>
            </button>
            <ul class="users-item-dropdown dropdown">
              <li><a href="##">Edit</a></li>
              <li><a href="##">Quick edit</a></li>
              <li><a href="##">Trash</a></li>
            </ul>
          </span>
        </td> -->
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="chart1">
  <canvas id="myChart1" height="180px"></canvas>
</div>
<div class="chart1">
  <canvas id="myChart2" height="180px"></canvas>
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
              label: 'ระดับเตือนภัย',
              data: [<?= $max1_level_water ?>],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#ff9900'],
              borderColor: ['#ff9900'],
              borderWidth: 1,
              radius: 0.1
            },
            {
              label: 'ระดับวิกฤต',
              data: [<?= $max2_level_water ?>],
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
              text: ['ระดับน้ำแม่น้ำมูล เมืองอุบลราชธานี', 'เดือน ' + monthNames[<?= $m - 1 ?>] + " " + <?= $y + 543 ?>],
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
    var ctx = document.getElementById('myChart2');
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
            label: 'ปริมาณน้ำ',
            data: [<?= $result_amount_water; ?>],
            cubicInterpolationMode: 'monotone',
            tension: 0.4,
            backgroundColor: ['#1a1aff'],
            borderColor: ['#1a1aff'],
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            y: {
              min: <?= $min; ?>,
              max: <?= $max + $avg_amount_water ?>,
              ticks: {
                stepSize: 10
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
                  size: 15,
                  weight: '500'
                }
              }
            },
            title: {
              display: true,
              text: ['ปริมาณน้ำแม่น้ำมูล เมืองอุบลราชธานี', 'เดือน ' + monthNames[<?= $m - 1 ?>] + " " + <?= $y + 543 ?>],
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

<script>
  $(function() {
    <?php
    $max_m = null;
    $maxl_m = null;
    $sql4 = "SELECT * FROM `val_water`";
    $result4 = mysqli_query($conn, $sql4);
    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
      if ($row4['amount_water'] > $max_m) {
        $max_m = $row4['amount_water'];
      }
      if ($row4['level_water'] > $maxl_m) {
        $maxl_m = $row4['level_water'];
      }
    }
    $result_amount_water = null;
    $result_level_water = null;
    $arr_amount_water = null;
    $arr_level_water = null;
    $amount_water_max_m_sql = null;
    $amount_level_water_m_sql = null;
    $max1_level_water_mun = "";
    $max2_level_water_mun = "";
    $sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
      $date_y =  $row1['date_y'];
      $result_amount_water = "";
      $result_level_water = "";
      // $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
      $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
      $result2 = mysqli_query($conn, $sql2);
      while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $date_m =  $row2['date_m'];
        $zero_num = 2; //จำนวนหลัก
        $date_m = sprintf("%0" . $zero_num . "d", $date_m);
        $sql3 = "SELECT MAX(`level_water`) as amount_level_water_m , MAX(`amount_water`) as amount_water_max_m FROM val_water WHERE `date` LIKE '%$date_y-$date_m%'";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
          $amount_water_max_m_sql = $row3['amount_water_max_m'];
          $amount_level_water_m_sql = $row3['amount_level_water_m'];
          if ($amount_water_max_m_sql == "-") {
            $amount_water_max_m_sql = 0;
          }
          if ($amount_level_water_m_sql == "-") {
            $amount_level_water_m_sql = 0;
          }

          $amount_water_max_m =  $amount_water_max_m_sql . ",";
          $amount_level_water_m =  $amount_level_water_m_sql . ",";
          $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
          $color = '#1a8' . $rand[rand(0, 15)] . 'ff';
        }
        $result_amount_water = $amount_water_max_m . $result_amount_water;
        $result_level_water = $amount_level_water_m . $result_level_water;
      }
      $arr_amount = explode(",", $result_amount_water);
      array_pop($arr_amount);
      $result_amount_water = implode(",", $arr_amount);
      $arr_amount_water = $arr_amount_water . $result_amount_water . "|";
      $arr_level = explode(",", $result_level_water);
      array_pop($arr_level);
      $result_level_water = implode(",", $arr_level);
      $arr_level_water = $arr_level_water . $result_level_water . "|";
      $path = substr($_SERVER['PHP_SELF'] . "/", 15, -1);
      $sql = "SELECT * FROM `list_water` WHERE water_path_history = '$path'";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $level_water_max1 = $row["level_water_max1"];
        $level_water_max2 = $row["level_water_max2"];
      }
      for ($i = 1; $i <= 12; $i++) {
        $max1_level_water_mun = $level_water_max1 . "," . $max1_level_water_mun;
        $max2_level_water_mun = $level_water_max2 . "," . $max2_level_water_mun;
      }
    }
    ?>
    var ctx = document.getElementById('myChart3');
    var maxl_m = <?= $maxl_m; ?>;
    let arr_level_water = "<?= $arr_level_water; ?>";
    let myArray = arr_level_water.split("|");
    let myArray2 = myArray[0].split(",");
    const text = myArray[0];
    console.log(myArray);
    if (ctx) {
      Chart.defaults.color = "#909090";
      var myCanvas = ctx.getContext('2d');
      var myChart = new Chart(myCanvas, {
        type: 'line',
        data: {
          labels: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
          family: "'IBM Plex Sans Thai', sans-serif",
          datasets: [{
              label: 'ระดับเตือนภัย',
              data: [<?= $max1_level_water_mun; ?>],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#ff9900'],
              borderColor: ['#ff9900'],
              borderWidth: 0.5,
              radius: 0.1,

            },
            {
              label: 'ระดับวิกฤต',
              data: [<?= $max2_level_water_mun; ?>],
              cubicInterpolationMode: 'monotone',
              tension: 0.4,
              backgroundColor: ['#ff0000'],
              borderColor: ['#ff0000'],
              borderWidth: 0.5,
              radius: 0.1,

            },
            <?php
            $result_amount = "";
            $i = 0;
            $sql = "SELECT COUNT(DISTINCT YEAR(date)) AS max_year FROM val_water ORDER BY YEAR(date) ASC;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $max_year = $row['max_year'];
            }
            $sql1 = "SELECT DISTINCT YEAR(date) as date_y FROM val_water ORDER BY YEAR(date) ASC";
            $result1 = mysqli_query($conn, $sql1);
            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
              $date_y =  $row1['date_y'];
              $result_amount = "";
              // $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
              $sql2 = "SELECT DISTINCT MONTH(date) as date_m FROM `val_water` WHERE `date` LIKE '%$date_y%' ORDER BY `date_m` DESC";
              $result2 = mysqli_query($conn, $sql2);
              while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

                $date_m =  $row2['date_m'];
                $zero_num = 2; //จำนวนหลัก
                $date_m = sprintf("%0" . $zero_num . "d", $date_m);
                $sql3 = "SELECT  MAX(`amount_water`) as amount_water_max_m FROM  val_water WHERE `date` LIKE '%$date_y-$date_m%'";
                $result3 = mysqli_query($conn, $sql3);
                while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  $amount_water_max_m =  $row3['amount_water_max_m'] . ",";
                  $color = '#' . dechex(rand(0x000000, 0xFFFFFF));
                }
                $result_amount = $amount_water_max_m . $result_amount;
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
                  size: 14,
                  weight: '500',
                  family: "'IBM Plex Sans Thai', sans-serif",
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