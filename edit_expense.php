<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if expense_id is set and not empty
    if (isset($_POST["expense_id"]) && !empty($_POST["expense_id"])) {
        $expense_id = $_POST["expense_id"];
        
        // Retrieve expense details from the database
        $sql = "SELECT * FROM expense WHERE expense_id = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $expense_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Populate variables with existing expense details
            $expense_category = $row["expense_category"];
            $amount = $row["amount"];
            $comment = $row["comment"];
            
            // Render form with pre-filled values for editing
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Expense</title>
                <link rel="stylesheet" href="css/home.css">
                <!-- Add any additional styling or scripts as needed -->
            </head>
            <body>
                <div class="edit_expense_form">
                    <h2>Edit Expense</h2>
                    <form action="update_expense.php" method="post">
                        <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>">
                        <label for="category">Category:</label>
                        <input type="text" name="expense_category" id="category" value="<?php echo $expense_category; ?>" required><br><br>
                        <label for="amount">Amount:</label>
                        <input type="number" name="amount" id="amount" value="<?php echo $amount; ?>" required><br><br>
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" rows="4" required><?php echo $comment; ?></textarea><br><br>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Expense not found.";
        }
    } else {
        echo "Expense ID is missing.";
    }
} else {
    echo "Invalid request.";
}
?>
