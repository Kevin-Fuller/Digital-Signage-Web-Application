<?php
$currentTableName = $_GET['currentTableName'];
$toggle = $_GET['toggle'];

include('conn.php');

    if($toggle === "on") {
    $mysqli->query("UPDATE `other` SET `imageToggledOnOff` = '1' WHERE `other`.`tableName` = '$currentTableName';");

    header("location: ../index.php?currentTableName=$currentTableName");
    } else {
        $mysqli->query("UPDATE `other` SET `imageToggledOnOff` = '0' WHERE `other`.`tableName` = '$currentTableName';");

    header("location: ../index.php?currentTableName=$currentTableName");
    }


?>