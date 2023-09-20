<?php

function emptyInputSignup($username, $password, $passwordRep, $email)
{
    $result;

    if (empty($username) || empty($password) || empty($passwordRep) || empty($email))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalidUsername($username)
{
    $result;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passwordRep)
{
    $result;

    if ($password !== $passwordRep)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index-register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $password, $email)
{
    $admin = 0;
    $sql = "INSERT INTO users (username, email, pwd, admin) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index-register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $admin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index-register.php?error=none");
    exit();
}

function loginUser($conn, $username, $password)
{
    $usernameExists = usernameExists($conn, $username, $username);

    if ($usernameExists === false)
    {
        header("location: ../index-login.php?error=invalidcreds");
        exit();
    }

    $passwordHashed = $usernameExists["pwd"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false)
    {
        echo "WrongLogin";
        exit();
    }
    else if($checkPassword === true)
    {
        session_start();
        $_SESSION["userID"] = $usernameExists["ID"];
        $_SESSION["userName"] = $usernameExists["username"];
        $_SESSION["userEmail"] = $usernameExists["email"];
        $_SESSION["userAdmin"] = $usernameExists["admin"];
        
        //echo "ID: " . $_SESSION["userID"];
        //echo "Username: " . $_SESSION["userName"];
        //echo "Email: " . $_SESSION["userEmail"];
        //echo "Admin: " . $_SESSION["userAdmin"];

        header("location: ../index.php");
        exit();
        
    }
}

function emptyInputLogin($username, $password)
{
    $result;

    if (empty($username) || empty($password))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
?>
