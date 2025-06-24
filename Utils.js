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
    event.preventDefault();
    if (p1 == p2) {
        let passwordvalid = CheckPassword(p1);
        console.log(passwordvalid);
        if (!passwordvalid) {
            alert("Password invalid, please include at least one special character!");
            return false;
        }
    } 
    else {
        alert("Passwords do not match! Please try again");
        return false;
    }
    
    return true;
}

