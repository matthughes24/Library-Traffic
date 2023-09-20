<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../Admin.css">
		<title> View/Edit Permanent Structure Locations </title>
		<script type = "text/javascript">
			function confirmDelete(StructID)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "structDelete.php?StructID=" + StructID;
				}
			} 
			function edit(StructID)
			{
				document.getElementById('edit').style.display = 'block';
				document.getElementById('StructID').value = StructID;
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
				<h1> View and Edit Permanent Structure Locations</h1>
			</div>
			
			<div id = "nav-div">
				<ul>
					<li><a href = "../adminPanel.html">Main</a></li>
					<li><a href = "../Book Locations/bookLocations.php">Book Locations</a></li>
					<li><a href = "../Shelf Locations/shelfLocations.php">Shelf Locations</a></li>
					<li><a href = "structLocations.php">Permanent Structure Locations</a></li>
					<li><a href = "../Feedback/feedback.php">Feedback Statistics</a></li>
					<li><a href = "../Book Status/bookLocationStatus.php">Book Location Status</a></li>
					<li><a href = "../../index.php">Exit</a></li>
				</ul>
			</div>
				
			<div id = "main">
				<br><button type = "button" onClick = "add()">Click here to add new record.</button><br>
				<p>Type:<br> 1 = Rectangle<br>2 = Circle</p>
				<p>Map:<br> 0 = Main Floor<br>1 = Concourse<br>2 = Ground Floor</p>
	<?php
		include ("../connect.php");
		//get records from database
	    $results_per_page = 25;
		$datatable = "PermStructLocations_f21";
		if (isset($_GET["page"])) { 
			$page  = $_GET["page"]; 
			} else { 
				$page=1; 
			}; 
         $start_from = ($page-1) * $results_per_page;
		 $sql = "SELECT * FROM " . $datatable . " ORDER BY StructID LIMIT $start_from, " .$results_per_page;

		if ($data = $conn->query($sql))
		{
			//create and display table of records if there are entries
			if ($data->num_rows > 0)
			{
				echo "<table><tr><th>StructID</th><th>Type</th><th>X</th><th>Y</th><th>Width</th><th>Height</th><th>Map</th><th></th><th></th>";
				while ($row = $data->fetch_object())
				{
					echo "<tr><td>" . $row->StructID . "</td>";
					echo "<td>" . $row->Type . "</td>";
					echo "<td>" . $row->X . "</td>";
					echo "<td>" . $row->Y . "</td>";
					echo "<td>" . $row->Width . "</td>";
					echo "<td>" . $row->Height . "</td>";
					echo "<td>" . $row->Map . "</td>";
					echo "<td><a href = 'javascript:edit(". $row->StructID .")'>Edit<a/></td>";
					echo "<td><a href = 'javascript:confirmDelete(". $row->StructID .")'>Delete</a></td></tr>";
				}
			}
			else
			{
				echo "The database is curently empty!";
			}
			echo "</table>";
		}

		$sql2 = "SELECT COUNT(StructID) AS total FROM ".$datatable;
		$result = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_assoc($result);
		$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages 
					$href = '"structLocations.php?page='.$i.'"';
					echo "<button type='button' style='display:inline;' onclick='window.location.href=".$href."'";
					if ($i==$page) echo " class='curPage' ";
		
					 
					echo ">".$i."</button> ";
		}; 

		$conn->close();
	?>
				<br><button type = "button" onClick = "add()">Click here to add new record.</button><br>
			</div>
			
		</div>
		
		<div id = "add" class = "modal">
			<form class = "modal-content animate" action = "structAdd.php" method = "post">
				<div class = "imgcontainer">
					<span onclick = "document.getElementById('add').style.display = 'none'" class = "close" title = "Close Modal">&times;</span>
				</div>
				<div class = "container">
					<h1 class = "modalh1"> Add Entry </h1>
					<!--<label>StructID</label><input type = "text" name = "StructID" value = "" required><br>-->
					<br><label>Type</label><input type = "text" name = "Type" value = "" required><br>
					<br><label>X</label><input type = "text" name = "X" value = "" required><br>
					<br><label>Y</label><input type = "text" name = "Y" value = "" required><br>
					<br><label>Width</label><input type = "text" name = "Width" value = "" required><br>
					<br><label>Height</label><input type = "text" name = "Height" value = "" required><br>
					<br><label>Map</label><input type = "text" name = "Map" value = "" required><br>
					<br><input class = "modalbutton" type = "submit" name = "submit" value = "Submit">
				</div>
				<div class = "container" style = "background-color: #f1f1f1">
					<button class = "modalbutton cancelbtn" type = "button" onclick = "document.getElementById('add').style.display = 'none'">Cancel</button>
				</div>
			</form>
		</div>	
		
		<div id = "edit" class = "modal">
			<form class = "modal-content animate" action = "structEdit.php" method = "post">
				<div class = "imgcontainer">
					<span onclick = "document.getElementById('edit').style.display = 'none'" class = "close" title = "Close Modal">&times;</span>
				</div>
				<div class = "container">
					<h1 class = "modalh1"> Edit Record </h1>
					<label>StructID</label><input id = "StructID" type = "text" name = "StructID" value = "" readonly><br>
					<br><label>Type</label><input type = "text" name = "Type" value = "" required><br>
					<br><label>X</label><input type = "text" name = "X" value = ""><br>
					<br><label>Y</label><input type = "text" name = "Y" value = ""><br>
					<br><label>Width</label><input type = "text" name = "Width" value = ""><br>
					<br><label>Height</label><input type = "text" name = "Height" value = ""><br>
					<br><label>Map</label><input type = "text" name = "Map" value = ""><br>
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