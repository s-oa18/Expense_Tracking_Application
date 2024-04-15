<?php
session_start();
include("connection.php");

if (empty($_POST["email"]) || empty($_POST["password"])) {
    echo "Both fields are required.";
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Fetch user details including role and status
    $sql = "SELECT user_id, username, password, role, status FROM users WHERE email=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verify the password
        if ($password === $row['password']) { // 
            // Check if the account is active
            if ($row['status'] === 'active') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username']; 
                $_SESSION['userId'] = $row['user_id']; 
                $_SESSION['role'] = $row['role']; 
                
                // Check user role
                if ($row['role'] === 'admin') {
                    header("location: admin_home.php"); 
                } else {
                    header("location: home.php"); // 
                }
            } else {
                // Account is deactivated
                echo "Account is deactivated. Please contact support for assistance.";
            }
        } else {
            // Incorrect password
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }
}
?>
