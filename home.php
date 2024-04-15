<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    
    exit;
}

// Set the userId session variable
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $expense_category = isset($_POST['category']) ? $_POST['category'] : "";
    $amount = isset($_POST['amount']) ? $_POST['amount'] : "";
    $comment = isset($_POST['comment']) ? $_POST['comment'] : "";

    // Check if any of the fields are empty
    if (empty($expense_category) || empty($amount) || empty($comment)) {
        echo "All fields are required.";
    } else {
        // Insert the expense into the database
        include('connection.php');

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
            exit;
        } else {
            echo "Error inserting data: " . mysqli_error($db);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker home</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dosis:wght@200..800&family=Nanum+Gothic+Coding&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    </link>
</head>

<body>
    <div class="home">
        <div class="home_one">
            <img src="images/budget-logo 1.png" alt="">
            <div class="circle">

            </div>


            <p class="welcome_name">Welcome,
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
                <div class="dash">

                    <img src="images/expense 1.png" alt="">
                    <p>Expense</p>

                </div>
                <div class="dash">

                    <img src="images/logout 1.png" alt="">
                    <p><a href="logout.php">Logout</a></p>
                </div>
            </div>


        </div>
        <div class="home_two">
            <h3 class="add_expense">Add Expense</h3>
            <?php
            $expense_category = isset($_POST['category']) ?  $_POST['category'] : "";
            $amount = isset($_POST['amount']) ? $_POST['amount'] : "";
            $comment = isset($_POST['comment']) ? $_POST['comment'] : "";
            $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
            
            // Echoing variables
            // echo "User ID: " . $userId . "<br>";
            // echo "Expense Category: " . $expense_category . "<br>";
            // echo "Amount: $" . $amount . "<br>";
            // echo "Comment: " . $comment . "<br>";
?>
            <h4>Income Category</h4>
            <form method="post" action="home.php" class="expense_form" id="expenseForm">
            <div id="validationMessage"></div>
                <select class=""  name="category" id="dropdown">
                    <option value="">Select Category</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Electricity">Electricity</option>
                    <option value="Food">Food</option>
                    <option value="Fuel">Fuel</option>
                    <option value="Others">Others</option>
                </select>
                <input type="number" name="amount" id="amount" placeholder="Amount">
                <textarea class="comment" id="comment" rows="6" name="comment" placeholder="Leave your comment here"></textarea>
                <button type="submit" name="submit">Add</button>
            </form>


        </div>





    </div>

    </div>



    <script>
        document.getElementById('dropdown').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex].text;
            document.getElementById("expense-name").value = selectedOption;
        });

    document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("expenseForm");
    const category = document.getElementById("dropdown");
    const amount = document.getElementById("amount");
    const comment = document.getElementById("comment");
    const validationMessage = document.getElementById("validationMessage");
    validationMessage.style.display = "none";

    form.addEventListener("submit", function(event) {
        let message = "";
        validationMessage.innerHTML = "";
        // Category validation
        if (category.value === "") {
            message += "Please select a category.<br>";
        }
        // Amount validation
        if (amount.value === "" || isNaN(amount.value) || Number(amount.value) <= 0) {
            message += "Please enter a valid amount greater than 0.<br>";
        }
        if (comment.value.trim().length < 5) {
            message += "Comment must be at least 5 characters long.<br>";
        }
        if (message !== "") {
            validationMessage.innerHTML = message;
            validationMessage.style.display = "block";
            event.preventDefault();
        }
    });
});

    </script>




</body>

</html>
