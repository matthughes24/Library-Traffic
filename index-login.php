<?php
  include_once 'index-navbar.php';
?>

<html>
<head>
 <title> Login </title> 
</head> 
<body style="background-color:orange;">

<CENTER>

<div class="card text-center">
  <div class="card-header">
    <h1>Login</h1>
  </div>
  <form method="post" action="scripts/login.php">
       <div class="card-body">
         <h5 class="card-title">Please enter your credentials</h5>
         <h5>User Name:
         <input type="text" name="username">
         <h5 style="padding-left: 15px;">Password:  
         <input type="password" name="pwd">
         <h5 style="padding-left: 100px">
         <button type="submit" name="Enter">Submit</button>
       </div>
  </form>
  <div class="card-footer text-muted">
    <?php
      if (isset($_GET["error"]))
        {
                if ($_GET["error"] == "emptyinput")
                {
                        echo "<p>Please fill in all fields</p>";
                }
                else if ($_GET["error"] == "invalidcreds")
                {
                        echo "<p>Invalid Credentials</p>";
                }
        }
    ?>
  </div>
</div>

</CENTER>

</body>
</html>

<?php
        include_once 'index-footer.php';
?>
