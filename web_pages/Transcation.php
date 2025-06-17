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
<body>
    <div class="container py-4">
        <!-- Transaction Form -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">                <div class="card">
                    <div class="card-body">                        <div class="prevPage">
                            <img src="../Images/BookCorner_Flipped.jpg" onclick="window.location.href='HomePage.php'" alt="Previous Page">
                        </div>
                        <h3 class="card-title text-center mb-4">New Transaction</h3>
                        <form>
                            <div class="mb-3">
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="transaction" value="credit" id="credit">
                                    <label class="btn btn-outline-primary" for="credit">Credit</label>
                                    <input type="radio" class="btn-check" name="transaction" value="debit" id="debit">
                                    <label class="btn btn-outline-primary" for="debit">Debit</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Lists -->
        <div class="row">
            <!-- Credit Transactions -->
            <div class="col-md-6 mb-4">                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Credit History</h4>
                        <div class="list-group">
                            <div class="list-group-item bg-transparent border-light d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">Salary</h6>
                                    <small>May 20, 2025</small>
                                </div>
                                <span class="badge bg-success">+$3,000</span>
                            </div>
                            <div class="list-group-item bg-transparent border-light d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">Freelance Work</h6>
                                    <small>May 15, 2025</small>
                                </div>
                                <span class="badge bg-success">+$500</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Debit Transactions -->
            <div class="col-md-6 mb-4">                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Debit History</h4>
                        <div class="list-group">
                            <div class="list-group-item bg-transparent border-light d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">Groceries</h6>
                                    <small>May 19, 2025</small>
                                </div>
                                <span class="badge bg-danger">-$150</span>
                            </div>
                            <div class="list-group-item bg-transparent border-light d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">Internet Bill</h6>
                                    <small>May 18, 2025</small>
                                </div>
                                <span class="badge bg-danger">-$75</span>
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