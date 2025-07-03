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
require_once(__DIR__ . '/../DB_connect.php');
require_once(__DIR__ . '/DBFunctions/HomePage_vars.php');
$username = $_SESSION['username'];

if (isset($_POST["save_budget"])) {
    $yearly = $_POST['yearly_budget'];
    $monthly = $_POST['monthly_budget'];
    $weekly = $_POST['weekly_budget'];
    $sql = "UPDATE budget SET yearly_budget = ?, monthly_budget = ?, weekly_budget   = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddds", $yearly, $monthly, $weekly, $username);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST["saving"])){
    $amount = $_POST["saving"];
    $sql = "UPDATE user SET savings = savings + ? where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $amount, $username);
    $stmt->execute();
    $sql = "SELECT savings from user where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $saving_amount = $row ? $row["savings"]: 0;
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

                        <form method="POST" action="">
                            <!-- Yearly Budget -->
                            <div class="mb-4">
                                <label for="budget" class="form-label">Allocate yearly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="yearly_budget" name="yearly_budget" required>
                                </div>
                            </div>

                            <!-- Monthly Budget -->
                            <div class="mb-4">
                                <label for="monthly_budget" class="form-label">Monthly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="monthly_budget" name="monthly_budget" required>
                                </div>
                            </div>

                            <!-- Weekly Budget -->
                            <div class="mb-4">
                                <label for="weekly_budget" class="form-label">Weekly budget</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="weekly_budget" name="weekly_budget" required>
                                </div>
                                <button type="button" class="btn btn-primary" name="autoallocate" onclick="Autofill(document.getElementById('yearly_budget').value,document.getElementById('monthly_budget').value, document.getElementById('weekly_budget').value);">AutoFill values</button>
                                <button type="Reset" class="btn btn-primary">Reset</button>

                                <button type="submit" class="btn btn-primary" name="save_budget" style="margin-left:74.5%;" onclick="">Submit</button>
                            </div>

                                
                        </form>
                            <!-- Credit Savings -->
                            <div class="mb-4">
                                <form method="POST" action="">
                                <label for="credit_saving" class="form-label">Credit saving account</label>
                                <div class="input-group" style="width: 50%;">
                                    <input type="number" class="form-control" name="saving" required>
                                <button type="submit" style="margin-left:12%;" class="btn btn-primary" name="credit_saving" onclick="BudgetVerify(document.getElementByName('yearly_budget').value,document.getElementByName('monthly_budget').value, document.getElementByName('weekly_budget').value)">Submit</button>
                                </form>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <h4>Total Savings: <span class="badge bg-primary"><?php echo "$saving_amount"?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function BudgetVerify(y,m,w,event){
            //The Monthly budget must be a twelfth or less of the Yearly budget
            if(y/12 <= m){
                //The Weekly budget must be less than or equal to a 52nd of the Yearly budget.
                if(y/52 <= w){
                    return true;
                }
                else{
                    event.preventDefault();
                    alert("Weekly Budget calculation incorrect!");
                    return false;
                }
            }
            else{
                event.preventDefault();
                alert("Monthly Budget calculation incorrect!");
                return false;
            }
        }

        function Autofill(y,m,w){
                    
        if(y==""&& w==""&& m=="")
        {
             window.alert("Please Allocate Budget to Atleast one field");
        }
        else
        {
            if(y=="")
        {
            if(m!=""){
                y=m*12;
                document.getElementById("yearly_budget").value=parseInt(y);
                if(w==""){
                    w=m/4;
                    document.getElementById("weekly_budget").value=parseInt(w);
                }
            }
            else{
                y=w*52;
                document.getElementById("yearly_budget").value=parseInt(y);
                if(m==""){
                    m=w*4;
                    document.getElementById("monthly_budget").value=parseInt(m);
                }
            }
        }
        else if(m==""){
            if(w!=="")
        {
            m=w*4;
            document.getElementById("monthly_budget").value=m;
        }
        else{
            m=y/12;
            w=m/4;
            document.getElementById("monthly_budget").value=parseInt(m);
            document.getElementById("weekly_budget").value=parseInt(w);

        }

        }
        else if(w==""){
            
            if(y!="")
        {
            w=y/52;
            document.getElementById("weekly_budget").value=w;

        }
        else
            {
                w=m/4;
                y=w*52;
            document.getElementById("weekly_budget").value=parseInt(w);
            document.getElementById("yearly_budget").value=parseInt(y);


            }
        }
        

        }

    }

    </script>

</body>
</html>