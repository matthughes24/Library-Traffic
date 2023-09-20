<?php
    include_once 'index-navbar.php';
?>


<title> Register WEBSITE </title> 
</head> 
<body style="background: orange;">
<div class="card text-center">
    <div class="card-header">
        <h1>Register</h1>
    </div>
    <form method="post" action="scripts/register.php">
        <div class="card-body">
            <h5 class="card-title">Please fill out the registration form to create an account</h5>
            <h5>User Name:
            <input type="text" name="username">
            <h5 style="padding-left: 15px;">Password:
            <input type="password" name="pwd">
            <h5 style="padding-right: 53px;">Repeat Password:
            <input type="password" name="pwdrep">
            <h5 style="padding-left: 52px;">Email:
            <input type="text" name="email">
            <h5 style="padding-left: 100px;">
            <button type="submit" name="Enter">Register</button>
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
            else if ($_GET["error"] == "invalidusername")
            {
                echo "<p>Choose a proper username</p>";
            }
            else if ($_GET["error"] == "invalidemail")
            {
                echo "<p>Choose a proper email</p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch")
            {
                echo "<p>Passwords don't match</p>";
            }
            else if ($_GET["error"] == "usernameexists")
            {
                echo "<p>This username already exists, please choose another one</p>";
            }
            else if ($_GET["error"] == "none")
            {
                echo "<p>You have signed up!</p>";
            }

        }
        ?>
    </div>    
</div>

</body>
</html>

<?php
        include_once 'index-footer.php';
?>
