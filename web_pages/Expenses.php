<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"]))
{
    echo "User is not logged in, please log back in: <a href=../index.php>Login</a>";
    die();
}
include '../DB_Connect.php';
include 'DBFunctions/Variables.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h2 class="text-center mb-4">Expense Categories</h2>
        <div class="row">
            <!-- Progress Bars Column -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="prevPage mb-3">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h4 class="card-title text-center mb-4">Total Expenses: RS <?php echo number_format($total_expenses, 2); ?></h4>
                        <div class="expense-summary">
                            <!-- Transport -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Transport</span>
                                    <span>RS <?php echo number_format($category_totals['Transport'], 2); ?> (<?php echo $total_expenses > 0 ? round($category_totals['Transport']/$total_expenses*100) : 0; ?>%)</span>
                                </div>
                                <div class="progress bg-light">
                                    <div class="progress-bar" style="width: <?php echo $total_expenses > 0 ? round($category_totals['Transport']/$total_expenses*100) : 0; ?>%; background-color: #8b5e34;"></div>
                                </div>
                            </div>
                            <!-- Education -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Education</span>
                                    <span>RS <?php echo number_format($category_totals['Education'], 2); ?> (<?php echo $total_expenses > 0 ? round($category_totals['Education']/$total_expenses*100) : 0; ?>%)</span>
                                </div>
                                <div class="progress bg-light">
                                    <div class="progress-bar" style="width: <?php echo $total_expenses > 0 ? round($category_totals['Education']/$total_expenses*100) : 0; ?>%; background-color: #8b5e34;"></div>
                                </div>
                            </div>
                            <!-- Health -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Health</span>
                                    <span>RS <?php echo number_format($category_totals['Health'], 2); ?> (<?php echo $total_expenses > 0 ? round($category_totals['Health']/$total_expenses*100) : 0; ?>%)</span>
                                </div>
                                <div class="progress bg-light">
                                    <div class="progress-bar" style="width: <?php echo $total_expenses > 0 ? round($category_totals['Health']/$total_expenses*100) : 0; ?>%; background-color: #8b5e34;"></div>
                                </div>
                            </div>
                            <!-- Shopping -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Shopping</span>
                                    <span>RS <?php echo number_format($category_totals['Shopping'], 2); ?> (<?php echo $total_expenses > 0 ? round($category_totals['Shopping']/$total_expenses*100) : 0; ?>%)</span>
                                </div>
                                <div class="progress bg-light">
                                    <div class="progress-bar" style="width: <?php echo $total_expenses > 0 ? round($category_totals['Shopping']/$total_expenses*100) : 0; ?>%; background-color: #8b5e34;"></div>
                                </div>
                            </div>
                            <!-- Food -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Food</span>
                                    <span>RS <?php echo number_format($category_totals['Food'], 2); ?> (<?php echo $total_expenses > 0 ? round($category_totals['Food']/$total_expenses*100) : 0; ?>%)</span>
                                </div>
                                <div class="progress bg-light">
                                    <div class="progress-bar" style="width: <?php echo $total_expenses > 0 ? round($category_totals['Food']/$total_expenses*100) : 0; ?>%; background-color: #8b5e34;"></div>
                                </div>
                                <br>
                                <p style="font-size:large; color:darkorange;">Note: Expense History can be found under Transaction History</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Transaction Cards Column -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="list-group" style="font-family: 'Old newspaper font', sans-serif;">
                            <!-- Transport -->
                            <form method="POST" action="" class="list-group-item bg-transparent border-light mb-3">
                                <h5 class="mb-3">Transport</h5>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expense_amount" placeholder="Enter amount" required>
                                    <input type="hidden" name="category" value="Transport">
                                    <button class="btn btn-primary" type="submit" name="add_expense">Add</button>
                                </div>
                            </form>
                            <!-- Education -->
                            <form method="POST" action="" class="list-group-item bg-transparent border-light mb-3">
                                <h5 class="mb-3">Education</h5>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expense_amount" placeholder="Enter amount" required>
                                    <input type="hidden" name="category" value="Education">
                                    <button class="btn btn-primary" type="submit" name="add_expense">Add</button>
                                </div>
                            </form>
                            <!-- Health -->
                            <form method="POST" action="" class="list-group-item bg-transparent border-light mb-3">
                                <h5 class="mb-3">Health</h5>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expense_amount" placeholder="Enter amount" required>
                                    <input type="hidden" name="category" value="Health">
                                    <button class="btn btn-primary" type="submit" name="add_expense">Add</button>
                                </div>
                            </form>
                            <!-- Shopping -->
                            <form method="POST" action="" class="list-group-item bg-transparent border-light mb-3">
                                <h5 class="mb-3">Shopping</h5>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expense_amount" placeholder="Enter amount" required>
                                    <input type="hidden" name="category" value="Shopping">
                                    <button class="btn btn-primary" type="submit" name="add_expense">Add</button>
                                </div>
                            </form>
                            <!-- Food -->
                            <form method="POST" action="" class="list-group-item bg-transparent border-light mb-3">
                                <h5 class="mb-3">Food</h5>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expense_amount" placeholder="Enter amount" required>
                                    <input type="hidden" name="category" value="Food">
                                    <button class="btn btn-primary" type="submit" name="add_expense">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>