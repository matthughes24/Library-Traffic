<?php 
	include ("../connect.php");
	// if submit is pressed, submit the form with updated data
	if (isset($_POST['submit']))
	{
		$ID = $conn->real_escape_string($_POST['ID']);
		$CallNo = $conn->real_escape_string($_POST['CallNo']);
		$CorrectShelf = $conn->real_escape_string($_POST['CorrectShelf']);
		$CurrentShelf = $conn->real_escape_string($_POST['CurrentShelf']);
		$Status = $conn->real_escape_string($_POST['Status']);
		
		if ($stmt = $conn->prepare("UPDATE book_location_status SET ID = ?, CallNo = ?, RightShelf = ?, CurrentShelf = ?, Status = ? WHERE ID = $ID"))
		{
			$stmt->bind_param("isiii",$ID,$CallNo,$CorrectShelf,$CurrentShelf,$Status);
			$stmt->execute();
			$stmt->close();
			header("Location: bookLocationStatus.php");
		}
		else
		{
			echo "Error: Unable to complete edit request.";
		}
	}	
	$conn->close();
?>	
