<?php

    //This file contains all the data fetched from the DB that needs to be displayed on the Homepage.

    session_start();
    require_once(__DIR__ . '/../../DB_Connect.php');
    
    $username=$_SESSION["username"];

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

?>