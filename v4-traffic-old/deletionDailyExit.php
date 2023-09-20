<?php
include('session.php');
include('config.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
    // Create connection
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "TRUNCATE traffic_daily_exited";

    if ($conn->query($sql) === TRUE)
    {
        header("location: successDeleteDailyExitData.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
?>