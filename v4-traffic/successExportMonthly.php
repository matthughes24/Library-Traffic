<?php 
include('config.php');
$conn = $link;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT DayOfMonth, PeopleEntered FROM traffic_monthly_exited";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Day of the Month</th>  
                         <th>People Entered</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
       <td>'.$row["DayOfMonth"].'</td>  
       <td>'.$row["PeopleEntered"].'</td>  
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=exportMonthlyEntered.xls');
  echo $output;
 }
}
?>
