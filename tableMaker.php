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
    <title>Build A Board</title>
    <link rel="stylesheet" href="style/tableMaker.css">
</head>
<body>
    <?php include 'scripts/conn.php';

    $result = $mysqli->query('SELECT * from tablegenerator'); ?>
    <div class="pageWrapper">
        
<div class="leftPage">
<a href="">Dashboard</a>
<a href="">Getting Started</a>
<a href="">FAQ</a>
<button>Log Out</button>
</div>
<div class="rightPage">
    <div class="shape1"></div>
    <div class="shape2"></div>
    <div class="shape3"></div>
    <div class="triangle"></div>
    <div class="topBar">
        <h1 class="dash">Dashboard</h1>
    </div>

    <div class="organizedBoards">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="individualBoard">
            <form class="indivBoard" action="index.php?currentTableName=<?php echo $row['userTableName']?>" method="POST">
                <input type="hidden" name="tableName" value="<?php echo $row['userTableName']?>">
                <div class="tableName"><?php echo $row['userTableName'] ?></div>
                <div class="lowerSection"><button class="editPage" type="submit">Edit</button>
                <a onclick="return confirm('Are you sure you wish to delete this board? You will be unable to recover it!')" href="scripts/createNewBoard.php?delete=<?php echo $row['userTableName']?>">Delete</a></div>
                <input type="hidden" name="tableName" value="<?php echo $row['userTableName']?>">
            </form>
    </div>
    <?php endwhile;?> 
    </div>  

    <div class="createNew">
        <h2 class="CNMB">Create a new menu board:</h2>
        <p class="subtextScript">Edit your board to get a customized piece of digital signage. From there, simply connect the link to your preffered method of display and your new menu board is good to go!</p>
    <form action="scripts/createNewBoard.php" method="POST" class="createNewForm">
        <input type="text" name="userTableName" placeholder="Board Name">
        <select id="type" name="type" class="dropdown">
            <option value="normal" class="dropdownContent">Normal</option>
        </select>
        <button type="submit" name="submitNewTable" class="createBoardButton" >Create New Board</button>
    </form>
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