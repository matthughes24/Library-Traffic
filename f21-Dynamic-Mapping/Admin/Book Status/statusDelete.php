<?php
	include ("../connect.php");
	
	if (isset($_GET['ID']) && is_numeric($_GET['ID']))
	{
		$ID = $_GET['ID'];
		if ($stmt = $conn->prepare("DELETE FROM book_location_status WHERE ID = ? LIMIT 1"))
		{
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$stmt->close();
			// refresh page after deletion
			header ("Location: bookLocationStatus.php");
		}
		else
		{
			echo "ERROR: Cannot complete delete request.";
		}
	}
	$conn->close();
?>
