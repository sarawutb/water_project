<?php
$path_arr = explode("/", $_SERVER['PHP_SELF']);
$path = $path_arr[count($path_arr) - 1];
$sql = "SELECT * FROM `setup_system` LIMIT 1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $lat_setup = $row["lat_setup"];
    $lng_setup = $row["lng_setup"];
    $zoom_setup = $row["zoom_setup"];
    $type_setup = $row["type_setup"];
    $key_setup = $row["key_setup"];
}
// print_r($path);
?>
<script src="js/sweetalert2@11.js"></script>
<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="index.php" class="logo-wrapper" title="Home">
                <span class="sr-only">หน้าหลัก</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">UBONWLM</span>
                    <span class="logo-subtitle">อุบลราชธานี</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="<?php if ($path == 'index.php') {
                                    echo "active";
                                } ?>" href="index.php"><span class="icon home" aria-hidden="true"></span>หน้าแรก</a>
                </li>
                <li>
                    <a class="<?php if ($path == 'list_data.php') {
                                    echo "active";
                                } ?>" href="list_data.php"><span class="icon document" aria-hidden="true"></span>รายงานสถิติข้อมูล</a>
                </li>
            </ul>
            <span class="system-menu__title">ระบบ</span>
            <ul class="sidebar-body-menu">
                <ul class="cat-sub-menu"></ul>
                <?php if (isset($_SESSION["status_user"])) { ?>
                    <li>
                        <a class="<?php if ($path == 'admin_page1.php') {
                                        echo "active";
                                    } ?>" href="admin_page1.php"><span class="icon edit" aria-hidden="true"></span>จัดการข้อมูล</a>
                        <ul class="cat-sub-menu"></ul>
                    </li>
                    <li>
                        <a class="<?php if ($path == 'admin_page2.php') {
                                        echo "active";
                                    } ?>" href="admin_page2.php"><span class="icon move" aria-hidden="true"></span>กำหนดจุดพิกัด</a>
                    </li>
                    <!-- <li>
								<a class="" href="admin_page3.php"><span class="icon setting" aria-hidden="true"></span>กำหนดค่าระบบ</a>
							</li> -->
            </ul>
            <ul class="sidebar-body-menu">
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon setting" aria-hidden="true"></span>การตั้งค่า
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu-custom <?php if ($path == 'admin_setting_system.php' || $path == 'admin_setting_device.php'|| $path == 'admin_setting_notify.php') {
                                                        echo "visible";
                                                    } ?>">
                        <li>
                            <a class="<?php if ($path == 'admin_setting_system.php') {
                                            echo "active";
                                        } ?>" href="admin_setting_system.php">ตั้งค่าระบบ</a>
                        </li>
                        <li>
                            <a class="<?php if ($path == 'admin_setting_device.php') {
                                            echo "active";
                                        } ?>" href="admin_setting_device.php">ตั้งค่าอุปกรณ์</a>
                        </li>
                        <!-- <li>
                            <a class="<?php if ($path == 'admin_setting_notify.php') {
                                            echo "active";
                                        } ?>" href="admin_setting_notify.php">การแจ้งเตือน</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <span class="system-menu__title">ออกจากระบบ</span>
                    <a class="" href="auth/logout_manager.php"><span class="icon settings-line" aria-hidden="true"></span>ออกจากระบบ</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="login.php"><span class="icon user-3" aria-hidden="true"></span>เข้าสู่ระบบ</a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</aside>
<?php
if (isset($_SESSION['save_success'])) {
    echo "<script>
		Swal.fire({
			position: 'center',
			icon: 'success',
			title: '" . $_SESSION['save_success'] . "',
			showConfirmButton: false,
			timer: 2000
		})
	</script>";
}
unset($_SESSION['save_success']);
unset($_SESSION['status']);
?>