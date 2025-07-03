<?php

    //This file contains all the data fetched from the DB that needs to be displayed on the FrontEnd.

    require_once(__DIR__ . '/../../DB_Connect.php');

    session_start();
    
    try {
        if (!isset($_SESSION["username"])) {
            throw new Exception("Error, User not logged in.");
        }
        $username = $_SESSION["username"];
    } catch (Exception $e) {
        // Handle the error, e.g., redirect or show an error message
        die( $e->getMessage());
    }

    //HOMEPAGE

    $sql="SELECT creation_date from user where username = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $account_creation= $row["creation_date"];

    $sql="SELECT Total_credit from user where username = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $Total_credit= $row["Total_credit"];

    $sql="SELECT avg_runningbalance from user where username = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $avg_runningbalance= $row["avg_runningbalance"];

    $sql="SELECT savings from user where username = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $saving_amount= $row["savings"];

    function showbudget($option){
        global $conn;
        global $username;

        $sql = "SELECT `$option` FROM budget WHERE username = ?";
        $stmt = $conn -> prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_assoc();

        $running_budget = $row[$option];

        return $running_budget;
    }

//EXPENSES:

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_expense"])) {
    $amount = $_POST["expense_amount"];
    $category = $_POST["category"];
    // Subtract from Total_credit
    $sql = "UPDATE user SET Total_credit = Total_credit - ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $amount, $username);
    $stmt->execute();
    // Insert into transcation
    $sql = "INSERT INTO transcation(username, Transcation_id, total_amount, Category, Type) VALUES (?, ?, ?, ?,'Debit')";
    $stmt = $conn->prepare($sql);
    $tId = time();
    $stmt->bind_param("sids", $username, $tId, $amount, $category);
    $stmt->execute();
    $stmt->close();
}

// Fetch category totals from transcation table
$categories = ['Transport', 'Education', 'Health', 'Shopping', 'Food'];

//Todo, make the above array dynamic where new categories can be added by the user.

$category_totals = [];

foreach ($categories as $cat) {
    $sql = "SELECT SUM(total_amount) as total FROM transcation WHERE username = ? AND Category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $cat);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $category_totals[$cat] = $row['total'] ? floatval($row['total']) : 0;
    $stmt->close();
}

$total_expenses = array_sum($category_totals);

//PROFILE:

$sql="SELECT SUM(total_amount) FROM transcation WHERE username=? and Type='Debit'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ->fetch_assoc();
    $stmt->close();   

    $total_spend = $row['SUM(total_amount)'];
    
    $sql="SELECT SUM(total_amount) FROM transcation where username=? and type='Credit'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result -> fetch_assoc();
    $stmt->close();
    $total_Credit= $row['SUM(total_amount)'];

     $sql="SELECT AVG(total_amount) FROM transcation where username=? and  type='Credit'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result -> fetch_assoc();
    $stmt->close();
    $avg_total= round($row['AVG(total_amount)']);

    $sql="SELECT AVG(total_amount) FROM transcation where username=? and  type='Debit'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result -> fetch_assoc();
    $stmt->close();
    $avg_Debit= round($row['AVG(total_amount)']);

?>