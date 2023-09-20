<?php
include('session.php');
include('config.php');

if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}

if (isset($_POST['submit']))
{ 
        $lastName = $_POST['choice'];
	

    	// Create connection
    	$conn = $link;
    	// Check connection
    	if ($conn->connect_error)
    	{
        	die("Connection failed: " . $conn->connect_error);
    	}

    	$sql = "UPDATE FinalUserTable SET role='2' WHERE lastname='$lastName'";

	if ($conn->query($sql) === TRUE)
    	{
        	header("location: successExistingUserToAdmin.php");
    	}
    	else
    	{
        	echo "Error: " . $sql . "<br>" . $conn->error;
    	} 
}
$conn->close();
?>
