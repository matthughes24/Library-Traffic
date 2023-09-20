<?php
error_reporting(0);
include('session.php');
include('redirectExcelMakeAChoice.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<HTML>
  <HEAD>
       <TITLE>Import Excel Files</TITLE>
	   <link href="style.css" rel="stylesheet" type="text/css">

  </HEAD>

  <BODY>
  <li class="button"><a class="nav-link" href="predictTraffic.php">Home</a></li>

	<div id="dropdownExcel">
		<h1>Please Import Daily Entered and Exited Excel Files</h1>
        <form action="" method="POST">
            <div class="camera-select">
				<h3>Please Enter Today's Date</h3>
				<input id="myInput" type="text"/>
	  			<h3>Please Choose Entered or Exited</h3>
				<select name="camera" class="graph-choice">
					<option value="1">Entered</option>
					<option value="2">Exited</option>
				</select>
 			</div>
			
			<br>
  	  		<input onclick="displayDate()" name="submit" type="submit" value="Submit" class="submit">	
		</form>  
		<p id="show_name">
   </p>
			<br>
			
	</div>
	<script>
    
   	//document.getElementById("myInput").value = test;
    
	function displayDate() {
      var originalName = document.getElementById("myInput").value;
	  localStorage.setItem("storageName",originalName);
      document.getElementById("show_name").innerHTML = "Date Entered :" + originalName;
   }
	</script>
  </BODY>
</HTML>
