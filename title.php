<?php

session_start();

include 'conn.php';

if (isset($_POST['saveTitle'])) {
    $title = $_POST['title'];


    $mysqli->query("
    UPDATE other 
    SET color = '$title' 
    WHERE id=1") or die($mysqli->error());

    $_SESSION['message'] = "Title has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}


?>