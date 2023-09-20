<script>
    window.onload = alert(localStorage.getItem("storageName"));
    var newDate = localStorage.getItem("storageName")
    console.log(newDate)
    document.cookie = "myJavascriptVar = " + newDate
    <?php 
    use Http\Discovery\HttpClientDiscovery;
    use Http\Message\CookieJar;
    use Http\Client\Common\PluginClient;
    use Http\Client\Common\Plugin\CookiePlugin;
             $phpDate ="<script>document.write(newDate);</script>";   
             $myPhpVar= $_COOKIE['myJavascriptVar'];
          ?>
</script>
<?php
error_reporting(0);
$conn = mysqli_connect("localhost","p_f22_04","50tgon","p_f22_04_db");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
if (isset($_POST["import"]))
{
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType))
  {
        $targetPath = 'uploads/'.$_FILES['file']['name'];

        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        $count = 0;
        $index = 0;
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            $switch = 0;
            $currentLine = 338;
            foreach ($Reader as $Row)
            {
                $count++;
                if($count == $currentLine + 6 && $count < 485){
                    $time = $Row[0];
                    $trimmedTime = trim($time, "</td>");

                    $currentLine = $count;
                    $switch = 1;
                    
                } else if($count == $currentLine + 2 && $switch == 1 && $count < 485){
                    $people = $Row[0];
                    $trimmedPeople = trim($people, "</td>");

                    $queryTime = "INSERT INTO `cam_exit` (`date`, `time`, `exited`) VALUES ('$myPhpVar', '$trimmedTime', '$trimmedPeople');";
                    echo $trimmedPeople;
                    $resultTime = mysqli_query($conn, $queryTime);
                    $switch = 0;
                    $index++;
                }
             }
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
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
    <h2>Import Daily Exit Excel File</h2>
    
    <div class="outer-container">
        <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel File to Upload and Import</label>
                
		<h4>To be used ONLY to upload information for Daily Report Data</h4>
        <?php echo($myPhpVar)  ?>
		<input type="file" name="file" id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            </div>    
        </form>
    </div>

    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div> 
</body>
</html>
