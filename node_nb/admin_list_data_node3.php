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
            $tempnb3 = "-";
            $humidnb3 = "-";
            $lightnb3 = "-";
            $distancenb3 = "-";
            $rssinb3 = "-";
            $datenb3 = "-";
            $result_level_water  = null;
            $sql1 = "SELECT * FROM `val_nb3` WHERE `date_nb3` LIKE '%$y_m_sql%' ORDER BY `val_nb3`.`date_nb3` ASC";
            $result1 = mysqli_query($conn, $sql1);
            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                $tempnb3 =  $row1['temp_nb3'];
                $humidnb3 =  $row1['humid_nb3'];
                $lightnb3 =  $row1['light_nb3'];
                $distancenb3 =  $row1['distance_nb3'];
                $rssinb3 =  $row1['rssi_nb3'];
                $datenb3 =  $row1['date_nb3'];

                $result_level_water = $result_level_water . $distancenb3;
                $date_ex = explode("-", $datenb3);
                $day = $date_ex[2];
            ?>
                <tr class="users-table-info">
                    <td style="text-align: center;"><button id="myBtn<?= $num ?>" class="badge-active" type="button">เลือก</button></td>

                    <td style="text-align: center;">
                        <?= $day; ?>
                    </td>
                    <td style="text-align: center;"><?= $distancenb3; ?></td>
                    <td><span class="badge-pending"><?= $tempnb3; ?></span></td>
                    <td><span class="badge-active"><?= $humidnb3; ?></span></td>
                    <td><span class="badge-success"><?= $lightnb3; ?></span></td>
                    <td><span class="badge-success"><?= $rssinb3; ?></span></td>
                </tr>
                <script>
                    $(function() {
                        $('#myBtn<?= $num ?>').on('click', function() {
                            modal.style.display = "none";
                        });
                    });
                </script>
            <?php $num++;
            } ?>
        </tbody>
    </table>
</div>