<?php
error_reporting(0);
include('session.php');
include('config.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page
}
// Create connection
$conn = $link;
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$userselect= $_SESSION['login_user'];
$sql = "SELECT * FROM traffic_annual";
$result = $conn->query($sql);
$max = 0;
$maxtime = '';
?>

<HTML>
  <HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
               <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
          <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Traffic Log Reports</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="trafficLogDaily.php">Daily</a>
            <a class="dropdown-item" href="trafficLogWeekly.php">Weekly</a>
            <a class="dropdown-item" href="trafficLogMonthly.php">Monthly</a>
            <a class="dropdown-item" href="trafficLogAnnually.php">Annual</a>
        </li>
        </ul>
     </div>
  </div>
</nav>
  </HEAD>

    <body>
  	<div class="container" style="width:900px;">  
                <h2 align="center">Annual Report</h2>  
                <h3 align="center">Max Traffic Data</h3><br />  
                <div style="clear:both"></div>                 
                <br />  
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">Month</th>  
                               <th width="30%">People Entered</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                      
                            if((int)$row['PeopleEntered'] >= $max){
                                $max = (int)$row['PeopleEntered'];
                                $maxtime = $row['Month'];
                            }
                     }
                     ?>
                          <tr>  
                               <td><?php echo $maxtime; ?></td>
                               <td><?php echo $max;?></td>
                          </tr>   
                     </table>  
                </div>  
           </div>  
      </body> 
</HTML>
