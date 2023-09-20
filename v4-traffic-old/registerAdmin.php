<?php
include('session.php');
include('config.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
if (isset($_POST['submit']))
{ 
  if (empty($_POST['username']) || empty($_POST['password']))
  { 
    $error = "Please fill in all forms";
  } 
  else
  { 
    // Define variables sent from the form
    //Setting Role to 2 will grant the Admin access
    $Role = "2";
    //$Role = mysql_real_escape_string($Role);
    $Password = $_POST['password'];
    $Firstname = $_POST['username'];


    // Create connection
    $conn = $link;
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO FinalUserTable (role, password, firstname) VALUES ('$Role', '$Password', '$Firstname')";

    if ($conn->query($sql) === TRUE)
    {
        header("location: successfullyRegisteredAdmin.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
  }
}
?>
