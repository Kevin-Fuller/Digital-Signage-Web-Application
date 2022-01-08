<?php

session_start();

include 'conn.php';

$currentTableName = $_GET['currentTableName'];

if (isset($_POST['saveColor'])) {
    $color = $_POST['color'];


    $mysqli->query("
    UPDATE other 
    SET color = '$color' 
    WHERE tableName = '$currentTableName' ") or die($mysqli->error());

    $_SESSION['message'] = "Color has been saved! '$currentTableName'";
    $_SESSION['msg_type'] = "success";

    header("location: index.php?currentTableName=$currentTableName");
}


?>