<?php
error_reporting(0);
include('updateExistingUserToAdmin.php');
include('config.php');

$link;

echo "<h2>Choose which instructor you would like to give access to admin-level privileges</h2>";
echo "<form action='' method='post'>";
echo "<select name='choice'>";

while ($row = mysqli_fetch_array($result))
{
echo "<option value='".$row["lastname"]."'>".$row["lastname"].", ".$row["firstname"]."</option>";
}
echo "</select>";
echo "<input name='submit' type='submit' value='Submit'>";
echo "</form>";
?>

<HTML>
  <HEAD>
       <TITLE>Add Admin to Existing User</TITLE>
  </HEAD>
</HTML>
