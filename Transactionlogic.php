<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require 'DB_connect.php';

    if (isset($_POST["add_credit"])) {
    $newAmount = $_POST["credit_amount"];
    $username = $_SESSION["username"];
    $sql = "UPDATE user SET Total_credit = Total_credit + ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $newAmount, $username);
    $stmt->execute();
    header("Location: HomePage.php");
    exit();
}
    ?>
</body>
</html>