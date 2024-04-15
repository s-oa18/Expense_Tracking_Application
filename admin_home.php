<?php
    
    include("connection.php");

    session_start();
  
    if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit;
    }

   
    $successMessage = "";
    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        if ($success === 'user_added') {
            $successMessage = "User added successfully!";
        }
       
    }


    // SQL queries to get the number of users, total number of expenses, and expenses by category
    $sqlUsers = "SELECT COUNT(*) AS user_count FROM users";
    $sqlTotalExpenses = "SELECT COUNT(*) AS total_expenses FROM expense";
    $sqlExpensesByCategory = "SELECT expense_category, COUNT(*) AS category_count FROM expense GROUP BY expense_category";
    
    // Execute the queries
    $resultUsers = mysqli_query($db, $sqlUsers);
    $resultTotalExpenses = mysqli_query($db, $sqlTotalExpenses);
    $resultExpensesByCategory = mysqli_query($db, $sqlExpensesByCategory);

    // Initialize variables to store counts
    $userCount = $totalExpensesCount = 0;
    $categoryCounts = array();

    // Fetch the results and store counts
    if ($resultUsers) {
        $row = mysqli_fetch_assoc($resultUsers);
        $userCount = $row['user_count'];
    }
    if ($resultTotalExpenses) {
        $row = mysqli_fetch_assoc($resultTotalExpenses);
        $totalExpensesCount = $row['total_expenses'];
    }
    if ($resultExpensesByCategory) {
        while ($row = mysqli_fetch_assoc($resultExpensesByCategory)) {
            $categoryCounts[$row['expense_category']] = $row['category_count'];
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
        <div class="home_one">
            <img src="images/budget-logo 1.png" alt="">
            <div class="circle"></div>
            <p class="welcome_name">Welcome Admin</p>
            <div class="das">
                <div class="dash">
                    <img src="images/dashboard 1.png" alt="">
                    <p><a href="add_users.php">Add Users</a></p>
                </div>
                <div class="dash">
                    <img src="images/credit-card 1.png" alt="">
                    <p><a href="deactivate.php">Deactivate Account</a></p>
                </div>
                <div class="dash">
                    <img src="images/expense 1.png" alt="">
                    <p><a href="delete.php">Delete Account</a></p>
                </div>
                <div class="dash">
                    <img src="images/logout 1.png" alt="">
                    <p><a href="logout.php">Logout</a></p>
                </div>
            </div>
        </div>
        <div class="home-two">
            <div>
                <h2>Summary</h2>
                <p>Total Users: <?php echo $userCount; ?></p>
                <p>Total Expenses: <?php echo $totalExpensesCount; ?></p>
            </div>
            <div>
                <h2>Expenses by Category</h2>
                <ul>
                    <?php foreach ($categoryCounts as $category => $count): ?>
                        <li><?php echo $category . ': ' . $count; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
