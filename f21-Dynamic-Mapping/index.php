<?php
	session_start();
	$admin = 0;
	if (isset($_SESSION["userAdmin"]))
	{
		$admin = $_SESSION["userAdmin"];
	}
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
			function loadDoc(el, url) { //runs PHP script to access database and display shelves
				var xhttp = new XMLHttpRequest();
				console.log(el);
				xhttp.open("GET", url, true);
				xhttp.onload = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById(el).innerHTML = this.responseText;
					}
				};
				xhttp.send();
			}
			loadDoc("shelvesMain", "mainFloorDisplayer.php");
			loadDoc("shelvesConcourse", "concourseDisplayer.php");
			loadDoc("shelvesGround", "groundDisplayer.php");
		</script>

		<script type="text/javascript">
			//mouseover popup function
			function pullHash(){
				if(window.location.hash.length > 6){
					document.getElementById("textbox1").value = window.location.hash.replace("#",' ')
						getText();
				}
			}
			function bookCheck(){
				var request = new XMLHttpRequest();
				request.open('GET', 'bookLocations.php', true);
				
				request.onreadystatechange = function() {
					if (this.readyState == this.DONE) {
						console.log("state change");
						var rawData = request.responseText;
						//Normalize data
						rawData = rawData.toUpperCase(); 
						rawData = rawData.replace(' ','');
						console.log("started");
						//Array of shelfs, [i][0] = start call number, [i][1] = end call number, [i][2] = floor, [i][3] = shelf number
						var items = [
							[]
						];
						var rawDataArr = rawData.split('\n');
						for (var i = 1; i < rawDataArr.length; i++) {
							var temp = rawDataArr[i].split(',');
							if (temp[1] != 'MISSING') {
								if (temp[0] != undefined && temp[1] != undefined && temp[2] != undefined && temp[3] != undefined) {
									items.push([temp[1].trim(), temp[2].trim(), temp[3].trim(), temp[0].trim()]);
								}
							}
						}

						items.splice(0, 1); //keep or remove?
						for (var i = 0; i < rawDataArr.length; i++) {
							console.log(rawDataArr[i]);
						}
						for (var i = 0; i < items.length; i++) {
							console.log(items[i]);
						}
						//Format of a call number: [Section][Subsection][Number]['.'][String]
						//Object to store shelf attributes for sorting
						function shelf(s1, ss1, n1, str1, s2, ss2, n2, str2, flr, mapno) {
							this.section1 = s1;
							this.subsection1 = ss1;
							this.number1 = n1;
							this.string1 = str1;
							this.section2 = s2;
							this.subsection2 = ss2;
							this.number2 = n2;
							this.string2 = str2;
							this.floor = flr;
							this.mapnumber = mapno;
						}
						var shelves = [];
						//Parse raw text items array into shelf objects
						for (var i = 0; i < items.length; i++) { 
							shelves.push(new shelf(items[i][0].charAt(0), "", "", "", items[i][1].charAt(0), "", "", "", items[i][2], items[i][3]));
							if (isNaN(items[i][0].charAt(1))) {
								shelves[i].subsection1 = items[i][0].charAt(1);
							}
							if (isNaN(items[i][1].charAt(1))) {
								shelves[i].subsection2 = items[i][1].charAt(1);
							}
							//Read first line of call number up to '.'
							for (var x = 0; x < items[i][0].length; x++) {
								if (isNaN(items[i][0].charAt(x)) == false && items[i][0].charAt(x) != '.') {
									shelves[i].number1 = shelves[i].number1 + items[i][0].charAt(x);
								}
								//Once '.' is found, continue iterating but adding to 'string' attribute, then break
								if (items[i][0].charAt(x) == '.') {
									for (var y = x + 1; y < items[i][0].length; y++) {
										shelves[i].string1 = shelves[i].string1 + items[i][0].charAt(y);
									}
									break;
								}
							}
							//same as above but for end value
							for (var x = 0; x < items[i][1].length; x++) {
								if (isNaN(items[i][1].charAt(x)) == false && items[i][1].charAt(x) != '.') {
									shelves[i].number2 = shelves[i].number2 + items[i][1].charAt(x);
								}
								if (items[i][1].charAt(x) == '.') {
									for (var y = x + 1; y < items[i][1].length; y++) {
										shelves[i].string2 = shelves[i].string2 + items[i][1].charAt(y);
									}
									break;
								}
							}
						}
						// start loop and open text file
						var request2 = new XMLHttpRequest();
						request2.open('GET', 'test.txt')
						request2.onreadystatechange = function() {
							
							
							text = request2.responseText
							lines = text.split("\n")
							currentIndex = lines[0]

						 for(j = 1; j<lines.length; j++)
						 {	
							var str = lines[j]
							console.log(str);
							str = str.toUpperCase();
							str = str.replace('Stacks:', '');
							str = str.trim();
							//Declaring input call number, parsing to object for useful bits
							var callno = {
								section: str.charAt(0),
								subsection: "",
								number: "",
								string: ""
							};
							if (isNaN(str.charAt(1))) {
								callno.subsection = str.charAt(1);
							}
							for (var i = 1; i < str.length; i++) {
								if (isNaN(str.charAt(i)) == false && str.charAt(i) != '.') {
									callno.number = callno.number + str.charAt(i);
								}
								if (str.charAt(i) == '.') {
									for (var x = i + 1; x < str.length; x++) {
										callno.string = callno.string + str.charAt(x);
									}
									break;
								}
							}
							
							var index;
							for (var i = 0; i < shelves.length; i++) {
								//If strictly between start and end subsection, match found
								if ((callno.section + callno.subsection) > (shelves[i].section1 + shelves[i].subsection1) && (callno.section + callno.subsection) < (shelves[i].section2 + shelves[i].subsection2)) {
									index = shelves[i].floor + "-" + shelves[i].mapnumber;
									console.log("INDEX ASSIGNED - Callnumber " + str + " section is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].section1 + shelves[i].subsection1) + " - " + callno.section + callno.subsection + " - " + (shelves[i].section2 + shelves[i].subsection2));
								}
								//If contained within start section
								else if ((callno.section + callno.subsection) == (shelves[i].section1 + shelves[i].subsection1)) {
									//If contained in start section and further in number
									if ((parseInt(callno.number, 10) > parseInt(shelves[i].number1, 10))) {
										index = shelves[i].floor + "-" + shelves[i].mapnumber;
										console.log("INDEX ASSIGNED - Callnumber " + callno.number + " number is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].number1) + "-" + (shelves[i].number2));
									}
									//If equal to start section and start number, assign if further in string
									else if ((parseInt(callno.number, 10) == parseInt(shelves[i].number1, 10))) {
										if (callno.string >= shelves[i].string1) {
											console.log("INDEX ASSIGNED - Callnumber " + callno.string + " string is STRICTLY OR EQUAL in the range of shelf " + i + " RANGE: " + (shelves[i].string1) + "-" + (shelves[i].string2));
											index = shelves[i].floor + "-" + shelves[i].mapnumber;
										}
									}

								}
								//If contained within end section
								else if ((callno.section + callno.subsection) == (shelves[i].section2 + shelves[i].subsection2)) {
									//if contained in end section and less far in number
									if ((parseInt(callno.number, 10) < parseInt(shelves[i].number2, 10))) {
										index = shelves[i].floor + "-" + shelves[i].mapnumber;
										console.log("INDEX ASSIGNED - Callnumber " + callno.number + " number is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].number1) + "-" + (shelves[i].number2));
									}
									//if equal to end section and number, assign if less far in string
									else if ((parseInt(callno.number, 10) == parseInt(shelves[i].number2, 10))) {
										if (callno.string <= shelves[i].string1) {
											console.log("INDEX ASSIGNED - Callnumber " + callno.string + " string is STRICTLY OR EQUAL in the range of shelf " + i + " RANGE: " + (shelves[i].string1) + "-" + (shelves[i].string2));
											index = shelves[i].floor + "-" + shelves[i].mapnumber;
										}
									}
								}
							}

							console.log(index);
							//get shelf in format of [floor]-[number]
							try{
							var s = document.getElementsByClassName(index.toString())[0];
							//s.setAttribute("fill", "#EC4D39");
							//s.setAttribute("stroke", "blue");
							}
							catch(err){
								document.getElementById("modalHeader").innerHTML = "Sorry!"
								document.getElementById("modalParagraph").innerHTML = "Your book wasn't found. Sorry.";
								document.getElementById("modalButton").click();                     	     
							}
							var indexFloor;
							switch(index.charAt(0)){
								case '1':
									indexFloor="Concourse";
									showConcourse();
									break;
								case '0':
									indexFloor="Main floor";
									showMain();
									break;
								case '2':
									indexFloor="Ground floor";
									showGround();
									break;
								default:
									break;
							}
							
							if(index != currentIndex){
								document.getElementById("modalParagraph").innerHTML = "misplaced book " + lines[j] + "at" + currentIndex.split('-')[1] + " on " + indexFloor;                   	
								document.getElementById("modalButton").click();
								color(currentIndex);
							}

							
							$('#bookFoundModal').on('show.bs.modal', function(e) {
								
							});           

							}
						}	

						request2.send()

						      
					}
				}

				request.send();
			}

			function getText() {
				//read text from URL
				var request = new XMLHttpRequest();
				request.open('GET', 'bookLocations.php', true);
				
				request.onreadystatechange = function() {
					if (this.readyState == this.DONE) {
						console.log("state change");
						var rawData = request.responseText;
						//Normalize data
						rawData = rawData.toUpperCase(); 
						rawData = rawData.replace(' ','');
						console.log("started");
						//Array of shelfs, [i][0] = start call number, [i][1] = end call number, [i][2] = floor, [i][3] = shelf number
						var items = [
							[]
						];
						var rawDataArr = rawData.split('\n');
						for (var i = 1; i < rawDataArr.length; i++) {
							var temp = rawDataArr[i].split(',');
							if (temp[1] != 'MISSING') {
								if (temp[0] != undefined && temp[1] != undefined && temp[2] != undefined && temp[3] != undefined) {
									items.push([temp[1].trim(), temp[2].trim(), temp[3].trim(), temp[0].trim()]);
								}
							}
						}

						items.splice(0, 1); //keep or remove?
						for (var i = 0; i < rawDataArr.length; i++) {
							console.log(rawDataArr[i]);
						}
						for (var i = 0; i < items.length; i++) {
							console.log(items[i]);
						}
						//Format of a call number: [Section][Subsection][Number]['.'][String]
						//Object to store shelf attributes for sorting
						function shelf(s1, ss1, n1, str1, s2, ss2, n2, str2, flr, mapno) {
							this.section1 = s1;
							this.subsection1 = ss1;
							this.number1 = n1;
							this.string1 = str1;
							this.section2 = s2;
							this.subsection2 = ss2;
							this.number2 = n2;
							this.string2 = str2;
							this.floor = flr;
							this.mapnumber = mapno;
						}
						var shelves = [];
						//Parse raw text items array into shelf objects
						for (var i = 0; i < items.length; i++) { 
							shelves.push(new shelf(items[i][0].charAt(0), "", "", "", items[i][1].charAt(0), "", "", "", items[i][2], items[i][3]));
							if (isNaN(items[i][0].charAt(1))) {
								shelves[i].subsection1 = items[i][0].charAt(1);
							}
							if (isNaN(items[i][1].charAt(1))) {
								shelves[i].subsection2 = items[i][1].charAt(1);
							}
							//Read first line of call number up to '.'
							for (var x = 0; x < items[i][0].length; x++) {
								if (isNaN(items[i][0].charAt(x)) == false && items[i][0].charAt(x) != '.') {
									shelves[i].number1 = shelves[i].number1 + items[i][0].charAt(x);
								}
								//Once '.' is found, continue iterating but adding to 'string' attribute, then break
								if (items[i][0].charAt(x) == '.') {
									for (var y = x + 1; y < items[i][0].length; y++) {
										shelves[i].string1 = shelves[i].string1 + items[i][0].charAt(y);
									}
									break;
								}
							}
							//same as above but for end value
							for (var x = 0; x < items[i][1].length; x++) {
								if (isNaN(items[i][1].charAt(x)) == false && items[i][1].charAt(x) != '.') {
									shelves[i].number2 = shelves[i].number2 + items[i][1].charAt(x);
								}
								if (items[i][1].charAt(x) == '.') {
									for (var y = x + 1; y < items[i][1].length; y++) {
										shelves[i].string2 = shelves[i].string2 + items[i][1].charAt(y);
									}
									break;
								}
							}
						}

						var str = document.getElementById("callnum").value;
						console.log(str);
						str = str.toUpperCase();
						str = str.replace('Stacks:', '');
						str = str.trim();
						//Declaring input call number, parsing to object for useful bits
						var callno = {
							section: str.charAt(0),
							subsection: "",
							number: "",
							string: ""
						};
						if (isNaN(str.charAt(1))) {
							callno.subsection = str.charAt(1);
						}
						for (var i = 1; i < str.length; i++) {
							if (isNaN(str.charAt(i)) == false && str.charAt(i) != '.') {
								callno.number = callno.number + str.charAt(i);
							}
							if (str.charAt(i) == '.') {
								for (var x = i + 1; x < str.length; x++) {
									callno.string = callno.string + str.charAt(x);
								}
								break;
							}
						}
						
						var index;
						for (var i = 0; i < shelves.length; i++) {
							//If strictly between start and end subsection, match found
							if ((callno.section + callno.subsection) > (shelves[i].section1 + shelves[i].subsection1) && (callno.section + callno.subsection) < (shelves[i].section2 + shelves[i].subsection2)) {
								index = shelves[i].floor + "-" + shelves[i].mapnumber;
								console.log("INDEX ASSIGNED - Callnumber " + str + " section is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].section1 + shelves[i].subsection1) + " - " + callno.section + callno.subsection + " - " + (shelves[i].section2 + shelves[i].subsection2));
							}
							//If contained within start section
							else if ((callno.section + callno.subsection) == (shelves[i].section1 + shelves[i].subsection1)) {
								//If contained in start section and further in number
								if ((parseInt(callno.number, 10) > parseInt(shelves[i].number1, 10))) {
									index = shelves[i].floor + "-" + shelves[i].mapnumber;
									console.log("INDEX ASSIGNED - Callnumber " + callno.number + " number is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].number1) + "-" + (shelves[i].number2));
								}
								//If equal to start section and start number, assign if further in string
								else if ((parseInt(callno.number, 10) == parseInt(shelves[i].number1, 10))) {
									if (callno.string >= shelves[i].string1) {
										console.log("INDEX ASSIGNED - Callnumber " + callno.string + " string is STRICTLY OR EQUAL in the range of shelf " + i + " RANGE: " + (shelves[i].string1) + "-" + (shelves[i].string2));
										index = shelves[i].floor + "-" + shelves[i].mapnumber;
									}
								}

							}
							//If contained within end section
							else if ((callno.section + callno.subsection) == (shelves[i].section2 + shelves[i].subsection2)) {
								//if contained in end section and less far in number
								if ((parseInt(callno.number, 10) < parseInt(shelves[i].number2, 10))) {
									index = shelves[i].floor + "-" + shelves[i].mapnumber;
									console.log("INDEX ASSIGNED - Callnumber " + callno.number + " number is STRICTLY in the range of shelf " + i + " RANGE: " + (shelves[i].number1) + "-" + (shelves[i].number2));
								}
								//if equal to end section and number, assign if less far in string
								else if ((parseInt(callno.number, 10) == parseInt(shelves[i].number2, 10))) {
									if (callno.string <= shelves[i].string1) {
										console.log("INDEX ASSIGNED - Callnumber " + callno.string + " string is STRICTLY OR EQUAL in the range of shelf " + i + " RANGE: " + (shelves[i].string1) + "-" + (shelves[i].string2));
										index = shelves[i].floor + "-" + shelves[i].mapnumber;
									}
								}
							}
						}

						console.log(index);
						//get shelf in format of [floor]-[number]
						try{
						var s = document.getElementsByClassName(index.toString())[0];
						//s.setAttribute("fill", "#EC4D39");
						//s.setAttribute("stroke", "blue");
						}
						catch(err){
							document.getElementById("modalHeader").innerHTML = "Sorry!"
							document.getElementById("modalParagraph").innerHTML = "Your book wasn't found. Sorry.";
							document.getElementById("modalButton").click();                     	     
						}
						var indexFloor;
						switch(index.charAt(0)){
							case '1':
								indexFloor="Concourse";
								showConcourse();
								break;
							case '0':
								indexFloor="Main floor";
								showMain();
								break;
							case '2':
								indexFloor="Ground floor";
								showGround();
								break;
							default:
								break;
						}
						if(index != undefined){
							document.getElementById("modalParagraph").innerHTML = "Your book was found on shelf " + index.split('-')[1] + " on " + indexFloor;                   	
							document.getElementById("modalButton").click();
							color(index);
						}

						
						$('#bookFoundModal').on('show.bs.modal', function(e) {
							
						});                 
					}
				}

				request.send();
			}

			function showAbout() {
				document.getElementById("mainfloormap").style.display = "none";
				document.getElementById("groundfloormap").style.display = "none";
				document.getElementById("concoursemap").style.display = "none";
				document.getElementById("about").style.display = "block";
			}

			function showMain() {
				document.getElementById("mainfloormap").style.display = "block";
				document.getElementById("groundfloormap").style.display = "none";
				document.getElementById("concoursemap").style.display = "none";
				document.getElementById("about").style.display = "none";
			}

			function showGround() {
				document.getElementById("groundfloormap").style.display = "block";
				document.getElementById("mainfloormap").style.display = "none";
				document.getElementById("concoursemap").style.display = "none";
				document.getElementById("about").style.display = "none";

			}

			function showConcourse() {
				document.getElementById("mainfloormap").style.display = "none";
				document.getElementById("groundfloormap").style.display = "none";
				document.getElementById("concoursemap").style.display = "block";
				document.getElementById("about").style.display = "none";

			}

			var classnum;
			function color(index) {
				console.log("started coloring shelves");
				if(classnum != null) {
					var shelfToWhite = document.getElementsByClassName(classnum);
					shelfToWhite[0].setAttribute("style", "fill:black;");
				}
				
				classnum = index;
				
				var shelvesToColor = document.getElementsByClassName(index);
				for (var i = 0; i < shelvesToColor.length; i++){
					if(shelvesToColor[i] != undefined){
						shelvesToColor[i].setAttribute("style", "fill:red; stroke-width:2; stroke:rgb(0,0,0)");
					}
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
			}
			
			#groundfloormap {
				margin: 0 auto;
				display: none;
			}
			
			#concoursemap {
				margin: 0 auto;
				display: none;
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
	<!-- Navigation -->
	<body onload="pullHash();">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img src="assets/NewPaltz Logo.png" height="200%" style="margin-top:1px;position:relative;top:-10px" alt="">
					</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="#" onclick="showMain();">Main Floor</a>
						</li>
						<li>
							<a href="#" onclick="showConcourse();">Concourse</a>
						</li>
						<li>
							<a href="#" onclick="showGround();">Ground Floor</a>
						</li>
						<li>
							<a href="#" onclick="showAbout();">About</a>
						</li>
						<li>
							<?php
							if ($admin === 2)
							{
							?>
								<a href="Admin/adminPanel.html">Admin</a>
							<?php
							}
							else
							{
							?>
								 <!-- <a href="#" onclick="document.getElementById('id01').style.display='block'">Admin</a> -->
							<?php
							}							
							?>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<!--Modal-->
		<a id="modalButton" href="#bookFoundModal" data-toggle="modal" data-book-id="my_id_value"></a>
			<div class="modal" id="bookFoundModal">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 id="modalHeader" class="modal-title">Call number found!</h4>
				</div>
				<div class="modal-body">
					<p id="modalParagraph"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
			</div>
		<div class="bodydiv">
			<label for="callno">Call Number:</label>
			<input type="text" id="callnum" name="callNumber" style="width:100%;padding:12px; border-radius: 8px;" placeholder="Enter call number here..."/>
			<button id="submit" onclick = "getText()" type="">Submit</button>
			<label for="bookCheck">Book Check start</label>
			<button id="submit" onclick = "bookCheck()" type="">Submit</button>
		</div>
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
