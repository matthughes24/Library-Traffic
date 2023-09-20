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
$userselect= $_SESSION['login_user'];
?>

<html>
  <head>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php $query = "SELECT role from FinalUserTable where username = '$userselect'"; 
          $ses_sql = mysqli_query($conn, $query); 
          $row = mysqli_fetch_assoc($ses_sql); 
          $num = $row['role'];
          $home = '';
          if($num == 2)
          {
            $home = 'adminProfile.php';
          }else{
            $home = 'profile.php';
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
          $output3 .= '<li class="nav-item">
          <a class="nav-link" href="loginPage.php">Admin Login<span class="sr-only"></span></a>
        </li>';
          if($num == 1)
          {
            echo $output3;
          }else{
            
          }
          ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Traffic Reports</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="graphDailyReport.php">Daily</a>
            <a class="dropdown-item" href="graphWeeklyReport.php">Weekly</a>
            <a class="dropdown-item" href="graphMonthlyReport.php">Monthly</a>
            <a class="dropdown-item" href="graphAnnualReport.php">Annual</a>
        </li>
        <?php
          $query = "SELECT role from FinalUserTable where username = '$userselect'"; 
          $ses_sql = mysqli_query($conn, $query); 
          $row = mysqli_fetch_assoc($ses_sql); 
          $num = $row['role'];
          $output .= '<li class="nav-item">
          <a class="nav-link" href="importExcelMakeAChoice.php">Upload Excel File</a>
          </li>';
          if($num == 2)
          {
            echo $output;
          }else{
            
          }
          ?>
      </ul>

    </div>
  </div>
</nav>
    <h1 id="welcome" style="text-align:center; font-family:Roboto; color:#2f90ff;">New Paltz Library Traffic Camera<i></i></h1>
    </br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Month', 'People Entered', 'People Exited'],
          <?php 
          $sql = "SELECT * FROM traffic_annual INNER JOIN traffic_annual_exited ON traffic_annual.Month=traffic_annual_exited.Month";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['Month']."',".$row['PeopleEntered'].",".$row['PeopleExited']."],";
                    if(((int)$row['PeopleEntered'])>$max){
                      $max = ((int)$row['PeopleEntered']);
                      $maxtime = $row['Month'];
                    }
                    if(((int)$row['PeopleExited'])>$max){
                      $maxexit = ((int)$row['PeopleExited']);
                      $maxtimeexit = $row['Month'];
                    }
            }
            ?>
        ]);
        var options = {
          width: 800,
          chart: {
            title: 'Annual Traffic Report Enter/Exit',
            subtitle: 'People entered on the left, people exited on the right'
          },
          bars: 'vertical', // Required for Material Bar Charts.
          series: {
            0: { axis: 'entered' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'exited' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            x: {
              entered: {label: 'people'}, // Bottom x-axis.
              exited: {side: 'top', label: 'Annual Traffic data of enter/exit'} // Top x-axis.
            }
          }
        };
      var chart = new google.charts.Bar(document.getElementById('barchart_material'));
      chart.draw(data, options);
    };
    </script>

      <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawLineChart);

      function drawLineChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Month');
      data.addColumn('number', 'People Entered');
      data.addColumn('number', 'People Exited');

      data.addRows([
        <?php
            $sql = "SELECT * FROM traffic_annual INNER JOIN traffic_annual_exited ON traffic_annual.Month=traffic_annual_exited.Month";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['Month']."',".$row['PeopleEntered'].",".$row['PeopleExited']."],"; 
                  }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Annual Traffic Report',
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

      var chart = new google.charts.Line(document.getElementById('curve_chart'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
      <div id="barchart_material"></div>
      <nav>
      <ul id="mainMenu">
        <li><a href="graphAnnualReport.php">Entered</a></li>
        <li><a href="graphAnnualReportExit.php">Exited</a></li>
        <li><a href="graphAnnualReportDual.php">Enter/Exited</a></li>
      </ul>
    </nav>
      <div class="small-chart-container">
        <div id="curve_chart"></div>    
        <div id="chart_div"></div>
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
  </html>
