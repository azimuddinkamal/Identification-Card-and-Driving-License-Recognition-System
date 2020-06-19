<?php
require_once "../../config/config.php";

$sql="select id, name, id_no, pic_name, purpose, time(visit_time) as check_in_time, date(visit_time) as check_in_date,
			time(check_out_time) as check_out_time, date(check_out_time) as check_out_date from userlog";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$data = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				
					$jsonArrayItem = array();
					$jsonArrayItem['id'] = $row['id'];
					$jsonArrayItem['name'] = $row['name'];
					$jsonArrayItem['id_no'] = $row['id_no'];
					$jsonArrayItem['pic_name'] = $row['pic_name'];
					$jsonArrayItem['purpose'] = $row['purpose'];
					$jsonArrayItem['check_in_time'] = $row['check_in_time'];
					$jsonArrayItem['check_in_date'] = $row['check_in_date'];
				
				if(($row['check_out_time'] == '' || $row['check_out_date'] == '')){
					$jsonArrayItem['check_out_time'] = 'N/A';
					$jsonArrayItem['check_out_date'] = 'N/A';
				}else{
					$jsonArrayItem['check_out_time'] = $row['check_out_time'];
					$jsonArrayItem['check_out_date'] = $row['check_out_date'];
				}
				

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);

?>