<?php
include './connect.php';
?>


<article class="white-block">
    <div class="chart1">
        <canvas id="myChart" height="100" aria-label="Site statistics" role="img"></canvas>
    </div>
</article>
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="plugins/feather.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="js/script.js"></script>
<script>
    let water_man = [];
    let water_khong = [];
    let water_see = [];
    let water_lamdom = [];
    <?php
    // $date_y_m_d = date("Y-m");
    $date_month_now = date("d", strtotime("last day of this month"));
    $i = 1;
    for ($i = 1; $i <= $date_month_now; $i++) {
        $date_y_m_d = "2022-01";
        $date_y_m_d = $date_y_m_d . "-" . $i;

        $sql = "SELECT val_water.level_water as water_man,
    val_water_khong.level_water as water_khong,
    val_water_see.level_water as water_see,
    val_water_lamdom.level_water as water_lamdom
    FROM `val_water`
    INNER JOIN val_water_khong on val_water_khong.date = val_water.date
    INNER JOIN val_water_see on val_water_see.date = val_water.date
    INNER JOIN val_water_lamdom on val_water_lamdom.date = val_water.date
    WHERE val_water.date = '$date_y_m_d'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $color1 = '#' . dechex(rand(0x000000, 0xFFFFFF));
                $color2 = '#' . dechex(rand(0x000000, 0xFFFFFF));
                $color3 = '#' . dechex(rand(0x000000, 0xFFFFFF));
                $color4 = '#' . dechex(rand(0x000000, 0xFFFFFF));
    ?>
                var var_water_man = "<?= $row['water_man'] ?>";
                var var_water_khong = "<?= $row['water_khong'] ?>";
                var var_water_see = "<?= $row['water_see'] ?>";
                var var_water_lamdom = "<?= $row['water_lamdom'] ?>";
                water_man.push(var_water_man);
                water_khong.push(var_water_khong);
                water_see.push(var_water_see);
                water_lamdom.push(var_water_lamdom);
    <?php   }
        }
    }
    ?>
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
        // let arr_level_water = "<?php // $arr_level_water; 
                                    ?>";
        // let myArray = arr_level_water.split("|");
        // let myArray2 = myArray[0].split(",");
        // const text = myArray[0];
        if (ctx) {
            Chart.defaults.color = "#909090";
            var myCanvas = ctx.getContext('2d');
            var myChart = new Chart(myCanvas, {
                type: 'line',
                data: {
                    labels: count_date,
                    datasets: [{
                            label: 'แม่น้ำมูล',
                            data: water_man,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            backgroundColor: ['<?= $color1; ?>'],
                            borderColor: ['<?= $color1; ?>'],
                            borderWidth: 1,

                        },
                        {
                            label: 'แม่น้ำชี',
                            data: water_see,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            backgroundColor: ['<?= $color2; ?>'],
                            borderColor: ['<?= $color2; ?>'],
                            borderWidth: 1,

                        },
                        {
                            label: 'แม่น้ำโขง',
                            data: water_khong,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            backgroundColor: ['<?= $color3; ?>'],
                            borderColor: ['<?= $color3; ?>'],
                            borderWidth: 1,

                        },
                        {
                            label: 'ลำโดมใหญ่',
                            data: water_lamdom,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            backgroundColor: ['<?= $color4; ?>'],
                            borderColor: ['<?= $color4; ?>'],
                            borderWidth: 1,

                        },

                        // {
                        //   label: 'ระดับวิกฤต',
                        //   data: [113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84, 113.84],
                        //   cubicInterpolationMode: 'monotone',
                        //   tension: 0.4,
                        //   backgroundColor: ['#ff0000'],
                        //   borderColor: ['#ff0000'],
                        //   borderWidth: 0.5,
                        //   .1,

                        // },

                    ]
                },
                options: {

                    scales: {
                        y: {
                            // min: 105,
                            max: 120,
                            ticks: {
                                stepSize: 5
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
                                    weight: '500'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: ['ระดับน้ำเขื่อนปากมูล ' + month[<?= date('m') - 1 ?>] + ' พ.ศ. <?= date('Y') + 543 ?>', 'หน่วย : ม.(รทก.)'],
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