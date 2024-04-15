<?php
    include("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $checkResult = mysqli_query($db, $checkEmailQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "Email already exists.";
        } else {
            // Insert the new user into the database
            $insertQuery = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
            if (mysqli_query($db, $insertQuery)) {
                // Redirect with success message
                header("Location: admin_home.php?success=user_added");
                exit();
            } else {
                echo "Error: " . $insertQuery . "<br>" . mysqli_error($db);
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker home</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dosis:wght@200..800&family=Nanum+Gothic+Coding&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <div class="home">
    <div>
    <h2>Add User</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Add User</button>
    </form>
</div>

    </div>
</body>

</html>


















