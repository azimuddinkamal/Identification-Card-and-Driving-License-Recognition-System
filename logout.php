<?php

// Initialize the session
session_start();

require_once 'config/config.php';

$sql="DELETE FROM userdata where ic_no is not null";

mysqli_query($link, $sql) or die (mysqli_error());

 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();



// Redirect to login page
header("location: login.php");
exit;
?>