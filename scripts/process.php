<?php



$id = 0;
$item = "";
$price = "";
$description = "";
$descriptionSubheader = "";
$descriptionItalics = "";
$update = false;
$updateSubheader = false;
$updateItalics = false;

include 'conn.php';

$currentTableName = $_GET['currentTableName'];

if (isset($_POST['save'])) {
    $itemName = $_POST['item'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $mysqli->query("INSERT INTO data (item, price, description, type, tableGroup) VALUES('$itemName', '$price', '$description', 'isItem', '$currentTableName')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php?currentTableName=$currentTableName");
}

if (isset($_POST['saveSubheader'])) {
    $description = $_POST['description'];

    $mysqli->query("INSERT INTO data (description, type, tableGroup) VALUES('$description', 'isSubheader','$currentTableName')") or die($mysqli->error());

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php?currentTableName=$currentTableName");
}

if (isset($_POST['saveItalics'])) {
    $description = $_POST['description'];

    $mysqli->query("INSERT INTO data (description, type, tableGroup) VALUES('$description', 'isItalics','$currentTableName')") or die($mysqli->error());

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php?currentTableName=$currentTableName");
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE from data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: ../index.php?currentTableName=$currentTableName");
}


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update=true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $row = $result->fetch_array();
    $item = $row['item'];
    $price = $row['price'];
    $description = $row['description'];  
}

if (isset($_GET['editSubheader'])){
    $id = $_GET['editSubheader'];
    $updateSubheader=true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $row = $result->fetch_array();
    $descriptionSubheader = $row['description'];  
}

if (isset($_GET['editItalics'])){
    $id = $_GET['editItalics'];
    $updateItalics=true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $row = $result->fetch_array();
    $descriptionItalics = $row['description'];  
}

if (isset($_GET['outstock'])){
    $id = $_GET['outstock'];
    $mysqli->query("UPDATE data SET inOutStock = 1 WHERE id=$id") or die($mysqli->error());

    header("location: ../index.php?currentTableName=$currentTableName");
}

if (isset($_GET['instock'])){
    $id = $_GET['instock'];
    $mysqli->query("UPDATE data SET inOutStock = 0 WHERE id=$id") or die($mysqli->error());

    header("location: ../index.php?currentTableName=$currentTableName");
}


if (isset($_POST['update'])){
    $id = $_POST['id'];
    $item = $_POST['item'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $mysqli->query("UPDATE data SET item='$item', price='$price', description='$description' WHERE id=$id") or die($mysqli->error());

    header("location: ../index.php?currentTableName=$currentTableName");
}



?>