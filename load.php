<?php

require_once "config/config.php";

$jsonFile='C://xampp//htdocs//fyp//json//info.json';
$jsondata = file_get_contents($jsonFile);

$data = json_decode($jsondata, true);
//var_dump($data);

$id_type = $data['result'][0]['prediction'][0]['ocr_text'];

if (strlen($id_type)<=5){
	$ic_no = $data['result'][0]['prediction'][1]['ocr_text'];
	$fname = $data['result'][0]['prediction'][2]['ocr_text'];
	$address = $data['result'][0]['prediction'][3]['ocr_text'];
	$id_type = $data['result'][0]['prediction'][0]['ocr_text'];
}else{
	$ic_no = $data['result'][0]['prediction'][2]['ocr_text'];
	$fname = $data['result'][0]['prediction'][1]['ocr_text'];
	$address = $data['result'][0]['prediction'][3]['ocr_text'];
	$id_type = $data['result'][0]['prediction'][0]['ocr_text'];
}


//var_dump($data);
$ic_no = str_replace('-','', $ic_no);
$ic_no=preg_replace('/\s+/', '', $ic_no);

$ic_last_no = (int)substr($ic_no,-1);

$ic_last_no = $ic_last_no % 2;

$address = str_replace("\n",', ', $address);
$fname = str_replace("\n",' ', $fname);

if ($ic_last_no != 0){
	$sex= "Male";
}else {
	$sex="Female";
}

if (strlen($id_type)<=5){
	$id_type = "MyKad";
}else{
	$id_type = "Driving License";
}

$sql = "INSERT INTO userdata (id_type, ic_no, fname, address, sex) 
			VALUES ('$id_type', '$ic_no', '$fname', '$address', '$sex')";

mysqli_query($link, $sql);
?>