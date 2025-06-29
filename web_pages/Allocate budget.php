<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Allocation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">

<?php
require 'DB_connect.php';
session_start();
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_budget"])) {
    $yearly = $_POST['yearly_budget'];
    $monthly = $_POST['monthly_budget'];
    $weekly = $_POST['weekly_budget'];

    // Check if budget already exists for this user
    $check = $conn->prepare("SELECT * FROM budget WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update existing record
        $sql = "UPDATE budget SET yearly = ?, monthly = ?, weekly = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddds", $yearly, $monthly, $weekly, $username);
    } else {
        // Insert new record
        $sql = "INSERT INTO budget (username, yearly, monthly, weekly) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sddd", $username, $yearly, $monthly, $weekly);
    }

    $stmt->execute();
    $stmt->close();
}
?>

</head>
<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8 mx-auto"><div class="card">
                    <div class="card-body">
                        <div class="prevPage">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h3 class="card-title text-center mb-4">Budget Allocation</h3>
                        <form>
                            <!-- Running Balance Display -->
                            <div class="mb-4">
                                <h4 class="text-center">Running Balance: <span class="badge bg-success">$5000</span></h4>
                            </div>

                            <!-- Yearly Budget -->
                            <div class="mb-4">
                                <label for="budget" class="form-label">Allocate yearly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="budget" name="budget" required>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <!-- Monthly Budget -->
                            <div class="mb-4">
                                <label for="monthly_budget" class="form-label">Monthly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="monthly_budget" name="monthly_budget" required>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <!-- Weekly Budget -->
                            <div class="mb-4">
                                <label for="weekly_budget" class="form-label">Weekly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="weekly_budget" name="weekly_budget" required>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <!-- Credit Savings -->
                            <div class="mb-4">
                                <label for="credit_saving" class="form-label">Credit saving account</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="credit_saving" name="credit_saving" required>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <!-- Total Savings Display -->
                            <div class="text-center">
                                <h4>Total Savings: <span class="badge bg-primary">$2000</span></h4>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>