<?php 
include('config.php');
$conn = $link;
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT TimeExited, PeopleExited FROM traffic_daily_exited";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Time Exited</th>  
                         <th>People Exited</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
       <td>'.$row["TimeExited"].'</td>  
       <td>'.$row["PeopleExited"].'</td>  
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=exportDailyExited.xls');
  echo $output;
 }
}
?>
