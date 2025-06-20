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
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"], $_POST["confirm_password"])) {
        $username = $_POST["username"];
        $pass = $_POST["password"];
        $confirm_pass = $_POST["confirm_password"];
    
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $username, $pass);
            if ($stmt->execute()) {
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $pass;
                header("Location: index.php");
                exit();
            } else {
                echo "Error inserting data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    }

    $conn->close();
    ?>
    