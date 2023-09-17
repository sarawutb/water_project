<?php
include("connect.php");
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
$sql1 = "SELECT DISTINCT YEAR(date_nb1) as date_y FROM val_nb1 ORDER BY YEAR(date_nb1) ASC;";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $date_y =  $row1['date_y'];
    $result_amount_water = "";
    $result_level_water = "";
    // $sql2 = "SELECT * FROM `val_water` WHERE `date` LIKE '%$date_y%'";
    $sql2 = "SELECT DISTINCT MONTH(date_nb1) as date_m FROM `val_nb1` WHERE `date_nb1` LIKE '%$date_y%' ORDER BY `date_m` DESC;";
    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $date_m =  $row2['date_m'];
        $zero_num = 2; //จำนวนหลัก
        $date_m = sprintf("%0" . $zero_num . "d", $date_m);
        $sql3 = "SELECT MAX(`distance_nb1`) as amount_level_water_m FROM val_nb1 WHERE `date_nb1` LIKE '%$date_y-$date_m%';";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $amount_level_water_m_sql = $row3['amount_level_water_m'];
            if ($amount_level_water_m_sql == "-") {
                $amount_level_water_m_sql = 0;
            }
            $amount_level_water_m =  $amount_level_water_m_sql . ",";
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#1a8' . $rand[rand(0, 15)] . 'ff';
        }
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
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    #myChart {
        width: 230px;
        height: 230px;
    }

    @media (max-width: 400px) {
        #myChart {
            width: 160px;
            height: 600px;
        }
    }
</style>
<article class="white-block">
    <div class="chart1">
        <canvas id="myChart" height="140" aria-label="Site statistics" role="img"></canvas>
    </div>
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="js/script.js"></script>


<script>
    let water_node1 = [];
    let water_node2 = [];
    let water_node3 = [];
    <?php
    $date_month_now = date("d", strtotime("last day of this month"));
    $i = 1;
    for ($i = 1; $i <= $date_month_now; $i++) {
        // $date_y_m_d = "2022-01";
        $date_y_m_d = date("Y-m");
        $date_y_m_d = $date_y_m_d . "-" . $i;

        $sql = "SELECT val_nb1.distance_nb1 as water_node1,
        val_nb2.distance_nb2 as water_node2,
        val_nb3.distance_nb3 as water_node3
            FROM `val_nb1`
            INNER JOIN val_nb2 on val_nb2.date_nb2 = val_nb1.date_nb1
             INNER JOIN val_nb3 on val_nb3.date_nb3 = val_nb1.date_nb1
            WHERE val_nb1.date_nb1 = '$date_y_m_d';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
                var var_water_node1 = "<?= $row['water_node1'] ?>";
                var var_water_node2 = "<?= $row['water_node2'] ?>";
                var var_water_node3 = "<?= $row['water_node3'] ?>";
                water_node1.push(var_water_node1);
                water_node2.push(var_water_node2);
                water_node3.push(var_water_node3);


    <?php   }
        }
    }
    ?>

    // const array1 = [1, 3, 2];

    var max1 = Math.max(...water_node1);
    var max2 = Math.max(...water_node2);
    var max3 = Math.max(...water_node3);
    // alert(test);
    var max = Math.max(max1, max2, max3);
    var data_list = [water_node1, water_node2, water_node3]
    var color_list = ['#1a75ff', '#ff9900', '#00cc00'];
    let count_date = [];
    var date_month_now = <?= $date_month_now ?>;
    var i;
    for (i = 1; i <= date_month_now; i++) {
        count_date.push(i);
    }
    var month = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    $(function() {
        var ctx = document.getElementById('myChart');
        var maxl_m = 200;
        if (ctx) {
            Chart.defaults.color = "#909090";
            var myCanvas = ctx.getContext('2d');
            var myChart = new Chart(myCanvas, {
                type: 'line',
                data: {
                    labels: count_date,
                    family: "'IBM Plex Sans Thai', sans-serif",
                    datasets: [
                        <?php
                        $i = 0;
                        $sql = "SELECT * FROM `list_device` WHERE `device_status` = 1;";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?> {
                                label: '<?= $row['device_name'] ?>',
                                data: data_list[<?= $i ?>],
                                cubicInterpolationMode: 'monotone',
                                tension: 0.4,
                                backgroundColor: [color_list[<?= $i ?>]],
                                borderColor: [color_list[<?= $i ?>]],
                                borderWidth: 2,
                            },
                        <?php $i++;
                        } ?>
                        // {
                        //     label: 'NB02',
                        //     data: water_node2,
                        //     cubicInterpolationMode: 'monotone',
                        //     tension: 0.4,
                        //     backgroundColor: ['#ff9900'],
                        //     borderColor: ['#ff9900'],
                        //     borderWidth: 1,
                        //     radius: 2,
                        // },
                        // {
                        //     label: 'NB03',
                        //     data: water_node3,
                        //     cubicInterpolationMode: 'monotone',
                        //     tension: 0.4,
                        //     backgroundColor: ['#00cc00'],
                        //     borderColor: ['#00cc00'],
                        //     borderWidth: 1,
                        //     radius: 2,
                        // },
                    ]
                },
                options: {

                    scales: {
                        y: {
                            // min: 105,
                            max: max + 1,
                            ticks: {
                                stepSize: 1
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
                                    size: 12,
                                    weight: '500',
                                    family: "'IBM Plex Sans Thai', sans-serif",
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: ['ระดับน้ำ NB ' + month[<?= date('m') - 1 ?>] + ' พ.ศ. <?= date('Y') + 543 ?>', 'หน่วย : ม.(รทก.)'],
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