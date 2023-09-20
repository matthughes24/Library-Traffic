<?php
	error_reporting(0);
	include('session.php');
	include_once 'index-navbar.php';
	if(!isset($_SESSION['login_user']))
	{ 
	  //header("location: index.php"); // Redirecting To Home Page 
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<style>
			.button {
			display: inline-block;
			outline: 0;
			border: 0;
			cursor: pointer;
			background-color: #497de6;
			border-radius: 4px;
			padding: 8px 16px;
			font-size: 14px;
			color: white;
			line-height: 25px;
			margin-right: 10px;
			}
			
			.flex-container {
				display:flex;
				justify-content: center;
				align-items: center;
				padding: 10px;
			}
			
			.flex-check {
				display:flex;
				justify-content: center;
				align-items: center;
			}
			
			figure {
				align-items: center;
				width: 200px;
				margin: 0px;
			}
			
			figcaption {
				justify-content: center;
				margin: 0 auto;
				align-self: center;
				width: fit-content;
			}
		</style>
	</head>
   <?php
	    $myfile = fopen("uploads/s1-camera.txt", "r") or die("Unable to open for read file1!");
		$s1test = fread($myfile,filesize("uploads/s1-camera.txt"));
		fclose($myfile);
		$myfileIn = fopen("uploads/s2-cameraIn.txt", "r") or die("Unable to open for read file2!");
		$s2test = fread($myfileIn,filesize("uploads/s2-cameraIn.txt"));
		fclose($myfileIn);
		$myfileTraffic = fopen("uploads/s3-traffic.txt", "r") or die("Unable to for read open file3!");
		$s3test = fread($myfileTraffic,filesize("uploads/s3-traffic.txt"));
		fclose($myfileTraffic);
   ?>

    <body>

    <link href="animation.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
	
	var timesClicked2 = 0;
        var flag1 = "<?php echo $s1test; ?>";
        var flag2 = "<?php echo $s2test; ?>";
        var flag3 = "<?php echo $s3test; ?>";
        $(document).ready(function(){
         			
	$(b2).click(function(){
                timesClicked2++;
                if(timesClicked2 == 1){
                    	$(".arrow-4").show();
			$(".arrow-4-text").show();
                }else if(timesClicked2 == 2){
			$(".arrow-5").show();
                    	$(".arrow-4-text").hide();
                    	$(".arrow-5-text").show();
		}else if(timesClicked2 == 3){
			$(".arrow-6").show();
                    	$(".arrow-5-text").hide();
                    	$(".arrow-6-text").show();
		}else if(timesClicked2 == 4){
                    	$(".arrow-6-text").hide();
			$(".arrow-7").show();
                    	$(".arrow-7-text").show();
		}
		else if(timesClicked2 == 5){
			$(".arrow-7-text").hide();
			$(".arrow-8").show();
                    	$(".arrow-8-text").show();

			
		}

            });
        });
		
		 
		function change(){
			var image = document.getElementById('circle');
			if(image_tracker=='orange'){
			image.src='blue.png';
			image_tracker='blue';
			}
			else{
			image.src='orange.png';
			image_tracker='orange';
			}
		}
        </script>


    
    <div class="infinity-1" style = "display:none; position:absolute; left:232px; top:200px;"></div>
    <div class="infinity-2" style = "display:none; position:absolute; left:560px; top:200px;"></div>
    <div class="infinity-3" style = "display:none; position:absolute; left:568px; top:120px;"></div>
                <div class="flex-container">
					<figure>
						<img src="images/Robot.png" id="robotImg" alt="Image example of robot" style="height:100%;width:100%;"/>
						<figcaption>Robot through Library.</figcaption>
					</figure>
					<img src="assets/arrow.png" id="arrow0" alt="An arrow pointing towards the right" style="height:7%;width:7%;">
					<img src="assets/clara.png" id="claraImg" alt="Image example of clara" style="height:8%;width:8%;">
					<img src="assets/arrow.png" id="arrow1" alt="An arrow pointing towards the right" style="height:7%;width:7%;">
					<figure>
						<img src="assets/database.png" id="databaseImg" alt="Image example of database" style="height:100%;width:100%;">
						<figcaption>Database</figcaption>
					</figure>
					<img src="assets/arrow.png" id="arrow1" alt="An arrow pointing towards the right" style="height:7%;width:7%;">
					<figure>
						<img src="assets/misplacedex.png" id="databaseImg" alt="Image example of misplaced books" style="height:100%;width:100%;">
						<figcaption>Misplaced Page</figcaption>
					</figure>
				</div>
				<div class="flex-check">
					<img src="assets/checkmark.png" id="checkmark0" alt="checkmark under robot" style="height:4%;width:4%;margin-right: 125px;">
					<img src="assets/checkmark.png" id="checkmark1" alt="checkmark under clara" style="height:4%;width:4%;margin-left: 110px;">
					<img src="assets/checkmark.png" id="checkmark2" alt="checkmark under database" style="height:4%;width:4%;margin-left: 220px;">
					<img src="assets/checkmark.png" id="checkmark3" alt="checkmark under website" style="height:4%;width:4%;margin-left: 250px;">
				</div>
			<!--<img src="images/visualizerest2.PNG" id= image2 alt="Traffic project overview">-->
			<div class="arrow-4-text" style="display:none">
                <span class="caption animatable"> The robot moves to different bookshelves. <br>
                     The cameras in the robot takes pictures of the books. </span>
            </div>
			<div class="arrow-5-text" style="display:none">
                <span class="caption animatable"> The robot sends the images of the books in the form of a .jpg <br>
                     file to an image processor. </span>
            </div>
			<div class="arrow-6-text" style="display:none">
                <span class="caption animatable"> The image processor determines the code on the side of each <br>
                     book. </span>
            </div>
			<div class="arrow-7-text" style="display:none">
                <span class="caption animatable"> The books call number is then uplodaed to the website database 
		</span>
            </div>
	    </div>
			<div class="arrow-8-text" style="display:none">
                <span class="caption animatable"> The information stored on the database is then displayed <br> in the digital library map if the book is out of place
		</span>
            </div>
			
			<div class="arrow-4" style="display:none"></div>
			<div class="arrow-5" style="display:none"></div>
			<div class="arrow-6" style="display:none"></div>
			<div class="arrow-7" style="display:none"></div>
			<div class="arrow-8" style="display:none"></div>

			<button id= b2>Next</button>
			<button id= check>Test Checks</button>
		</div>
    </body>
</html>
