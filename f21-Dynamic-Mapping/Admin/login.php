<?php
	include ("connect.php");
	include ("functions.php");
	// check if submit is pressed, then process inputs
	if (isset($_POST['submit']))
	{
		$Username = $conn->real_escape_string($_POST['Username']);
		$usernameExists = usernameExists($conn, $Username, $Username);
		$passwordHashed = $usernameExists["pwd"];
		$Password = $conn->real_escape_string($_POST['Password']);
		$checkPassword = password_verify($Password, $passwordHashed);
		$stmt = $conn->query("SELECT * FROM users WHERE username = '{$Username}' AND pwd = '{$passwordHashed}' LIMIT 1");
		if ($usernameExists["admin"] !== 2)
		{
			echo "Error: This Account does not have admin privelages. Please contact your administrator";
			
			echo "<br><br><a href=\"javascript:history.go(-1)\"><button type = 'submit' name = 'retry'> Retry </button></a>";
		}
		// if a match is found, direct to admin controls page
		if ($stmt->num_rows == 1 && $usernameExists["admin"] === 2)
		{
			header ("Location: adminPanel.html");
		}
		//check that all fields are filled
		else
		{
			echo "Error: Invalid Login Credentials.";
	
			echo "<br><br><a href=\"javascript:history.go(-1)\"><button type = 'submit' name = 'retry'> Retry </button></a>";
		}
	}
	$conn->close();
?>

