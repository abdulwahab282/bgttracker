<?php
    require_once(__DIR__ . '/../../DB_Connect.php');
    session_start();
    $username = $_SESSION["username"];
    
    function credit_acc($category){

        global $conn;
        global $username;

        $newAmount = $_POST["credit_amount"];

        $sql = "UPDATE user SET Total_credit = Total_credit + ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ds", $newAmount, $username);
        $stmt->execute();
        $sql = "INSERT into transcation(username,Transcation_id,total_amount,Category,Type) values(?,?,?,?,'Credit')";
        $stmt = $conn->prepare($sql);
        
        $tId=time(); //Time will always be different so Transaction IDs will remain unique.
        
        $stmt->bind_param("sids", $username, $tId, $newAmount, $category);
        $stmt->execute();
        $stmt->close();
    }

    function debit_acc($category){

        global $conn;
        global $username;

        $newAmount = $_POST["debit_amount"];

        $sql = "UPDATE user SET Total_credit = Total_credit - ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ds", $newAmount, $username);
        $stmt->execute();
        $stmt->close();

        $sql = "INSERT into transcation(username,Transcation_id,total_amount,Category,Type) values(?,?,?,?,'Debit')";
        $stmt = $conn->prepare($sql);
        
        $tId=time();
        
        $stmt->bind_param("sids", $username, $tId, $newAmount, $category);
        $stmt->execute();
        $stmt->close();
    }
?>