<?php

session_start();

include 'conn.php';

$currentTableName = $_GET['currentTableName'];

if (isset($_POST['saveTitle'])) {
    $title = $_POST['title'];


    $mysqli->query("
    UPDATE other 
    SET title = '$title' 
    WHERE tableName = '$currentTableName'") or die($mysqli->error());

    $_SESSION['message'] = "Title has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php?currentTableName=$currentTableName");
}


?>