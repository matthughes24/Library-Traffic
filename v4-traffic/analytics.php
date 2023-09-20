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
	<title>Analytics Dashboard</title>
	<style>
		.container {
			width: 1000px;
			display: block;
			overflow: auto;
			font-family: 'Poppins', sans-serif;
			margin: 0 auto;
			background-color: #003e7e;
			border-radius: 20px;
			box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
			padding: 20px;
			color: white;
		}

		.container h1 {
			text-align: center;
			font-size: 35px;
			margin-bottom: 20px;
		}

		.container p {
			font-size: 25px;
			font-weight: 500;
		}

		.container button {
			margin: 5px;		
			background-color: #f58426;
			border: none;
			border-radius: 10px;
			text-decoration: none;
		}

		.container button a {
			padding: 10px;
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
		<h1>ANALYTICS DASHBOARD</h1>
		<p>ANALYTICS</p>
		<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="graphDailyReport.php">View Graphs</a></button>
		<button class="button" id="predictTraffic"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="predictTraffic.php">Predict Traffic</a></button>
		<button class="button" id="visualizeData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="monitorTrafficSystem.php">Animation</a></button>
		<br><br><br><br>
		<p>OLD FILTERING (MOCK DATA)</p>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogDaily.php">Daily Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogWeekly.php">Weekly Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogMonthly.php">Monthly Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogAnnually.php">Annual Traffic Log Report</a></button>
		<br><br><br><br><br><br><br>
		<p>BASIC FILTERING (REAL DATA)</p>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogDaily.php">Daily Traffic Log Report (same hour period, all dates)</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogWeekly.php">Weekly Traffic Log Report (Choose first day, see 7 days)</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogMonthly.php">Monthly Traffic Log Report (Choose month and year)</a></button>
	  	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogAnnually.php">Annually Traffic Log Report (Choose year)</a></button>
		<br><br><br><br><br><br><br><br><br><br><br><br><br>
		<p>ADVANCED FILTERING (REAL DATA)</p>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p1d.php">Advanced Daily Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p2w.php">Advanced Weekly Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p3m.php">Advanced Monthly Traffic Log Report</a></button>
		<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p4a.php">Advanced Annual Traffic Log Report</a></button>
		<br><br><br><br><br><br><br>
		<p>NEW FILTERING (MOCK DATA)</p>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p11d.php">Advanced Daily Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p12w.php">Advanced Weekly Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p13m.php">Advanced Monthly Traffic Log Report</a></button>
      	<button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p14a.php">Advanced Annual Traffic Log Report</a></button>
	</div>
	<br>
</body>
</html>