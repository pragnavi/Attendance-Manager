
<?php
session_start();
$sem = $_SESSION['semester'];
$batch = $_SESSION['batch'];
$section = $_SESSION['section'];
$cname = $_SESSION['course_code'];
include "data.php";
$sql = "SELECT Roll_no FROM Student WHERE semester = '$sem' AND batch = '$batch' AND section = '$section' AND course_code = '$cname'";
$result = $conn->query($sql);
echo "<table border='0' align='center'>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "<button type='button' onclick='this.style.backgroundColor='red''>$row['Roll_no']</button>";
	echo "<tr>";
         echo "<td>" . $row['Roll_no'] . "</td>";
	 echo "</tr>";
    }
"</table>";
} 
else {
    echo "0 results";
}
$conn->close();
?> 



<!DOCTYPE html> 
<html>
<head><link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600' />
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <link href="a_home.css" rel="stylesheet" type="text/css" media="screen" />
Table
<title> Data </title>
<style>
body{text-align:center;}
</style>
</head>

























