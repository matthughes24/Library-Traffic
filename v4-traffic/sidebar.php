<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bx-menu'></i>
      <span class="logo_name"><a id="admin-button" href="adminProfile.php">ADMIN DASHBOARD</a></span>
    </div>
    <ul class="nav-links">
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-collection'></i>
            <span class="link_name">MANAGE WEBSITE DATA</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">MANAGE WEBSITE DATA</a></li>
          <li><a href="importExcelMakeAChoice.php">Upload to Database</a></li>
          <li><a href="exportDataMakeAChoice.php">Download from Database</a></li>
          <li><a href="warningDeleteData.php">Delete Traffic Data</a></li>
          <li><a href="monitorTrafficSystem.php">Animation</a></li>
        </ul>
      </li>
      <br>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">MANAGE CAMERA DATA</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">MANAGE CAMERA DATA</a></li>
          <li><a href="cameraData.php">View Camera Data</a></li>
          <li><a href="cameraDataTransfer.php">Transfer Camera Data</a></li>
          <li><a href="cameraDataViewTransferred.php">See Transferred Data</a></li>
        </ul>
      </li>
      <br>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-line-chart'></i>
            <span class="link_name">ANALYTICS (Mock Data)</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">ANALYTICS (Mock Data)</a></li>
          <li><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogDaily.php">Mock Daily Traffic Log</a></li>
          <li><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogWeekly.php">Mock Weekly Traffic Log</a></li>
          <li><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogMonthly.php">Mock Monthly Traffic Log</a></li>
          <li><a href="https://cs.newpaltz.edu/p/s23-02/v1/v4-traffic/trafficLogAnually.php">Mock Annual Traffic Log</a></li>         
        </ul>
      </li>
      <br>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-line-chart'></i>
            <span class="link_name">BASIC FILTERING</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">BASIC FILTERING</a></li>
          <li><a href="trafficLogDaily.php">Daily Traffic Log</a></li>
          <li><a href="trafficLogWeekly.php">Weekly Traffic Log</a></li>
          <li><a href="trafficLogMonthly.php">Monthly Traffic Log</a></li>
          <li><a href="trafficLogAnnually.php">Annual Traffic Log</a></li>          
        </ul>
      </li>
      <br>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-line-chart'></i>
            <span class="link_name">ADVANCED FILTERING</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">ADVANCED FILTERING</a></li>
          <li><a href="p1d.php">Advanced Daily Traffic Log</a></li>
          <li><a href="p2w.php">Advanced Weekly Traffic Log</a></li>
          <li><a href="p3m.php">Advanced Monthly Traffic Log</a></li>
          <li><a href="trafficLogAnnually.php">Advanced Annual Traffic Log</a></li>        
        </ul>
      </li>
      <br>
      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-plug'></i>
            <span class="link_name">USER MANAGEMENT</span>
          </a>
          <i id="down-arrow" class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">USER MANAGEMENT</a></li>
          <li><a href="addAdminMakeAChoice.php">Add Admin</a></li>
          <li><a href="changePassword.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</body>
<script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
      let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
      arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
</script>
</html>