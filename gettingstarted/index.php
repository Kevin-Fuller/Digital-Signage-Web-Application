<?php
session_start();

if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="../style/tableMaker.css">
</head>
<body>
    <?php include '../scripts/conn.php';

    $currentUser = $_SESSION['username'];
    $result = $mysqli->query("SELECT * from tablegenerator WHERE user = '$currentUser'"); ?>
    
    
    <div class="pageWrapper">
        
        <div class="leftPage">
            <a href="../tablemaker.php">Dashboard</a>
            <a href="" class="active">Getting Started</a>
            <a href="../faq/">FAQ</a>
            <a href="scripts/logout.php">Log Out</a>
        </div>

        <div class="rightPage">
            <div class="shape1"></div>
            <div class="shape2"></div>
            <div class="shape3"></div>
            <div class="triangle"></div>
            <div class="topBar">
                <h1 class="dash">Getting Started: <br>Welcome <?php echo($_SESSION['username']); ?></h1>
            </div>
            
            
            <div class="createNew">
                <h2 class="CNMB">How to Get Your Menu Board Started:</h2>
            </div>
        </div>




</div>


    
</body>
</html>

<?php
} else {
    header("Location: login.php");
}
?>