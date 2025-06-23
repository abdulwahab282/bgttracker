<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
</head>
<?php
    $host = "localhost";
    $dbname = "budget_tracker";
    $user = "user";
    $password = "user";
    $port = 3000; // Change to your actual port
    
    $conn = new mysqli($host, $user, $password, $dbname, $port);
    
    if ($conn->connect_error) {
        die("Unexpected error: " . $conn->connect_error);
    }
    
    $username = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "INSERT INTO user VALUES (?, ?, ?, 0, 0, 0, 0)";
    $stmt = $conn->prepare($sql);
    $currenttime=date("Y-m-d");
    $stmt->bind_param("sss", $username, $pass, $currenttime);
    if($stmt->execute()){
    echo "<script>window.alert('Sign up Successful!');</script>";
    $stmt->close();
    $conn->close();
    header("Location: index.php");
    }
    else{
        echo '"Error: ". $stmt->error';
    }
?>
    