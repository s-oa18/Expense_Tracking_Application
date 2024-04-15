<?php

include ('connection.php');
session_start();


$successMessage = "";
if (isset($_GET['success']) && $_GET['success'] == 'expense_updated') {
    $successMessage = '<div class="success-message">Expense updated successfully!</div>';
}

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;


$expenses = [];

if ($userId) {
    $sql = "SELECT expense_id, expense_category, amount, comment FROM expense WHERE user_id = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $expenses[] = $row;
    }
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
}
?>

<?php
include ('connection.php');
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$categoryTotals = [];

if ($userId) {
    $sql = "SELECT expense_category, SUM(amount) AS total_amount FROM expense WHERE user_id = ? GROUP BY expense_category";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryTotals[$row['expense_category']] = $row['total_amount'];
    }
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Expense Tracker</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dosis:wght@200..800&family=Nanum+Gothic+Coding&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<body>
    <div class="home">
        <div class="home_one">

            <img src="images/budget-logo 1.png" alt="">
            <div class="circle">

            </div>


            <p>Welcome,
                <?php echo $_SESSION['username']; ?>!
            </p>

            <div class="das">


                <div class="dash">
                    <img src="images/dashboard 1.png" alt="">
                    <p><a href="dashboard.php">Dashboard</a></p>

                </div>

                <div class="dash">

                    <img src="images/credit-card 1.png" alt="">
                    <p><a href="home.php">Add Expense</a></p>


                </div>
                <!-- <div class="dash">

                    <img src="images/expense 1.png" alt="">
                    <p>Expense</p>

                </div> -->
                <div class="dash">

                    <img src="images/logout 1.png" alt="">
                    <p><a href="logout.php">Logout</a></p>

                </div>

     <!-- 
                <div class="dash">

                    <img src="images/settings 1.png" alt="">
                    <p>settings</p>


                </div> -->



            </div>


        </div>
        <div class="home_two">
        <div class="expenses">
     <div class="shopping">
        
        <img src="images/shopping-cart 1.png" alt="Grocery">
        <!-- <h3>Grocery</h3> -->
        <span> <?php echo isset($categoryTotals['Grocery']) ? $categoryTotals['Grocery'] : '0'; ?>
        
    </span>
    </div>
    <div class="Electricity">
        <img src="images/plug 1.png" alt="">
        <span><?php echo isset($categoryTotals['Electricity']) ? $categoryTotals['Electricity'] : '0'; ?></span>
    </div>
    <div class="food">
        <img src="images/fork 1.png" alt="">
        <span><?php echo isset($categoryTotals['Food']) ? $categoryTotals['Food'] : '0'; ?></span>
    </div>
    <div class="fuel">
        <img src="images/fuel 1.png" alt="">
        <span><?php echo isset($categoryTotals['Fuel']) ? $categoryTotals['Fuel'] : '0'; ?></span>
        
    </div>
    <div class="others">
        <img src="images/menu 1.png" alt="">
        <span><?php echo isset($categoryTotals['Others']) ? $categoryTotals['Others'] : '0'; ?></span>
    </div>
</div>



            <div>
            <div class="expenses_list">
    <?php if (empty($expenses)): ?>
        <p>No expenses recorded.</p>
    <?php else: ?>
        <?php
        
        $categoryImages = [
            'Grocery' => 'images/shopping-cart 1.png',
            'Electricity' => 'images/plug 1.png',
            'Food' => 'images/fork 1.png',
            'Fuel' => 'images/fuel 1.png',
            'Others' => 'images/menu 1.png'
            
        ];
        

        foreach ($expenses as $expense): 
            $imageSrc = isset($categoryImages[$expense['expense_category']]) ? $categoryImages[$expense['expense_category']] : 'images/default.png'; 
        ?>
            <div class="expense_item">
                <img class="expense_category_image" src="<?php echo htmlspecialchars($imageSrc); ?>" alt="<?php echo htmlspecialchars($expense['expense_category']); ?>">
                <h3>Category: <?php echo htmlspecialchars($expense['expense_category']); ?></h3>
                <p>Amount: $<?php echo htmlspecialchars($expense['amount']); ?></p>
                <p>Comment: <?php echo htmlspecialchars($expense['comment']); ?></p>
                <form action="edit_expense.php" method="post">
                <input type="hidden" name="expense_id" value="<?php echo $expense['expense_id']; ?>">
                <button type="submit">Edit</button>
                
                </form>
                
            </div>
            
        <?php endforeach; ?>
    <?php endif; ?>
</div>
            </div>


        </div>

    
</body>

</html>
