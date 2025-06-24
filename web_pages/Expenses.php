<?php
require 'DB_Connect.php';
session_start();
$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_expense"])) {
    $amount = $_POST["expense_amount"];
    $category = $_POST["category"];
    // Subtract from Total_credit
    $sql = "UPDATE user SET Total_credit = Total_credit - ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $amount, $username);
    $stmt->execute();
    // Insert into transcation
    $sql = "INSERT INTO transcation(username, Transcation_id, total_amount, Category) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $tId = time();
    $stmt->bind_param("sids", $username, $tId, $amount, $category);
    $stmt->execute();
    $stmt->close();
}

// Fetch category totals from transcation table
$categories = ['Transport', 'Education', 'Health', 'Shopping', 'Food'];
$category_totals = [];
foreach ($categories as $cat) {
    $sql = "SELECT SUM(total_amount) as total FROM transcation WHERE username = ? AND Category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $cat);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $category_totals[$cat] = $row['total'] ? floatval($row['total']) : 0;
    $stmt->close();
}
$total_expenses = array_sum($category_totals);
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
        
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <select class="form-select">
                    <option selected>Select Period</option>
                    <option value="yearly">Yearly</option>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                </select>
            </div>
        </div>

        <!-- Expense Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">                <div class="card">
                    <div class="card-body">                        <div class="prevPage">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="list-group">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>