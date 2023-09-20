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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<link rel="stylesheet" media="screen" href="style.css">
  	<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
      <title>New Paltz Library Traffic</title>
      <link href="style.css" rel="stylesheet" type="text/css">
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
      <br>

			
	  <div class = "userButtons"style = "height: 70px; width: 890px;background-color: coral;border-radius: 25px;margin: auto;z-index: 1;">
	  <button class="button" id="deleteData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="cameraData.php">View Camera Data</a></button>
      <button class="button" id="showLogs" style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="trafficLogDaily.php">View Traffic Data</a></button>
      <button class="button" id="importExcel"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="importExcelMakeAChoice.php">Upload To Database</a></button>
      <button class="button" id="exportData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="exportDataMakeAChoice.php">Download from Database</a></button>
      <button class="button" id="deleteData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="warningDeleteData.php">Delete Traffic Data</a></button>
	  
	  
	  </div>
	  
	  <div class = "userButtons"style = "height: 70px; width: 500px;color: #6699FF;text-align:center;font-size: 34px;font-weight: 500;margin: auto;">Data Management
			</div>
			<div class = "userButtons"style = "height: 70px; width: 400px;background-color: coral;border-radius: 25px;margin: auto;z-index: 1; float:left;">
      <button class="button" id="viewGraph"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="graphDailyReport.php">View Graphs</a></button>
      <button class="button" id="predictTraffic"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="predictTraffic.php">Predict Traffic</a></button>
      <button class="button" id="visualizeData"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="monitorTrafficSystem.php">Animation</a></button>
	  <div class = "userButtons"style = "height: 70px; width: 300px;background-color: coral;border-radius: 25px;z-index: -1;">
			</div>
			<div class = "userButtons"style = "height: 70px; width: 400px;color: #6699FF;text-align:center;font-size: 34px;font-weight: 500;margin: auto;">Analytics
			</div>
	  </div>
	  
			<div class = "userButtons"style = "height: 70px; width: 400px;background-color: coral;border-radius: 25px;margin: auto;z-index: 1;float:right;">
      <button class="button" id="addAdmin" style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="addAdminMakeAChoice.php">Add Admin</a></button>
      <button class="button" id="changePassword"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="changePassword.php">Change Password</a></button>
      <button class="button" id="addAdmin"style="margin-top:+15px;margin-left: 20px;margin-right: 20px;"><a href="logout.php">Logout</a></button>
	  <div class = "userButtons"style = "height: 70px; width: 400px;background-color: coral;border-radius: 25px;">
			</div>
			<div class = "userButtons"style = "height: 70px; width: 425px;color: #6699FF;text-align:center;font-size: 34px;font-weight: 500;margin: auto;">User Management
			</div>
	  </div>
	  
			
   </div>
</body>

</html>