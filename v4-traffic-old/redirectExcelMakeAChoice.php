<?php
include('session.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
if (isset($_POST['submit']))
{ 
    $cameraOption = $_POST['camera'];
    if ($cameraOption == 1)
    {
	header("location: importExcelUsers.php"); 
    }
    elseif($cameraOption == 2)
    {
    header("location: importExcelDailyExit.php");
    }
}
$conn->close();
?>