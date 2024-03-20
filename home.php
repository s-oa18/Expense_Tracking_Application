<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- <h2>Welcome !</h2> -->
    <div class="home">
        <div class="home_one">
            <img src="images/budget-logo 1.png" alt=""> 
            <div class="circle">
            
            </div>

          
            <p class="welcome_name">Welcome, <?php echo $_SESSION['username']; ?>!</p>

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
        <div class="home_two">

            <h3 class="add_expense">Add Expense</h3>

            <div class="dropdown">
                <h3>Income Category</h3>
                
            </div>

           
                <!-- <select name="content" id="dropdown">
                    
                </select> -->
                <form method = "post" action="add_expense.php" >
                    <select class=""  id="dropdown">
                        <!-- <option value="">Select Category</option> -->
                    <option value="Groccery">Groccery</option>
                    <option value="Electricity">Electricity</option>
                    <option value="Food">Food</option>
                    <option value="Fuel">Fuel</option>
                    <option value="Others">Others</option>
    
                    </select>
                <input type="text" name= "expense_category" placeholder="Expense name" id="expense-name" readonly>
                <!-- <input type="date" placeholder="Date" id="date"> -->
                <input type="number" name= "amount" placeholder="Amount" id="expense-name">
                <input type="text" name= "comment" placeholder="Add comment..." id="expense-name" >
                <!-- <textarea id="commentSection" placeholder="Leave your comment here"></textarea> -->
                <button>Add</button>
            </form>



              </div>

            
        </div>
    </div>

    <script>
    document.getElementById('dropdown').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex].text;
        document.getElementById("expense-name").value = selectedOption;
    });
</script>
</body>
</html>


<!-- html
<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <style>
    /* CSS styles */
    .container {
      text-align: center;
      margin-top: 50px;
    }
    h1 {
      font-size: 24px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome, <span id="username"></span>!</h1>
  </div>
  
  <script>
    // JavaScript code
    var username = prompt("Please enter your username:");
    document.getElementById("username").innerHTML = username;
  </script>
</body>
</html> -->