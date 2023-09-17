<?php
include("connect.php");
$date = $_GET['date'];
$date_ex = explode("-",$date);
// print_r($date_ex);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y."-".$m;
 // echo $y_m_sql;


					$result_amount_water = "";
					$result_level_water = "";
					$date_amount_water = "";
					$cout = 0;
					$sum = 0;
          $max = null;
          $maxl = null;
					$sql1 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water`.`date` DESC";
		                    $result1 = mysqli_query($conn, $sql1);
		                      while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
														// 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
		                          $amount_water_arr =  $row1['amount_water'].",";
		                          $amount_level_arr =  $row1['level_water'].",";
															$result_amount_water = $amount_water_arr.$result_amount_water;
															$result_level_water = $amount_level_arr.$result_level_water;

		                          $date_water_arr =  $row1['date'];
															$strDate = explode("-", $date_water_arr);
															$cout++;
                              $sum = $sum+$row1['amount_water'];

                              if($row1['amount_water'] > $max){
                                $max = $row1['amount_water'];
                              }
                              if($row1['level_water'] > $maxl){
                                $maxl = $row1['level_water'];
                              }
															$date_water_arr = "'".$strDate[2]."',";
															$date_amount_water = $date_water_arr.$date_amount_water;
		      		}
							// echo $result_level_water;

              $min = null;
              $minl = null;
              $sql2 = "SELECT MIN(amount_water) AS min,MIN(level_water) AS minl FROM `val_water` WHERE `date` LIKE '%$y_m_sql%'";
    		                    $result2 = mysqli_query($conn, $sql2);
    		                      while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                                $min = $row2['min'];
                                $minl = $row2['minl'];
                              }
             $min = $min-10;
             $max = $max+10;
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
        <th>แรงลม กม/ชม</th>
        <th>ความกดอากาศ hPa</th>
        <!-- <th>จัดการ</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
        include("connect.php");
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
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $level_water =  $row['level_water'];
                            $amount_water =  $row['amount_water'];
                            $date_water =  $row['date'];

                            $date_ex = explode("-", $date_water);
                            $day = $date_ex[2];

                            $sql1 = "SELECT * FROM `val_tmd` WHERE date_tmd = '$date_water'";
                                            $result1 = mysqli_query($conn, $sql1);
                                            while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
                                                $temp_tmd =  $row1['temp_tmd'];
                                                $humidity_tmd =  $row1['humidity_tmd'];
                                                $wind_tmd =  $row1['wind_tmd'];
                                                $date_tmd =  $row1['date_tmd'];
                                                $MeanSeaLevelPressure_tmd =  $row1['MeanSeaLevelPressure_tmd'];
                                                $rainfall_tmd =  $row1['rainfall_tmd'];
                                                $land_visibility_tmd =  $row1['land_visibility_tmd'];
        		}
      ?>
      <tr>
        <!-- <td>
          <label class="users-table__checkbox">
            <input type="checkbox" class="check">
          </label>
        </td> -->
        <td style="text-align: center;">
          <?=$day;?>
        </td>
        <td style="text-align: center;"><?=$level_water;?></td>
        <!-- <td style="text-align: center;"><?="-";?></td> -->
        <td style="text-align: center;"><?=$amount_water;?></td>
        <td><span class="badge-pending"><?=$temp_tmd;?></span></td>
        <td><span class="badge-active"><?=$wind_tmd;?></span></td>
        <td><span class="badge-active"><?=$MeanSeaLevelPressure_tmd;?></span></td>
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
    <canvas id="myChart1" height="180" aria-label="Site statistics" role="img"></canvas>
    <canvas id="myChart2" height="180" aria-label="Site statistics" role="img"></canvas>
  </div>

	<script>
$(function () {
var ctx = document.getElementById('myChart1');
const monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
const dateObj = new Date();
const month = monthNames[dateObj.getMonth()];

if (ctx) {
  var myCanvas = ctx.getContext('2d');
  var myChart = new Chart(myCanvas, {
    type: 'bar',
    data: {
      labels: [<?=$date_amount_water;?>],
      datasets: [{
        label: 'ระดับน้ำ',
        data: [<?=$result_level_water;?>],
        cubicInterpolationMode: 'monotone',
        tension: 0.4,
        backgroundColor: ['#1a75ff'],
        borderColor: ['#1a75ff'],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          min: <?=$minl-0.05?>,
          max: <?=$maxl+0.05?>,
          ticks: {
            stepSize: 0.1
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
          text: ['ปริมาณน้ำแม่น้ำมูล เมืองอุบลราชธานี', 'เดือน '+ monthNames[ <?=$m-1?>] +" "+ <?=$y+543?>],
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
$(function () {
var ctx = document.getElementById('myChart2');
const monthNames = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
const dateObj = new Date();
const month = monthNames[dateObj.getMonth()];

if (ctx) {
  var myCanvas = ctx.getContext('2d');
  var myChart = new Chart(myCanvas, {
    type: 'bar',
    data: {
      labels: [<?=$date_amount_water;?>],
      datasets: [{
        label: 'ปริมาณน้ำ',
        data: [<?=$result_amount_water;?>],
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
          min: <?=$min;?>,
          max: <?=$max;?>,
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
          text: ['ปริมาณน้ำแม่น้ำมูล เมืองอุบลราชธานี', 'เดือน '+ monthNames[ <?=$m-1?>] +" "+ <?=$y+543?>],
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
