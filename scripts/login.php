<?php

if (isset($_POST["Enter"]))
{
    $username = $_POST["username"];
    $password = $_POST["pwd"];

    require_once "config.php";
    require_once "functions.php";

    if (emptyInputLogin($username, $password) !== false)
    {
        header("location: ../index-login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password);
}
else
{
    echo "initial POST didn't work";
    exit();
}
