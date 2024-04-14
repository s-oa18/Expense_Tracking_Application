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
            
            <img class="img_login" src="images/login 1.png" alt="">
        </div>
        <div class="con_two">
            <h1>Sign in Account</h1>

            <form  action="admin_login.php" >
                
                    <input type="email" name= "email" placeholder ="Email"   id="email" >
                    <input type="password" name= "password" placeholder = "Password"  id="password">
                    <button>Login</button>
            </form>

           
            
           
        </div>

    </div>
</body>
</html>
