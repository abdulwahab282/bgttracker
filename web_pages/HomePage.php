<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
    <?php
    session_start();
    function get_creationdate($username): bool|mysqli_result|null {
        $host = "localhost";
        $dbname = "budget_tracker";
        $dbuser = "user";
        $password = "user";
        $port = 3000;
        $conn = new mysqli($host, $dbuser, $password, $dbname, $port);
        
        $stmt = $conn->prepare("SELECT creation_date FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }

    function get_totalcredit($username): bool|mysqli_result|null {
        $host = "localhost";
        $dbname = "budget_tracker";
        $dbuser = "user";
        $password = "user";
        $port = 3000;
        $conn = new mysqli($host, $dbuser, $password, $dbname, $port);
        
        $stmt = $conn->prepare("SELECT total_credit FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }
 function get_totalspend($username): bool|mysqli_result|null {
        $host = "localhost";
        $dbname = "budget_tracker";
        $dbuser = "user";
        $password = "user";
        $port = 3000;
        $conn = new mysqli($host, $dbuser, $password, $dbname, $port);
        
        $stmt = $conn->prepare("SELECT total_spend FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }
    function get_avg($username): bool|mysqli_result|null {
        $host = "localhost";
        $dbname = "budget_tracker";
        $dbuser = "user";
        $password = "user";
        $port = 3000;
        $conn = new mysqli($host, $dbuser, $password, $dbname, $port);
        
        $stmt = $conn->prepare("SELECT avg_runningbalance FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }

    ?>
    
</head>
<body>
    <div class="container-fluid py-4" id="homePage">
        <div class="row">
        
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2" style="cursor: pointer;">
                                <img src="../Images/Profile.jpg" alt="Profile" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;" onclick="window.location.href='Profile.php'">
                            </div>
                            <div class="col-md-10">
                                <div class="nextPage">
                                <img src="../Images/BookCorner.jpg" onclick="window.location.href='Admin.php'" alt="Next Page">
                                </div>
                                <h2 class="card-title mb-4">Profile Information</h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="mb-2">Account Creation: <span class="badge bg-secondary">
                                        <?php 
                                        $result = get_creationdate($_SESSION["username"]);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            echo $row["creation_date"];
                                        } else {
                                            echo "No user found or error occurred.";}?></span></p>
                                        <p class="mb-2">Total Amount Spent: <span class="badge bg-danger">
                                            <?php 
                                        $result = get_totalspend($_SESSION["username"]);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            echo $row["total_spend"];
                                        } else {
                                            echo "No user found or error occurred.";}?>
                                        </span></p>
                                        </span></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-2">Total Credited: <span class="badge bg-success">
                                             <?php 
                                        $result = get_totalcredit($_SESSION["username"]);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            echo $row["total_credit"];
                                        } else {
                                            echo "No user found or error occurred.";}?>
                                        </span></p>
                                        <p class="mb-2">Average Balance: <span class="badge bg-info">
                                            <?php 
                                        $result = get_avg($_SESSION["username"]);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            echo $row["avg_runningbalance"];
                                        } else {
                                            echo "No user found or error occurred.";}?>
                                        </span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Budget Overview</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Running Budget: <span class="badge bg-primary">$2000</span></h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Current Savings: <span class="badge bg-success">$1000</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Allocate Budget</h3>
                        <a href="Allocate%20budget.php" class="btn btn-lg btn-primary w-100">Manage Budget</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Transactions</h3>
                        <a href="Transcation.php" class="btn btn-lg btn-primary w-100">View Transactions</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Expenses Tracking</h3>
                        <a href="Expenses.php" class="btn btn-lg btn-primary w-100">Track Expenses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>