<?php
error_reporting(0); 
include('login.php');
include('session.php');
include('redirectGraphData.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
$servername = "localhost";
$username = "p_f22_04";
$password = "50tgon";
$dbname = "p_f22_04_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$userselect= $_SESSION['login_user'];
?>

<html>
  <head>
  <title> Daily Traffic Graph</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  <?php 
		include 'navbar.php';
	?>
   
  <h1 id="welcome" style="text-align:center; font-family:Roboto; color:#2f90ff;">New Paltz Library Traffic Camera<i></i></h1>
</br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Time Entered', 'People Entered'],
          <?php 
          $sql = "SELECT * FROM traffic_daily";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['TimeEntered']."',".$row['PeopleEntered']."],";
                    if(((int)$row['PeopleEntered'])>$max){
                      $max = ((int)$row['PeopleEntered']);
                      $maxtime = $row['TimeEntered'];
                    }
                    if(((int)$row['PeopleEntered'])<=$min){
                      $min = ((int)$row['PeopleEntered']);
                      $mintime = $row['TimeEntered'];
                    }
            }
            ?>
        ]);
        var options = {
          chart: {
            title: 'Daily Entered Traffic Report',
            subtitle: 'Students entered in library',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Time Entered', 'People Entered'],
	<?php 
	    $sql = "SELECT * FROM traffic_daily";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['TimeEntered']."',".$row['PeopleEntered']."],";
		}
	  ?>
        ]);

        var options = {
          title: 'Daily Libary People Count',
          curveType: 'none',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
  </script>
      <div id="barchart_material"></div>
      

      <div class="small-chart-container">
      <div id="curve_chart"></div>    
      </div>
      <div id="chart_div"></div>
      
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>