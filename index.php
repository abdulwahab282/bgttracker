<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Budget Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
</head>
<?php

    require 'DB_Connect.php';

    if ($conn->connect_error) {
        echo "Unexpected error: ". $conn->connect_error;
        die();
    }
    else
    {
        if(isset($_POST["username"]) && isset($_POST["password"])){
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
    }
?>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card p-4 shadow-lg" style="min-width: 300px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Budget Tracker Login</h2>

                <form action=""  method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <button type ="submit" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                    <div class="mb-3">
                        <button style="color:white" onclick="window.location.href='signup.php'" class="btn btn-link" >Sign Up</a> 
                    </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>