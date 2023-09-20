<?php 
include('config.php');
$conn = $link;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM traffic_weekly";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Day of the Week</th>  
                         <th>People Exited</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
       <td>'.$row["DayOfWeek"].'</td>  
       <td>'.$row["PeopleExited"].'</td>  
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=exportWeeklyExited.xls');
  echo $output;
 }
}
?>
