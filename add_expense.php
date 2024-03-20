<?php

include('connection.php');
    $expense_category=$_POST['expense_category'];
    
    $amount=$_POST['amount'];
    $comment=$_POST['comment'];

    if(empty($_POST["expense_category"]) || empty($_POST["amount"]) || empty($_POST["comment"]))
    {
        echo "All fields are required.";
    }
       
    else
    {   
        $sql = "INSERT INTO expense (expense_category,amount, comment) VALUES ('$expense_category','$amount', '$comment')";
        $result = mysqli_query($db, $sql);

        if($result)
        {
            echo "Expense added Successfully";
            header("Location: popup.php");
        }
        else
        {
            echo "Something Went Wrong!";
            header("Location: home.php");
        }
    }
   
?>