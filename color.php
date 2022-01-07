<?php

include 'conn.php';

if (isset($_POST['saveColor'])) {
    $color = $_POST['color'];


    $mysqli->query("
    UPDATE other 
    SET color = '$color' 
    WHERE id=1") or die($mysqli->error());

    $_SESSION['message'] = "Color has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}


?>