<?php
error_reporting(0);
include('login.php'); // Includes Login Script
?>
<html>	
<head>
    <title>Login</title>
    <style>
        #login {
            background-color: #003e7e;
			border-radius: 20px;
			margin: 0 auto;
			margin-top: 20px;
			padding: 20px;
			width: 800px;
			color: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        }
        
        #login h1 {
            text-align: center;
            font-size: 30px;
        }

		#login p {
            font-size: 20px;
			margin-bottom: 10px;
			font-weight: 550;
        }
        
        #login input[type="text"],
        #login input[type="password"] {
			font-size: 20px;
            width: 100%;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #login input[type="submit"] {
            width: 100%;
            padding: 15px;
            border-radius: 5px;
            border: none;
            background-color: #337ab7;
            color: #fff;
            font-size: 25px;
			font-weight: 550;
            cursor: pointer;
			margin: 20px 0;
        }
        
        #login input[type="submit"]:hover {
            background-color: #286090;
        }
        
        #login .error-message {
            font-size: 20px;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('https://www.newpaltz.edu/media/ocm/images/blue-repeat-logo.png'); background-size: cover;">
    <?php 
        include 'navbar.php';
    ?>
    <div id="login">
        <br>
        <h1 id="loginFont">Login</h1>
        <br>	
        <form action="" method="post">
            <p>Username</p>
            <input id="name" type="text" name="username" placeholder="Enter Username" required>
            <p>Password</p>
            <input id="password" type="password" name="password" placeholder="Enter Password" required>           
            <input id="submit" name="submit" type="submit" value="Login">           
        </form>

        <div class="error-message">
            <?php echo $error; ?>
        </div>
    </div>
</body>
</html>