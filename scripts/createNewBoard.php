<?php 
include "conn.php";

session_start();



if (isset($_POST['submitNewTable'])) {
    $tableType = $_POST['type'];
    $tableName = $_POST['userTableName'];
    $username = $_SESSION['username'];
    $userTableName = $username.$tableName;
    


    $result = $mysqli->query("SELECT * from tablegenerator WHERE tableName = '$userTableName'");

    $row = mysqli_fetch_array($result);
    //if already in table: redirect user back with the error message
    if(is_null($row['tableName'])){

        //if tableName is empty dont add
        if($tableName === ""){
            $_SESSION['message'] = "The submitted name is empty!";
            $_SESSION['msg_type'] = "danger";
            header("location: ../tableMaker.php");
        } else {
    
        
            $mysqli->query("INSERT INTO tablegenerator (tableName, userTableName, tableType, user) VALUES('$userTableName', '$tableName', '$tableType', '$username')") or die($mysqli->error);

            $mysqli->query("INSERT INTO other (color, title, tableName) VALUES('#FFFFFF', 'Title', '$userTableName')") or die($mysqli->error);
            
            header("location: ../tableMaker.php");
        }
    } else {
        $_SESSION['message'] = "That name already exists.";
        $_SESSION['msg_type'] = "danger";
        header("location: ../tableMaker.php");
    }
}

if (isset($_GET['delete'])){
    $tableName = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE tablegroup='$tableName'") or die($mysqli->error);

    $mysqli->query("DELETE FROM other WHERE tableName='$tableName'") or die($mysqli->error);

    $mysqli->query("DELETE FROM tablegenerator WHERE tableName='$tableName'") or die($mysqli->error);


    unlink('../images/'.$tableName.'.jpg');
    unlink('../images/'.$tableName.'Overlay.jpg');

    header("location: ../tableMaker.php");

}

?>