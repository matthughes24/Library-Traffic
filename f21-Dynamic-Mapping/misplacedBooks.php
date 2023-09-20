<?php
	session_start();
	$admin = 0;
	if (isset($_SESSION["userAdmin"]))
	{
		$admin = $_SESSION["userAdmin"];
	}

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
	$incorrectArray = array();
	$correctArray = array();
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			array_push($incorrectArray, $row["current_floor"] . '-' . $row["current_shelf"]);
			array_push($correctArray, $row["correct_floor"] . '-' . $row["correct_shelf"]);
		}
		$result->free();
	}
	else
		{
			echo "0 results";
		}
	$conn->close();
?>

<!DOCTYPE HTML>

<html>
	<title>Library Book Locator </title>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="HandheldFriendly" content="true">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="stylesheets/MapApp.css" media="all">
		<link rel="stylesheet" type="text/css" href="stylesheets/LoginModal.css" media="all">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script>
			function color(index, color) {
                console.log(index)
				console.log("started coloring shelves");
				//Looks for shelves (<rect> objects) with the class name of the parameter (there will only be 1 or 0 results)
				var shelvesToColor = document.getElementsByClassName(index);
				for (var i = 0; i < shelvesToColor.length; i++){
					if(shelvesToColor[i] != undefined){
						console.log(shelvesToColor[i]);
						shelvesToColor[i].setAttribute("style", `fill:${color}; stroke-width:2; stroke:rgb(0,0,0)`);
						console.log(shelvesToColor[i]);
					}
				}
			}
			
			function loadDoc(el, url) { //runs PHP script to access database and display shelves
				var xhttp = new XMLHttpRequest();
				console.log(el);
				xhttp.open("GET", url, true);
				xhttp.onload = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById(el).innerHTML = this.responseText;
						var correctData = <?php echo json_encode($correctArray); ?>;
						correctData.forEach(element => color(element, "green"));
						var incorrectData = <?php echo json_encode($incorrectArray); ?>;
						incorrectData.forEach(element => color(element, "red"));
					}
				};
				xhttp.send();
			}
			loadDoc("shelvesMain", "mainFloorDisplayer.php");
			loadDoc("shelvesConcourse", "concourseDisplayer.php");
			loadDoc("shelvesGround", "groundDisplayer.php");
			
			//mouseover popup function
			function pullHash(){
				if(window.location.hash.length > 6){
					document.getElementById("textbox1").value = window.location.hash.replace("#",' ')
						getText();
				}
			}
		</script>

		<style type="text/css" media="all">
			#bookshelves {
				margin: 0 auto;
				display: none;
			}
			
			#mainfloormap {
				margin: 0 auto;
				display: block;
				height: 700px;
                width: 700px;
			}
			
			#groundfloormap {
				margin: 0 auto;
				display: block;
				height: 700px;
				width: 700px;

			}
			
			#concoursemap {
				margin: 0 auto;
				display: block;
				height: 700px;
				width: 700px;

			}
			
			#about {
				margin: 15 auto;
				display: none;
			}

			#search {
				margin: 15 auto;
				display: none;
			}
			
			.info_panel {
				background-color: rgba(255, 255, 255, .8);
				padding: 5px;
				font-size: 16px;
				font-family: Helvetica, Arial, sans-serif;
				position: absolute;
				border: 1px solid #333;
				color: #333;
				white-space: nowrap;
			}
			
			textarea {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}
			
			#submit {
				width: 100%;
				background-color: #0694CF;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}
			
			#submit:hover {
				background-color: #043E7E;
			}
			
			p {
				padding: 10%;
			}
			
			.bodydiv {
				padding: 20px;
				display: flex;
				flex-direction: row;
			}
			/* navbar */
			
			.navbar-default {
				background-color: #0694CF;
			}
			/* title */
			
			.navbar-default .navbar-brand {
				color: #777;
			}
			
			.navbar-default .navbar-brand:hover,
			.navbar-default .navbar-brand:focus {
				color: #5E5E5E;
			}
			/* link */
			
			.navbar-default .navbar-nav>li>a {
				color: white;
			}
			
			.navbar-default .navbar-nav>li>a:hover,
			.navbar-default .navbar-nav>li>a:focus {
				color: white;
				background-color: #043E7E;
			}
			
			.navbar-default .navbar-nav>.active>a,
			.navbar-default .navbar-nav>.active>a:hover,
			.navbar-default .navbar-nav>.active>a:focus {
				color: #555;
				background-color: #E7E7E7;
			}
			
			.navbar-default .navbar-nav>.open>a,
			.navbar-default .navbar-nav>.open>a:hover,
			.navbar-default .navbar-nav>.open>a:focus {
				color: #555;
				background-color: #D5D5D5;
			}
			
			.navbar-default .navbar-toggle,
			.navbar-default .navbar-toggle:hover,
			.navbar-default .navbar-toggle:focus {
				color: 333;
				background-color: #043E7E;
			}
			
			.info_panel::first-line {
				font-weight: bold;
			}

			.st01{fill:#80B4DE;}
			.st02{fill:#CAD08F;}
			.st03{fill:#FECC83;}
			.st1{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
			.st2{fill:none;stroke:#000000;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
			.st4{fill:none;}
			.st5{font-family:'Helvetica-Light';}
			.st6{font-size:50px;}
			.st7{font-family:'Helvetica';}
			.st8{font-size:24px;}

		</style>

	</head>
		<!--SVG div container-->
		<div class="bodydiv">
			<form id="test">
				<input type="hidden" name="floor" value="0"/>
			</form>
			
			<!--Book shelves SVG-->
			<svg id="bookshelves"></svg>
			<!--Main floor SVG-->
			<svg id="mainfloormap" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 720 873" style="enable-background:new 0 0 720 873;" xml:space="preserve">
				<switch>
					<g i:extraneous="self">
						<g id="color_blocks">
						
						</g>
						<g id="lines">
							<polyline class="st2" points="10.1,414.3 11.2,63 709.4,63.8 712,863.7 10,863 10.1,528 "/>
						</g>
						<g id="shelvesMain">
						<!-- mainFloorDisplayer.php takes care of displaying these shelves -->
						</g>
						<g id="text">
							<rect x="7.6" y="15.4" class="st4" width="701.9" height="48.3"/>
							<text transform="matrix(1 0 0 1 241.8191 51.4319)" class="st5 st6">Main Floor</text>
							<rect x="440.1" y="447.7" class="st4" width="182" height="56.5"/>
							<text transform="matrix(1 0 0 1 472.3978 464.9856)"><tspan x="0" y="0" class="st7 st8">Computers</tspan><tspan x="6" y="24" class="st7 st8">& Printers</tspan></text>
							<rect x="136.1" y="495.6" class="st4" width="218.6" height="23.9"/>
							<text transform="matrix(1 0 0 1 190.0314 512.8294)" class="st7 st8">Help Desk</text>
							<rect x="249" y="345" class="st4" width="111.3" height="32.9"/>
							<text transform="matrix(1 0 0 1 274.0449 362.2889)" class="st7 st8">Stairs</text>
						</g>
					</g>
				</switch>
			</svg>
			<!--Ground floor SVG-->
			<svg id="groundfloormap" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 720 886.8" style="enable-background:new 0 0 720 886.8;" xml:space="preserve">
				<switch>
					<g i:extraneous="self">
						<g id="color_blocks">
							
						</g>
						<g id="lines">
							<rect x="-48.1" y="119.1" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 830.6214 110.6306)" class="st1" width="816.2" height="703"/>
							
						</g>
						<g id="shelvesGround">
						<!-- groundDisplayer.php takes care of displaying these shelves -->
						</g>
						<g id="text">
							<rect x="7.5" y="14" class="st4" width="704.9" height="48.3"/>
							<text transform="matrix(1 0 0 1 212.7262 50.0434)" class="st5 st6">Ground Floor</text>
							<rect x="202.5" y="343.8" class="st4" width="195.3" height="61.5"/>
							<text transform="matrix(1 0 0 1 269.459 361.0605)" class="st7 st8">Stairs</text>
							<rect x="-3.9" y="560.7" class="st4" width="137.5" height="50.7"/>
							<text transform="matrix(1 0 0 1 31.5566 577.9268)"><tspan x="0" y="0" class="st7 st8">Micro-</tspan><tspan x="3.3" y="24" class="st7 st8">forms</tspan></text>
						</g>
					</g>
				</switch>
			</svg>
			<!--Concourse SVG-->
			<svg id="concoursemap" version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 720 900" style="enable-background:new 0 0 720 900;" xml:space="preserve">
				<switch>
					<g i:extraneous="self">
						<g id="color_blocks">
						
						</g>
						<g id="lines">
							<rect x="-53" y="125.2" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 837.291 116.1347)" class="st2" width="827.2" height="703"/>
						</g>
						<g id="shelvesConcourse" transform="translate(28, -25)">
							<rect x="430.5" y="704.8" class="st3" width="84.7" height="7.9"/>
							<!-- concourseDisplayer.php takes care of displaying these shelves -->
						</g>
						<g id="text">
							<rect x="7.8" y="12.4" class="st4" width="701.9" height="48.3"/>
							<text transform="matrix(1 0 0 1 236.4349 48.3583)" class="st5 st6">Concourse</text>
							<rect x="173.5" y="732.7" class="st4" width="121.8" height="52"/>
							<text transform="matrix(1 0 0 1 198.4135 750.0033)"><tspan x="-100" y="0" class="st7 st8">Create</tspan><tspan x="-100" y="24" class="st7 st8">Space</tspan></text>
							<rect x="239.3" y="351.5" class="st4" width="121.8" height="52"/>
							<text transform="matrix(1 0 0 1 269.4931 368.7356)" class="st7 st8">Stairs</text>
							<rect x="24" y="103.9" class="st4" width="195.3" height="61.5"/>
							<text transform="matrix(1 0 0 1 48.2807 121.1792)"><tspan x="0" y="0" class="st7 st8">Faculty / Staff</tspan><tspan x="9.3" y="24" class="st7 st8">Quiet Room</tspan></text>
						</g>
					</g>
				</switch>
			</svg>
		</div>
		<div id="about">
			<p>
				<h1> STL Library Call Number Locator Tool</h1>
				<h3>How to use</h3>
				<ul>
					<li> Copy Stacks call number from Library Catalog</li>
					<img src="assets/Example.png" width=100%>
					<li> Paste and Submit </li>
					<li>If a match is found, the shelf will be highlighted red</li>
				</ul>
				<br>
				Questions? Bugs? Contact me at <a href="mailto:dinardia1@hawkmail.newpaltz.edu?Subject=Library Book Finder">dinardia1@hawkmail.newpaltz.edu</a>
				<br>
				<br>
				Developed by Anthony Giordano, Brenden Wrafter, Darrell Maxwell for the Sojourner Truth Library at SUNY New Paltz Android/iOS app
				<br>
				Graphics by Kelly McInerney
				<br>
				Dynamic Mapping developed by Anthony DiNardi
			</p>
		</div>
		
		<div id="id01" class="loginmodal" style="display: none;">

			<form class="loginmodal-content animate" action="./Admin/login.php" method="post">
				<div class="imgcontainer">
					<span onclick="document.getElementById('id01').style.display='none'" class="closebtn" title="Close Modal">&times;</span>
					<img src="assets/SUNY Logo.png" alt="SUNY Logo" class="avatar">
				</div>

				<div class="container">
					<h3 style="text-align: center;">Please Log into a user account:<h3>
					<h2 style="text-align: center;"><a href='https://cs.newpaltz.edu/p/f21-17/f21-v3/index-dynamic.php' class='btn' role='button'>Login</a><h2>
					<h4 style="text-align: center;">If you are already logged into an account, that means your account does not have admin privelages. Please contact your administrator, or login to an account that has administrative capabilities.</h4>
					
				</div>
			</form>
		</div>
	</body>
</html>
