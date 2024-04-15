<?php
    include("connection.php");
    session_start();

    // Check if the user is logged in and is an admin
    if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit;
    }

    // Check if a success message exists in the URL parameters
    $successMessage = "";
    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        if ($success === 'user_deactivated') {
            $successMessage = "User deactivated successfully!";
        }
        // You can add more success message cases for other actions if needed
    }

    // Query to retrieve a list of users
    $sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);

    // Initialize an array to store user data
    $users = array();

    // Fetch the results and store user data in the array
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deactivate User Accounts</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dosis:wght@200..800&family=Nanum+Gothic+Coding&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="container">
        <h2>Deactivate User Accounts</h2>
        <!-- Display the success message if it exists -->
        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <!-- Display the list of users -->
        <?php if (!empty($users)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <!-- Form to deactivate user account -->
                                <form action="deactivate_user.php" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit">Deactivate</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
        <a href="admin_home.php">Back to Admin Home</a>
    </div>
</body>

</html>
