<?php
require_once "../config/config.php";


	$name		= $_POST['name'];    
	$id 		= $_POST['id'];
	$purpose	= $_POST['purpose'];
	$pic		= $_POST['pic'];
	$time		= $_POST['time'];
	$department = $_POST['department'];
	$sex		= $_POST['sex'];

	$sql = "INSERT INTO userlog (visit_time, name, id_no, gender, pic_name, purpose, department) 
			VALUES ('$time', '$name', '$id', '$sex','$pic', '$purpose', '$department')";
	
	mysqli_query($link, $sql);

	$sql1 = " DELETE FROM userdata where ic_no ='$id'";
	mysqli_query($link, $sql1);


	if(mysqli_affected_rows($connect) > 0){
		echo "<script type='text/javascript'>alert('Succesful');</script>";
		header("location: ../../index.php");
	}else{
		echo "<script type='text/javascript'>alert('Fail');</script>";
		header("location: ../../index.php");
	}

?>