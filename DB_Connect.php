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
?> 