<?php
// Include the database connection file
include('connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['expense_id']) && !empty($_POST['expense_category']) && !empty($_POST['amount']) && !empty($_POST['comment'])) {
        // Prepare and bind the parameters
        $stmt = $db->prepare("UPDATE expense SET expense_category=?, amount=?, comment=? WHERE expense_id=?");
        $stmt->bind_param("sssi", $expense_category, $amount, $comment, $expense_id);

        // Set parameters and execute
        $expense_category = $_POST['expense_category'];
        $amount = $_POST['amount'];
        $comment = $_POST['comment'];
        $expense_id = $_POST['expense_id'];

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the dashboard with success message
            header("Location: dashboard.php?success=expense_updated");
            exit;
        } else {
            // Redirect back to the dashboard with error message
            header("Location: dashboard.php?error=update_failed");
            exit;
        }
    } else {
        // Redirect back to the dashboard with error message if any field is empty
        header("Location: dashboard.php?error=all_fields_required");
        exit;
    }
} else {
    // If the form wasn't submitted via POST method, redirect back to the dashboard
    header("Location: dashboard.php");
    exit;
}
?>
