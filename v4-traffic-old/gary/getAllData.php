<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
// set default timezone
date_default_timezone_set('America/New_York');
$current_date = date("Y-m-d");
//echo "Current Date: " . $current_date;
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<script src="/js/CalendarPopup.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript">      var cal = new CalendarPopup();      </script>
</head>
<body>

<div>
<form name="GateData" method="post">
<label for="date1">Date </label>: <input type="text" name="date1" id="date1" value="<?php echo $current_date; ?>" onclick="cal.select(this,this.id,'yyyy-MM-dd'); return false;" size="25" placeholder="Click Here" readonly>
<label for="type">Time span </label>: <select id="type" name="type">
  <option>daily</option>
  <option>weekly</option>
  <option>monthly</option>
  <option>yearly</option>
</select>
 <button type="submit">Get counts for this date</button>
</form>
</div>
<?php

if (isset($_POST["date1"])) {
/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
echo $_POST["date1"];

$url = "http://Datauser:Getdata!@137.140.52.68/ISAPI/System/Video/inputs/channels/1/counting/search";

//Set the start and end times of a date to get counts for a day. You could make these dates in a form.
$starttime = "2022-08-01T00:00:00";
$endtime = "2022-12-01T23:59:59";
$starttime = $_POST["date1"]."T00:00:00";
$endtime = $_POST["date1"]."T23:59:59";
$reporttype = $_POST["type"];
$payload = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><CountingStatisticsDescription><reportType>". $reporttype ."</reportType><timeSpanList><timeSpan><startTime>". $starttime ."</startTime><endTime>". $endtime ."</endTime></timeSpan></timeSpanList></CountingStatisticsDescription>";

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


        echo '<style>table {margin:10px;} table, th, td {  border: 1px dotted black;  border-collapse: collapse;} th, td {  padding: 4px;} td{text-align:right;font-family:Consolas,Courier;}</style>';
      echo '<h2 id="inBuilding"></h2>';
        echo '<h2>Table</h2><table id="myTable"><tbody><tr><th>Hour</th><th>HourEnd</th><th>Enter</th><th>Exit</th></tr>' . $datarows;
     echo '<tr><th>Totals for</th><th>'.$_POST["date1"].'</th><th id="enter">0</th><th id="exit">0</th></tr></tbody></table>';
?>

<script>
updateSubTotal(); // Initial call

function updateSubTotal() {
  var table = document.getElementById("myTable");
  let subTotalEnter = Array.from(table.rows).slice(1).reduce((total, row) => {       return total + parseFloat(row.cells[2].innerHTML); }, 0);
  document.getElementById("enter").innerHTML = subTotalEnter.toFixed(0);
  let subTotalExit = Array.from(table.rows).slice(1).reduce((total, row) => {  return total + parseFloat(row.cells[3].innerHTML); }, 0);
  document.getElementById("exit").innerHTML = subTotalExit.toFixed(0);
  let leftInBuilding = (subTotalEnter.toFixed(0) - subTotalExit.toFixed(0));
  document.getElementById("inBuilding").innerHTML = leftInBuilding + ": People in the building-aproximately.<br /><small>Remember staff can get around the gate.</small>";
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
       echo '<h2>JSON Simplified by removing "timeSpan" tags from XML</h2><textarea rows="100" cols="100" style="max-height:90vh;max-width:95%" spellcheck="false" >[' .$datarowJSON.']</textarea><br />';
      $hoursCounts = json_decode("[".$datarowJSON."]");

    echo '<h2>PHP Array from JSON decode PHP loves JSON</h2><textarea rows="100" cols="100" style="max-height:90vh;max-width:95%" spellcheck="false">';
      print_r($hoursCounts);
      echo '</textarea><br />';
}
       if ($_POST["type"]=="daily"){
         $fileDayJSON = '/var/www/html/newbookdata/'.$_POST["date1"].'GateCount.txt';
     //  file_put_contents($fileDayJSON, $datarowJSON);
         }
         if ($_POST["type"]=="monthly"){
         $fileDayJSON = '/var/www/html/newbookdata/monthOf'.$_POST["date1"].'GateCount.txt';
      // file_put_contents($fileDayJSON, $datarowJSON);
         }

?>

</body>
</html>
