<?php 
include "../conn.php";






if (isset($_POST['submitNewTable'])) {
    $tableType = $_POST['type'];
    $tableName = $_POST['userTableName'];
    
    $mysqli->query("INSERT INTO tablegenerator (tableName, userTableName, tableType) VALUES('$tableName', '$tableName', '$tableType')") or die($mysqli->error);

    $mysqli->query("INSERT INTO other (color, title, tableName) VALUES('#FFFFFF', 'Title', '$tableName')") or die($mysqli->error);
    
    header("location: ../tableMaker.php");
}



?>