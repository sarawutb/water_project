<?php
header('Content-Type: text/html; charset=utf-8');

date_default_timezone_set("Asia/Bangkok");
//  $servername = "localhost";
//  $username = "ubonwlm";
//  $password = "ubonwlm";
//  $dbname = "ubonwlm_water";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assmartfarm_iot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//$con= mysqli_connect("localhost","root","","online_exam") or die("Error: " . mysqli_error($con));
mysqli_query($conn, "SET NAMES 'utf8' ");

//mysqli_set_charset($conn, "utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
