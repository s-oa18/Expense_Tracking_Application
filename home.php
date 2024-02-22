<?php
	session_start();					//retrieve or create session
	if (!IsSet($_SESSION["user"]))		//user name must in session to stay here
		header("Location: login.php");	//if not, go back to login page
	$username=$_SESSION["user"];		//get user name into variable $username
?>
<!doctype html>
<html>
	<head>
		<title>User Home</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/CSS/style.css">
	</head>
	<body>
		<section class="welcome">

		  <h1>Welcome back, <?php print $username; ?>!</h1>
		     <br>
		  <p class="small_text">
			
			<h4>This is your home page.</h4>
			
		 </p>
		

	

	     <form method="get" action="logout.php" class="logout"><br>
			<button type="submit" class="logout_button">Logout</button>
		 </form>
	   </section>
		
	</body>
</html>
