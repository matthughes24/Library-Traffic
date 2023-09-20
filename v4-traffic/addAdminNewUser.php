<?php
error_reporting(0);
include('session.php');
include('registerAdmin.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<html>
   <head>
      <title>Register A New Admin</title> 
   </head> 

   <body>
      <p>Please enter information to register a new admin: </p>
      <h4>(Keep in mind that the password you set will be temporary and can be changed later)</h4>
      <form action="" method="post">
         Username: <input type="text" name="firstname" required>
         <p>
         Password: <input type="text" name="password" required>
         <p>
         <input type="submit" name="submit" value="Submit">
      </form>
     
      <div style = "font-size:11px; color:#cc0000; margin-top:10px">
	      <?php echo $error; ?>
      </div> 
   </body>
</html>