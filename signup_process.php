<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_POST["username"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);



$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "expense_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];



$sql = "INSERT INTO users (username, email, password ) VALUES ('$username','$email','$password') ";

if ($conn->query($sql) === TRUE) {
    header("Location: signup-success.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>





