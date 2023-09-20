<?php
error_reporting(0);
include('session.php'); 
include('config.php');
if(!isset($_SESSION['login_user']))
{ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

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
</style>
<!DOCTYPE html>
<html>
   <head>
   <title>Animation</title>       
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
    <?php 
        include 'navbar.php';
    ?>

    <link href="animation.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var timesClicked1 = 0;
		var timesClicked2 = 0;
        var flag1 = "<?php echo $s1test; ?>";
        var flag2 = "<?php echo $s2test; ?>";
        var flag3 = "<?php echo $s3test; ?>";
        $(document).ready(function(){
            $(b1).click(function(){
                timesClicked1++;
                if(timesClicked1 == 1){
					$(".blank").hide();
                    if(flag1 == 1)
                    {
                        console.log(flag1);
                        $(".arrow-1").show();
                        $(".arrow-1-text").show();
                    }else{
                        $(".infinity-1").show();
                        $(".arrow-1-text").show();
                    }
                }else if(timesClicked1 == 2){
                    $(".arrow-1-text").hide();
                    $(".arrow-2-text").show();
                    if(flag2 == 1)
                    {
                        console.log(flag2);
                        $("#excelimg").show();
                        $(".arrow-2").show();
                    }else{
                        $(".infinity-2").show();
                    }
                }else{
                    $(".arrow-2-text").hide();
                    $("#excelimg").hide();
                    $(".arrow-3-text").show();
                    if(flag3 == 1)
                    {
                        console.log(flag3);
                        $("#htmlimg").show();
                        $(".arrow-3").show();
                    }else{
                        $(".infinity-3").show();
                    }
                }
            });
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
        </script>


    
    <img src="images/visualize.png" id= image1 alt="Traffic project overview">
    <div class="infinity-1" style = "display:none; position:absolute; left:232px; top:200px;"></div>
    <div class="infinity-2" style = "display:none; position:absolute; left:560px; top:200px;"></div>
    <div class="infinity-3" style = "display:none; position:absolute; left:568px; top:120px;"></div>
            <div class="arrow-1" style="display:none"></div>
			<div class="blank"><br><br><br><br>
			</div>
            <div class="arrow-1-text" style="display:none">
                <span class="caption animatable"> The Traffic Camera will count the amount of people who cross its detection line. <br>
                     Inward counts as an enter. Outward counts as an exit. </span>
            </div>
            <div class="arrow-2-text" style="display:none">
                <span class="caption animatable"> Then the camera will store the counting data in an excel file which <br>
                     the user will then manually upload to our sites database. </span>
            </div>
            <div class="arrow-3-text" style="display:none">
                <span class="caption animatable"> This data will then be propogated to our website <br>
                     which will display the data in our graphing dashboard. </span>
            </div>
            <img src="images/xlsx.png" id= excelimg alt="excel file image" style = "display:none; width: 5%; height: 5%; position:absolute; left:550px; top:300px;">
            <img src="images/html.png" id= htmlimg alt="html file image" style = "display:none; width: 3%; height: 5%; position:absolute; left:680px; top:100px;">
            <div class="arrow-2" style="display:none"></div>
            <div class="arrow-3" style="display:none"></div>
            
        <button id= b1>Next</button>
        <div>
			<img src="images/visualizerest2.PNG" id= image2 alt="Traffic project overview">
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
		</div>
    </body>
</html>
