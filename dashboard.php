<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Expense Tracker</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="home">
    <div class="home_one">
            <img src="images/budget-logo 1.png" alt=""> 
            <div class="circle">
            
            </div>

          
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

            <div class="das">


                <div class="dash">
                    <img src="images/dashboard 1.png" alt="">
                    <p><a href="dashboard.php">Dashboard</a></p>

                </div>

                <div class="dash">

                    <img src="images/credit-card 1.png" alt="">
                    <p><a href="home.php">Add Expense</a></p>
                    

                </div>
                <div class="dash">

                    <img src="images/expense 1.png" alt="">
                    <p>Expense</p>

                </div>
                <div class="dash">

                    <img src="images/logout 1.png" alt="">
                    <p><a href="logout.php">Logout</a></p>

                </div>


                <!-- <div class="dash">

                    <img src="images/settings 1.png" alt="">
                    <p>settings</p>


                </div> -->



            </div>

            
        </div>
        <div>
            <div class="dashboard">

                <div class="expenselogo1">
                    <img src="images/income expense 1.png" alt="">
                    <div>
                        <p>Income</p>
                        
                    </div>
                </div>
                <div class="expenselogo2">
                    <img src="images/expense 1.png" alt="">
                    <div>
                        <p>Income</p>
                        
                    </div>
                </div>
                <div class="expenselogo3">
                    <img src="images/money-bag 1.png" alt="">
                    <div>
                        <p>Income</p>
                        
                    </div>
                </div>
                
            </div>

            <div class="expenses">
                <div class="shopping">
                    <img src="images/shopping-cart 1.png" alt="">
                    <div>
                        
                        
                    </div>
                </div>
                <div class="Electricity">
                    <img src="images/plug 1.png" alt="">
                    <div>
                        
                        
                    </div>
                </div>
                <div class="food">
                    <img src="images/fork 1.png" alt="">
                    <div>
                        
                        
                    </div>
                
            </div>
            <div class="fuel">
                <img src="images/fuel 1.png" alt="">

            </div>
            
            <div class="others">
                <img src="images/menu 1.png" alt="">
            </div>
            
        </div>
       
        
    </div> 
</body>
</html>