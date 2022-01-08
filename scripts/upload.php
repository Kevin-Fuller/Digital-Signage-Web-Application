<?php
session_start();

$currentTableName = $_GET['currentTableName'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                if ($fileActualExt === "png") {
                    echo("ADD PNG CONVERSIONS LATER");
                } else {
                    $fileNameNew = "backdropImage".".".$fileActualExt;
                    $fileDestination = "../images/".$fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    $_SESSION['message'] = "Image has been uploaded!";
                    $_SESSION['msg_type'] = "success";

                    header("Location: ../index.php?currentTableName=$currentTableName");
                }
            } else {
                $_SESSION['message'] = "Your file is too big!";
                $_SESSION['msg_type'] = "danger";

                header("Location: ../index.php?currentTableName=$currentTableName");

            }
        } else {
            $_SESSION['message'] = "There was an error uploading your file!";
            $_SESSION['msg_type'] = "danger";

            header("Location: ../index.php?currentTableName=$currentTableName");
        }
    } else {
        $_SESSION['message'] = "You cannot upload files of this type!";
        $_SESSION['msg_type'] = "danger";

        header("Location: ../index.php?currentTableName=$currentTableName");
    }
}


?>