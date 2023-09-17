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
$max2_level_water = "";
$date_amount_water = "";
$cout = 0;
$sum = 0;
$max = null;
$maxl = null;
$sql1 = "SELECT * FROM `val_nb3` WHERE `date_nb3` LIKE '%$y_m_sql%' ORDER BY `val_nb3`.`date_nb3` ASC";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
  $temp_nb3 =  $row1['temp_nb3'];
  $humid_nb3 =  $row1['humid_nb3'];
  $light_nb3 =  $row1['light_nb3'];
  $distance_nb3 =  $row1['distance_nb3'].",";
  $rssi_nb3 =  $row1['rssi_nb3'];
  $date_nb3 =  $row1['date_nb3'].",";

  $result_level_water = $result_level_water.$distance_nb3;
  $date_ex = explode("-", $date_nb3);
  $day = $date_ex[2];
  $date_amount_water = $date_amount_water.$day;
  
}
$min = null;
$minl = null;
?>
<div class="users-table table-wrapper" style="width: 100%;height: 500px;overflow: auto;">
  <table class="posts-table">
    <thead>
      <tr class="users-table-info">
        <th style="text-align: center;">วันที่</th>
        <th style="text-align: center;">ระดับน้ำ ม.</th>
        <th>อุณหภูมิ °C</th>
        <th>ความชื้น %</th>
        <th>ค่าความเข้มแสง</th>
        <th>คลื่นสัญญาณ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      $tempNb3 = "-";
      $humidNb3 = "-";
      $lightNb3 = "-";
      $distanceNb3 = "-";
      $rssiNb3 = "-";
      $dateNb3 = "-";
      $result_level_water = "";
      $sql1 = "SELECT * FROM `val_nb3` WHERE `date_nb3` LIKE '%$y_m_sql%' ORDER BY `val_nb3`.`date_nb3` ASC";
      $result1 = mysqli_query($conn, $sql1);
      while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        $tempNb3 =  $row1['temp_nb3'];
        $humidNb3 =  $row1['humid_nb3'];
        $lightNb3 =  $row1['light_nb3'];
        $distanceNb3 =  $row1['distance_nb3'];
        $rssiNb3 =  $row1['rssi_nb3'];
        $dateNb3 =  $row1['date_nb3'];

        $result_level_water = $result_level_water . $distanceNb3.",";
        $date_ex = explode("-", $dateNb3);
        $day = $date_ex[2];
      ?>
        <tr class="users-table-info">
          <td style="text-align: center;">
            <?= $day; ?>
          </td>
          <td style="text-align: center;"><?= $distanceNb3; ?></td>
          <td><span class="badge-pending"><?= $tempNb3; ?></span></td>
          <td><span class="badge-active"><?= $humidNb3; ?></span></td>
          <td><span class="badge-success"><?= $lightNb3; ?></span></td>
          <td><span class="badge-success"><?= $rssiNb3; ?></span></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="chart1">
  <canvas id="myChart1" height="180px"></canvas>
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
          datasets: [
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
                  size: 15,
                  weight: '500'
                }
              }
            },
            title: {
              display: true,
              text: ['NB03', 'เดือน ' + monthNames[<?= $m - 1 ?>] + " " + <?= $y + 543 ?>],
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
