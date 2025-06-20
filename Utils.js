function CheckUsername(username) {
    let specialcharacters = ['!','@','#','$','%','^','&','*','(',')','_','-','+','='];
    for (let i = 0; i < specialcharacters.length; i++) {
        if (username.includes(specialcharacters[i])) {
            return true;
        }
    }
    return false;
}

function MatchPattern(p1, p2, username) {
    let usernamevalid = CheckUsername(username);
    if (!usernamevalid) {
        window.alert("Username invalid, please include at least one special character!");
        return;
    }
    if (p1.length >= 8) {
        window.alert("Password must be less than 8 characters!");
        return;
    }
    if (p1 == p2) {
        window.alert("Account successfully created, redirecting to Login Page...");
        window.location.href = "index.php";
    } else {
        window.alert("Passwords do not match! Please try again");
    }
    return;
}

