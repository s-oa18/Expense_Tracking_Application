<?php
session_start();
include ('connection.php');


$expense_category = isset($_POST['category']) ? $_POST['category'] : "";
$amount = isset($_POST['amount']) ? $_POST['amount'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

// Check if any of the fields are empty and output which field is empty
if (empty($expense_category)) {
    echo "Expense category is required.";
} elseif (empty($amount)) {
    echo "Amount is required.";
} elseif (empty($comment)) {
    echo "Comment is required.";
} else {
    // All fields are filled, proceed with insertion using prepared statement
    $sql = "INSERT INTO expense (expense_category, amount, comment, user_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 'sssi', $expense_category, $amount, $comment, $userId);
    $result = mysqli_stmt_execute($stmt);

   
    if ($result) {
        
        header("Location: dashboard.php");
        exit; // It's important to exit after redirection
    } else {
        
        echo "Error inserting data: " . mysqli_error($db);
      
    }
}
?>
