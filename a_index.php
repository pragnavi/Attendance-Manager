<?php
	
	if (isset($_SESSION))
		/*1*/{
		header("Location: a_login.html");		
		/*1*/}
	
	else{/*2*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{/*3*/
		  //for login using username and password
		 	 if (isset($_POST['login-submit'])) 
		    	   {/*4*/
		    		$username = $_POST["username"];
		    		$password = $_POST["password"];
		    		if (empty($username))
				{/*5*/
				    $message1 = "Username is required";
				}/*5*/
				elseif (empty($password))
				{/*6*/
				    $message1 = "Password is required";
				}/*6*/
				else
				{/*7*/
					include "data.php";
					$sql = "SELECT * FROM teacher WHERE username='$username' AND password='$password'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1 ) {/*8*/
						$row = $result->fetch_assoc();
						$_SESSION['username']=$row["username"];
						$_SESSION['password']=$row["password"];
						header("Location: a_login.html");
						exit();
						}/*8*/
					else{/*9*/
						
						$message1 = "Invalid Username or Password";
					    }/*9*/
					
			     	  }/*7*/
		            }/*4*/
		     	
		}/*3*/
	}/*2*/
?>

<!DOCTYPE html>
<html lang=en>
<head>
  <meta charset="UTF-8">
  <title>Form</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600' />
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <link href="a_home.css" rel="stylesheet" type="text/css" media="screen" />
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
 	<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Sign In</label> 
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
						<input id="check" type="checkbox" class="check" checked>
						<label for="check"><span class="icon"></span> Keep me Signed in</label>
					</div>
					
					<div class="group">
						<input type="submit" name="login-submit" id="login-submit" class="button" value="Sign In">
					</div>
					<div id="form-groupmsg">
						<label for="remember"><?php echo $message1;?></label>
		                	</div>
				
				</div>
  				
			</div>
		</div>
	</div>
  
</form>

</body> 


</html>
