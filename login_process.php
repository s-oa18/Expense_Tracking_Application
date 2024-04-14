
<?php
    session_start();
    include("connection.php");

    if(empty($_POST["email"]) || empty($_POST["password"])) {
        echo "Both fields are required.";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT id, username FROM users WHERE email='$email' and password='$password'";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username']; // Save username in session
            $_SESSION['userId'] = $row['id']; // Save user id in session
            header("location: home.php");
        } else {
            echo "Incorrect username or password";
        }
    }
?>

