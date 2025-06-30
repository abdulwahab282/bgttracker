<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
</head>
<?php

    require_once(__DIR__ . '/../DB_connect.php');
    require_once(__DIR__ . '/DBFunctions/CreditDebit.php');

    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_credit"])) {
        credit_acc($_POST["credit_category"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_debit"])) {
        debit_acc($_POST["debit_category"]);
    }

    // Fetch all transactions for the user, most recent first
    $transactions = [];
    $sql = "SELECT Date, total_amount, Category, Type FROM transcation WHERE username = ? ORDER BY Date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    $stmt->close();
?>

<body>
    <div class="container py-4">
        <!-- Transaction Form -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="prevPage">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h3 class="card-title text-center mb-4">New Transaction</h3>
                            <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label"> Credit Amount</label>
                                <input type="number" class="form-control" name="credit_amount" id="amount" required>
                                <label class="form-label" required>Category:</label>
                                <input type="text" class="form-control" name="credit_category">
                                <button type="submit" class="btn btn-danger w-100" name="add_credit">Credit</button>
                            </div>
                            </form>
                            <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Debit Amount</label>
                                <input type="number" class="form-control" name="debit_amount" required>
                                <label class="form-label" required>Category:</label>
                                <input type="text" class="form-control" name="debit_category" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100" name="add_debit">Debit</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Transaction History</h4>
                        <div class="list-group" style="max-height: 350px; overflow-y: auto;">
                            <?php foreach ($transactions as $txn): ?>
                                <div class="list-group-item bg-transparent border-light d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <small><?php echo htmlspecialchars($txn['Date']); ?></small><br>
                                        <small class="text-muted">Category: <?php echo htmlspecialchars($txn['Category']); ?></small>
                                    </div>
                                    <span class="badge <?php echo ($txn['Type'] == 'Credit') ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo ($txn['Type'] == 'Credit' ? 'RS +' : 'RS -') . htmlspecialchars($txn['total_amount']); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>