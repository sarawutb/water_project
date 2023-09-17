<?php
include("connect.php");
$max_m = null;
$maxl_m = null;
$sql4 = "SELECT * FROM `val_water`";
              $result4 = mysqli_query($conn, $sql4);
                while ($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)) {
                  if($row4['amount_water'] > $max_m){
                    $max_m = $row4['amount_water'];
                  }
                  if($row4['level_water'] > $maxl_m){
                    $maxl_m = $row4['level_water'];
                  }
                }
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
}
print_r($arr_level_water);
?>
<article class="white-block">
  <div class="chart1">
    <canvas id="myChart" height="240" aria-label="Site statistics" role="img"></canvas>
  </div>
  <br>
  <div class="chart2">
    <canvas id="myChart_02" height="240" aria-label="Site statistics" role="img"></canvas>
  </div>
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!-- <script src="./plugins/chart.min.js"></script> -->
<!-- Icons library -->
<!-- <script src="plugins/feather.min.js"></script> -->
<!-- Custom scripts -->
<!-- <script src="js/script.js"></script> -->
<script>
$(function () {
var ctx = document.getElementById('myChart');
var maxl_m = <?=$maxl_m;?>;
let arr_level_water = "<?=$arr_level_water;?>";
let myArray = arr_level_water.split("|");
let myArray2 = myArray[0].split(",");
 const text = myArray[0];
if (ctx) {
  Chart.defaults.color = "#909090";
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
        ?> {
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
var ctx = document.getElementById('myChart_02');

var max_m = <?=$max_m;?>;
let arr_amount_water = "<?=$arr_amount_water;?>";
let myArray = arr_amount_water.split("|");
let myArray2 = myArray[0].split(",");
const text = myArray[0];
// const text = ["Banana", "Orange", "Apple", "Mango"];

// document.getElementById("demo").innerHTML = myArray2;
if (ctx) {
Chart.defaults.color = "#909090";
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
      ?> {
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
