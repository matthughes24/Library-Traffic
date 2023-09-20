<?php
    include_once 'index-navbar.php';
    include_once 'scripts/config.php';
    
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
?>

<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="styles/adminStyle.css">

        <meta charset = "UTF-8">
        <title> View/Edit Book Locations </title>
        <script type = "text/javascript">
                function confirmDelete(ID)
                {
                        if (confirm("Are you sure you want to delete this Account?"))
                        {
                                window.location.href = "scripts/accountDelete.php?ID=" + ID;
                        }
                } 
                function editAccount(ID, username, email, pwd, admin)
                {
                        currlevel = "Current Level: ";
                        document.getElementById('edit').style.display = 'block';
                        document.getElementById('ID').value = ID;
                        document.getElementById('username').value = username;
                        document.getElementById('email').value = email;
                        document.getElementById('pwd').value = pwd;
                        document.getElementById('admin').innerHTML = currlevel.concat(admin);
                }
        </script>
</head>
<body style="background: orange;">

    <div class="card">
        <div class="card-header">
            <h1 align="center">Administrative Tools</h1>
        </div>
        <div class="card-body">
            <table class="table table-dark">
                <thead>
                    <tr align="center">
                        <th colspan="5" align="center"><h5 border="2px">Select A User Account To Configure</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                <?php
                        while($rows = $result->fetch_assoc())
                        {
                ?>        
                            <tr>
                                <td align="center"><?php echo $rows['ID']; ?></td>
                                <td align="center"><?php echo $rows['username']; ?></td>
                                <td align="center"><?php echo $rows['email']; ?></td>
                                <td align="center"><?php echo $rows['admin']; ?></td>
                                <td align='center'><a class='bi bi-gear btn-outline-light' href='javascript:editAccount(<?php echo $rows['ID']; ?> , <?php echo json_encode($rows['username']); ?> , <?php echo json_encode($rows['email']); ?> , <?php echo json_encode($rows['pwd']); ?> , <?php echo $rows['admin']; ?>)' style='padding-right:20px;'></a><a href='javascript:confirmDelete(<?php echo $rows['ID']; ?>)' class='btn btn-outline-light' role='button'>Delete</a></td>
                            </tr>
                <?php
                    }
                ?>
                <tbody>
            </table>
        </div>
    </div>
    
    
    <div id = "edit" class = "modal">
        <form class = "modal-content animate" action = "scripts/editAccount.php" method = "post">
                <div class = "container">
                        <h1 class = "modalh1"> Edit Account </h1>
                        <label style="font-weight: bold;">ID</label><input id = "ID" type = "text" name = "ID" value = "" readonly><br>
                        <br><label style="font-weight: bold;">Username</label><input id = "username" type = "text" name = "username" value = "" required><br>
                        <br><label style="font-weight: bold;">Email</label><input id = "email" type = "text" name = "email" value = "" required><br>
                        <br><label style="font-weight: bold;">Password</label><input id = "pwd" type = "text" name = "pwd" value = "" required><br>
                        <br><label style="font-weight: bold;">Admin Level</label><p id = "admin"></p>
                        <br><label style="padding-right: 5px;">Local(0)</label><input type = "radio" name = "admin" value = "0" required>
                        <label style="padding-right: 5px;">Staff(1)</label><input type = "radio" name = "admin" value = "1" required>
                        <label style="padding-right: 5px;">Admin(2)</label><input type = "radio" name = "admin" value = "2" required>
                        <br><br><br><br><br>
                </div>
                <div class = "container" style = "background-color: #467fd0; text-align: center;">
                        <button class = "modalbutton cancelbtn" type = "button" onclick = "document.getElementById('edit').style.display = 'none'">Cancel</button>
                        <input class = "modalbutton" type = "submit" name = "submit" value = "Submit">

                </div>
        </form>
    </div>

<script>
        var modal1 = document.getElementById('edit');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) 
        {
		if (event.target == modal1) 
		{
			modal1.style.display = "none";
		}
        }
</script>


</body>

<?php
    include_once 'index-footer.php';
?>
