<?php
error_reporting(0);
include('login.php'); // Includes Login Script

?>
<html>
	

<head>
    <title> Library Traffic Camera Data </title>
    <link href="style.css" rel="stylesheet" type="text/css">
	<li class="button"><a class="nav-link" href="predictTraffic.php">Home</a></li>
</head>


<body>


	
  <div id="login">
	  	<br>
      	<h1 style="text-align:center" id="loginFont">Login</h1>
	  	<br><br>	
    	<form action="" method="post">
	   	<p id="loginFont" style="font-size:20px;">Username
    	   <input id="name" type="text" name="username" placeholder="Enter your username" required>
	   	<p id="loginFont" style="font-size:20px;">Password
           <input id="password" type="password" name="password" placeholder="Enter your password" required>
	   	<p>
    	   <input id="submit" name="submit" type="submit" value="Login">
		</form>

	<div style="font-size:16px; color:#cc0000; margin-top:10px">
	   <?php echo $error; 
	   ?>
	</div>
  </div>
</body>



</html>