
<script>
    /*
    window.onload = alert(localStorage.getItem("storageName"));
    var newDate = localStorage.getItem("storageName")
    console.log(newDate)
    document.cookie = "myJavascriptVar = " + newDate
    */
    <?php 
    /*
    use Http\Discovery\HttpClientDiscovery;
    use Http\Message\CookieJar;
    use Http\Client\Common\PluginClient;
    use Http\Client\Common\Plugin\CookiePlugin;
             $phpDate ="<script>document.write(newDate);</script>";   
             $myPhpVar= $_COOKIE['myJavascriptVar'];
    */
    ?>
</script>
<?php
include('config.php');
error_reporting(0);
$conn = $link;

if(array_key_exists('import', $_POST)) {
    import();
}

function import() {
    $conn = mysqli_connect("localhost","p_f22_04","50tgon","p_f22_04_db");
    //$queryDelete = "TRUNCATE TABLE `p_f22_04_db`.`mock_data`;";
    //resultDelete = mysqli_query($conn, $queryDelete);
    //Add 365 days
    $i = 0;
    $time = 0;
    $entered = 0;
    $date = '10/10/2020';
    /*
    while ($i < 3650){
        $i++;
        //Loop for each day
        $hours_in_day = 23;
        
        while($hours_in_day >= 0){
            if($hours_in_day == 23){
                $time = '23:00-24:00';
                $entered = 0;
            }else if($hours_in_day == 22){
                $time = '22:00-23:00';
                $entered = 0;
            }else if($hours_in_day == 21){
                $time = '21:00-22:00';
                $entered = 0;
            }else if($hours_in_day == 20){
                $time = '20:00-21:00';
                $entered = 0;
            }else if($hours_in_day == 19){
                $time = '19:00-20:00';
                $entered = rand(10, 30);
            }else if($hours_in_day == 18){
                $time = '18:00-19:00';
                $entered = rand(40, 60);
            }else if($hours_in_day == 17){
                $time = '17:00-18:00'; 
                $entered = rand(60, 100);
            }else if($hours_in_day == 16){
                $time = '16:00-17:00';
                $entered = rand(60, 100);
            }else if($hours_in_day == 15){
                $time = '15:00-16:00';
                $entered = rand(75, 150);
            }else if($hours_in_day == 14){
                $time = '14:00-15:00';
                $entered = rand(100, 200);
            }else if($hours_in_day == 13){
                $time = '13:00-14:00';
                $entered = rand(100, 200);
            }else if($hours_in_day == 12){
                $time = '12:00-13:00';
                $entered = rand(150, 300);
            }else if($hours_in_day == 11){
                $time = '11:00-12:00';
                $entered = rand(150, 300);
            }else if($hours_in_day == 10){
                $time = '10:00-11:00';
                $entered = rand(75, 150);
            }else if($hours_in_day == 9){
                $time = '09:00-10:00';
                $entered = rand(75, 150);
            }else if($hours_in_day == 8){
                $time = '08:00-09:00';
                $entered = rand(75, 150);
            }else if($hours_in_day == 7){
                $time = '07:00-08:00';
                $entered = rand(25, 50);
            }else if($hours_in_day == 6){
                $time = '06:00-07:00';
                $entered = rand(5, 20);
            }else if($hours_in_day == 5){
                $time = '05:00-06:00';
                $entered = rand(0, 5);
            }else if($hours_in_day == 4){
                $time = '04:00-05:00';
                $entered = rand(0, 3);
            }else if($hours_in_day == 3){
                $time = '03:00-04:00';
                $entered = 0;
            }else if($hours_in_day == 2){
                $time = '02:00-03:00';
                $entered = 0;
            }else if($hours_in_day == 1){
                $time = '01:00-02:00';
                $entered = 0;
            }else if($hours_in_day == 0){
                $time = '00:00-01:00';
                $entered = 0;
            }    
            $hours_in_day--;
            

            $query = "INSERT INTO `mock_data` (`date`, `time`, `enter`) VALUES ('$date', '$time', '$entered');";
            $result = mysqli_query($conn, $query);
        }
        
        $datex = strtotime("+1 day", strtotime($date));
        $date = date("m/d/Y", $datex);
    }
    */

}



    


?>

<!DOCTYPE html>
<html>    
<head>

<style>    
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Import Mock Data</h2>
    
    <div class="outer-container">
            <div>
                <form method="post">
                    <input type="submit" name="import"
                    class="btn-submit" value="Import" />
                </form>
            </div>    
    </div>
</body>
</html>