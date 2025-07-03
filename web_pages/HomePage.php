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
    require_once ("DBFunctions/HomePage_vars.php");
    $budget_display = showbudget("monthly_budget");
    if(isset($_POST["budget_time"])){
        $choice = $_POST["budget_time"];
        switch($choice){
            case "weekly_budget":
                $budget_display=showbudget("weekly_budget");
                break;
            case "monthly_budget":
                $budget_display=showbudget("monthly_budget");
                break;
            case "yearly_budget":
                $budget_display=showbudget("yearly_budget");
                break;
        }
    }
?>
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
                                <h2 class="card-title mb-4">Profile Information - <?php echo"$username" ?></h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="mb-2">Account Creation: <span class="badge bg-secondary">
                                        <?php
                                        echo "$account_creation";
                                        ?>
                                        </span></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-2">Total Balance: <span class="badge bg-success">
                                            <?php
                                            echo "$Total_credit";
                                            ?>
                                            </span>
                                        </p>
                                        <p class="mb-2">Average Balance: <span class="badge bg-info">
                                            <?php
                                            echo "$avg_runningbalance";
                                            ?>
                                            </p>
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
                            <form method="post" action="">
    <h3>Running Budget: <?php echo $budget_display?>
        <span class="badge bg-primary"></span>
        <select name="budget_time" onchange="this.form.submit()">
            <option value="monthly_budget" <?php if(isset($choice) && $choice == "monthly_budget") echo "selected"; ?>>Monthly</option>
            <option value="weekly_budget" <?php if(isset($choice) && $choice == "weekly_budget") echo "selected"; ?>>Weekly</option>
            <option value="yearly_budget" <?php if(isset($choice) && $choice == "yearly_budget") echo "selected"; ?>>Yearly</option>
        </select>
    </h3>
</form>
                            </div>
                            <div class="col-md-6">
                                <h3>Current Savings: <span class="badge bg-success"><?php echo "$saving_amount"; ?></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Allocate Budget</h3>
                        <a href="Allocatebudget.php" class="btn btn-lg btn-primary w-100">Manage Budget</a>
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
