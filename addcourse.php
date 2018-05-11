<?php
session_start();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{//1
			if (isset($_POST['login-submit1'])) 
		  	{//2
			$fname = $_POST["fname"];
			$cname = $_POST["cname"];
		    	$section = $_POST["section"];
			$batch = $_POST["batch"];
			$sem = $_POST["sem"];
			$username = $_SESSION['username'];
			if (empty($fname)||empty($section)||empty($batch)||empty($cname) || empty($sem))
			{//3
				$message = "Enter all credentials";
				$fErr ="Yes";
			}//3
			else if(!(preg_match("/^[a-zA-Z]*$/",$fname)) || !(preg_match("/^[A-Za-z0-9]+$/",$cname)))
			{//4
				$message = "Enter correct credentials";
				$fErr = "Yes";			
			}//4
			

			if($fErr != "Yes")
			{//5
				include "data.php";
					$sql = "SELECT * FROM `Course` WHERE course_code='$cname' AND semester='$sem' AND batch='$batch' AND section='$section'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {//6
                  					$message = "Course already exists";
                  					$conn->close();
				    		}//6
					//for inserting the new course's details into database.
						else{//7
				       	$sql ="INSERT INTO `Course`(`course_name`, `course_code`, `semester`, `batch`, `section`, `username`) VALUES ('$fname','$cname','$sem','$batch','$section','$username')";
				    			if ($conn->query($sql) === TRUE) {//8
						 	   $message="Course added successfully";
						    	 } //8
							else {//9
						   	   $message="Error: " . $sql . " " . $conn->error;
						     	 }//9
							$conn->close();
				            	    }//7
			}//5
		}//2
	}//1
?>

<!DOCTYPE html>
<html>
<head>


<div class="topnav">
               <a href="a_register.php" class="current_page_item" style="float:right">Logout</a>
                <a href="registration1.php" class="current_page_item" style="float:right">View Attendance</a>
                 <a href="registration.php" class="current_page_item" style="float:right">Mark Attendance</a>
                  <a style="float:right" class="active" href="addcourse.php">Add Course</a>
          
</div>





<title></title>
<meta name="robots" content="noindex, nofollow">
<!-- Include CSS File Here -->
<link rel="stylesheet" href="css/style1.css"/>
<!-- Include JS File Here -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/registration.js"></script> -->
</head>
<body>
<div class="container">
<div class="main">
<form id="login-submit1" class="form" method="post" action="#">



<label>Course Name :
<input type="text" name="fname" id="fname" placeholder="name"><br></label>
<label>Course Code :
<input type="text" name="cname" id="cname" placeholder="eg:15CSE313"><br></label>
<label>Semester :
<br>
<select  name="sem" style="width:325px">
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
<select  name="section" style="width:325px">
<option value=" ">SELECT</option>
<option value="a">A</option>
<option value="b">B</option>
<option value="c">C</option>
<option value="d">D</option>
</select></br>
</br>
<div class="grp">
<input type="submit" name="login-submit1" id="login-submit1" class="button" value="Add">
</div>
<div id="form-groupmsg">
<label for="remember"><?php echo $message;?></label>
</div>
</form>
</div>
</body>
</html>
