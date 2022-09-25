<?php
//session_start();

require "Header.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Comptabile" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="LoginStyle.css">
    </head>

    <body>
        <h1> ACCOUNT LOGIN</h1>
        <main>
            <!-- Login Form -->
            <form action = "includes/login.inc.php" method = "post" class = LoginForm>
                <input type = "text" name = "uid" placeholder="Username" class = LoginElement>
                <br>
                <input type = "password" name = "pwd" placeholder="Password" class = LoginElement>
                <br><button type = "submit" name ="login-submit" class= LoginElement>LOGIN</button>
            </form>
            <a href="signup.php"><center> Not yet a user? Sign up</center> </a>
            <!--Logout Form -->

        </main>
    </body>
</html>