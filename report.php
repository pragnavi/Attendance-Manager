<!DOCTYPE html>
<html>
<head>
Table
<title> Report </title>
<style>
body{text-align:center;}
</style>
</head>
<body bgcolor=#7FFFD4>
<?php
session_start();
$sem = $_SESSION['semester'];
$batch = $_SESSION['batch'];
$section = $_SESSION['section'];
$session = $_SESSION['session'];
$cname = $_SESSION['course_code'];
include "data.php";
$sql = "SELECT * FROM `details` WHERE semester = '$sem' AND batch = '$batch' AND section = '$section' AND session = '$session' AND course_code = '$cname'";
$result = $conn->query($sql);

/*student table doesnot have the column attendance*/

$sql1 = "SELECT * FROM `details` WHERE attendance='A' AND semester = '$sem' AND batch = '$batch' AND section = '$section' AND course_code = '$cname'  AND session = '$session'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()){
			$str = $str . $row1['Roll_no'] . " ";	
		}    
      
/*$Absentees = array();
while($row1 = $result1->fetch_assoc()){
	$Absentees[] = $row1['Roll_no'];
}
print_r($Absentees);*/
echo "<table border='1' align='center'><tr><th>Date</th><th>Semester</th><th>Batch</th><th>Section</th><th>Period</th><th>Session</th><th>Course Code</th><th>List of Absentees</th></tr>";
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo "<tr>";
		  echo "<td>" . $row['date'] . "</td>";
		  echo "<td>" . $row['semester'] . "</td>";
	 	  echo "<td>" . $row['batch'] . "</td>";
		  echo "<td>" . $row['section'] . "</td>";
		  echo "<td>" . $row['period'] . "</td>";
		  echo "<td>" . $row['session'] . "</td>";
		  echo "<td>" . $row['course_code'] . "</td>";  
		  echo "<td>" . $str . "</td>";
		echo"</tr>";
	}
echo "</table>";
}
else{
	echo "0 results";
}
$conn->close();
?>
</body>
</html>
