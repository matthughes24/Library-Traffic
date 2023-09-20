<?php
error_reporting(0);
include('session.php');
include('redirectDeleteData.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<html>
  <head>
       <title>Delete Traffic Data</title>
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
		label, select {
			color: #FFFFFF;
			display: block;
			margin-top: 10px;
			margin-bottom: 10px;
			font-weight: 600;
			font-size: 20px;
		}
		select {
			background-color: #FFFFFF;
			border: none;
			border-radius: 5px;
			color: #0066CC;
			cursor: pointer;
			padding: 10px 20px;
			width: 100%;
		}
		input[type=text] {
			background-color: #FFFFFF;
			border: none;
			border-radius: 5px;
			color: #0066CC;
			padding: 10px;
			width: 100%;
		}
		input[type=submit] {
			background-color: #FFFFFF;
			border: none;
			border-radius: 5px;
			color: #0066CC;
			cursor: pointer;
			padding: 10px 20px;
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
		<h1>Select Data Table to Delete</h1>
        <form action="" method="POST">
			<label>Choose Entered or Exited</label>
			<select name="camera">
				<option value="1">Entered</option>
				<option value="2">Exited</option>
			</select>
 			
			<label>Choose the Periodicity</label>	
			<select name="choice">
				<option value="1">Daily</option>
				<option value="2">Weekly</option>
				<option value="3">Monthly</option>
				<option value="4">Annual</option>
			</select>
	  		<br>
  	  		<input name="submit" type="submit" value="Submit">
		</form>
	</div>
</body>
</html>