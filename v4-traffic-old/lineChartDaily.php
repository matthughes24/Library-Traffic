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
?>


<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Hour');
      data.addColumn('number', 'People Entered');
      data.addColumn('number', 'People Exited');

      data.addRows([
        <?php
          $sql = "SELECT * FROM traffic_daily INNER JOIN traffic_daily_exited ON TimeEntered=TimeExited";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['TimeEntered']."',".$row['PeopleEntered'].",".$row['PeopleExited']."],"; 
                  }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Daily Traffic Report',
          subtitle: 'in people entered/exited'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
</head>
<body>
  <div id="line_top_x"></div>
</body>
</html>
