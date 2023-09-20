<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../Admin.css">
		<title> View Your Current Book Location Status </title>
		<script type = "text/javascript">
			function confirmDelete(ID)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "statusDelete.php?ID=" + ID;
				}
			} 
			function edit(ID)
			{
				document.getElementById('edit').style.display = 'block';
				document.getElementById('ID').value = ID;
			}
			function add()
			{
				document.getElementById('add').style.display = 'block';
			}
		</script>
	</head>

	<body>
		<div id = "wrapper">
			<div id = "header-div">
				<h1> View Current Book Locations That Are Detected By The Robot</h1>
			</div>
			
			<div id = "nav-div">
				<ul>
					<li><a href = "../adminPanel.html">Main</a></li>
					<li><a href = "../Book Locations/bookLocations.php">Book Locations</a></li>
					<li><a href = "../Shelf Locations/shelfLocations.php">Shelf Locations</a></li>
					<li><a href = "../PermStruct Locations/structLocations.php">Permanent Structure Locations</a></li>
					<li><a href = "../Feedback/feedback.php">Feedback Statistics</a></li>
                                        <li><a href = "../Book Status/bookLocationStatus.php">Book Location Status</a></li>
					<li><a href = "../../index.php">Exit</a></li>
				</ul>
			</div>
				
			<div id = "main">
	<?php
		include ("../connect.php");
		//get records from database
	    $results_per_page = 25;
		$datatable = "book_location_status";
		if (isset($_GET["page"])) { 
			$page  = $_GET["page"]; 
			} else { 
				$page=1; 
			}; 
         $start_from = ($page-1) * $results_per_page;
		 $sql = "SELECT * FROM " . $datatable . " ORDER BY ID LIMIT $start_from, " .$results_per_page;

		if ($data = $conn->query($sql))
		{
			//create and display table of records if there are entries
			if ($data->num_rows > 0)
			{
				echo "Status:";
				echo "<br>";
				echo "0 = Fixed/Correct Placement";
				echo "<br>";
				echo "1 = Incorrect Placement";
				echo "<br>";
				echo "<table><tr><th>ID</th><th>Call No.</th><th>Correct Shelf</th><th>Current Shelf</th><th>Discover Time</th><th>Status</th><th></th><th></th>";
				while ($row = $data->fetch_object())
				{
					echo "<tr><td>" . $row->ID . "</td>";
					echo "<td>" . $row->CallNo . "</td>";
					echo "<td>" . $row->RightShelf . "</td>";
					echo "<td>" . $row->CurrentShelf . "</td>";
					echo "<td>" . $row->DiscoverTime . "</td>";
					echo "<td>" . $row->Status . "</td>";
					echo "<td><a href = 'javascript:edit(". $row->ID .")'>Edit<a/></td>";
					echo "<td><a href = 'javascript:confirmDelete(". $row->ID .")'>Delete</a></td></tr>";
				}
			}
			else
			{
				echo "The Robot hasn't detected any outstanding book locations!";
			}
			echo "</table>";
		}

		$sql2 = "SELECT COUNT(ID) AS total FROM ".$datatable;
		$result = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_assoc($result);
		$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages 
					$href = '"bookLocationStatus.php?page='.$i.'"';
					echo "<button type='button' style='display:inline;' onclick='window.location.href=".$href."'";
					if ($i==$page) echo " class='curPage' ";
		
					 
					echo ">".$i."</button> ";
		}; 

		$conn->close();
	?>
			</div>
			
		</div>
		
		<div id = "edit" class = "modal">
			<form class = "modal-content animate" action = "statusEdit.php" method = "post">
				<div class = "imgcontainer">
					<span onclick = "document.getElementById('edit').style.display = 'none'" class = "close" title = "Close Modal">&times;</span>
				</div>
				<div class = "container">
					<h1 class = "modalh1"> Edit Record </h1>
					<label>ID</label><input id = "ID" type = "text" name = "ID" value = "" readonly><br>
					<br><label>Call No.</label><input id= "CallNo" type = "text" name = "CallNo" value = ""><br>
					<br><label>Correct Shelf</label><input id = "RightShelf" type = "text" name = "CorrectShelf" value = ""><br>
					<br><label>Current Shelf</label><input id = "CurrentShelf" type = "text" name = "CurrentShelf" value = ""><br>
					<br><label>Status</label><input id = "Status" type = "text" name = "Status" value = ""><br>
					<br><input class = "modalbutton" type = "submit" name = "submit" value = "Submit">
				</div>
				<div class = "container" style = "background-color: #f1f1f1">
					<button class = "modalbutton cancelbtn" type = "button" onclick = "document.getElementById('edit').style.display = 'none'">Cancel</button>
				</div>
			</form>
		</div>
		
		<script>
		var modal1 = document.getElementById('add');
		var modal2 = document.getElementById('edit');
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) 
		{
			if (event.target == modal1 || event.target == modal2) 
			{
				modal1.style.display = "none";
				modal2.style.display = "none";
			}
		}
		</script>
	</body>
</html>
