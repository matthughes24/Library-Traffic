<?php
include('config.php');
$connect = $link;
$sql = "SELECT * FROM traffic_monthly";  
$result = mysqli_query($connect, $sql);
?>
<html>  
 <head>  
  <title>Export Monthly Entered Report Data to Excel</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
   <div class="table-responsive">  
    <h2 align="center">Export Monthly Entered Report Data to Excel</h2><br /> 
    <table class="table table-bordered">
     <tr>  
       <th>Day of the Month</th>  
       <th>People Entered</th>  
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
       <tr>  
         <td>'.$row["DayOfMonth"].'</td>  
         <td>'.$row["PeopleEntered"].'</td>  
       </tr>  
        ';  
     }
     ?>
    </table>
    <br />
    <form method="post" action="successExportMonthly.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>  
  </div>  
 </body>  
</html>
