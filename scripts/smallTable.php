<?php
session_start();

include 'conn.php';

$currentUserOnline = $_SESSION['username'];
$currentTableName = $_GET['currentTableName'];

if (isset($_POST['createNew2Table'])) {

    $name = $_POST['newTableName'];
    $newName = $name.$currentUserOnline;

    $mysqli->query("INSERT INTO data (item, price, description, type, tableGroup) VALUES('', '', '$newName', 'isTable', '$currentTableName')") or die($mysqli->error);

    header("location: ../index.php?currentTableName=$currentTableName");
    
}

if (isset($_POST['update2Table'])) {
    $id = $_POST['id'];
    $tLeft = $_POST['tLeft'];
    $tRight = $_POST['tRight'];
    $editTable = $_POST['editTable'];
    $mysqli->query("UPDATE smalltables SET tableLeft = '$tLeft', tableRight = '$tRight' WHERE id=$id") or die($mysqli->error());
    header("location: ../index.php?currentTableName=$currentTableName&editTable=$editTable");
}

if (isset($_POST['add2Table'])) {
    $tLeft = $_POST['tLeft'];
    $tRight = $_POST['tRight'];
    $editTable = $_POST['editTable'];
    $mysqli->query("INSERT INTO smalltables (tableLeft, tableRight, tableAssociatedName) VALUES('$tLeft', '$tRight', '$editTable')") or die($mysqli->error);


    header("location: ../index.php?currentTableName=$currentTableName&editTable=$editTable");
}
?>