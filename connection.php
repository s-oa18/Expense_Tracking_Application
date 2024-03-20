<?php
$servername = "localhost";
$dbname='expense_tracker';
$username = "root";
$password = "root";
// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
 die("Connection failed: " . $db->connect_error);
}
echo "";
?>