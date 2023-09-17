<?php
session_start();
if ($_SESSION['id_user']) {
  include("connect.php");
} else {
  session_destroy();
  header("location:index.php");
}

if (isset($_POST['add_area_map'])) {
  $color_map = $_POST['color_map'];
  $area_lat_map = $_POST['area_lat_map'];
  $area_lng_map = $_POST['area_lng_map'];
  $name_map = $_POST['name_map'];
  $detail_map = $_POST['detail_map'];
  $file_map = [];
  $water_list_map = $_POST['water_list_map'];
  $date_data_map = $_POST['date_data_map'];
  $type_map = 1;

  if (isset($_POST['status_map'])) {
    $status_map = $_POST['status_map'];
  } else {
    $status_map = 0;
  }
  $data_file = null;

  if (count($_FILES["file_map"]['name']) > 0) {
    //check if any file uploaded
    $GLOBALS['msg'] = ""; //initiate the global message
    for ($j = 0; $j < count($_FILES["file_map"]['name']); $j++) { //loop the uploaded file array
      $filen = $_FILES["file_map"]['name']["$j"]; //file name
      $name_file = strtotime("now") . $j;
      $type_file = substr($filen, strrpos($filen, '.') + 1);
      $file = "file_" . $name_file . "." . $type_file;
      $path = 'uploads/' . $file; //generate the destination path
      if (move_uploaded_file($_FILES["file_map"]['tmp_name']["$j"], $path)) {
        array_push($file_map, $file);
        $data_file = implode(",", $file_map);
      } else {
        $_SESSION['save_success'] = "บันทึกไม่สำเร็จ";
        $_SESSION['status'] = "danger";
        // break;
      }
    }
  }

  $sql = "INSERT INTO `val_map` (`id`, `lat_map`, `lng_map`, `color_map`, `name_map`, `detail_map`, `type_map`, `list_water_map`, `value_water_map`, `file_path_map`, `status_map`)
        VALUES (NULL, 
        '$area_lat_map', 
        '$area_lng_map', 
        '$color_map', 
        '$name_map', 
        '$detail_map', 
        '$type_map', 
        '$water_list_map', 
        '$date_data_map', 
        '$data_file', 
        '$status_map');";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "บันทึกสำเร็จ";
    $_SESSION['status'] = "success";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    // header('Location:admin_page2.php');
    echo "<script>
              window.history.go(-2);
          </script>";
  } else {
    $_SESSION['save_success'] = "บันทึกไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}

if (isset($_POST['edit_area_map'])) {
  $id = $_POST['id'];
  // echo $id;
  $color_map = $_POST['color_map'];
  $area_lat_map = $_POST['area_lat_map'];
  $area_lng_map = $_POST['area_lng_map'];
  $name_map = $_POST['name_map'];
  $detail_map = $_POST['detail_map'];
  $list_water_map = $_POST['water_list_map'];
  $value_water_map = $_POST['date_data_map'];
  $file_path_map = $_POST['file_map_list'];
  $type_map = 1;
  if (isset($_POST['status_map'])) {
    $status_map = $_POST['status_map'];
  } else {
    $status_map = 0;
  }
  $file_map = [];

  // print_r($file_path_map); 
  // print_r($_FILES["file_map"]['name']);

  // $dir    = './uploads';
  // $files = scandir($dir);
  // $files_old = explode(",", $file_path_map);
  // for ($i = 2; $i < count($files); $i++) {
  //   if (in_array($files[$i], $files_old)) {
  //     unlink($dir . "/" . $files[$i]);
  //   }
  // }

  if (count($_FILES["file_map"]['name']) > 1) {
    //check if any file uploaded
    $GLOBALS['msg'] = ""; //initiate the global message
    for ($j = 0; $j < count($_FILES["file_map"]['name']); $j++) { //loop the uploaded file array
      $filen = $_FILES["file_map"]['name']["$j"]; //file name
      $name_file = strtotime("now") . $j;
      $type_file = substr($filen, strrpos($filen, '.') + 1);
      $file = "file_" . $name_file . "." . $type_file;
      $path = 'uploads/' . $file; //generate the destination path
      if (move_uploaded_file($_FILES["file_map"]['tmp_name']["$j"], $path)) {
        array_push($file_map, $file);
        $file_path_map = implode(",", $file_map);
      } else {
        $_SESSION['save_success'] = "บันทึกไม่สำเร็จ";
        $_SESSION['status'] = "danger";
        // break;
      }
    }
  }
  $sql = "UPDATE `val_map` SET
          `lat_map` = '$area_lat_map',
          `lng_map` = '$area_lng_map',
          `color_map` = '$color_map',
          `name_map` = '$name_map',
          `detail_map` = '$detail_map',
          `type_map` = '$type_map',
          `list_water_map` = '$list_water_map',
          `value_water_map` = '$value_water_map',
          `file_path_map` = '$file_path_map',
          `status_map` = '$status_map'
          WHERE `val_map`.`id` = $id;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    header('Location:admin_page2.php');
    // echo "<script>
    //           window.history.go(-2);
    //       </script>";
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}

if (isset($_GET['update1_data'])) {
  $date = $_GET['date'];
  $level_water = $_GET['level_water'];
  $amount_water = $_GET['amount_water'];

  $sql = "UPDATE `val_water` SET `level_water` = '$level_water',`amount_water` = '$amount_water' WHERE date = '$date';";
  $conn->query($sql);

  $temp_tmd = $_GET['temp_tmd'];
  $humidity_tmd = $_GET['humidity_tmd'];
  $MeanSeaLevelPressure_tmd = $_GET['MeanSeaLevelPressure_tmd'];
  $wind_tmd = $_GET['wind_tmd'];
  $land_visibility_tmd = $_GET['land_visibility_tmd'];

  $sql = "UPDATE `val_tmd` SET `temp_tmd` = '$temp_tmd', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE date_tmd = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update2_data'])) {
  $date = $_GET['date'];
  $level_water = $_GET['level_water'];
  $amount_water = $_GET['amount_water'];

  $sql = "UPDATE `val_water_khong` SET `level_water` = '$level_water',`amount_water` = '$amount_water' WHERE date = '$date';";
  $conn->query($sql);

  $temp_tmd = $_GET['temp_tmd'];
  $humidity_tmd = $_GET['humidity_tmd'];
  $MeanSeaLevelPressure_tmd = $_GET['MeanSeaLevelPressure_tmd'];
  $wind_tmd = $_GET['wind_tmd'];
  $land_visibility_tmd = $_GET['land_visibility_tmd'];

  $sql = "UPDATE `val_wather_khong` SET `temp_tmd` = '$temp_tmd', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE date_tmd = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update3_data'])) {
  $date = $_GET['date'];
  $level_water = $_GET['level_water'];
  $amount_water = $_GET['amount_water'];

  $sql = "UPDATE `val_water_mun2` SET `level_water_mun2` = '$level_water',`amount_water_mun2` = '$amount_water' WHERE date = '$date';";
  $conn->query($sql);

  $temp_wather_mun2 = $_GET['temp_wather_mun2'];
  $humidity_wather_mun2 = $_GET['humidity_wather_mun2'];
  $MeanSeaLevelPressure_wather_mun2 = $_GET['MeanSeaLevelPressure_wather_mun2'];
  $wind_wather_mun2 = $_GET['wind_wather_mun2'];
  $land_visibility_wather_mun2 = $_GET['land_visibility_wather_mun2'];

  $sql = "UPDATE `val_wather_mun2` SET `temp_wather_mun2` = '$temp_wather_mun2', `humidity_wather_mun2` = '$humidity_wather_mun2', `MeanSeaLevelPressure_wather_mun2` = '$MeanSeaLevelPressure_wather_mun2', `wind_wather_mun2` = '$wind_wather_mun2', `land_visibility_wather_mun2` = '$land_visibility_wather_mun2' WHERE date_wather_mun2 = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update4_data'])) {
  $date = $_GET['date'];
  $level_water_sirinton = $_GET['level_water_sirinton'];
  $amount_water_sirinton = $_GET['amount_water_sirinton'];

  $sql = "UPDATE `val_water_sirinton` SET `level_water_sirinton` = '$level_water_sirinton',`amount_water_sirinton` = '$amount_water_sirinton' WHERE date = '$date';";
  $conn->query($sql);

  $temp_wather_sirinton = $_GET['temp_wather_sirinton'];
  $humidity_wather_sirinton = $_GET['humidity_wather_sirinton'];
  $MeanSeaLevelPressure_wather_sirinton = $_GET['MeanSeaLevelPressure_wather_sirinton'];
  $wind_wather_sirinton = $_GET['wind_wather_sirinton'];
  $land_visibility_wather_sirinton = $_GET['land_visibility_wather_sirinton'];

  $sql = "UPDATE `val_wather_sirinton` SET `temp_wather_sirinton` = '$temp_wather_sirinton', `humidity_wather_sirinton` = '$humidity_wather_sirinton', `MeanSeaLevelPressure_wather_sirinton` = '$MeanSeaLevelPressure_wather_sirinton', `wind_wather_sirinton` = '$wind_wather_sirinton', `land_visibility_wather_sirinton` = '$land_visibility_wather_sirinton' WHERE date_wather_sirinton = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update5_data'])) {
  $date = $_GET['date'];
  $level_water = $_GET['level_water'];
  $amount_water = $_GET['amount_water'];

  $sql = "UPDATE `val_water_lamdom` SET `level_water` = '$level_water',`amount_water` = '$amount_water' WHERE date = '$date';";
  $conn->query($sql);

  $temp_tmd = $_GET['temp_tmd'];
  $humidity_tmd = $_GET['humidity_tmd'];
  $MeanSeaLevelPressure_tmd = $_GET['MeanSeaLevelPressure_tmd'];
  $wind_tmd = $_GET['wind_tmd'];
  $land_visibility_tmd = $_GET['land_visibility_tmd'];

  $sql = "UPDATE `val_wather_lamdom` SET `temp_tmd` = '$temp_tmd', `humidity_tmd` = '$humidity_tmd', `MeanSeaLevelPressure_tmd` = '$MeanSeaLevelPressure_tmd', `wind_tmd` = '$wind_tmd', `land_visibility_tmd` = '$land_visibility_tmd' WHERE date_tmd = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update_nb1_data'])) {
  $date = $_GET['date'];
  $temp_nb1 = $_GET['temp_Nb1'];
  $humid_nb1 = $_GET['humidity_Nb1'];
  $light_nb1 = $_GET['light_Nb1'];
  $distance_nb1 = $_GET['level_water_Nb1'];
  $rssi_nb1 = $_GET['rssi_Nb1'];

  $sql = "UPDATE `val_nb1` SET `temp_nb1` = '$temp_nb1', `humid_nb1` = '$humid_nb1', `light_nb1` = '$light_nb1', `distance_nb1` = '$distance_nb1', `rssi_nb1` = '$rssi_nb1' WHERE date_nb1 = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update_nb2_data'])) {
  $date = $_GET['date'];
  $temp_nb2 = $_GET['temp_Nb2'];
  $humid_nb2 = $_GET['humidity_Nb2'];
  $light_nb2 = $_GET['light_Nb2'];
  $distance_nb2 = $_GET['level_water_Nb2'];
  $rssi_nb2 = $_GET['rssi_Nb2'];

  $sql = "UPDATE `val_nb2` SET `temp_nb2` = '$temp_nb2', `humid_nb2` = '$humid_nb2', `light_nb2` = '$light_nb2', `distance_nb2` = '$distance_nb2', `rssi_nb2` = '$rssi_nb2' WHERE date_nb2 = '$date';";
  $conn->query($sql);
}

if (isset($_GET['update_nb3_data'])) {
  $date = $_GET['date'];
  $temp_nb3 = $_GET['temp_Nb3'];
  $humid_nb3 = $_GET['humidity_Nb3'];
  $light_nb3 = $_GET['light_Nb3'];
  $distance_nb3 = $_GET['level_water_Nb3'];
  $rssi_nb3 = $_GET['rssi_Nb3'];

  $sql = "UPDATE `val_nb3` SET `temp_nb3` = '$temp_nb3', `humid_nb3` = '$humid_nb3', `light_nb3` = '$light_nb3', `distance_nb3` = '$distance_nb3', `rssi_nb3` = '$rssi_nb3' WHERE date_nb3 = '$date';";
  $conn->query($sql);
}

if (isset($_GET['delete_map'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM `val_map` WHERE `val_map`.`id` = $id";
  $sql1 = "SELECT * FROM val_map WHERE `val_map`.`id` = $id";
  $result1 = $conn->query($sql1);
  while ($row = $result1->fetch_assoc()) {
    $file_path_map = explode("/", $row['file_path_map']);
    $file_path_map  = $file_path_map[count($file_path_map) - 1];
  }
  $dir    = './uploads';
  $files = scandir($dir);
  $files_delete = explode(",", $file_path_map);
  for ($i = 2; $i < count($files); $i++) {
    if (in_array($files[$i], $files_delete)) {
      unlink($dir . "/" . $files[$i]);
    }
  }
  if ($conn->query($sql) === TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo "<script>
              window.history.go(-1);
          </script>";
  }
}

if (isset($_POST['admin_setup_update_water'])) {
  $water_id = $_POST['water_id'];
  $water_name = $_POST['water_name'];
  if (isset($_POST['water_status'])) {
    $water_status = $_POST['water_status'];
  } else {
    $water_status = 0;
  }
  echo $water_status;
  $level_water_max1 = $_POST['level_water_max1'];
  $level_water_max2 = $_POST['level_water_max2'];
  $water_lat = $_POST['water_lat'];
  $water_lng = $_POST['water_lng'];
  $sql = "UPDATE `list_water` SET 
  `water_name` = '$water_name', 
  `water_status` = '$water_status',
  `level_water_max1` = '$level_water_max1', 
  `level_water_max2` = '$level_water_max2', 
  `water_lat` = '$water_lat', 
  `water_lng` = '$water_lng' 
  WHERE `list_water`.`id_water` = $water_id;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    // header('Location:admin_page2.php');
    echo "<script>
              window.history.go(-1);
          </script>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}

if (isset($_POST['admin_setup_update2_water'])) {
  $device_id = $_POST['device_id'];
  $device_name = $_POST['device_name'];
  $device_status = $_POST['device_status'];
  $device_lat = $_POST['device_lat'];
  $device_lng = $_POST['device_lng'];

  if (isset($_POST['device_status'])) {
    $device_status = $_POST['device_status'];
  } else {
    $device_status = 0;
  }

  $sql = "UPDATE `list_device` SET 
  `device_name` = '$device_name', 
  `device_status` = '$device_status', 
  `device_lat` = '$device_lat', 
  `device_lng` = '$device_lng' 
  WHERE `list_device`.`device_id` = $device_id;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
    echo "<script>
              window.history.go(-1);
          </script>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}

if (isset($_POST['save_setup'])) {
  $lat_setup = $_POST['lat_setup'];
  $lng_setup = $_POST['lng_setup'];
  $key_setup = $_POST['key_setup'];
  $zoom_setup = $_POST['zoom_setup'];
  $select_setup = $_POST['select_setup'];

  // echo $lat_setup;
  // echo $lng_setup;
  // echo $key_setup;
  // echo $zoom_setup;
  // echo $select_setup;

  $sql = "UPDATE `setup_system` SET 
  `lat_setup` = '$lat_setup', 
  `lng_setup` = '$lng_setup', 
  `zoom_setup` = '$zoom_setup', 
  `type_setup` = '$select_setup', 
  `key_setup` = '$key_setup' 
  WHERE `setup_system`.`id_setup` = 1;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    // header('Location:admin_page2.php');
    echo "<script>
              window.history.go(-1);
          </script>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}
if (isset($_POST['admin_setup_update_water_status'])) {
  $water_id = $_POST['water_id'];
  if (isset($_POST['water_status'])) {
    $water_status = $_POST['water_status'];
  } else {
    $water_status = 0;
  }
  // echo $water_status;
  $sql = "UPDATE `list_water` SET 
  `water_status` = '$water_status'
  WHERE `list_water`.`id_water` = $water_id;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    // header('Location:admin_page2.php');
    // echo "<script>
    //           window.history.go(-1);
    //       </script>";
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}
if (isset($_POST['admin_setup_update_water_statusMap'])) {
  $water_id = $_POST['water_id'];
  if (isset($_POST['water_status'])) {
    $water_status = $_POST['water_status'];
  } else {
    $water_status = 0;
  }
  $sql = "UPDATE `list_water` SET 
  `water_status` = '$water_status'
  WHERE `list_water`.`id_water` = $water_id;";
  $conn->query($sql);
}
if (isset($_POST['admin_setup_update_device2_status'])) {
  $device_id = $_POST['device_id'];
  if (isset($_POST['device_status'])) {
    $device_status = $_POST['device_status'];
  } else {
    $device_status = 0;
  }
  $sql = "UPDATE `list_device` SET `device_status` = '$device_status' WHERE `list_device`.`device_id` = $device_id;";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['save_success'] = "อัพเดทสำเร็จ";
    $_SESSION['status'] = "success";
  } else {
    $_SESSION['save_success'] = "อัพเดทไม่สำเร็จ";
    $_SESSION['status'] = "danger";
  }
}
if (isset($_POST['admin_setup_update_device2_statusMap'])) {
  $device_id = $_POST['device_id'];
  if (isset($_POST['device_status'])) {
    $device_status = $_POST['device_status'];
  } else {
    $device_status = 0;
  }
  $sql = "UPDATE `list_device` SET `device_status` = '0' WHERE `list_device`.`device_id` = $device_id;";
  $conn->query($sql);
}
