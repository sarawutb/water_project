<?php
session_start();
if ($_SESSION['id_user']) {
    include("../connect.php");
} else {
    session_destroy();
    header("location:index.php");
}

date_default_timezone_set("Asia/Bangkok");
$date = $_GET['date'];
$data = $_GET['data'];
$date_ex = explode("-", $date);
// print_r($date_ex);
$m = $date_ex[0];
$y = $date_ex[1];
$y_m_sql = $y . "-" . $m;

$m_y_js = $m . "-" . $y;

?>
<div class="users-table table-wrapper" id="update" style="width: 100%;height: 500px;overflow: auto;">
    <table class="posts-table">
        <thead>
            <tr class="users-table-info">
                <th style="text-align: center;">เลือก</th>
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
            $date_up = $m . "-" . $y;
            $num = 1;
            $temp_tmd = "-";
            $humidity_tmd = "-";
            $wind_tmd = "-";
            $date_tmd = "-";
            $MeanSeaLevelPressure_tmd = "-";
            $rainfall_tmd = "-";
            $land_visibility_tmd = "-";
            $sql = "SELECT * FROM `val_water` LEFT JOIN val_tmd on val_water.date =  val_tmd.date_tmd WHERE `date` LIKE '%$y_m_sql%' ORDER BY `val_water`.`date` ASC;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $id_water =  $row['id_water'];
                $level_water =  $row['level_water'];
                $amount_water =  $row['amount_water'];
                $date_water =  $row['date'];

                $date_ex = explode("-", $date_water);
                $day = $date_ex[2];

                $id_tmd =  $row['id_tmd'];
                $temp_tmd =  $row['temp_tmd'];
                $humidity_tmd =  $row['humidity_tmd'];
                $wind_tmd =  $row['wind_tmd'];
                $date_tmd =  $row['date_tmd'];
                $MeanSeaLevelPressure_tmd =  $row['MeanSeaLevelPressure_tmd'];
                $rainfall_tmd =  $row['rainfall_tmd'];
                $land_visibility_tmd =  $row['land_visibility_tmd'];

            ?>
                <tr class="users-table-info">
                    <td style="text-align: center;"><button id="myBtn<?= $num ?>" class="badge-active" type="button">เลือก</button></td>
                    <td style="text-align: center;">
                        <?= $day; ?>
                    </td>
                    <td style="text-align: center;"><?= $level_water; ?></td>
                    <td style="text-align: center;"><?= $amount_water; ?></td>
                    <td style="text-align: center;"><?= $temp_tmd; ?></td>
                    <td style="text-align: center;"><?= $humidity_tmd; ?></td>
                    <td style="text-align: center;"><?= $wind_tmd; ?></td>
                    <td style="text-align: center;"><?= $land_visibility_tmd; ?></td>
                    <td style="text-align: center;"><?= $MeanSeaLevelPressure_tmd; ?></td>
                    <!-- <td><button style="border-radius: 5px;padding:4px 8px;background-color:#e69900" type="button"><p style="font-size:13px" class="stat-cards-info__num">แก้ไข</p></button></td> -->
                </tr>
                <script>
                    $('#myBtn').val("")
                    $(function() {
                        $('#myBtn<?= $num ?>').on('click', function() {
                            modal.style.display = "none";
                            $('#myBtn').val("<?= "(ชุดข้อมูล)" . $data ." ณ วันที่ ". $date_water ?>")
                            $('#myData').val("<?= $date_water ?>")
                        });
                    });
                </script>

            <?php $num++;
            } ?>
        </tbody>
    </table>
</div>