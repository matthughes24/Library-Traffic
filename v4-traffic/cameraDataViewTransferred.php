<?php  
error_reporting(0);
include('login.php');
include('session.php');
 include('config.php');
 $conn = $link;
 $query = "SELECT * FROM traffic_Cam_Data ORDER BY dateStart";
   # INNER JOIN traffic_Cam_Data ON timeStart=timeStart
 $result = mysqli_query($conn, $query);  
 $userselect= $_SESSION['login_user'];
 ?>  
<html>
  <head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Transferred Camera Data</title>
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
          include 'sidebar.php';
     ?>
  	<div class="container" style="width: 100%;">  
               <h2 style="text-align: center;">Transferred Camera Data</h2><br>
               <div style="margin-left: 17%; width: 100%; display:flex; flex-direction:row; justify-content: center; align-items: center;">               
                <div class="col-md-3">  
                     <input list="from_timelist" name="from_time" id="from_time" class="form-control" placeholder="From Time" />
                     <datalist id="from_timelist">
                         <option value ="00:00:00">
                         <option value ="01:00:00">
                         <option value ="02:00:00">
                         <option value ="03:00:00">
                         <option value ="04:00:00">     
                         <option value ="05:00:00">
                         <option value ="06:00:00">
                         <option value ="07:00:00">
                         <option value ="08:00:00">
                         <option value ="09:00:00">
                         <option value ="10:00:00">
                         <option value ="11:00:00">
                         <option value ="12:00:00">
                         <option value ="13:00:00">
                         <option value ="14:00:00">     
                         <option value ="15:00:00">
                         <option value ="16:00:00">
                         <option value ="17:00:00">
                         <option value ="18:00:00">
                         <option value ="19:00:00">
                         <option value ="20:00:00">
                         <option value ="21:00:00">
                         <option value ="22:00:00">
                         <option value ="23:00:00">
                     </datalist>
                </div>  
                <div class="col-md-3">  
                     <input list="to_timelist" name="to_time" id="to_time" class="form-control" placeholder="To Time" />  
                     <datalist id="to_timelist">
                         <option value ="00:00:00">
                         <option value ="01:00:00">
                         <option value ="02:00:00">
                         <option value ="03:00:00">
                         <option value ="04:00:00">     
                         <option value ="05:00:00">
                         <option value ="06:00:00">
                         <option value ="07:00:00">
                         <option value ="08:00:00">
                         <option value ="09:00:00">
                         <option value ="10:00:00">
                         <option value ="11:00:00">
                         <option value ="12:00:00">
                         <option value ="13:00:00">
                         <option value ="14:00:00">     
                         <option value ="15:00:00">
                         <option value ="16:00:00">
                         <option value ="17:00:00">
                         <option value ="18:00:00">
                         <option value ="19:00:00">
                         <option value ="20:00:00">
                         <option value ="21:00:00">
                         <option value ="22:00:00">
                         <option value ="23:00:00">
                     </datalist>
                </div>  
                <div class="col-md-5">  
                     <input type="button" click="clear()" name="filtertime" id="filtertime" value="Filter" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>  
		</div>               
                <br />  
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr> <th width="5%">Date</th>
                               <th width="10%">Start Time (to Next Hour)</th>  
                               <th width="10%">People Entered</th>
                               <th width="10%">People Exited</th> 
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                              <td><?php echo $row['dateStart']; ?></td> 
                               <td><?php echo $row['timeStart']; ?></td>  
                               <td><?php echo $row['enterCount']; ?></td>
                               <td><?php echo $row['exitCount']; ?></td>
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
     window.onload = function() {
          document.getElementById("filtertime").addEventListener("click",clear);
     }

     function clear() {
          document.getElementById("from_time").value = "";
          document.getElementById("to_time").value = "";
     }  

     $(document).ready(function(){  
          $('#filtertime').click(function(){  
               var from_time = $('#from_time').val();  
               var to_time = $('#to_time').val();  
               if(from_time != '' && to_time != '')  
               {  
                    $.ajax({  
                         url:"filtertime.php",  
                         method:"POST",  
                         data:{from_time:from_time, to_time:to_time},  
                         success:function(data)  
                         {  
                              $('#order_table').html(data);
                         }  
                    });  
               }  
               else  
               {  
                    alert("Please Select Time");  
               }  
           });    
     $('#filtergraph').click(function(){  
     var from_time = $('#from_time').val();  
     var to_time = $('#to_time').val();  
     if(from_time != '' && to_time != '')  
     {  
          $.ajax({  
               url:"filtergraph.php",  
               method:"POST",  
               data:{from_time:from_time, to_time:to_time},  
               success:function(data)  
               {  
               alert("Data was succesfully captured");
               }  
          });  
     }  
     else  
     {  
          alert("Please Select Time");  
     }  
     }); 
});
</script>