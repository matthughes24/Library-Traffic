<?php
include('config.php');
	error_reporting(0);
	include('login.php');
	include('session.php');

	if (!isset($_SESSION['login_user'])) { 
		header("location: index.php"); // Redirecting To Home Page 
	}

	// Create connection
	$conn = $link;
	$userselect= $_SESSION['login_user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Predict Traffic</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<link rel="stylesheet" media="screen" href="style.css">
  	<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
</head>
<body>
	<!-- TOP NAV BAR -->
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
		/*
		$queryDelete = "DELETE FROM cam_enter WHERE date = 'Enter_Date_Here'";
		$delete = mysqli_query($conn, $queryDelete);
		*/
    ?>

	
	<!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
		<div class="container-fluid">
		<h3><a class="navbar-brand" href=<?php echo $home; ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
		<path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
		<path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
		</svg>
		<span style="color: #6699FF">Library</span>Traffic</a></h3>
		<div class="p-3 mb-2 text-white text-start float-left">
		<h2>
			
		<div id="date-time"></div>
		</h2>
		</div>
		<script>
			const zeroFill = n => {
				return ('0' + n).slice(-2);
			}
			const interval = setInterval(() => {
				const now = new Date();
				const dateTime = dayOfWeek+ '    '+zeroFill((now.getMonth() + 1)) 
				+ '/' + zeroFill(now.getUTCDate()) 
				+ '/' + now.getFullYear() + ' ' 
				+ zeroFill(now.getHours()) + ':' 
				+ zeroFill(now.getMinutes()) + ':' 
				+ zeroFill(now.getSeconds());
				document.getElementById('date-time').innerHTML = dateTime;
			}, 1000);
		</script>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		</div>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href=<?php echo $home; ?>>Home <span class="sr-only">(current)</span></a>
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
	</nav> -->
	
			<div style = "color: #6699FF;text-align:center;font-size: 52px;font-weight: 500;">Current Library Traffic</div>	
		<div id="date-time"></div>
	<br>
	
	<!-- GAUGE CHART -->
	<div class="container-fluid">
	<div id='gaugeChart'><a class="zc-ref" href="http://zingchart.com"></a></div>

	<script>
	</script>
	<!-- OTHER CHARTS -->



</script>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);
		window.feed = function(callback) {
		var tick = {};
		//tick.plot0 selects a random value for the gauge.. just for simulation.
		//tick.plot0 = Math.ceil(15 + Math.random() * 165);
		callback(JSON.stringify(tick));
		
		};

		// function grabCurrent() {
		// 	<?php
		// 		$sql = "SELECT * FROM traffic_daily"; 
		// 		//TODO: new sql to select from daily exited table
		// 		//select * from exited;
		// 		$result = mysqli_query($conn,$sql); 
		// 		date_default_timezone_set('US/Eastern');
		// 		$hourOfDay = Date('H'); 
		// 		$resultHour = 0;
		// 		$totalPeople = 0;
		// 		while($row = mysqli_fetch_array($result)) {
		// 			$totalPeople += ((int)$row['PeopleEntered']);
		// 			$resultHour = substr((int)$row['TimeEntered'], 0, 2); 
		// 			if ($resultHour == $hourOfDay) {
		// 				$numInside = ((int)$row['PeopleEntered']);
		// 			}
		// 		}	
		// 	?>
		// }
		function predTraffic() {
			<?php
				$sql = "SELECT * FROM cam_enter"; 
				$result = mysqli_query($conn,$sql); 
				date_default_timezone_set('US/Eastern');
				$hourOfDay =  Date('H'); 
				$resultHour = 0;
				$totalPeople = 0;
				$days = 0;
				$average = 0;
				$dayOfWeek = date("l");
				while($row = mysqli_fetch_array($result)) {
					$totalPeople += ((int)$row['enter']);
					$resultHour = substr($row['time'], 0, 2); 
					$resultDay = substr($row['date'], 3, 2); 
					$resultMonth = substr($row['date'], 0, 2); 
					$resultYear = substr($row['date'], 6, 9); 
					//10/31/2022
					//0123456789
					$resultDate = date("l", mktime(0,0,0,$resultMonth,$resultDay,$resultYear));
					
					if ($resultHour == $hourOfDay && $resultDate == $dayOfWeek) {
						$numInside += ((int)$row['enter']);
						$days += 1;
					}
				}	
				$average = ($numInside/$days)
			?>
		}
		
		var totalPeople = "<?php echo $totalPeople; ?>";
		var resultHour = "<?php echo $resultHour; ?>";
		var hourOfDay = "<?php echo $hourOfDay; ?>";
		var numInside = "<?php echo $numInside; ?>";
		var average = "<?php echo $average; ?>";
		var dayOfWeek = "";
		var dayOfWeekFromPhp = "<?php echo $resultDate; ?>";
		
   				window.onload = predTraffic();
				
				const d = new Date();
				let day = d.getDay();
				if(day == 0){
					dayOfWeek = "Sunday";
				}
				if(day == 1){
					dayOfWeek = "Monday";
				}
				if(day == 2){
					dayOfWeek = "Tuesday";
				}
				if(day == 3){
					dayOfWeek = "Wednesday";
				}
				if(day == 4){
					dayOfWeek = "Thursday";
				}
				if(day == 5){
					dayOfWeek = "Friday";
				}
				if(day == 6){
					dayOfWeek = "Saturday";
				}
				console.log('day of week from php (should be last day on mysql table): ' + dayOfWeekFromPhp);
				console.log('day of week: '+ dayOfWeek);
				console.log('RESULT HOUR' +resultHour);
				console.log('hour'+hourOfDay);
				console.log('total People inside' +totalPeople);
				console.log('TOTAL INSIDE BASED ON HOUR: ' +numInside);
				console.log('average of that total: ' +average);
		var myConfig = {
		type: "gauge",
		globals: {
			fontSize: 20
		},
		plotarea: {
			marginTop: 35
		},
		plot: {
			size: '100%',
			valueBox: {
			placement: 'center',
			text: '%v', //default
			fontSize: 35,
			rules: [{
				rule: '%v >= 144 && %v <= 180',
				text: 'Very Busy'
				},
				{
				rule: '%v >= 108 && %v < 144',
				text: 'Busy'
				},
				{
				rule: '%v >= 36 && %v < 108',
				text: 'Average'
				},
				{
				rule: '%v < 36 && %v > 0',
				text:'Slow'
				},
				{
				rule: '%v == 0',
				text: 'Zero Traffic'
				}
			]}
		},
		
		tooltip: {
			borderRadius: 5
		},
		scaleR: {
			aperture: 180,
			minValue: 0,
			maxValue: 180,
			step: 36,
			center: {
			visible: false
			},
			tick: {
			visible: false
			},
			item: {
			offsetR: 0,
			rules: [{
				rule: '%i == 9',
				offsetX: 15
			}]
			},
			labels: ['Min', '', '', '', '', 'Max'],
			ring: {
			size: 75,
			rules: [{
				rule: '%v < 30',
				backgroundColor: 'limegreen'
				},
				{
				rule: '%v >= 30 && %v < 60',
				backgroundColor: 'lightgreen'
				},
				{
				rule: '%v >= 60 && %v < 90',
				backgroundColor: 'yellow'
				},
				{
				rule: '%v >= 90 && %v < 120',
				backgroundColor: 'orange'
				},
				{
				rule: '%v > 120 && %v <= 150',
				backgroundColor: 'red'
				}
			]}
		},
		// refresh: {
		// 	type: "feed",
		// 	transport: "js",
		// 	url: "feed()",
		// 	interval: 1800000,
		// },
		
		series: [{
			values: [parseInt(average)], // starting value
			backgroundColor: 'royalblue',
			indicator: [10, 10, 10, 10, 0.55],
			animation: {
			effect: 2,
			method: 1,
			sequence: 4,
			speed: 900
			},
		}]
		};
		
		zingchart.render({
		id: 'gaugeChart',
		data: myConfig,
		height: 500,
		width: '100%'
		});


		function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Day of the Week', 'People Entered'],
			<?php
			$sql = "SELECT * FROM cam_enter"; 
			$result = mysqli_query($conn,$sql);
			$totalPeople = 0;
			$average = 0;

			
			$h0 = 0;
			$h1 = 0;
			$h2 = 0;
			$h3 = 0;
			$h4 = 0;
			$h5 = 0;
			$h6 = 0;
			$h7 = 0;
			$h8 = 0;
			$h9 = 0;
			$h10 = 0;
			$h11 = 0;
			$h12 = 0;
			$h13 = 0;
			$h14 = 0;
			$h15 = 0;
			$h16 = 0;
			$h17 = 0;
			$h18 = 0;
			$h19 = 0;
			$h20 = 0;
			$h21 = 0;
			$h22 = 0;
			$h23 = 0;


			$avg0 = 0;
			$avg1 = 0;
			$avg2 = 0;
			$avg3 = 0;
			$avg4 = 0;
			$avg5 = 0;
			$avg6 = 0;
			$avg7 = 0;
			$avg8 = 0;
			$avg9 = 0;
			$avg10 = 0;
			$avg11 = 0;
			$avg12 = 0;
			$avg13 = 0;
			$avg14 = 0;
			$avg15 = 0;
			$avg16 = 0;
			$avg17 = 0;
			$avg18 = 0;
			$avg19 = 0;
			$avg20 = 0;
			$avg21 = 0;
			$avg22 = 0;
			$avg23 = 0;


			while($row = mysqli_fetch_array($result)) {
				
				$totalPeople += ((int)$row['enter']);
				$resultHour = substr($row['time'], 0, 2); 
				$resultDay = substr($row['date'], 3, 2); 
				$resultMonth = substr($row['date'], 0, 2); 
				$resultYear = substr($row['date'], 6, 9); 

				$resultDate = date("l", mktime(0,0,0,$resultMonth,$resultDay,$resultYear));
				
				if ($resultHour == 00) {
					$h0 += ((int)$row['enter']);
					$avg0 += 1;
				}
				else if($resultHour == 1){
					$h1 += ((int)$row['enter']);
					$avg1 += 1;
				}
				else if($resultHour == 2){
					$h2 += ((int)$row['enter']);
					$avg2 += 1;
				}
				else if($resultHour == 3){
					$h3 += ((int)$row['enter']);
					$avg3 += 1;
				}
				else if($resultHour == 4){
					$h4 += ((int)$row['enter']);
					$avg4 += 1;
				}
				else if($resultHour == 5){
					$h5 += ((int)$row['enter']);
					$avg5 += 1;
				}
				else if($resultHour == 6){
					$h6 += ((int)$row['enter']);
					$avg6 += 1;
				}
				else if($resultHour == 7){
					$h7 += ((int)$row['enter']);
					$avg7 += 1;
				}
				else if($resultHour == 8){
					$h8 += ((int)$row['enter']);
					$avg8 += 1;
				}
				else if($resultHour == 9){
					$h9 += ((int)$row['enter']);
					$avg9 += 1;
				}
				else if($resultHour == 10){
					$h10 += ((int)$row['enter']);
					$avg10 += 1;
				}
				else if($resultHour == 11){
					$h11 += ((int)$row['enter']);
					$avg11 += 1;
				}
				else if($resultHour == 12){
					$h12 += ((int)$row['enter']);
					$avg12 += 1;
				}
				else if($resultHour == 13){
					$h13 += ((int)$row['enter']);
					$avg13 += 1;
				}
				else if($resultHour == 14){
					$h14 += ((int)$row['enter']);
					$avg14 += 1;
				}
				else if($resultHour == 15){
					$h15 += ((int)$row['enter']);
					$avg15 += 1;
				}
				else if($resultHour == 16){
					$h16 += ((int)$row['enter']);
					$avg16 += 1;
				}
				else if($resultHour == 17){
					$h17 += ((int)$row['enter']);
					$avg17 += 1;
				}
				else if($resultHour == 18){
					$h18 += ((int)$row['enter']);
					$avg18 += 1;
				}
				else if($resultHour == 19){
					$h19 += ((int)$row['enter']);
					$avg19 += 1;
				}
				else if($resultHour == 20){
					$h20 += ((int)$row['enter']);
					$avg20 += 1;
				}
				else if($resultHour == 21){
					$h21 += ((int)$row['enter']);
					$avg21 += 1;
				}
				else if($resultHour == 22){
					$h22 += ((int)$row['enter']);
					$avg22 += 1;
				}
				else if($resultHour == 23){
					$h23 += ((int)$row['enter']);
					$avg23 += 1;
				}

			}	
			$h0 = ($h0/$avg0);
			$h1 = ($h1/$avg1);
			$h2 = ($h2/$avg2);
			$h3 = ($h3/$avg3);
			$h4 = ($h4/$avg4);
			$h5 = ($h5/$avg5);
			$h6 = ($h6/$avg6);
			$h7 = ($h7/$avg7);
			$h8 = ($h8/$avg8);
			$h9 = ($h9/$avg9);
			$h10 = ($h10/$avg10);
			$h11 = ($h11/$avg11);
			$h12 = ($h12/$avg12);
			$h13 = ($h13/$avg13);
			$h14 = ($h14/$avg14);
			$h15 = ($h15/$avg15);
			$h16 = ($h16/$avg16);
			$h17 = ($h17/$avg17);
			$h18 = ($h18/$avg18);
			$h19 = ($h19/$avg19);
			$h20 = ($h20/$avg20);
			$h21 = ($h21/$avg21);
			$h22 = ($h22/$avg22);
			$h23 = ($h23/$avg23);
			
			$sql0 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h0' WHERE `traffic_daily`.`DailyId` = 0";
			$result = mysqli_query($conn,$sql0);
			$sql1 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h1' WHERE `traffic_daily`.`DailyId` = 1";
			$result = mysqli_query($conn,$sql1);
			$sql2 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h2' WHERE `traffic_daily`.`DailyId` = 2";
			$result = mysqli_query($conn,$sql2);
			$sql3 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h3' WHERE `traffic_daily`.`DailyId` = 3";
			$result = mysqli_query($conn,$sql3);
			$sql4 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h4' WHERE `traffic_daily`.`DailyId` = 4";
			$result = mysqli_query($conn,$sql4);
			$sql5 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h5' WHERE `traffic_daily`.`DailyId` = 5";
			$result = mysqli_query($conn,$sql5);
			$sql6 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h6' WHERE `traffic_daily`.`DailyId` = 6";
			$result = mysqli_query($conn,$sql6);
			$sql7 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h7' WHERE `traffic_daily`.`DailyId` = 7";
			$result = mysqli_query($conn,$sql7);
			$sql8 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h8' WHERE `traffic_daily`.`DailyId` = 8";
			$result = mysqli_query($conn,$sql8);
			$sql9 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h9' WHERE `traffic_daily`.`DailyId` = 9";
			$result = mysqli_query($conn,$sql9);
			$sql10 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h10' WHERE `traffic_daily`.`DailyId` = 10";
			$result = mysqli_query($conn,$sql10);
			$sql11 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h11' WHERE `traffic_daily`.`DailyId` = 11";
			$result = mysqli_query($conn,$sql11);
			$sql12 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h12' WHERE `traffic_daily`.`DailyId` = 12";
			$result = mysqli_query($conn,$sql12);
			$sql13 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h13' WHERE `traffic_daily`.`DailyId` = 13";
			$result = mysqli_query($conn,$sql13);
			$sql14 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h14' WHERE `traffic_daily`.`DailyId` = 14";
			$result = mysqli_query($conn,$sql14);
			$sql15 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h15' WHERE `traffic_daily`.`DailyId` = 15";
			$result = mysqli_query($conn,$sql15);
			$sql16 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h16' WHERE `traffic_daily`.`DailyId` = 16";
			$result = mysqli_query($conn,$sql16);
			$sql17 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h17' WHERE `traffic_daily`.`DailyId` = 17";
			$result = mysqli_query($conn,$sql17);
			$sql18 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h18' WHERE `traffic_daily`.`DailyId` = 18";
			$result = mysqli_query($conn,$sql18);
			$sql19 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h19' WHERE `traffic_daily`.`DailyId` = 19";
			$result = mysqli_query($conn,$sql19);
			$sql20 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h20' WHERE `traffic_daily`.`DailyId` = 20";
			$result = mysqli_query($conn,$sql20);
			$sql21 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h21' WHERE `traffic_daily`.`DailyId` = 21";
			$result = mysqli_query($conn,$sql21);
			$sql22 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h22' WHERE `traffic_daily`.`DailyId` = 22";
			$result = mysqli_query($conn,$sql22);
			$sql23 = "UPDATE `traffic_daily` SET `PeopleEntered` = '$h23' WHERE `traffic_daily`.`DailyId` = 23";
			$result = mysqli_query($conn,$sql23);

			
				$sql = "SELECT * FROM traffic_weekly";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_array($result)) {
					echo "['".$row['DayOfWeek']."',".$row['PeopleEntered']."],";
				}
			?>
			]);

			var options = {
				chart: {
					title: 'Average DAILY Traffic Report Data',
					legend: { position: 'top' }
					
				},
				bars: 'vertical' // Required for Material Bar Charts.
				};

			var chart = new google.charts.Bar(document.getElementById('predictBarchart'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		};
		
	</script>

	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		window.onload = drawChart();
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Day of the Week', 'People Entered'],
			<?php 

			$sql = "SELECT * FROM cam_enter"; 
			$result = mysqli_query($conn,$sql);
			$totalPeople = 0;
			$average = 0;

			$monday = 0;
			$tuesday = 0;
			$wednesday = 0;
			$thursday = 0;
			$friday = 0;
			$saturday = 0;
			$sunday = 0;

			$avgMon = 0;
			$avgTue = 0;
			$avgWed = 0;
			$avgThur = 0;
			$avgFri = 0;
			$avgSat = 0;
			$avgSun = 0;

			while($row = mysqli_fetch_array($result)) {
				
				$totalPeople += ((int)$row['enter']);
				$resultHour = substr($row['time'], 0, 2); 
				$resultDay = substr($row['date'], 3, 2); 
				$resultMonth = substr($row['date'], 0, 2); 
				$resultYear = substr($row['date'], 6, 9); 

				$resultDate = date("l", mktime(0,0,0,$resultMonth,$resultDay,$resultYear));
				
				if ('Monday' == $resultDate) {
					$monday += ((int)$row['enter']);
					$avgMon += 1;
				}
				else if('Tuesday' == $resultDate){
					$tuesday += ((int)$row['enter']);
					$avgTue += 1;
				}
				else if('Wednesday' == $resultDate){
					$wednesday += ((int)$row['enter']);
					$avgWed += 1;
				}
				else if('Thursday' == $resultDate){
					$thursday += ((int)$row['enter']);
					$avgThur += 1;
				}
				else if('Friday' == $resultDate){
					$friday += ((int)$row['enter']);
					$avgFri += 1;
				}
				else if('Saturday' == $resultDate){
					$saturday += ((int)$row['enter']);
					$avgSat += 1;
				}
				else if('Sunday' == $resultDate){
					$sunday += ((int)$row['enter']);
					$avgSun += 1;
				}
			}	
			$monday = ($monday/$avgMon) * 24;
			$tuesday = ($tuesday/$avgTue) * 24;
			$wednesday = ($wednesday/$avgWed) * 24;
			$thursday = ($thursday/$avgThur) * 24;
			$friday = ($friday/$avgFri) * 24;
			$saturday = ($saturday/$avgSat) * 24;
			$sunday = ($sunday/$avgSun) * 24;
			

			$sqlMon = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$monday' WHERE `traffic_weekly`.`ID` = 1";
			$result = mysqli_query($conn,$sqlMon);
			$sqlTue = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$tuesday' WHERE `traffic_weekly`.`ID` = 2";
			$result = mysqli_query($conn,$sqlTue);
			$sqlWed = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$wednesday' WHERE `traffic_weekly`.`ID` = 3";
			$result = mysqli_query($conn,$sqlWed);
			$sqlThur = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$thursday' WHERE `traffic_weekly`.`ID` = 4";
			$result = mysqli_query($conn,$sqlThur);
			$sqlFri = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$friday' WHERE `traffic_weekly`.`ID` = 5";
			$result = mysqli_query($conn,$sqlFri);
			$sqlSat = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$saturday' WHERE `traffic_weekly`.`ID` = 6";
			$result = mysqli_query($conn,$sqlSat);
			$sqlSun = "UPDATE `traffic_weekly` SET `PeopleEntered` = '$sunday' WHERE `traffic_weekly`.`ID` = 7";
			$result = mysqli_query($conn,$sqlSun);


			$sql = "SELECT * FROM traffic_daily";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)) {
				echo "['".$row['TimeEntered']."',".$row['PeopleEntered']."],";
			}
			?>
			]);

			var options = {
			title: 'Average HOURLY Library Traffic',
			curveType: 'none',
			legend: { position: 'top' }
			};

			var chart = new google.visualization.LineChart(document.getElementById('predictLinechart'));

			chart.draw(data, options);
		}
	</script>

	<div id="predictBarchart"></div>
	
	<div class="small-chart-container"><div id="predictLinechart" ></div><div id="chart_div"></div></div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</div>
</body>
</html>