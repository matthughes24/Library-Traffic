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
$sql = "SELECT * FROM traffic_weekly";
$result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
               $data = $row['PeopleEntered'];
    }
?>

<html>
  <head>
  <button id="barChartButt"><a href="graphWeeklyReport.php">View Bar Chart</a></button>
  <button id="lineChartButt"><a href="lineChartWeekly.php">View Line Chart</a></button>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['People Entered', <?php echo $data ?>]
        ]);

        var options = {
          width: 800, height: 1000,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>
  </body>

</html>
