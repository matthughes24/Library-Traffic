<?php	

include ("config.php");
include ("functions.php");	

// if submit is pressed, submit the form with updated data 
if (isset($_POST['submit'])) 
{ 
    $ID = $conn->real_escape_string($_POST['ID']); 
    $user = $conn->real_escape_string($_POST['username']); 
    $email = $conn->real_escape_string($_POST['email']); 
    $pwd = $conn->real_escape_string($_POST['pwd']);
    $admin = $conn->real_escape_string($_POST['admin']);
 
 
    if ($ID !== null && $user !== "" && $email !== "" && $pwd !== "")
    {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);        
        
        if ($stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, pwd = ?, admin = ? WHERE ID = $ID"))
        {
            $stmt->bind_param("sssi",$user,$email,$hashedPwd, $admin); $stmt->execute();
            $stmt->close(); header("Location: ../index-admin.php");
        }
        else
        {
            echo "Error: unable to complete edit request.";
        }
    }
    else
    {
        echo "Error: Please Make sure all fields are filled.";   
    }
} 
$conn->close();
    
?>	
