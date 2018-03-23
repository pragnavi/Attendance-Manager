<?php
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			if (isset($_POST['register-submit'])) 
			     {
		    		$username = $_POST["username"];
		    		$email = $_POST["email"];
		    		$password = $_POST["password"];
				$cpassword = $_POST["cpassword"];
		    		//checking name
		    	/*1*/	if (empty($username)) {
				    $message2 = "Name is required";
				    $fErr = "Yes"; 
				}
				else {
				    // check if name has only letters and whitespace
				    	if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
				      		$message2 = "Name must have Only letters and white space ";
				      		$fErr = "Yes"; 
				      }
				}
				//checking the email 
			/*2*/	if (empty($email)) {
				    $message2 = "Email is required";
				    $fErr = "Yes";
				     }
				else {
				    // check if e-mail address is well-formed
				    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				      $message2 = "Invalid email format";
				      $fErr = "Yes"; 
					}
				     }
		//checking password
			/*3*/	if (empty($password)) {
				    $message2 = "password is required";
				    $fErr = "Yes";
				   } 
				else {
				    // check if password has 1-Lowercase, 1-Uppercase,1-Symbol and a length of 8 to 12
				    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#_$%]{8,12}$/',$password)){
				      $message2 = "Password of min. 8-20 characters and with at least one lowercase char, one uppercase 					                                        char,one digit, one special sign of @#_$% is accepted.";
				      $fErr = "Yes"; 
					}
				   }

			/*4*/	if (empty($cpassword)) {
				    $message2 = "password cannot be empty";
				    $fErr = "Yes";
				   } 
				else {
				    // check if password has 1-Lowercase, 1-Uppercase,1-Symbol and a length of 8 to 12
				    if(!($cpassword===$password)){
				      $message2 = "please enter same passwords";
				      $fErr = "Yes"; 
					}
				   }


	          	   /*5*/      if($fErr!="Yes")
				      {
					include "data.php";
					$check="SELECT * FROM teacher WHERE username ='$username'";
					$result = $conn->query($check);
					//checking if the username is already there in database.
                  				if ($result->num_rows > 0) {
                  					$message2 = "username already exists";
                  					$conn->close();
				    		}
					//for inserting the new user's details into database.
						else{
				       	$sql ="INSERT INTO `teacher`(`username`,`password`,`email`) VALUES ('$username','$password','$email')";
				    			if ($conn->query($sql) === TRUE) {
						 	   $message2="Account created successfully, Please Login ";
						    	 } 
							else {
						   	   $message2="Error: " . $sql . " " . $conn->error;
						     	 }
							$conn->close();
				            	    }
				      }
				
        		   } 
		    
		}
?>

<!DOCTYPE html>
<html lang=en>
<head>
  <meta charset="UTF-8">
  <title>Form</title>
  
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600' />
  <link href="a_home.css" rel="stylesheet" type="text/css" media="screen" />
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>

<body>
	<div class="topnav">
			
				<a href="a_index.php" class="current_page_item" style="float:right">SignIn</a>
			 	<a href="a_register.php" class="current_page_item" style="float:right">SignUp</a>
  				<a style="float:right" class="current_page_item" href="a_home.html">Home</a>
			
	</div> 
  <form id="login-form" action=" " method="post" role="form" style="display:block">
  <div class="login-wrap">
	<div class="login-html">
 	<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Sign Up</label> 
		<div class="login-form">
		<div class="sign-up-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="username" name="username" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="password" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="cpassword" name="cpassword" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input id="email" name="email" type="email" class="input">
					</div>
					<div class="group">
						<input type="submit" name="register-submit" id="register-submit" class="button" value="SignUp">
					</div>
					<div id="form-groupmsg">
						<label for="remember"><?php echo $message2;?></label>
					</div>
					
		  </div>
		</div>
		</div>
	</div>
  
</form>

</body>

</html>




