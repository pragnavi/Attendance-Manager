<?php
session_start();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{//1
			if (isset($_POST['login-submit'])) 
		  	{//2
			$date = $_POST["date"];
			$cname = $_POST["cname"];
		    	$section = $_POST["section"];
			$batch = $_POST["batch"];
			$sem = $_POST["sem"];
			$session = $_POST["session"];
			$period = $_POST["period"];
			$username = $_SESSION['username'];
			if(empty($username))
            {
                echo "You need to SignIn </br><a href=a_index.php>SignIn</a>";

                    
            }
            else{
                echo     "Welcome ".$username."!!!";
            }


			if (empty($date)|| empty($cname)||empty($section)||empty($batch)||empty($sem) || empty($session)|| empty($period))
			{//3
				$message = "Enter all credentials";
				$fErr ="Yes";
			}//3
			else if(!(preg_match("/^[0-9]+$/",$period)) || !(preg_match("/^[A-Za-z0-9]+$/",$cname)))
			{//4
				$message = "Enter correct credentials";
				$fErr = "Yes";			
			}//4
			
			if($fErr != "Yes")
			{//5
				include "data.php";
					
					$sql = "SELECT * FROM `details` WHERE course_code='$cname' AND date='$date' AND semester='$sem' AND batch='$batch' AND section='$section' AND period='$period' AND session='$session'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {//6
                  					$message = "Attendance already added";
                  					$conn->close();
							$err = "Yes";
				    		}//6
					//for adding attendance details into database.
					$sql2 = "SELECT Roll_no FROM `Student` WHERE course_code='$cname' AND semester='$sem' AND batch='$batch' AND section='$section' ";
					$result2 = $conn->query($sql2);
					//while($row = $result2->fetch_assoc()){
					//	ehco $row[Roll_no];					
					//}
					$sql1 = "SELECT * FROM `Course` WHERE course_code='$cname' AND semester='$sem' AND batch='$batch' AND section='$section' AND username='$username' ";
					
					$result1 = $conn->query($sql1);
					if ($result1->num_rows > 0 && !($err)) {//6
						//$count=65;
						
						//$values = array();
						$i=0;
						$k=0;
						
					
							while ($row = $result2->fetch_assoc()){
								$sql3 ="INSERT INTO `details`(`date`, `semester`, `batch`, `section`, `period`, `session`, `course_code`, `Roll_no`, `attendance`) VALUES ('$date','$sem','$batch','$section','$period','$session','$cname','$row[Roll_no]', 'P')"; 
								$result3 = $conn->query($sql3);
								$i++;
							}
							//$sql3 .= join(',', $values);
							$sql5 = "SELECT Roll_no FROM `Student` WHERE course_code='$cname' AND semester='$sem' AND batch='$batch' AND section='$section' ";
						$result5 = $conn->query($sql5);
							while ($row = $result5->fetch_assoc()){
								$k++;
							}
				    			if ($k === $i) {//8
							
						 	   $message="Details added successfully";
header("Location: bubbles1.php");
$_SESSION['semester']=$sem;
$_SESSION['batch']=$batch;
$_SESSION['section']=$section;
$_SESSION['course_code']=$cname;
						    	 } //8
							else {//9
						   	   $message="Error: " . $sql . " " . $conn->error;
						     	 }//9
							$conn->close();
				    		}//6
						
				      
				            	   
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
                 <a href="registration.php" class="active" style="float:right">Mark Attendance</a>
                  <a style="float:right" class="current_page_item" href="addcourse.php">Add Course</a>
          
</div>





<title>Registration Form Using jQuery - Demo Preview</title>
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
<form name='login-submit' class="form" method="post" action="#">

<label>Date :
<input type="date" name="date" placeholder="dd/mm/yyyy"><br></label>
<label>Semester :
<?php
//session start();
include "data.php";
$username = $_SESSION['username'];
	$sql21 = "SELECT DISTINCT semester FROM `Course` WHERE username='$username'";
	$result21 =  $conn->query($sql21);
	echo '<select name="sem" style="width:325px">';
	while($row21 = $result21->fetch_assoc()){
		echo '<option value="'.$row21['semester'].'">'.$row21["semester"].'</option>';
	}
	echo '</select>';
?>
<!--<br>
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
</select>--></br>
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

<label>Period :
<input type="text" name="period" id="period" placeholder="hour"><br></label>
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
<input type="text" name="cname" id="cname" placeholder="eg:cse313"><br></label>
<input type="submit" name="login-submit" id="login-submit" class="button" value="Get List">
<div id="form-groupmsg">
<label for="remember"><?php echo $message;?></label>
</div>
</form>
</div>
</body>
</html>
