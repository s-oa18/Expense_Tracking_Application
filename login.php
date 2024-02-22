<?php
session_start();	//create or retrieve session

if (IsSet($_SESSION["user"]))			//if username exists in session, user has logged in
	{
	header("Location: home.php");		//forward to use home page
	exit();
	}
?>
<!--
	Otherwise show login page/form.
-->
<!doctype html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="assets/CSS/style.css">
		
	</head>
	<body>
		<section class="form">	
			<h3>Log into account</h3>
			<!--
				This form submits the username and password to the script validate.php.
			-->
			<form id="login" method="post" action="validate.php">
				Username: <input type="text" name="user"> <br/>
				Password: <input type="password" name="password"> <br/>
				<button type="submit" class="login_button">Login</button>
			</form>
		</section>
	</body>
</html>
