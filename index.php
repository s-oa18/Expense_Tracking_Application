<?php
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("location: home.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


    
        
    <div class="container">
        <div class="con_one">
            <img src="images/budget-logo 1.png" alt="">
            <!-- <img class="img_ellipse" src="images/Ellipse 1.png" alt=""> -->
            <img class="img_login" src="images/login 1.png" alt="">
        </div>
        <div class="con_two">
            <h1>Sign in Account</h1>

            <form method="post" action="login_process.php" >
                <!-- <label for="">name</label> -->
                    <input type="email" name= "email" placeholder ="Email"   id="email" >
                    <input type="password" name= "password" placeholder = "Password"  id="password">
                    <div>
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                    <button>Login</button>
            </form>

            <div class="new_user">
                <p class="new"> New User?</p>
                <p><a class="register" href="signup.html">Register</a></p>
               
                
            </div>
            
           
        </div>

    </div>
</body>
</html>
