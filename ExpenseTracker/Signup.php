<?php
require "Header.php";
?>
<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="SignupStyle.css">
</head>
<body>
    <h1>ACCOUNT REGISTRATION</h1>
    <main>
            <form action = "includes/Signup.inc.php" method = "post" class = SignupForm>
            <input type = "text" name = "firstName" placeholder = "First Name" class = NameElement></input>
            <input type = "text" name = "lastName" placeholder = "Last Name" class = NameElement></input>
            <br>
            <input type = "text" name = "uid" placeholder = "Username" class = SignupElement></input>
            <input type = "password" name = "pwd" placeholder = "Password" class = SignupElement></input>
            <input type = "password" name = "pwd-confirm" placeholder = "Confirm Password" class = SignupElement></input>
            <button type = "submit" name = "signup-submit" class = SignupElement>SIGN UP </button>                 </form>
            <a href="Login.php"><center> Already have an account?</center> </a>
    </main>
</body>
<?php
require "footer.php"
?>