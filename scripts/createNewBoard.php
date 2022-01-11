<?php 
include "conn.php";

session_start();



if (isset($_POST['submitNewTable'])) {
    $tableType = $_POST['type'];
    $tableName = $_POST['userTableName'];
    $username = $_SESSION['username'];
    $userTableName = $username.$tableName;
    
    $mysqli->query("INSERT INTO tablegenerator (tableName, userTableName, tableType, user) VALUES('$userTableName', '$tableName', '$tableType', '$username')") or die($mysqli->error);

    $mysqli->query("INSERT INTO other (color, title, tableName) VALUES('#FFFFFF', 'Title', '$userTableName')") or die($mysqli->error);
    
    header("location: ../tableMaker.php");
}

if (isset($_GET['delete'])){
    $tableName = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE tablegroup='$tableName'") or die($mysqli->error);

    $mysqli->query("DELETE FROM other WHERE tableName='$tableName'") or die($mysqli->error);

    $mysqli->query("DELETE FROM tablegenerator WHERE tableName='$tableName'") or die($mysqli->error);

    header("location: ../tableMaker.php");

}

?>