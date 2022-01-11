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
        <button id="demo">Demo Mode</button>

    </div>

    <div id="popup">
        <button id="close" onclick="closePopup()">X</button>
        <div class="firstCollection">
        <h2>Warning</h2>
        <p>Demo mode is made to purely show off the application to other developers. Any information entered under the demo user account will automatically be reset the next time a user logs in.</p>
        </div>
        <div class="secondCollection">
        <h4>Ways to test the app:</h4>
        <ul>
            <li>Create a new menu board</li>
            <li>Delete an existing menu board</li>
            <li>Edit a menu board</li>
            <li>Add a new item to a menu board</li>
            <li>Modify an item on a menu board</li>
            <li>Change the color of the menu board</li>
            <li>Change an item to out of stock</li>
            <li>Preview the Menu Board</li>
            <li>Try accessing the app from a non-logged in account</li>
            <li>Log out of the app</li>
        </ul>
        <div class="buttonContainerDemo">
            <button class="demoAccount" id="ac1" onclick="fillInformation1()">Account 1</button>
            <button class="demoAccount" class="demoAccount2" id="ac2" onclick="fillInformation2()">Account 2</button>
        </div>
        </div>
    </div>
    <p class="dev">Developed by <a href="https://kevinfuller.me" class="name" target="_blank">Kevin Fuller</p>


    <script>
            function fillInformation1(){
                document.getElementById('uName').value="DemoUser1";
                document.getElementById('pWord').value="demopassword1";
                closePopup();
            }

            function fillInformation2(){
                document.getElementById('uName').value="DemoUser2";
                document.getElementById('pWord').value="demopassword2";
                closePopup();
            }

            document.getElementById("demo").addEventListener("click", function() {
            document.getElementById("popup").classList.add("active");
            });

            function closePopup(){
                document.getElementById("popup").classList.remove("active");
            }





    </script>

</body>
</html>

<?php 
session_start();

include 'scripts/conn.php';

include 'scripts/resetDemoUsers.php';

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