<?php
$myfile = fopen("uploads/s1-camera.txt", "w") or die("Unable to open file!");
$txt = "0";
fwrite($myfile, $txt);
fclose($myfile);
error_reporting(0);
session_start(); 
if(session_destroy()) // Destroying All Sessions { 
  header("location: index.php"); // Redirecting To Home Page }
?>