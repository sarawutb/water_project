
<?php
header('Content-Type: application/json;charset=utf-8');
$url = file_get_contents('data/water_ubun_amount.php');
$url_list = iconv( 'cp874', 'UTF-8', $url);
preg_match_all('/title="(.*?)"/is', $url_list, $name_water);
preg_match_all('/(<div align.*?)<\/div>/is', $url_list, $amount_water);


  print_r($name_water[1]);
  print_r($amount_water[1]);
?>
