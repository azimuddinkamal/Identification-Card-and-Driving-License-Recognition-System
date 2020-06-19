<?php

require_once "config/config.php";

$jsonFile='C://xampp//htdocs//fyp//json//scanOut.json';
$jsondata = file_get_contents($jsonFile);

$data = json_decode($jsondata, true);
//var_dump($data);

$ic_no = $data['result'][0]['prediction'][0]['ocr_text'];

//var_dump($data);
$ic_no = str_replace('-','', $ic_no);
$ic_no=preg_replace('/\s+/', '', $ic_no);


$sql = "DELETE FROM userdata where ic_no = '$ic_no'";
mysqli_query($link, $sql);

$sql1 = "UPDATE userlog set check_out_time = now() where id_no = '$ic_no'";
mysqli_query($link, $sql1);
?>