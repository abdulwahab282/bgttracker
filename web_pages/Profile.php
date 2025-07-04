<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
<?php
    session_start();
    if(!isset($_SESSION["username"]) && !isset($_SESSION["password"]))
    {
        echo "User is not logged in, please log back in: <a href=../index.php>Login</a>";
        die();
    }
    include 'DBFunctions/Variables.php';
?>
<body>
    <div class="container py-4">        <div class="card">
            <div class="card-body">
                <div class="row align-items-center mb-4">
                    <div class="col-md-3 text-center">
                        <img src="../Images/Profile.jpg" alt="Profile" class="rounded-circle img-fluid mb-3" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                             <div class="text-center">
                            <form method="POST">
                             <button name = 'logout' type="submit"  
                            class="btn btn-danger btn-lg">
                            Logout
                            </button>
                            </form>
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
                                    session_unset();
                                    session_destroy();
                                    header("Location: ../index.php");
                                    exit();
                                }
                            ?>
                </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-4">
                            <div class="col-md-6">                                <div class="card h-100">
                                    <div class="card-body">                        <div class="prevPage">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h5 class="card-title" style="text-align:center;">Account Details</h5>
                        <p class="mb-2">Account Creation: <span class="text-dark"><?php echo $account_creation?></span></p>
                                        <p class="mb-2">Average Credit Amount: <span class="badge bg-success"><?php echo $avg_total ?></span></p>
                                    </div>
                                    <p style="font-size:large; color:darkorange; margin-left:3%;">Note: The Average Credit amount is counted from Account Creation</p>
                                </div>
                            </div>
                            <div class="col-md-6">                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Financial Overview</h5>
                                        <p class="mb-2">Total Amount Spent: <span class="badge bg-danger"><?php echo $total_spend ?></span></p>
                                        <p class="mb-2">Total Amount Credited: <span class="badge bg-success"><?php echo $total_Credit ?></span></p>
                                        <p style="font-size:large; color:darkorange;">Note: The Numbers here are counted from Account Creation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Balance History</h5>
                                        <p class="mb-2">Average Debit Amount: <span class="badge bg-info"><?php echo $avg_Debit ?></span></p>
                                        <p style="font-size:large; color:darkorange;">Note: This is the average Withdrawal Amount in Transaction History</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>