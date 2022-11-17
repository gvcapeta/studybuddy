<?php 
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include ('db_conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Accounts</title>
    <link rel="stylesheet" href="admindashboardstyle.css">
    <link rel="stylesheet" href="admin.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
        <i class="bx bxs-component" style="text-shadow: none;"></i>
    </div>
    <ul class="nav-links">
      <li>
        <a href="admindashboard.php">
          <i class='bx bx-grid-alt' style="text-shadow: none;"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard.php" style="font-weight: 100;">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_students.php">
          <i class='bx bxs-book-reader'style="text-shadow: none;"></i>
          <span class="link_name">Students</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_students.php" style="font-weight: 100;">Students</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_teachers.php">
          <i class="fas fa-chalkboard-teacher" style="text-shadow: none;"></i>
          <span class="link_name">Teachers</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_teachers.php" style="font-weight: 100;">Teachers</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="admindashboard_classes.php">
            <i class="fas fa-apple-alt" style="text-shadow: none;"></i>
            <span class="link_name">Classes</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="admindashboard_classes.php" style="font-weight: 100;">Classes</a></li>
          <li><a href="admindashboard_subjects.php" style="font-weight: 100;">Subjects</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#" class="active">
            <i class="fas fa-user-friends" style="text-shadow: none;"></i>
            <span class="link_name">User Accounts</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#" style="font-weight: 100;">User Accounts</a></li>
          <li><a href="admindashboard_useraccounts_s.php" style="font-weight: 100;">Student</a></li>
          <li><a href="admindashboard_useraccounts_t.php" style="font-weight: 100;">Teacher</a></li>
          <li><a href="admindashboard_useraccounts_a.php" style="font-weight: 100;">Admin</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_userlogs.php">
            <i class="fas fa-list-ul" style="text-shadow: none;"></i>
            <span class="link_name">User Logs</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_userlogs.php" style="font-weight: 100;">User Logs</a></li>
        </ul>
      </li>

      <li>
        <a href="admindashboard_settings.php">
          <i class='bx bx-cog' style="text-shadow: none;"></i>
          <span class="link_name">Settings</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_settings.php" style="font-weight: 100;">Settings</a></li>
        </ul>
      </li>
      <li class="log_out">
          <div class="iocn-link">
          <a href="#">
            <i class="fas fa-user-circle"></i>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
          </div>
        <ul class="sub-menu" style="margin-top:-20px">
          <li><a class="link_name" href="#" style="font-weight: 100;">Welcome, <?php echo $_SESSION['email']; ?></a></li>
          <li><a href="logout_admin.php" style="font-weight: 100;">Logout</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section">
      <nav>
        <div class="home-content">
          <span class="text">Student Accounts</span>
        </div>
      </nav>
      <div class="container home-teacher container-flex">
          <div class="d-flex table-filter">
            <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                      $sql = "SELECT * FROM students";
                          $result = mysqli_query($conn, $sql);
                          $inner_ctr = mysqli_num_rows($result);
                          while($inner_row = mysqli_fetch_array($result)){?>
                    <tr>
                        <td><?php echo $inner_row['firstname']." ".$inner_row['middlename']." ".$inner_row['lastname']; ?></td>
                        <td><?php echo $inner_row['email']; ?></td>
                        <td><?php echo $inner_row['password']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
    </div>
  </section>
<!-- End View Modal -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  <style type="text/css">
    #table_length{
      display: none;
    }
    /*#table_info{
      display: none;
    }*/
    #table_filter label{
      font-weight: bold;
    }
    #table_filter{
      padding-bottom: 10px;
    }
    #table_filter input{
      background-color: #fff;
    }
    input[type="text"],input[type="date"],textarea#address{
      width: 100%;
      border: 1px solid;
      border-radius: 0;
    }
    button.close span{
      color: #000;
    }
    button.close{
      position: absolute;
      right: 20px;
      top: 20px;
    }
    .col-form-label {
      font-weight: normal;
    }
    div.dt-buttons{
      margin-top: 5px;
    }
    #studentView_length,#studentView_filter{
      display: none;
    }
    #table_wrapper{width: 100%;}
  </style>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#table').DataTable();
    });
  </script>
</body>
</html>
<?php 
}else{
     header("Location: adminlogin.php");
     exit();
}
 ?>