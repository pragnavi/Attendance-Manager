<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "apurva123";
$dbname = "Attendance1";

	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
?>
