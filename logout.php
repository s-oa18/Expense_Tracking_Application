<?php
	session_start();				//retrieve session
	session_destroy();				//then destroy it
	header("Location: signup.html");	//redirect to login page
	exit;
?>
