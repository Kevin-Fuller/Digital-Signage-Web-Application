<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'conn.php';

    $result = $mysqli->query('SELECT * from tablegenerator'); ?>
    
    <table class="">
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form action="index.php?currentTableName=<?php echo $row['userTableName']?>" method="POST">
                <input type="hidden" name="tableName" value="<?php echo $row['userTableName']?>">
                <td><?php echo $row['userTableName'] ?></td>
                <td><button type="submit">Edit Page</button></td>
                <input type="hidden" name="tableName" value="<?php echo $row['userTableName']?>">
            </form>
        </tr>
    <?php endwhile;?> 
    </table>  

    <form action="scripts/createNewBoard.php" method="POST">
        <input type="text" name="userTableName">
        <select id="type" name="type">
            <option value="normal">normal</option>
        </select>
        <button type="submit" name="submitNewTable">Create New Board</button>
    </form>

    


    
</body>
</html>