<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging in...</title>
</head>
<body>

<?php

$host = "localhost";
$dbname = "budget_tracker";
$user = "user";
$password = "user";
$port = 3000;

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    echo "Unexpected error: ". $conn->connect_error;
    die();
}
else
{
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $stmt = $conn->prepare("Select * from user where username = ? AND password = ?");
    $stmt->bind_param("si", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if($result->num_rows > 0)
    {
        #This is a valid user.
        session_start();
        $_SESSION["username"] = $user;
        $_SESSION["password"] = $pass;
        $_SESSION["connection"] = $conn;    
        header("Location: web_pages/HomePage.php");        
    }
    else
    {
        #This is not a valid user.
        sleep(2);
        echo "<script>alert('Invalid username or password. Redirecting to Login Page.');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
    
}
?>

</body>
</html>