<?php
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
?> 