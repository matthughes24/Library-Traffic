<?php  
     error_reporting(0);
     include('login.php');
     include('session.php');
     include('config.php');
     $conn = $link;
     $query = "SELECT * FROM cam_enter ORDER BY date";
 
     # INNER JOIN cam_exit ON time=time 
     $result = mysqli_query($conn, $query);  
     $userselect= $_SESSION['login_user'];
?>  
<html>
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daily Traffic Log</title>
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
          <h2 style="text-align: center;">Daily Report</h2>  
          <h3 style="text-align: center;">Traffic Data</h3><br>
          <div style="margin-left: 17%; width: 100%; display:flex; flex-direction:row; justify-content: center; align-items: center;">
          <div class="col-md-3">  
               <input list="from_timelist" name="from_time" id="from_time" class="form-control" placeholder="From Time" />
               <datalist id="from_timelist">
                    <option data-value=1 value ="00:00 - 01:00">
                    <option data-value=2 value ="01:00 - 02:00">
                    <option data-value=3 value ="02:00 - 03:00">
                    <option data-value=4 value ="03:00 - 04:00">
                    <option data-value=5 value ="04:00 - 05:00">     
                    <option data-value=6 value ="05:00 - 06:00">
                    <option data-value=7 value ="06:00 - 07:00">
                    <option data-value=8 value ="07:00 - 08:00">
                    <option data-value=9 value ="08:00 - 09:00">
                    <option data-value=10 value ="09:00 - 10:00">
                    <option data-value=11 value ="10:00 - 11:00">
                    <option data-value=12 value ="11:00 - 12:00">
                    <option data-value=13 value ="12:00 - 13:00">
                    <option data-value=14 value ="13:00 - 14:00">
                    <option data-value=15 value ="14:00 - 15:00">
                    <option data-value=16 value ="15:00 - 16:00">
                    <option data-value=17 value ="16:00 - 17:00">
                    <option data-value=18 value ="17:00 - 18:00">
                    <option data-value=19 value ="18:00 - 19:00">
                    <option data-value=20 value ="19:00 - 20:00">
                    <option data-value=21 value ="20:00 - 21:00">
                    <option data-value=22 value ="21:00 - 22:00">
                    <option data-value=23 value ="22:00 - 23:00">
                    <option data-value=24 value ="23:00 - 24:00">
               </datalist>
               </div>  
                <div class="col-md-3">  
                     <input list="to_timelist" name="to_time" id="to_time" class="form-control" placeholder="To Time" />  
                     <datalist id="to_timelist">
                     <option data-value=1 value ="00:00 - 01:00">
                         <option data-value=2 value ="01:00 - 02:00">
                         <option data-value=3 value ="02:00 - 03:00">
                         <option data-value=4 value ="03:00 - 04:00">
                         <option data-value=5 value ="04:00 - 05:00">     
                         <option data-value=6 value ="05:00 - 06:00">
                         <option data-value=7 value ="06:00 - 07:00">
                         <option data-value=8 value ="07:00 - 08:00">
                         <option data-value=9 value ="08:00 - 09:00">
                         <option data-value=10 value ="09:00 - 10:00">
                         <option data-value=11 value ="10:00 - 11:00">
                         <option data-value=12 value ="11:00 - 12:00">
                         <option data-value=13 value ="12:00 - 13:00">
                         <option data-value=14 value ="13:00 - 14:00">
                         <option data-value=15 value ="14:00 - 15:00">
                         <option data-value=16 value ="15:00 - 16:00">
                         <option data-value=17 value ="16:00 - 17:00">
                         <option data-value=18 value ="17:00 - 18:00">
                         <option data-value=19 value ="18:00 - 19:00">
                         <option data-value=20 value ="19:00 - 20:00">
                         <option data-value=21 value ="20:00 - 21:00">
                         <option data-value=22 value ="21:00 - 22:00">
                         <option data-value=23 value ="22:00 - 23:00">
                         <option data-value=24 value ="23:00 - 24:00">
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
                               <th width="5%">Time Entered</th>  
                               <th width="7%">People Entered</th>
                               <th width="7%">People Exited</th> 
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     { //but you can get the data for those that entered here? so there is infact data in that table
                     ?>  
                          <tr>  
                               <td><?php echo $row["date"]; ?></td> 
                               <td><?php echo $row["time"]; ?></td>  
                               <td><?php echo $row["enter"]; ?></td>
                               
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
                var shownValfrom = document.getElementById("from_time").value;
                var from_time = document.querySelector("#from_timelist option[value='"+shownValfrom+"']").dataset.value; 
                var shownValto = document.getElementById("to_time").value;
                var to_time = document.querySelector("#to_timelist option[value='"+shownValto+"']").dataset.value; 

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