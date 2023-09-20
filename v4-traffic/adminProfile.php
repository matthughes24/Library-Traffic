<?php
error_reporting(0);
include('session.php'); 
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
	<style>
		.container {
			width: 1000px;
			font-family: 'Poppins', sans-serif;
			margin: 0 auto;
			background-color: #003e7e;
			border-radius: 20px;
			padding: 20px;
			color: white;
			box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
		}

		.container h1 {
			text-align: center;
			font-size: 35px;
			margin-bottom: 20px;
		}

		.container p {
			margin-bottom: 10px;
			font-size: 25px;
			font-weight: 500;
		}

		.container button {
			margin: 5px;
			padding: 10px 20px;
			background-color: #f58426;
			border: none;
			border-radius: 10px;
			text-decoration: none;
		}

		.container button a {
			text-decoration: none;
			color: white;
			font-size: 20px;
		}
	</style>
</head>
<body style="background-image: url('https://www.newpaltz.edu/media/ocm/images/blue-repeat-logo.png'); background-size: cover;">
	<?php 
		include('navbar.php');
	?>
	<br>
	<div class="container">
		<h1>ADMIN DASHBOARD</h1>
		<h1 style="font-size: 30px;">Welcome back, <i style="color: #f58426;"><?php echo "$login_session"; ?></i></h1>
		<br>
		<p>User Management</p>
		<button><a href="addAdminMakeAChoice.php">Add Admin</a></button>
		<button><a href="changePassword.php">Change Password</a></button>
		<button><a href="logout.php">Logout</a></button>
		<br><br>
		<p>Website Data Management</p>
		<button><a href="importExcelMakeAChoice.php">Upload to Database</a></button>
		<button><a href="exportDataMakeAChoice.php">Download from Database</a></button>
		<button><a href="warningDeleteData.php">Delete Traffic Data</a></button>		
		<br><br>
		<p>Camera Data Management</p>
		<button><a href="cameraData.php">View Camera Data</a></button>
		<button><a href="cameraDataTransfer.php">Transfer Camera Data</a></button>
		<button><a href="cameraDataViewTransferred.php">See Transferred Data</a></button>		
		<br><br>
		<p>Analytics</p>
		<button><a href="graphDailyReport.php">View Graphs</a></button>
		<button><a href="predictTraffic.php">Predict Traffic</a></button>
		<button><a href="monitorTrafficSystem.php">Animation</a></button>
		<button><a href="trafficLogDaily.php">Daily Traffic Log Report</a></button>
		<button><a href="trafficLogWeekly.php">Weekly Traffic Log Report</a></button>
		<button><a href="trafficLogMonthly.php">Monthly Traffic Log Report</a></button>
		<button><a href="trafficLogAnnually.php">Annual Traffic Log Report</a></button>
	</div>
</body>
</html>