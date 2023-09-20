<html>
<head>
<script src="CalendarPopup.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript">	var cal = new CalendarPopup();	</script>
<title>View Camera Data</title>

<script>
     $( function() {
    $( "#datepicker" ).datepicker();
  } );
    </script>
</head>
<body>

<p> <h2> VIEW CAMERA DATA</h2> </p>
<div>
<form name="GateData" method="post">
<label for="date1">Date </label>: <input type="text" name="date1" id="date1" onclick="cal.select(this,this.id,'yyyy-MM-dd'); return false;" size="25" placeholder="Click Here" readonly> 

 <button type="submit">Get counts for this date</button>
</form>
</div>
<?php 
include('config.php');

if (isset($_POST["date1"])) {
/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
echo $_POST["date1"];

$url = "http://Datauser:Getdata!@137.140.52.68/ISAPI/System/Video/inputs/channels/1/counting/search";

//Set the start and end times of a date to get counts for a day. You could make these dates in a form. 
$starttime = "2022-11-15T00:00:00";
$endtime = "2022-11-15T23:59:59";
$starttime = $_POST["date1"]."T00:00:00";
$endtime = $_POST["date1"]."T23:59:59";
$payload = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><CountingStatisticsDescription><reportType>daily</reportType><timeSpanList><timeSpan><startTime>". $starttime ."</startTime><endTime>". $endtime ."</endTime></timeSpan></timeSpanList></CountingStatisticsDescription>";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

/* headers not needed???
'x-requested-with': "XMLHttpRequest",
'if-modified-since': "0",
'user-agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36",
'content-type': "application/x-www-form-urlencoded; charset=UTF-8",
'referer': "http://137.140.52.68/doc/page/application.asp",
'accept-encoding': "gzip, deflate",
'accept-language': "en-AU,en;q=0.9",
'cookie': "language=en; language=en",
'cache-control': "no-cache"
*/

//$headers = array( 'x-requested-with': "XMLHttpRequest",'if-modified-since': "0");
//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//curl_setopt($curl, CURLOPT_POSTFIELDS, $headers);

$resp = curl_exec($curl);
curl_close($curl);


	  $justrows = '/<matchList>(.*)<\/matchList>/Uis';
      preg_match($justrows , $resp, $datarowsxml);
	  if (isset($datarowsxml[1])){$datarows = $datarowsxml[1];}
	  $datarows= preg_replace('/<[\/]*timeSpan>/', '', $datarows);
	  $datarows= preg_replace('/matchElement/', 'tr', $datarows);
$find = ['/startTime/', '/endTime/','/enterCount/', '/exitCount/', '/peoplePassingCount/'];
$replace = ['td', 'td','td', 'td','td'];
$datarows = preg_replace($find, $replace, $datarows);

	  //$datarows= preg_replace('/matchElement/', 'tr', $datarows);
	 // echo '<textarea rows="100" cols="100" style="max-height:95%;max-width:95%" >'.$datarows.'</textarea><br />';
	  echo '<style>table {margin:10px;} table, th, td {  border: 1px dotted black;  border-collapse: collapse;} th, td {  padding: 4px;} td{text-align:right;font-family:Consolas,Courier;}</style>';
	  echo '<h2>Table</h2><table id="myTable"><tbody><tr><th>Hour</th><th>HourEnd</th><th>Enter</th><th>Exit</th><th>Pass</th></tr>' . $datarows;
     echo '<tr><th>Totals for</th><th>'.$_POST["date1"].'</th><th id="enter">0</th><th id="exit">0</th><th id="pass">0</th></tr></tbody></table><br />';
?>
<script>
updateSubTotal(); // Initial call

function updateSubTotal() {
  var table = document.getElementById("myTable");
  let subTotalEnter = Array.from(table.rows).slice(1).reduce((total, row) => {	 return total + parseFloat(row.cells[2].innerHTML); }, 0);
  document.getElementById("enter").innerHTML = subTotalEnter.toFixed(0);
  let subTotalExit = Array.from(table.rows).slice(1).reduce((total, row) => {	 return total + parseFloat(row.cells[3].innerHTML); }, 0);
  document.getElementById("exit").innerHTML = subTotalExit.toFixed(0);
  let subTotalPass = Array.from(table.rows).slice(1).reduce((total, row) => {	 return total + parseFloat(row.cells[4].innerHTML); }, 0);
  document.getElementById("pass").innerHTML = subTotalPass.toFixed(0);
}     //  alert(row.cells[2].innerHTML)
</script>
<?php
// Move raw data to second on display
echo '<h2>RawXML This is the data as it is returned. Not my favorite.</h2><textarea id="dataout" name="dataout" rows="100" cols="100" style="max-height:90vh;max-width:95%" spellcheck="false" >'.$resp."</textarea>";	  
	  if (isset($datarowsxml[1])){$datarowJSON = $datarowsxml[1];}
	  $datarowJSON= preg_replace('/<[\/]*timeSpan>/', '', $datarowJSON);
	  
	 $datarowJSON= preg_replace('/<matchElement>/', '{', $datarowJSON);
	 $datarowJSON= preg_replace('/<\/matchElement>/', '},', $datarowJSON);
     $find = ['/<\/startTime>/', '/<\/endTime>/','/<\/enterCount>/', '/<\/exitCount>/', '/<\/peoplePassingCount>/'];
$replace = [',', ',', ',', ',', ','];
$datarowJSON = preg_replace($find, $replace, $datarowJSON);
$find = ['/<([^>]+)>([^,]+)/'];
$replace = ['"$1":"$2"'];
$datarowJSON = preg_replace($find, $replace, $datarowJSON);
$datarowJSON = preg_replace("/[\r\n][\r\n][\r\n]/", "", $datarowJSON);
$datarowJSON= preg_replace('/,[\r\n]+\}/', "\r\n}", $datarowJSON);
$datarowJSON= preg_replace('/:"(\d+)"/', ":$1", $datarowJSON);
$datarowJSON = rtrim($datarowJSON, ",\r\n"); 
	 echo '<h2>JSON Simplified by removing "timeSpan" tags from XML</h2><textarea rows="100" cols="100" style="max-height:90vh;max-width:95%" spellcheck="false" >' .$datarowJSON.'</textarea><br />';
	$hoursCounts = json_decode("[".$datarowJSON."]");

    echo '<h2>PHP Array from JSON decode PHP loves JSON</h2><textarea rows="100" cols="100" style="max-height:90vh;max-width:95%" spellcheck="false">';
	print_r($hoursCounts);
	echo '</textarea><br />';
}


//Insert Camera Data into traffic_Cam_Data
$conn = $link;

		$token = @strtok($datarowsxml[1], "<");
		$timeVar = 0;
		$once = 0;
		while ($token !== false){
			//echo "$token<br>";
			$token = strtok("<");

			//Get Date
			if(str_starts_with($token, "startTime") && $once == 0){
				$dateVar = substr($token, 10, 10);
				$once = 1;
			}
			//Get Enter Var
			if(str_starts_with($token, "enterCount")){
				$enterVar = substr($token, 11, 3);
			}

			//Get Exit Var
			if(str_starts_with($token, "exitCount")){
				$exitVar = substr($token, 10, 3);

				$queryInsert = "INSERT INTO `traffic_Cam_Data` (`dateStart`, `timeStart`, `enterCount`, `exitCount`) 
        		VALUES ('$dateVar', '$timeVar', '$enterVar','$exitVar');";
        		$result = mysqli_query($conn, $queryInsert);

				$timeVar += 1;
			}
		}
?>

</body>
</html>