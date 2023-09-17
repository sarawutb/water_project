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
            $tempnb2 = "-";
            $humidnb2 = "-";
            $lightnb2 = "-";
            $distancenb2 = "-";
            $rssinb2 = "-";
            $datenb2 = "-";
            $result_level_water  = null;
            $sql1 = "SELECT * FROM `val_nb2` WHERE `date_nb2` LIKE '%$y_m_sql%' ORDER BY `val_nb2`.`date_nb2` ASC";
            $result1 = mysqli_query($conn, $sql1);
            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                $tempnb2 =  $row1['temp_nb2'];
                $humidnb2 =  $row1['humid_nb2'];
                $lightnb2 =  $row1['light_nb2'];
                $distancenb2 =  $row1['distance_nb2'];
                $rssinb2 =  $row1['rssi_nb2'];
                $datenb2 =  $row1['date_nb2'];

                $result_level_water = $result_level_water . $distancenb2;
                $date_ex = explode("-", $datenb2);
                $day = $date_ex[2];
            ?>
                <tr class="users-table-info">
                    <td style="text-align: center;"><button id="myBtn<?= $num ?>" class="badge-active" type="button">เลือก</button></td>

                    <td style="text-align: center;">
                        <?= $day; ?>
                    </td>
                    <td style="text-align: center;"><?= $distancenb2; ?></td>
                    <td><span class="badge-pending"><?= $tempnb2; ?></span></td>
                    <td><span class="badge-active"><?= $humidnb2; ?></span></td>
                    <td><span class="badge-success"><?= $lightnb2; ?></span></td>
                    <td><span class="badge-success"><?= $rssinb2; ?></span></td>
                </tr>
                <script>
                    $(function() {
                        $('#myBtn<?= $num ?>').on('click', function() {
                            modal.style.display = "none";
                        });
                    });
                </script>
            <?php $num++; } ?>
        </tbody>
    </table>
</div>