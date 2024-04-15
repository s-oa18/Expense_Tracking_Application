<?php

include("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
    // Sanitize the user ID to prevent SQL injection
    $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);

    // Update the user's status to deactivated
    $sql = "UPDATE users SET status = 'deactivated' WHERE user_id = $user_id";

    if (mysqli_query($db, $sql)) {
        
        header("Location: admin_home.php?success=user_deactivated");
        exit;
    } else {
        
        header("Location: admin_home.php?error=deactivation_failed");
        exit;
    }
} else {
    
    header("Location: admin_home.php");
    exit;
}
?>
