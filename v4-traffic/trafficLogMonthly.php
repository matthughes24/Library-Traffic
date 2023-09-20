<?php  
error_reporting(0);
include('login.php');
include('config.php');
include('session.php');
 $conn = $link;
 $query = "SELECT * FROM traffic_monthly INNER JOIN traffic_monthly_exited ON traffic_monthly.DayOfMonth=traffic_monthly_exited.DayOfMonth";
 $result = mysqli_query($conn, $query);  
 $userselect= $_SESSION['login_user']; 
 ?> 
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monthly Traffic Log</title>
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
          <h2 style="text-align: center;">Monthly Report</h2>  
          <h3 style="text-align: center;">Traffic Data</h3><br>  
               <div style="margin-left: 8%; width: 100%; display:flex; flex-direction:row; justify-content: center; align-items: center;"> 
               <div class="col-md-3">  
                <input type="text" name="from_year" id="from_year" class="form-control" placeholder="From Year(YYYY)" />
               </div>              
                <div class="col-md-3">  
                <input list="from_monthlist" name="from_month" id="from_month" class="form-control" placeholder="From Month" />
                     <datalist id="from_monthlist">
                         <option data-value=1 value ="01">
                         <option data-value=2 value ="02">
                         <option data-value=3 value ="03">
                         <option data-value=4 value ="04">
                         <option data-value=5 value ="05">     
                         <option data-value=6 value ="06">
                         <option data-value=7 value ="07">
                         <option data-value=8 value ="08">
                         <option data-value=9 value ="09">
                         <option data-value=10 value ="10">
                         <option data-value=11 value ="11">
                         <option data-value=13 value ="12">
                     </datalist>
                </div> 
                <div class="col-md-3">  
                <input type="text" name="to_year" id="to_year" class="form-control" placeholder="To Year(YYYY)" />
               </div>   
                <div class="col-md-3">  
                <input list="to_monthlist" name="to_month" id="to_month" class="form-control" placeholder="From Month" />
                     <datalist id="to_monthlist">
                         <option data-value=1 value ="01">
                         <option data-value=2 value ="02">
                         <option data-value=3 value ="03">
                         <option data-value=4 value ="04">
                         <option data-value=5 value ="05">     
                         <option data-value=6 value ="06">
                         <option data-value=7 value ="07">
                         <option data-value=8 value ="08">
                         <option data-value=9 value ="09">
                         <option data-value=10 value ="10">
                         <option data-value=11 value ="11">
                         <option data-value=13 value ="12">
                     </datalist>
                </div>

                <div class="col-md-3">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div> 
		</div>                
                <br />  
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">Day Of The Month</th>  
                               <th width="5%">People Entered</th> 
                               <th width="5%">People Exited</th> 
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["DayOfMonth"]; ?></td>  
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
           $('#filter').click(function(){  
                var from_month = $('#from_month').val();  
                var to_month = $('#to_month').val(); 
                var from_year = $('#from_year').val();  
                var to_year = $('#to_year').val();   
                if(from_month != '' && to_month != '' && from_year != ''&& to_year != '' )  
                {  
                     $.ajax({  
                          url:"filtermonth.php",  
                          method:"POST",  
                          data:{from_month:from_month, to_month:to_month,from_year:from_year, to_year:to_year},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
