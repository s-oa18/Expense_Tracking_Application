<?php
$servername = "localhost";
$dbname='expense_tracker';
$username = "root";
$password = "";


    try {
        $conn = new PDO("mysql: host= $servername; $dbname = $expense_tracker ", $username, $password );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "success";
    }catch(PDOException $e){
        echo "Failed: ". $e->getMessage();
    }
?>
