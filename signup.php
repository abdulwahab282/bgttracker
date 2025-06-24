<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Budget Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.cdnfonts.com/css/old-newspaper" rel="stylesheet">
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card p-4 shadow-lg" style="min-width: 300px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Budget Tracker Sign up</h2>

                <form action="signuplogic.php" method="POST" onsubmit="MatchPattern(document.getElementById('p1').value, document.getElementById('p2').value, event)">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Enter your name</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Enter password</label>
                        <input type="password" class="form-control" id="p1" name="password" required>
                    </div>
                     <div class="mb-4">
                        <label for="password" class="form-label">Confirm your password</label>
                        <input type="password" class="form-control" id="p2" name="confirm_password" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                        <button style="color:white" onclick="window.location.href='index.php'" class="btn btn-link" > Go back to Login</a> 

                    </div>
                        
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function CheckPassword(password) {
    let specialcharacters = ['!','@','#','$','%','^','&','*','(',')','_','-','+','='];
    for (let i = 0; i < specialcharacters.length; i++) {
        if (password.includes(specialcharacters[i])) {
            return true;
        }
    }
    return false;
}

function MatchPattern(p1, p2, event) {
    if (p1 == p2) {
        let passwordvalid = CheckPassword(p1);
        if (!passwordvalid) {
            event.preventDefault();
            alert("Password invalid, please include at least one special character!");
            return false;
        }
    } 
    else {
        event.preventDefault();
        alert("Passwords do not match! Please try again");
        return false;
    }
    alert("Signup Successful, redirecting to Login Page...")
    return true;
}
    </script>
</body>
</html>