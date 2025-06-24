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
require 'DB_connect.php';
session_start();
$username = $_SESSION["username"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_credit"])) {
    credit_acc();
}

function credit_acc(){
    global $conn;

    $newAmount = $_POST["credit_amount"];
    $username = $_SESSION["username"];

    $sql = "UPDATE user SET Total_credit = Total_credit + ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $newAmount, $username);
    $stmt->execute();
    $sql = "INSERT into transcation(username,Transcation_id,total_amount,Category) values(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $category = "Credit";
    $tId=time();
    $stmt->bind_param("sids", $username, $tId, $newAmount,$category);
    $stmt->execute();
    $stmt->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_debit"])) {
    debit_acc();
}

function debit_acc(){
    global $conn;

    $newAmount = $_POST["debit_amount"];
    $username = $_SESSION["username"];

    $sql = "UPDATE user SET Total_credit = Total_credit - ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $newAmount, $username);
    $stmt->execute();
    
}

$credit_history;
$debit_history;
$credit_amount;
$debit_amount;

$sql = "SELECT Date FROM transcation WHERE username = ? and Category='Credit' ORDER BY Date DESC LIMIT 2";
$stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultc = $stmt->get_result();
    $rowc = $resultc->fetch_assoc();
    $credit_history= $rowc['Date'];

$sql = "SELECT Date FROM transcation WHERE username = ? and Category='Debit' ORDER BY Date DESC LIMIT 2";
$stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultd = $stmt->get_result();
    $rowd = $resultd->fetch_assoc();
    $debit_history = $rowd ? $rowd['Date'] : null;
    $stmt->close();

    $sql = "SELECT total_amount FROM transcation WHERE username = ? and Category='Credit' ORDER BY Date DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultc = $stmt->get_result();
    $rowc = $resultc->fetch_assoc();
    $credit_amount= $rowc['total_amount'];

    $sql = "SELECT Date FROM transcation WHERE username = ? and Category='Debit' ORDER BY Date DESC LIMIT 2";
$stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultc = $stmt->get_result();
    $rowc = $resultc->fetch_assoc();
    $debit_history= $rowc['Date'];

    $sql = "SELECT total_amount FROM transcation WHERE username = ? and Category='debit' ORDER BY Date DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultc = $stmt->get_result();
    $rowc = $resultc->fetch_assoc();
    $debit_amount= $rowc['total_amount'];



// Fetch all transactions for the user, most recent first
$transactions = [];
$sql = "SELECT Date, total_amount, Category FROM transcation WHERE username = ? ORDER BY Date DESC";
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
            <div class="col-md-6 mx-auto">                <div class="card">
                    <div class="card-body">                        <div class="prevPage">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h3 class="card-title text-center mb-4">New Transaction</h3>
                        <form method="POST" action="">
        
    <div class="mb-3">
        <label class="form-label"> Credit Amount</label>
        <input type="number" class="form-control" name="credit_amount" id="amount" required>
    </div>
    <button type="submit" class="btn btn-primary w-100" name="add_credit">Submit</button>
</form>

<form method="POST" action="">
    <div class="mb-3">
        <label class="form-label">Debit Amount</label>
        <input type="number" class="form-control" name="debit_amount" required>
    </div>
    <button type="submit" class="btn btn-danger w-100" name="add_debit">Debit</button>
</form>


                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Lists -->
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
                                    <span class="badge <?php echo ($txn['Category'] == 'Credit') ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo ($txn['Category'] == 'Credit' ? 'RS +' : 'RS -') . htmlspecialchars($txn['total_amount']); ?>
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