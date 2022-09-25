<?php
$currentPage = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Comptabile" content="ie=edge">
        <link rel="stylesheet" href="HeaderStyle.css">
        <header>
            <nav>
            <?php
                if(isset($_SESSION['userId']))
                {
                    $home = '';
                    $profile = '';

                    if($currentPage == 'Home')
                    {
                        $home = 'current';
                    }
                    else
                    {
                        $profile = 'current';
                    }
                    echo'
                    <form action = "includes/logout.inc.php" method = "post">
                        <a href=Home.php class=' .$home.'> HOME</a>
                        <a href=Profile.php class=' .$profile.'> PROFILE</a>
                        <button type="submit" name="logout-submit">LOGOUT
                            <ion-icon name="exit-outline"></ion-icon>
                        </button>
                    </form>';           
                }
                else
                {
                    $login = '';
                    $signup = '';
                    $about = '';
                    if($currentPage == 'Login')
                    {
                        $login = 'current';
                    }
                    else if($currentPage == 'Signup')
                    {
                        $signup = 'current';
                    }
                    else
                    {
                        $about = 'current';
                    }
                    echo'
                    <a href=About.php class=' .$about.'> ABOUT</a>
                    <a href=Login.php class=' .$login.'> LOGIN</a>
                    <a href=Signup.php class=' .$signup.'> SIGNUP</a>';
                }
                
                ?>
            </nav>
            <!-- Ionicon Script Reference-->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        </header>
    </head>
    <body></body>

          
</html>