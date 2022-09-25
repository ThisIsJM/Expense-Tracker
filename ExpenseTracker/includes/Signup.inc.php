<?php

//Checks if user clicked the submit Button
if(isset($_POST['signup-submit']))
{
    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['pwd'];
    $passwordConfirm = $_POST['pwd-confirm'];

    //Error Handlers
    if(empty($username) || empty($firstName) || empty($lastName) ||empty($password) || empty($passwordConfirm)) //Checks if a box is empty
    {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&firstName=".$firstName."&lastName=".$lastName);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)) // Checks if the username is valid
    {
        header("Location: ../signup.php?error=invaliduid&firstName=".$firstName."&lastName=".$lastName);
        exit();
    }
    else if($password !== $passwordConfirm) // Checks if pasword confirmation and password are not the same 
    {
        header("Location: ../signup.php?error=passwordunmatched&uid=".$username."&firstName=".$firstName."&lastName=".$lastName);
        exit();
    }
    else //Checks if username is already taken
    {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ../signup.php?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0)
            {
                header("Location: ../signup.php?error=uidTaken&firstName=".$firstName."&lastName=".$lastName);
                exit();
            }
            else
            {
                $sql = "INSERT INTO users (uidUsers, firstNameUsers, lastNameUsers, pwdUsers) VALUES (?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("Location: ../signup.php?error=sqlError");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss",$username, $firstName, $lastName, $hashedPwd );
                    mysqli_stmt_execute($stmt);

                    header("Location: ../login.php?signup=Success");
                    exit();
                }
            }
        }
    }
    //Closing mysqli
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
{
    header("Location: ../signup.php");
    exit();

}

?>