<?php
// header ('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json;charset=utf-8');
         $urljson = file_get_contents('data/tmd_data.json');
        $json = $urljson;

        // $json = json_decode($json);
         echo $json;






?>
