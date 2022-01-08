<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="#">
        <input type="text" name="username" autocomplete="off" required>
        <input type="password" name="password" required>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>

<?php 
session_start();

include 'scripts/conn.php';


if (isset($_POST['username']) && isset($_POST['password'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $uName = validate($_POST['username']);
    $pWord = validate($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$uName' AND password = '$pWord'";
    $result = $mysqli->query($sql);

    if (empty($uName)) {
        //redirect home here
    } else if  (empty($pWord)) {
        //redirect home here
    } else {
        $sql = "SELECT * FROM users WHERE username='$uName' AND password = '$pWord'";
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) === 1) {
            $_SESSION['username'] = $uName;
            header("Location: tableMaker.php");
        } else {
            echo("incorrect login");
        }
    }




    $result=$mysqli->query($sql);

    if($result->fetch_assoc() == 1) {


    }
} else {

}
?>