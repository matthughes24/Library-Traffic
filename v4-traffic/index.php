<?php
error_reporting(0);
include('session.php');
include('config.php');
$username = 'camuserlow';
$password = 'cam2';
$_SESSION['login_user'] = $username; // Initializing Session
// Create connection
$conn = $link;
header("Location: predictTraffic.php");
?>