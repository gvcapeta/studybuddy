<?php 
session_start();

include 'db_conn.php';
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>User Logs</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="admindashboardstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
        <i class="bx bxs-component"></i>
      <span class="logo_name">PU-OCLS</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="admindashboard.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_students.php">
          <i class='bx bxs-book-reader'></i>
          <span class="link_name">Students</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_students.php">Students</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="admindashboard_useraccounts_a.php">
            <i class="fas fa-user-friends"></i>
            <span class="link_name">Admins</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="admindashboard_useraccounts_a.php">Admins</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_userlogs.php" class="active">
            <i class="fas fa-list-ul"></i>
            <span class="link_name">User Logs</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_userlogs.php">User Logs</a></li>
        </ul>
      </li>
      <li class="log_out">
          <div class="iocn-link">
          <a href="#">
            <i class="fas fa-user-circle"></i>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
          </div>
         <ul class="sub-menu" style="margin-top:-40px">
          <li><a class="link_name" href="#">Welcome, <?php echo $_SESSION['email']; ?></a></li>
          <li><a href="logout_admin.php">Logout</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section">
      <nav>
        <div class="home-content">
                <span class="text">User Logs</span>
        </div>
        </nav>
        <div class="container-fluid container-fullw bg-white">
        <div class="row">
        <div>
          &nbsp
        </div>
          
        <h1>User Activity</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>ID</th>
                <th>Email</th>
                <th>Activity</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require 'dbconfig.php';

                  $sql = "SELECT * FROM activity";
                $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["ts"] . "</td>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["activity"] . "</td>
                </tr>";
            }

            ?>
            </div>
        </tbody>
    </table>
          

</body>
</html>
<?php 
}
else{
     header("Location: adminlogin.php");
     exit();
}
 ?>