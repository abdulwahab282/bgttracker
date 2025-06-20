<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Budget Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card p-4 shadow-lg" style="min-width: 300px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Budget Tracker Login</h2>

                <form action="login.php"  method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <button type ="submit" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                    <div class="mb-3">
                        <button style="color:white" onclick="window.location.href='signup.php'" class="btn btn-link" >Sign Up</a> 
                    </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>