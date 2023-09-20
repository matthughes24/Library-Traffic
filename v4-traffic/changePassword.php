<?php
error_reporting(0);
include('session.php');
include('redirectChangePassword.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<html>
  <head>
       <title>Change Password</title>
	   <style>
		#container {
			background-color: #003e7e;
			border-radius: 20px;
			margin: 0 auto;
			margin-top: 20px;
			padding: 20px;
			width: 1000px;
		}

		h1 {
			color: #FFFFFF;
			text-align: center;
		}

		form {
			margin-top: 20px;
		}

		label {
			color: #FFFFFF;
			display: block;
			margin-top: 10px;
			margin-bottom: 10px;
			font-weight: 600;
			font-size: 20px;
		}

		input[type="radio"],
		input[type="checkbox"] {
			display: inline-block;
			vertical-align: middle;
			margin-right: 5px;
		}

		input[type="submit"] {
			background-color: #FFFFFF;
			border: none;
			border-radius: 5px;
			color: #0066CC;
			cursor: pointer;
			padding: 10px 20px;
			margin-top: 10px;
		}

		#show_name {
			color: #FFFFFF;
			text-align: center;
		}
	</style>
  </head>
  <body style="background-image: url('https://www.newpaltz.edu/media/ocm/images/blue-repeat-logo.png'); background-size: cover;">
  <?php 
        include 'navbar.php';
        include 'sidebar.php';
    ?>
	<div id="container">
		<h1>Change Your Own Password or Someone Else's Password</h1>
        <form action="" method="post">
			<label><input type="radio" name="choice" value="1" checked>My own password</label>
			<label><input type="radio" name="choice" value="2">Someone else's password</label>
			<br>
			<input name="submit" type="submit" value="Submit">
		</form>
	</div>	 
</body>
</html>