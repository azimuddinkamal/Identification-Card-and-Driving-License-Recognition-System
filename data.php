<?php
    require_once "config/config.php";

    $sql  = "SELECT department, count(department) as total FROM userlog group by department order by total desc limit 1";
    $sql1 = "SELECT count(name) AS total_visitor FROM userlog" ;
    $sql2 = "SELECT TIME_FORMAT(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF( check_out_time, visit_time)))), '%h:%i') AS diff FROM userlog where check_out_time is not null" ;
    $sql3 = "SELECT TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF( check_out_time, visit_time)))), '%h:%i') AS diff FROM userlog where check_out_time is not null" ;

    $result = mysqli_query($link, $sql) or die (mysqli_error());
    $result1 = mysqli_query($link, $sql1) or die (mysqli_error());
    $result2 = mysqli_query($link, $sql2) or die (mysqli_error());
    $result3 = mysqli_query($link, $sql3) or die (mysqli_error());

    $data = array(); // Department
    $data1 = array(); //Users
    $data2= array(); // Total hours
    $data3 = array(); // Average

		if ($result){
            if (mysqli_num_rows($result) > 0){

			while ($row = mysqli_fetch_array ($result)){
                $data = $row['department'];
            }
			}else{
                $data = 'N/A';
            }
        }
        
        if ($result1){
			while ($row = mysqli_fetch_array ($result1)){
				$data1 = $row['total_visitor'];
			
			}
        }

        if ($result2){

			if (mysqli_num_rows($result2) > 0){
                while ($row = mysqli_fetch_array ($result2)){
                    if (!empty($row['diff'])){
                        $data2 = $row['diff'];
                    }else{
                        $data2 = '0';
                    }
                }
                }else{
                    $data2 = '0';
                }
        }

        if ($result3){

			if (mysqli_num_rows($result3) > 0){
                while ($row = mysqli_fetch_array ($result3)){
                    if (!empty($row['diff'])){
                        $data3 = $row['diff'];
                    }else{
                        $data3 = '0';
                    }
                }
                }else{
                    $data3 = '0';
                }
        }
    
    $department = $data ; // Department
    $total_user = $data1  ; //Users
    $total_hours = $data2  ; // Total hours
    $avg_hours = $data3  ;
       //var_dump($data3);
?>