<?php
error_reporting(0);
include('session.php');
include('redirectExportData.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<HTML>
  <HEAD>
       <TITLE>What Type of Data?</TITLE>
	   <link rel="stylesheet" media="screen" href="style.css">
  </HEAD>

  <BODY>
  <li class="button"><a class="nav-link" href="predictTraffic.php">Home</a></li>

  
  <div id="dropdownExcel">
		<h1>Please select which excel file you'd like to export</h1>
        <form action="" method="POST">
            <div class="choice-select">
	  				<h3>Choose Entered or Exited</h3>
	  				<select name="camera" class="graph-choice">
    					<option value="1">Entered</option>
    					<option value="2">Exited</option>
	  				</select>
 			</div>
    		<div class="choice-select">
	  			<h3>Choose the Periodicity</h3>	
  	  			<select name="choice" class="graph-choice">
    				<option value="1">Daily</option>
    				<option value="2">Weekly</option>
    				<option value="3">Monthly</option>
    				<option value="4">Annual</option>
  	  			</select>
      		</div>
			<br>
  	  		<input name="submit" type="submit" value="Submit" class="submit">	
		</form>  
	</div>
  </BODY>
</HTML>
