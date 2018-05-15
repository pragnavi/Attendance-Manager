<?php
session_start();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{//1
			if (isset($_POST['login-submit2'])) 
		  	{//2
			$cname = $_POST["cname"];
		    	$section = $_POST["section"];
			$batch = $_POST["batch"];
			$sem = $_POST["sem"];
			$session = $_POST["session"];
			//$username = $_SESSION['username'];
			if (empty($cname)||empty($section)||empty($batch)||empty($sem) || empty($session))
			{//3
				$message = "Enter all credentials";
				$fErr ="Yes";
			}//3
			else if(!(preg_match("/^[A-Za-z0-9]+$/",$cname)))
			{//4
				$message = "Enter correct credentials";
				$fErr = "Yes";			
			}//4
			

			if($fErr != "Yes")
			{//5
				include "data.php";
					$sql = "SELECT * FROM `details` WHERE course_code='$cname' AND semester='$sem' AND batch='$batch' AND section='$section' AND session='$session'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0 && !($err)) {//6
						 	   header("Location: report1.php");
$_SESSION['semester']=$sem;
$_SESSION['batch']=$batch;
$_SESSION['section']=$section;
$_SESSION['session']=$session;
$_SESSION['course_code']=$cname;
							}//6		
							else {//9
						   	   $message="No record found for the details requested";
						     	 }//9
							$conn->close();
				    		
						
				      
				            	   
			}//5
		}//2
	}//1
?>

<!DOCTYPE html>
<html>
<head>


<div class="topnav">
               <a href="home.php" class="current_page_item" style="float:right">Logout</a>
                <a href="registration1.php" class="active" style="float:right">View Attendance</a>
                 <a href="registration.php" class="current_page_item" style="float:right">Mark Attendance</a>
                  <a style="float:right" class="current_page_item" href="addcourse.php">Add Course</a>
          
</div>





<title>Registration Form Using jQuery - Demo Preview</title>
<meta name="robots" content="noindex, nofollow">
<!-- Include CSS File Here -->
<link rel="stylesheet" href="css/style1.css"/>
<!-- Include JS File Here -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/registration.js"></script>
</head>
<body>
<div class="container">
<div class="main">
<form class="form" name="login-submit2" method="post" action="#">

<label>Semester :
<br>
<select name="sem" style="width:325px">
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
<select name="batch" style="width:325px">
<option value=" ">SELECT</option>
<option value="cse">CSE</option>
<option value="ece">ECE</option>
<option value="eee">EEE</option>
<option value="me">ME</option>
</select></br>
</br>

<label>Section :
<br>
<select name="section" style="width:325px">
<option value=" ">SELECT</option>
<option value="a">A</option>
<option value="b">B</option>
<option value="c">C</option>
<option value="d">D</option>
</select></br>
</br>


<label>Session :
<br>
<select name="session" style="width:325px">
<option value=" ">SELECT</option>
<option value="theory">Theory</option>
<option value="lab">Lab</option>
</select></br>
</br>
<!-- <label>Faculty :
<input type="text" name="fname" id="name" placeholder="name"><br></label> -->
<label>Course Code :
<input type="text" name="cname" id="cname" placeholder="eg:15CSE313"><br></label>
<input type="submit" name="login-submit2" id="login-submit2" class="button" value="View Report">
<div id="form-groupmsg">
<label for="remember"><?php echo $message;?></label>
</div>
</form>
</div>
</body>
</html>
