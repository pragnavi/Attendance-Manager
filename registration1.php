<?php
	if(isset($_SESSION)){
		header("Location: registration1.php");		
	}
	else
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			if (isset($_POST['login-submit'])) 
		  	{
			$dname = $_POST["dname"];
		    	$section = $_POST["section"];
			$batch = $_POST["batch"];
			$period = $_POST["period"];
			$session = $_POST["session"];
			
			$cname = $_POST["cname"];
			$sem = $_POST["sem"];	
			if (empty($dname)||empty($section)||empty($batch)||empty($period)||empty($session)||empty($cname) || empty($sem))
			{
				$message = "Enter all credentials";
				$fErr ="Yes";
			}
			else
			{
				include "data.php";
					$sql = "SELECT * FROM details WHERE  AND password='$password'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1 ) 
						{
						$row = $result->fetch_assoc();
						$_SESSION['dname']=$row["dname"];
						$_SESSION['section']=$row["section"];
						$_SESSION['batch']=$row["batch"];
						$_SESSION['period']=$row["period"];
						$_SESSION['session']=$row["session"];
						
						$_SESSION['cname']=$row["cname"];						
						header("Location: ");
						exit();
						
					    }
					else{
						
						$message = "Invalid credentials";
					    }
			}
		}
	}
}



?>
<!DOCTYPE html>
<html>
<head>


<div class="topnav">
               <a href="a_register.php" class="current_page_item" style="float:right">Logout</a>
                <a href="registration1.php" class="active" style="float:right">View Attendance</a>
                 <a href="registration.php" class="current_page_item" style="float:right">Mark Attendance</a>
                  <a style="float:right" class="current_page_item" href="addcourse.php">Add Course</a>
          
</div>





<title>Registration Form Using jQuery - Demo Preview</title>
<meta name="robots" content="noindex, nofollow">
<!-- Include CSS File Here -->
<link rel="stylesheet" href="style1.css"/>
<!-- Include JS File Here -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/registration.js"></script>
</head>
<body>
<div class="container">
<div class="main">
<form class="form" method="post" action="#">

<label>Semester :
<br>
<select  style="width:325px">
<option value=" ">SELECT</option>
<option value="s1">S1</option>
<option value="s2">S2</option>
<option value="s3">S3</option>
<option value="s4">S4</option>
<option value="s5">S5</option>
<option value="s6">S6</option>
<option value="s7">S7</option>
<option value="s8">S8</option>
</select></br>
</br>
<label>Batch :
<br>
<select  style="width:325px">
<option value=" ">SELECT</option>
<option value="cse">CSE</option>
<option value="ece">ECE</option>
<option value="eee">EEE</option>
<option value="me">ME</option>
</select></br>
</br>

<label>Section :
<br>
<select  style="width:325px">
<option value=" ">SELECT</option>
<option value="a">A</option>
<option value="b">B</option>
<option value="c">C</option>
<option value="d">D</option>
</select></br>
</br>


<label>Session :
<br>
<select style="width:325px">
<option value=" ">SELECT</option>
<option value="theory">Theory</option>
<option value="lab">Lab</option>
</select></br>
</br>
<!-- <label>Faculty :
<input type="text" name="fname" id="name" placeholder="name"><br></label> -->
<label>Course Code :
<input type="text" name="cname" id="cid" placeholder="eg:15CSE313"><br></label>
<input type="button" name="submit" id="submit" value="Get List">
</form>
</div>
</body>
</html>
