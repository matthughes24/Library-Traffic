<?php
error_reporting(0);
include('session.php');
include('redirectExcelMakeAChoice.php');
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Upload to Database</title>
    <style>
     #container {
        background-color: #003e7e;
        border-radius: 20px;
        margin: 0 auto;
		    margin-top: 20px;
        padding: 20px;
        width: 1000px;
      }
      h1 {
        color: #FFFFFF;
        text-align: center;
      }
      form {
        margin-top: 20px;
      }
      label, select {
        color: #FFFFFF;
        display: block;
        margin-top: 10px;
		    margin-bottom: 10px;
		    font-weight: 600;
        font-size: 20px;
      }
      select {
        background-color: #FFFFFF;
        border: none;
        border-radius: 5px;
        color: #0066CC;
        cursor: pointer;
        padding: 10px 20px;
        width: 100%;
      }
      input[type=text] {
        background-color: #FFFFFF;
        border: none;
        border-radius: 5px;
        color: #0066CC;
        padding: 10px;
        width: 100%;
      }
      input[type=submit] {
        background-color: #FFFFFF;
        border: none;
        border-radius: 5px;
        color: #0066CC;
        cursor: pointer;
        padding: 10px 20px;
      }
      #show_name {
        color: #FFFFFF;
        text-align: center;
	  }
    </style>
  </head>
  <body style="background-image: url('https://www.newpaltz.edu/media/ocm/images/blue-repeat-logo.png'); background-size: cover;">
  	<?php 
        include 'navbar.php';
        include 'sidebar.php';
    ?>
    <div id="container">
      <h1>Select Excel File to Import</h1>
      <form action="" method="POST">
        <label for="myInput">Enter Date</label>
        <input id="myInput" type="text" name="date" placeholder="mm/dd/yyyy"/>
        <label for="camera">Choose Entered or Exited</label>
        <select name="camera" id="camera">
          <option value="1">Entered</option>
          <option value="2">Exited</option>
        </select>
		<br>
        <input type="submit" name="submit" value="Submit">
      </form>  
      <p id="show_name"></p>
    </div>
    <script>
      function displayDate() {
        var originalName = document.getElementById("myInput").value;
        localStorage.setItem("storageName",originalName);
        document.getElementById("show_name").innerHTML = "Date Entered: " + originalName;
      }
    </script>
  </body>
</html>