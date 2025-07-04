<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
    <script defer>
        function ConfirmDeletion(event){
            if(confirm("Are you sure?") == false){
                event.preventDefault();
                return false;
            }
            else{
                alert("History Deleted!");
                return true;
            };
        }
    </script>
</head>
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit();
    }
    require_once(__DIR__ . '/../DB_connect.php');
    require_once(__DIR__ . '/DBFunctions/CreditDebit.php');

    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_credit"])) {
        credit_acc($_POST["credit_category"],$_POST["credit_amount"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_debit"])) {
        debit_acc($_POST["debit_category"]);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_history"]))
    {
        deletehistory();
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

    //DELETE HISTORY:

    function deletehistory()
    {
        global $conn;
        global $username;

        $sql = "DELETE from transcation where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $sql = "UPDATE user SET total_credit=0, savings=0 where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $stmt->close();
    }
?>

<body>
    <div class="container py-4">
        <!-- Transaction Form -->
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
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
                                <button type="submit" class="btn btn-danger w-100" name="add_credit" style="background-color: darkgreen";>Credit</button>
                            </div>
                            </form>
                            <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Debit Amount</label>
                                <input type="number" class="form-control" name="debit_amount" required>
                                <label class="form-label" required>Category:</label>
                                <input type="text" class="form-control" name="debit_category" required>
                            </div>
                                <button type="submit" class="btn btn-danger w-100" style="background-color: firebrick;"name="add_debit">Debit</button>
                            </form>

                    </div>
                </div>
            </div>
            <!-- Transactions List -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" onsubmit="ConfirmDeletion(event)">
                        <h4 class="card-title text-center mb-4">Transaction History
                        <button type="submit" name="delete_history" type="submit" class="badge bg-danger float-end" style="padding: 1.3%; color:lightgray;">Delete History</button>     
                        </form>
                        </h4>
                        <div class="list-group h-100" style="max-height: 455px; overflow-y: auto;">
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