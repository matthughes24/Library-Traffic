<?php
include('session.php');
include('config.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}

    // Create connection
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "TRUNCATE traffic_weekly";

    if ($conn->query($sql) === TRUE)
    {
        header("location: successDeleteClassData.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
?>
