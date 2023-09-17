<?php
$url2 = file_get_contents('data/water_ubon_level_list.php');
preg_match_all('/<div align=right>  (.*?) /is', $url2, $val2);
$num_see = count($val2[1])-10;
$num_kong = count($val2[1])-6;
$num_lamdom = count($val2[1])-5;

$see = ($val2[1][$num_see]);
$kong = ($val2[1][$num_kong]);
$lamdom = ($val2[1][$num_lamdom]);

print_r($see);
echo "<br>";
print_r($kong);
echo "<br>";
print_r($lamdom);
?>
