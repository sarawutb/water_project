<?php
include("connect.php");
$date = $_GET['date'];
$date_ex = explode("-",$date);
// print_r($date_ex);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y."-".$m;
 // echo $y_m_sql;

					$result_distance_nb1 = "";
					$result_level_water = "";
					$date_date_nb1 = "";
					$cout = 0;
					$sum = 0;
          $max = null;
					$sql1 = "SELECT * FROM `val_nb1` WHERE `date_nb1` LIKE '%$y_m_sql%' ORDER BY `val_nb1`.`date_nb1` DESC";
		                    $result1 = mysqli_query($conn, $sql1);
		                      while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
														// 173.73, 173.64, 170.33, 167.33, 175.17, 183.56, 185.24, 164.13, 170.12
		                          $distance_nb1 =  $row1['distance_nb1'].",";
															$result_distance_nb1 = $distance_nb1.$result_distance_nb1;

		                          $date_nb1 =  $row1['date_nb1'];
															$strDate = explode("-", $date_nb1);
															$cout++;

                              if($row1['distance_nb1'] > $max){
                                $max = $row1['distance_nb1'];
                              }
															$date_nb1 = "'".$strDate[2]."',";
															$date_date_nb1 = $date_nb1.$date_date_nb1;
		      		}
							// echo $result_level_water;

              $min = null;
              $minl = null;
              $sql2 = "SELECT MIN(distance_nb1) AS min FROM `val_nb1` WHERE `date_nb1` LIKE '%$y_m_sql%'";
    		                    $result2 = mysqli_query($conn, $sql2);
    		                      while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                                $min = $row2['min'];
                              }
             $min = $min-10;
             $max = $max+10;
						 // echo $max;
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
        <th style="text-align: center;">ระดับน้ำจากตลิ่ง เมตร</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>ค่าความเข้มแสง lux</th>
        <th>คลื่นสัญญาณ DB</th>
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
        $sql = "SELECT * FROM `val_nb1` WHERE `date_nb1` LIKE '%$y_m_sql%' ORDER BY `val_nb1`.`date_nb1` ASC";
                      $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $temp_nb1 =  $row['temp_nb1'];
                            $humid_nb1 =  $row['humid_nb1'];
                            $light_nb1 =  $row['light_nb1'];
                            $distance_nb1 =  $row['distance_nb1'];
                            $rssi_nb1 =  $row['rssi_nb1'];
                            $date_nb1 =  $row['date_nb1'];

                            $date_ex = explode("-", $date_nb1);
                            $day = $date_ex[2];


      ?>
      <tr class="users-table-info">
        <!-- <td>
          <label class="users-table__checkbox">
            <input type="checkbox" class="check">
          </label>
        </td> -->
        <td style="text-align: center;">
          <?=$day;?>
        </td>
        <td style="text-align: center;"><?=$distance_nb1;?></td>
        <td><span class="badge-pending"><?=$temp_nb1;?></span></td>
        <td><span class="badge-active"><?=$humid_nb1;?></span></td>
        <td><span class="badge-success"><?=$light_nb1;?></span></td>
        <td><span class="badge-success"><?=$rssi_nb1;?></span></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
  <div class="chart1">
    <canvas id="myChart1" height="180px"></canvas>
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
    type: 'line',
    data: {
      labels: [<?=$date_date_nb1;?>],
      datasets: [{
        label: 'ระดับน้ำจากตลิ่ง',
        data: [<?=$result_distance_nb1;?>],
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
          min: <?=$min?>,
          max: <?=$max?>,
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
