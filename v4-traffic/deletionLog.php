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

    $sql = "TRUNCATE traffic_daily";

    if ($conn->query($sql) === TRUE)
    {
        $myfile2 = fopen("uploads/s2-cameraIn.txt", "w") or die("Unable to open file!");
        $txt2 = "0";
        fwrite($myfile2, $txt2);
        fclose($myfile2);
        $myfile3 = fopen("uploads/s3-traffic.txt", "w") or die("Unable to open file!");
        $txt3 = "0";
        fwrite($myfile3, $txt3);
        fclose($myfile3);
        header("location: successDeleteLogData.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
?>
