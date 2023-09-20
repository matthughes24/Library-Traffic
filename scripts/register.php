<?php

if (isset($_POST["Enter"]))
{
    $username = $_POST["username"];
    $password = $_POST["pwd"];
    $passwordRep = $_POST["pwdrep"];
    $email = $_POST["email"];

    require_once "config.php";
    require_once "functions.php";

    if (emptyInputSignup($username, $password, $passwordRep, $email) !== false)
    {
        header("location: ../index-register.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false)
    {
        header("location: ../index-register.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false)
    {
        header("location: ../index-register.php?error=invalidemail");
        exit();
    }
    if (passwordMatch($password, $passwordRep) !== false)
    {
        header("location: ../index-register.php?error=passwordsdontmatch");
        exit();
    }
    if (usernameExists($conn, $username, $email) !== false)
    {
        header("location: ../index-register.php?error=usernameexists");
        exit();
    }

    createUser($conn, $username, $password, $email);

}
else
{
    header("location: ../index-register.php");
    exit();
}
?>
