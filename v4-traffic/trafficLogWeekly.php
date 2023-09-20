<?php  
error_reporting(0);
include('login.php');
include('session.php');
include('config.php');

 $conn = $link;
 $query = "SELECT * FROM traffic_weekly INNER JOIN traffic_weekly_exited ON traffic_weekly.DayOfWeek=traffic_weekly_exited.DayOfWeek";  
 $result = mysqli_query($conn, $query);  
 $userselect= $_SESSION['login_user'];
 ?> 
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weekly Traffic Log</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
  <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
  <body>
     <?php 
          include 'navbar.php';
     ?>
  	<div class="container" style="width: 100%;">
               <h2 style="text-align: center;">Weekly Report</h2>  
               <h3 style="text-align: center;">Traffic Data</h3><br>  
               <div style="display:flex; flex-direction:row; justify-content: center; align-items: center; text-align: center;">                            
                <div class="col-md-3">
                    <input type="Date" name="Date" id="Date" class="form-control" placeholder="YYYY-MM-DD"/>      
                </div>  
                <div class="col-md-3">  
                     <input type="button" name="filterdayweek" id="filterdayweek" value="Filter" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div>       
		</div>          
                <br>  
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">Day Of The Week</th>  
                               <th width="5%">People Entered</th>
                               <th width="5%">People Exited</th> 
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["DayOfWeek"]; ?></td>  
                               <td><?php echo $row["PeopleEntered"]; ?></td>
                               <td><?php echo $row["PeopleExited"]; ?></td>
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
</html>
<script>  
      $(document).ready(function(){  
           $('#filterdayweek').click(function(){  
                var Date = document.getElementById("Date").value;
                
                
                if(Date != '')  
                {  
                     $.ajax({  
                          url:"filterdayweek.php",  
                          method:"POST",  
                          data:{Date:Date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Day");  
                }  
           });  
      });  
 </script>
