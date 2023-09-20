<?php
include('session.php');
include('config.php');

if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
if (isset($_POST['submit']))
{ 
  if (empty($_POST['email']) || empty($_POST['newPassword']))
  { 
    $error = "Please fill in all forms";
  } 
  else
  { 
    // Define variables sent from the form
    $email = mysql_real_escape_string($_POST['email']);
    $newPassword = mysql_real_escape_string($_POST['newPassword']);

    // Create connection
    $conn = $link;
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "UPDATE FinalUserTable SET password='$newPassword' WHERE email='$email'";

    if ($conn->query($sql) === TRUE)
    {
        header("location: successChangeOtherUserPassword.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
  }
}
?>
