<?php
  	session_start();
    include_once 'index-navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/robot.css">
    <title>Robot</title>
</head>
<body>
	<header>
        <h1>Map of Misplaced Books</h1>
    </header>

	<div className="frame">
		<iframe src="f21-Dynamic-Mapping/misplacedBooks.php" height="800" width="100%" style="padding: 0.5rem 0.5rem;"></iframe>
	<div>
	
    <div id="spacing">
    <header>
        <h1>Misplaced Books</h1>
    </header>
	
    <div>
		<?php
			$servername = "localhost";
			$username = "p_f22_04";
			$password = "50tgon";
			$database = "p_f22_04_db";
		
			$conn = new mysqli($servername, $username, $password, $database);
			
			// Check connection
			if ($conn -> connect_error) 
			{
				die("Connection failed" .$conn->connect_error);
			}

			$sql = "SELECT * FROM misplaced_books";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			// output data of each row
			echo '<table id="tableId">
				<thead>
					<tr class="table-head"> 
						<td>Book Call #</td> 
						<td>Current Floor</td> 
						<td>Current Shelf</td> 
						<td>Correct Floor</td> 
						<td>Correct Shelf</td> 
						<td>Current Location</td>
						<td>Right Location</td>
					</tr>
				</thead>
				<tbody>';
				while ($row = $result->fetch_assoc()) {
					$book_call_number = $row["book_call_number"];
					$current_floor = $row["current_floor"];
					$current_shelf = $row["current_shelf"];
					$correct_floor = $row["correct_floor"];
					$correct_shelf = $row["correct_shelf"];
			
					echo '<tr> 
							  <td>'.$book_call_number.'</td>
							  <td>'.$current_floor.'</td>
							  <td>'.$current_shelf.'</td>
							  <td>'.$correct_floor.'</td>
							  <td>'.$correct_shelf.'</td>
							  <td><a href="current_book_location.php?data='.$book_call_number.'" target="_blank"> Click Me!</a></td>
							  <td><a href="correct_book_location.php?data='.$book_call_number.'" target="_blank"> Click Me!</a></td>
							</tr>';
				}
				$result->free();
			}
			else
				{
					echo "0 results";
				}
			echo "</tbody></table>";
			$conn->close();
		?>
    </div>
    </div>
</body>
</html>