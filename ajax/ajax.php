
<?php
//Initialize the session
session_start();


//Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>


<?php
require_once "../config/config.php";

$ajaxcall= $_POST['ajaxcall'];
//$ajaxcall= 'userlist';


switch($ajaxcall) {

	case "dailygraph":

		$sql="SELECT CASE 
		WHEN time(visit_time) BETWEEN '06:00:00' and '11:59:00' THEN 'Morning' 
		WHEN time(visit_time) BETWEEN '12:00:00' and '17:00:00' THEN 'Afternoon' 
		WHEN time(visit_time) BETWEEN '17:01:00' and '20:00:00' THEN 'Evening' 
		WHEN time(visit_time) BETWEEN '20:01:00' and '23:59:59' THEN 'Night' 
		WHEN time(visit_time) BETWEEN '00:00:00' and '05:59:59' THEN 'Midnight' 
		ELSE NULL 
		END AS TimeRange, COUNT(*) as Total FROM userlog 
		Where date(visit_time) > '2020-01-01' AND date(visit_time) <= NOW() 
		GROUP BY TimeRange HAVING TimeRange IS NOT NULL";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['label'] = $row['TimeRange'];
				$jsonArrayItem['value'] = $row['Total'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);

	break;

	case "weeklygraph":

		$sql="SELECT CASE 
		WHEN time(visit_time) BETWEEN '06:00:00' and '11:59:00' THEN 'Morning' 
		WHEN time(visit_time) BETWEEN '12:00:00' and '17:00:00' THEN 'Afternoon' 
		WHEN time(visit_time) BETWEEN '17:01:00' and '20:00:00' THEN 'Evening' 
		WHEN time(visit_time) BETWEEN '20:01:00' and '23:59:59' THEN 'Night' 
		WHEN time(visit_time) BETWEEN '00:00:00' and '05:59:59' THEN 'Midnight' 
		ELSE NULL 
		END AS TimeRange, COUNT(*) as Total FROM userlog 
		Where date(visit_time) = '2020-01-28' 
		GROUP BY TimeRange HAVING TimeRange IS NOT NULL";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['label'] = $row['TimeRange'];
				$jsonArrayItem['value'] = $row['Total'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);
		

	break;
	
	case "monthlygraph":

		$sql="SELECT CASE 
		WHEN time(visit_time) BETWEEN '06:00:00' and '11:59:00' THEN 'Morning' 
		WHEN time(visit_time) BETWEEN '12:00:00' and '17:00:00' THEN 'Afternoon' 
		WHEN time(visit_time) BETWEEN '17:01:00' and '20:00:00' THEN 'Evening' 
		WHEN time(visit_time) BETWEEN '20:01:00' and '23:59:59' THEN 'Night' 
		WHEN time(visit_time) BETWEEN '00:00:00' and '05:59:59' THEN 'Midnight' 
		ELSE NULL 
		END AS TimeRange, COUNT(*) as Total FROM userlog 
		Where date(visit_time) = '2020-01-28' 
		GROUP BY TimeRange HAVING TimeRange IS NOT NULL";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['label'] = $row['TimeRange'];
				$jsonArrayItem['value'] = $row['Total'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);
		

	break;
	
	case "yearlygraph":

		$sql="SELECT CASE 
		WHEN time(visit_time) BETWEEN '06:00:00' and '11:59:00' THEN 'Morning' 
		WHEN time(visit_time) BETWEEN '12:00:00' and '17:00:00' THEN 'Afternoon' 
		WHEN time(visit_time) BETWEEN '17:01:00' and '20:00:00' THEN 'Evening' 
		WHEN time(visit_time) BETWEEN '20:01:00' and '23:59:59' THEN 'Night' 
		WHEN time(visit_time) BETWEEN '00:00:00' and '05:59:59' THEN 'Midnight' 
		ELSE NULL 
		END AS TimeRange, COUNT(*) as Total FROM userlog 
		Where date(visit_time) = '2020-01-28' 
		GROUP BY TimeRange HAVING TimeRange IS NOT NULL";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['label'] = $row['TimeRange'];
				$jsonArrayItem['value'] = $row['Total'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);
		

	break;

	case "piechart":
		
		$sql = "SELECT department, count(department) as total FROM 
				userlog where date(visit_time) >='2020-01-01' 
				and date(visit_time) <= CURDATE()";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['label'] = $row['department'];
				$jsonArrayItem['value'] = $row['total'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);
		
	break;
	
	case "scan":
		$python = 'C:\\Users\\Azim\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe';
		$pyscript = 'C:\\xampp\\htdocs\\fyp\\python\\scanIn.py';
		$php = 'C:\\xampp\\php\\php.exe';
		$phpfile = 'C:\\xampp\\htdocs\\fyp\\load.php';
		$cmd = "$python $pyscript";
		$phpcmd = "$php $phpfile";
		exec("$cmd", $output);
		exec("$phpcmd", $a);
		echo json_encode($a);
	break;
	
	case "usertable":

	$sql=" select id, user_type, username, DATE_FORMAT(date(created_at),'%d-%m-%Y') as date_created, time(created_at) as time_created from users";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['id'] = $row['id'];
				$jsonArrayItem['user_type'] = $row['user_type'];
				$jsonArrayItem['username'] = $row['username'];
				$jsonArrayItem['date_created'] = $row['date_created'];
				$jsonArrayItem['time_created'] = $row['time_created'];
				$jsonArrayItem['update'] = '<button type="button" name="update" id="'.$row['id'].'" class="btn btn-link update">Edit</button>'."/".'<button type="button" name="delete" id="'.$row['id'].'" class="btn btn-link delete">Delete</button>'; 

				array_push($jsonArray, $jsonArrayItem);
			}
		}
		
		$data = array();
		$data['data'] = $jsonArray;

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($data);
		
	break;

	case "visitortable":

	$sql="select id, name, id_no, pic_name, purpose, time(visit_time) as check_in_time, DATE_FORMAT(date(visit_time),'%d-%m-%Y') as check_in_date,
			time(check_out_time) as check_out_time, DATE_FORMAT(date(check_out_time),'%d-%m-%Y') as check_out_date from userlog";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				
					$jsonArrayItem = array();
					$jsonArrayItem['id'] = $row['id'];
					$jsonArrayItem['name'] = $row['name'];
					$jsonArrayItem['id_no'] = $row['id_no'];
					$jsonArrayItem['pic_name'] = $row['pic_name'];
					$jsonArrayItem['check_in_time'] = $row['check_in_time'];
					$jsonArrayItem['check_in_date'] = $row['check_in_date'];
					$jsonArrayItem['update'] = '<button type="button" name="update" id="'.$row['id'].'" class="btn btn-link update">Edit</button>'."/".'<button type="button" name="delete" id="'.$row['id'].'" class="btn btn-link delete">Delete</button>'; 
				
				if($row['purpose'] == ''){
					$jsonArrayItem['purpose'] = 'N/A';
				}else{
					$jsonArrayItem['purpose'] = $row['purpose'];
				}
				
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
		
		$data = array();
		$data['data'] = $jsonArray;

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($data);
		
	break;

	case "showdata":

	$sql="SELECT * FROM userdata";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$jsonArray = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
	
				$jsonArrayItem = array();
				$jsonArrayItem['id_type'] = $row['id_type'];
				$jsonArrayItem['fname'] = $row['fname'];
				$jsonArrayItem['address'] = $row['address'];
				$jsonArrayItem['ic_no'] = $row['ic_no'];
				$jsonArrayItem['sex'] = $row['sex'];
				$jsonArrayItem['check_in_time'] = $row['check_in_time'];

				array_push($jsonArray, $jsonArrayItem);
			}
		}

		mysqli_close($link);

		header('Content-type: application/json');
		echo json_encode($jsonArray);
		
	break;

	case "scanOut":
		$python = 'C:\\Users\\Azim\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe';
		$pyscript = 'C:\\xampp\\htdocs\\fyp\\python\\scanOut.py';
		$php = 'C:\\xampp\\php\\php.exe';
		$phpfile = 'C:\\xampp\\htdocs\\fyp\\loadOut.php';
		$cmd = "$python $pyscript";
		$phpcmd = "$php $phpfile";
		exec("$cmd", $output);
		exec("$phpcmd", $a);
		echo json_encode($a);
	break;
	
	case "updateVisitorRecord":
		$id = $_POST['id'];
		$name = $_POST['name'];
		$ic_no = $_POST['ic_no'];
		$pic = $_POST['pic'];
		$purpose = $_POST['purpose'];
		$checkintime = $_POST['checkintime'];
		$checkindate = $_POST['checkindate'];
		$checkouttime = $_POST['checkouttime'];
		$checkoutdate = $_POST['checkoutdate'];
		
		$sql="UPDATE userlog set name = '$name', id_no = '$ic_no',
				pic_name = '$pic', purpose = '$purpose', 
				visit_time = (TIMESTAMP('$checkindate','$checkintime')),
				check_out_time = (TIMESTAMP('$checkoutdate','$checkouttime'))
				where id = '$id'";
		
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);
		echo "Success Update Visitor Info!";
		
	break;

	case 'addVisitorRecord':

		$id = $_POST['id'];
		$name = $_POST['name'];
		$ic_no = $_POST['ic_no'];
		$pic = $_POST['pic'];
		$purpose = $_POST['purpose'];
		$checkintime = $_POST['checkintime'];
		$checkindate = $_POST['checkindate'];
		$checkouttime = $_POST['checkouttime'];
		$checkoutdate = $_POST['checkoutdate'];

		$ic_last_no = (int)substr($ic_no,-1);

		$ic_last_no = $ic_last_no % 2;

		if ($ic_last_no != 0){
			$sex= "Male";
		}else {
			$sex="Female";
		}

		$sql = "INSERT INTO userlog (visit_time, name, id_no, gender, pic_name, purpose, check_out_time) 
			VALUES (TIMESTAMP('$checkindate','$checkintime'), '$name', '$ic_no', '$sex', '$pic', '$purpose', TIMESTAMP('$checkoutdate','$checkouttime'))";
	
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);

		echo "Visitor added!";

	break;
	
	case "getvisitortable":
	
	$id = $_POST['id'];
			
	$sql="select id, name, id_no, pic_name, purpose, time(visit_time) as check_in_time, date(visit_time) as check_in_date,
			time(check_out_time) as check_out_time, date(check_out_time) as check_out_date from userlog
			where id = '$id'";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$data = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				
					$jsonArrayItem = array();
					$jsonArrayItem['id'] = $row['id'];
					$jsonArrayItem['name'] = $row['name'];
					$jsonArrayItem['id_no'] = $row['id_no'];
					$jsonArrayItem['pic_name'] = $row['pic_name'];
					$jsonArrayItem['check_in_time'] = $row['check_in_time'];
					$jsonArrayItem['check_in_date'] = $row['check_in_date'];
					$jsonArrayItem['update'] = '<button type="button" name="update" id="'.$row['id'].'" class="btn btn-link update">Edit</button>'."/".'<button type="button" name="delete" id="'.$row['id'].'" class="btn btn-link delete">Delete</button>'; 
				
				if($row['purpose'] == ''){
					$jsonArrayItem['purpose'] = 'N/A';
				}else{
					$jsonArrayItem['purpose'] = $row['purpose'];
				}
				
				if(($row['check_out_time'] == '' || $row['check_out_date'] == '')){
					$jsonArrayItem['check_out_time'] = 'N/A';
					$jsonArrayItem['check_out_date'] = 'N/A';
				}else{
					$jsonArrayItem['check_out_time'] = $row['check_out_time'];
					$jsonArrayItem['check_out_date'] = $row['check_out_date'];
				}
				

				array_push($data, $jsonArrayItem);
			}
		}
		

		mysqli_close($link);
		header('Content-type: application/json');
		echo json_encode($data);
		
	break;

	case 'deleteVisitorRecord':

		$id = $_POST['id'];
			
		$sql="DELETE from userlog where id = '$id'";
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);
		echo "Success Remove a Visitor!";

	break;

	case 'getusertable':

		$id = $_POST['id'];

		$sql="select id, user_type, username, DATE_FORMAT(date(created_at),'%d-%m-%Y') as date_created, time(created_at) as time_created from users
				where id = '$id'";

		$result = mysqli_query($link, $sql) or die (mysqli_error());

		$data = array();

		if ($result){

			while ($row = mysqli_fetch_array ($result)){
				$jsonArrayItem = array();
				$jsonArrayItem['id'] = $row['id'];
				$jsonArrayItem['user_type'] = $row['user_type'];
				$jsonArrayItem['username'] = $row['username'];
				$jsonArrayItem['date_created'] = $row['date_created'];
				$jsonArrayItem['time_created'] = $row['time_created'];
				$jsonArrayItem['update'] = '<button type="button" name="update" id="'.$row['id'].'" class="btn btn-link update">Edit</button>'."/".'<button type="button" name="delete" id="'.$row['id'].'" class="btn btn-link delete">Delete</button>'; 

				array_push($data, $jsonArrayItem);
			}
		}

		mysqli_close($link);
		
		echo json_encode($data);

	break;

	case 'addUserRecord':

		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$confirmpass = $_POST['confirmpass'];

		$usernamecheck = strtolower($username);
		if(strpos($usernamecheck,'admin') !== false){
			echo "Cannot use admin as username!";
			break;
		}else{
			$sql = "SELECT id FROM users WHERE username = '$username'";
			$stmt = mysqli_query($link, $sql) or die (mysqli_error());

			if(mysqli_num_rows($stmt) == 1){
				echo "This username is already taken!";
				break;
			} else{
				$username = $_POST['username'];
			}
		}
		if(strlen($pass) < 6){
			echo "Password must have atleast 6 characters!";
			break;

		}else{
			if($pass != $confirmpass){
				echo "Password did not match!";
			break;
			}else{
				$hashpass = password_hash($pass, PASSWORD_DEFAULT);
				$user_type = "user";
			}
		}

		$sql = "INSERT INTO users (user_type, username, password) VALUES ('$user_type','$username' , '$hashpass')";
	
		
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);
		echo "User added!";
		
	break;

	case 'updateUserRecord':
		$id = $_POST['id'];
		$username = $_POST['username'];
		$datecreated = $_POST['datecreated'];
		$timecreated = $_POST['timecreated'];
		
		$sql="UPDATE users set username = '$username',
				created_at = (TIMESTAMP('$datecreated','$timecreated'))
				where id = '$id'";
		
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);
		echo "Success Update User Info!";
		
	break;

	case 'deleteUserRecord':

		$id = $_POST['id'];
			
		$sql="DELETE from users where id = '$id'";
		mysqli_query($link, $sql) or die (mysqli_error());
		mysqli_close($link);
		echo "Success Remove a User!";

	break;


}

?>
