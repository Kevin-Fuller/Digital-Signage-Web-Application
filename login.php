<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">

</head>
<body>
    <h1 class="title">Menu Maker</h1>
    <div class="shape1"></div>
    <div class="shape2"></div>
    <div class="triangle"></div>

    <div class="loginWrapper" id="loginWrap">
        <h1>Login</h1>
        <span class="line"></span>
        <form method="POST" action="#">
            <input id="uName" type="text" class="inputWords" name="username" autocomplete="off" placeholder="Username" required>
            <input id="pWord" type="password" class="inputWords" name="password" placeholder="Password" required>
            <input type="submit"  class="inputButton" name="submit" value="Login">
        </form>
        <button class="info" data-msg = "This web application allows for live-updating of digital menu boards. If you need a login, contact Kevin.">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <line x1="12" y1="8" x2="12.01" y2="8" />
            <polyline points="11 12 12 12 12 16 13 16" />
            </svg>
        </button>
        <button onclick="fillInformation()" id="demo">Demo Mode</button>
        <script>
            function fillInformation(){
                document.getElementById('uName').value="test1";
                document.getElementById('pWord').value="test2";
            }

            document.getElementById("demo").addEventListener("click", function() {
            document.getElementById("popup").classList.add("active");
            });

            function closePopup(){
                document.getElementById("popup").classList.remove("active");
            }



        </script>
    </div>

    <div id="popup">
        <button id="close" onclick="closePopup()">X</button>
        <h2>Warning</h2>
        <p>Demo mode is made to purely show off the application. Any information entered under the demo user account will automatically be reset the next time a user logs in.</p>
    </div>
    <p class="dev">Developed by <a href="https://kevinfuller.me" class="name" target="_blank">Kevin Fuller</p>
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