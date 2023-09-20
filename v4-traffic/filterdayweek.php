<?php  
include('config.php');
 //filter.php  
 if(isset($_POST["Date"]) || 1 == 1)  
 {  

      $conn = $link; 
      $output = '';  
      $var= $_POST["Date"];
      $date = str_replace('/', '-', $var);
       $trueDate  = date("Y-m-d", strtotime($date) );
      $TimeStampedDate = strtotime($trueDate ); //getting the time stamp from the string to add 7 days to it
      $englishText = '+7 day'; //string to add 7 days to the week
      $requireDateFormat = 'Y-m-d'; //format of the date
      $FinalDate = (String)date($requireDateFormat,strtotime($englishText, $TimeStampedDate)); //move the date ahead by 7 days and convert it to a string

       $query = "SELECT * FROM traffic_Cam_Data WHERE dateStart BETWEEN '".$trueDate . "' AND '".$FinalDate . "'  ORDER BY dateStart"; //perform the query from the start date to 7 days ahead
      $result = mysqli_query($conn, $query);  //get the result of the query 
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                    <th width="5%">Date</th>  
                    <th width="5%">Time</th>  
                    <th width="5%">People Entered</th>
                    <th width="30%">People Exited</th>   
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result)) //Display each result from the query
           {  
                $output .= '  
                     <tr>  
                          
                     <td>'. $row["dateStart"] .'</td>  
                     <td>'. $row["timeStart"] .'</td>  
                     <td>'. $row["enterCount"] .'</td>  
                     <td>'. $row["exitCount"] .'</td>
                     </tr>
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
 <html>
  <head>
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
      <script src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Day of the Week', 'People Entered', 'People Exited'],
          <?php 
           $sql = "SELECT * FROM traffic_Cam_Data WHERE dateStart BETWEEN '".$trueDate . "' AND '".$FinalDate . "'  ORDER BY dateStart";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                    echo "['".$row['dateStart']."',".$row['enterCount'].",".$row['exitCount']."],";
            }
            ?>
        ]);

        var options = {
          width: 800,
          chart: {
            title: 'Weekly Traffic Report Enter/Exit',
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
              exited: {side: 'top', label: 'Weekly Traffic data of enter/exit'} // Top x-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
      chart.draw(data, options);
    };
    </script>
  </head>
  <body>
    <div id="dual_x_div" style="width: 1000px; height: 700px;"></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>

 
