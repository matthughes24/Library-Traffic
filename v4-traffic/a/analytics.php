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
   </head>


<body>
<?php 
		$query = "SELECT role from FinalUserTable where username = '$userselect'"; 
        $ses_sql = mysqli_query($conn, $query); 
		$row = mysqli_fetch_assoc($ses_sql); 
		$num = $row['role'];
		$home = '';
		if ($num == 2) {
			$home = 'adminProfile.php';
		}
		else if($num == 1)
			{
			$home = 'profile.php';
		}
		else if($num == 3){
			$home = 'staffProfile.php';
		}
    ?>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
		<div class="container-fluid">
		<h3><a class="navbar-brand" href=<?php echo $home; ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
		<path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
		<path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
		</svg>
		<span style="color: #6699FF">Library</span>Traffic</a></h3>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		</div>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
				</li>

				<?php
				$query = "SELECT role from FinalUserTable where username = '$userselect'"; 
				$ses_sql = mysqli_query($conn, $query); 
				$row = mysqli_fetch_assoc($ses_sql); 
				$num = $row['role'];
				$output3 .= '<li class="nav-item"><a class="nav-link" href="loginPage.php">Login<span class="sr-only"></span></a></li>';
				if ($num == 1) {
					echo $output3;
				}
				else {
					echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout<span class="sr-only"></span></a></li>';
				}
				?>
			</ul>
		</div>
	</nav>

   <div id="profile"style = "height: 180px;">
      <h1 id="welcome">ADMIN DASHBOARD</h1>
      <h2>Welcome back, <i><?php echo "$login_session"; ?></i></h2>


      <hr>

<p> Analytics:
<p>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="graphDailyReport.php">View Graphs</a></button>
      <button class="button" id="predictTraffic"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="predictTraffic.php">Predict Traffic</a></button>
      <button class="button" id="visualizeData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="monitorTrafficSystem.php">Animation</a></button>
</p>     
      <hr>

<p>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogDaily.php">Daily Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogWeekly.php">Weekly Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogMonthly.php">Monthly Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogAnnually.php">Annual Traffic Log Report</a></button>
</p>
      <hr>
<p>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p1d.php">Advanced Daily Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p2w.php">Advanced Weekly Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p3m.php">Advanced Monthly Traffic Log Report</a></button>
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="p4a.php">Advanced Annual Traffic Log Report</a></button>
</p>

      <hr>
<p>
...
</p>

      <hr>
</body>

</html>