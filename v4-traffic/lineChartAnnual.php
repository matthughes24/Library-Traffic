<?php
error_reporting(0);
include('session.php');
include('redirectGraphData.php');
include('config.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
// Create connection
$conn = $link;
$sql = "SELECT * FROM traffic_annual";
$result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
               $data = $row['PeopleEntered'];
    }
?>


<html>
  <head>
    <button id="barChartButt"><a href="graphAnnualReport.php">View Bar Chart</a></button>
    <button id="gaugeChartButt"><a href="gaugeChartAnnual.php">View Gauge Chart</a></button>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Month', 'People Entered'],
	<?php 
	    $sql = "SELECT * FROM traffic_annual";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['Month']."',".$row['PeopleEntered']."],";
		}
	  ?>
        ]);

        var options = {
          title: 'Annual People Count',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 1500px; height: 900px"></div>
  </body>
</html>
