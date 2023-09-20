<?php
  //session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="animation.css">

    <title>Digital Library</title>
  <style>
         
        .navbar-custom {
            background-color: rgb(5,61,125);
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-custom">
	<h1 style="margin: auto; color: white;">New Paltz Smart Library</h1>
	<div class="container-fluid">
	
    <a class="navbar-brand" href="index.php">
              <img src="assets/NPLogo.png" alt="" width="64" height="64">
            </a>
            <a href="index-home.php" class="nav-link" style="color:white;">Home</a>
      <a href="smart-library" class="nav-link" style="color: white;" target="_target">Digital Library</a>
      <a href="index-dynamic.php" class="nav-link" style="color: white;">Locate A Book</a>
      <a href="index-robot.php" class="nav-link" style="color: white;">Misplaced</a>
      <a href="index-system-status.php" class="nav-link" style="color: white;">System Status</a>
      <a href="https://cs.newpaltz.edu/p/s23-02/v2/v4-traffic/predictTraffic.php" class="nav-link" style="color: white;" target="_target">Traffic Analysis</a>
	

          <?php
              
              if (isset($_SESSION["userID"]))
              {
          ?>
                  <a href='scripts/logout.php' class='btn btn-outline-light' role='button'>Logout</a>
          <?php      
                if ($_SESSION["userAdmin"] === 2)
                {
          ?>
                  <a href='index-admin.php' class='btn btn-outline-light' role='button'>Admin</a>
          <?php
                }
          ?>
                <?php echo "<a style='color: white; font-weight: bold; padding-left: 10px;'>Welcome <a style='font-weight: bold; color: orange;'>". $_SESSION['userName'] ."</a><a style='color: white';>!</a></a>"  ?>
          <?php
              }
              else
              {
          ?>
                <a href='index-register.php' class='btn btn-outline-light' role='button'>Register</a> 
                <a href='index-login.php' class='btn btn-outline-light' role='button'>Login</a>
          <?php
              }              
          ?>

           </div>

    
    </nav>
         
       </div>
     </div>