<?php
// delete_user.php

session_start();
include("connection.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle form submission for deleting users
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_users"])) {
    if (!empty($_POST["selected_users"])) {
        $selectedUsers = $_POST["selected_users"];
        
        // Convert the array of selected user IDs to a comma-separated string
        $userIds = implode(",", $selectedUsers);
        
        // Execute SQL query to delete selected users
        $sql = "DELETE FROM users WHERE user_id IN ($userIds)";
        if (mysqli_query($db, $sql)) {
            $successMessage = "Selected users deleted successfully.";
        } else {
            $errorMessage = "Error deleting selected users: " . mysqli_error($db);
        }
    } else {
        $errorMessage = "Please select at least one user to delete.";
    }
}

// Retrieve list of user accounts from the database
$sqlUsers = "SELECT user_id, username, email FROM users";
$resultUsers = mysqli_query($db, $sqlUsers);

// Display the delete user form and list of user accounts
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User Accounts</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dosis:wght@200..800&family=Nanum+Gothic+Coding&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="delete" style="margin-left: 70px">

    <h1>Delete User Accounts</h1>

    <?php
    // Display success or error messages, if any
    if (isset($successMessage)) {
        echo "<div class='success-message'>$successMessage</div>";
    }
    if (isset($errorMessage)) {
        echo "<div class='error-message'>$errorMessage</div>";
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Select Users to Delete:</h2>
        <?php
        // Display list of user accounts with checkboxes for selection
        if (mysqli_num_rows($resultUsers) > 0) {
            while ($row = mysqli_fetch_assoc($resultUsers)) {
                echo "<input type='checkbox' name='selected_users[]' value='{$row['user_id']}' />";
                echo "<label>{$row['username']} ({$row['email']})</label><br>";
            }
        } else {
            echo "No user accounts found.";
        }
        ?>

        <br>
        <button type="submit" name="delete_users">Delete Selected Users</button>
    </form>
    <a href="admin_home.php">Back to Admin Home</a>



    </div>
    
</body>

</html>
