<?php 
session_start();
include ('db_conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
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
        <i class="bx bxs-component"></i>
    </div>
    <ul class="nav-links">
      <li>
        <a href="admindashboard.php" class="active">
          <i class='bx bx-grid-alt' ></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_students.php">
          <i class='bx bxs-book-reader'></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_students.php">Students</a></li>
        </ul>
      </li>
       <li>
        <div class="iocn-link">
          <a href="admindashboard_useraccounts_a.php">
            <i class="fas fa-user-friends"></i>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="admindashboard_useraccounts_a.php">Admins</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_userlogs.php">
            <i class="fas fa-list-ul"></i>
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
          <li><a class="link_name" href="#" style="font-weight: 100;">Welcome, <?php echo $_SESSION['email']; ?></a></li>
          <li><a href="logout_admin.php" style="font-weight: 100;">Logout</a></li>
        </ul>
      </li>
  </div>
  <section class="home-section">
      <nav>
        <div class="home-content">
                <span class="text">Dashboard</span>
        </div>
        </nav>
        <div class="h-content">
            <div class="overview-boxes">
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">First Year</div>
                  <div class="number">
                      <?php
      
                        require 'dbconfig.php';
      
                      $query = "SELECT COUNT(*) AS total FROM students WHERE yearlvl = 1";   
                      $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                      $row =  $query_run->fetch_assoc();
      
                      echo $row['total'];
                      ?>  
                  </div>
                </div>
              </div>
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Second Year</div>
                  <div class="number">
                     <?php
      
                      require 'dbconfig.php';
      
                      $query = "SELECT COUNT(*) AS total FROM students WHERE yearlvl = 2";   
                      $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                      $row =  $query_run->fetch_assoc();
      
                      echo $row['total'];
                      ?>
                      </div>
                </div>
              </div>

              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Third Year</div>
                  <div class="number">
                     <?php
      
                      require 'dbconfig.php';
      
                      $query = "SELECT COUNT(*) AS total FROM students WHERE yearlvl = 3";   
                      $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                      $row =  $query_run->fetch_assoc();
      
                      echo $row['total'];
                      ?>
                      </div>
                </div>
              </div>
             
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Fourth Year</div>
                  <div class="number">
                    <?php
      
                      require 'dbconfig.php';
      
                      $query = "SELECT COUNT(*) AS total FROM students WHERE yearlvl = 4";   
                      $query_run = mysqli_query($connection, $query) or die(mysqli_error($connection));;
                      $row =  $query_run->fetch_assoc();
      
                      echo $row['total'];
                    ?>      
                  </div>
                </div>
              </div>
            </div>
            </div>
           
     
            <div class="container home-teacher container-flex">
            <div class="d-flex table-filter">
            <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
                <thead>
                    <tr>
                        <th width="25%">Student Name</th>
                        <th width="15%">Email</th>
                        <th width="15%">Password</th>
                        <th width="20%">Action</th>
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
                        <td>
                          <div class="d-flex justify-content-center admin_<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="id" class="id" value="<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="password" class="password" value="<?php echo $inner_row['password']; ?>">
                            <button class="btn edit edit_student" data-id="<?php echo $inner_row['id']; ?>" type="button" style="max-width: 170px;">Change Password</button>
                            <!-- <a href="delete_admin_record.php?id=<?php echo $inner_row['id'];?>" class="btn delete" style="background: #be6646;color:#000;">Delete</a> -->
                          </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
    </div>
  </section>

<!-- Edit Modal -->
  <div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="post" action="addstudent_record.php">
          <input type="hidden" name="id" value="" class="id">
          <div class="modal-body">
              <h3 class="modal-title" id="exampleModalLongTitle">Update Student Password</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <!-- <div class="form-group" style="margin-top:20px;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="firstname" class="col-form-label">Firstname</label>
                    <input type="text" class="form-control" id="efirstname" name="firstname" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="lastname" class="col-form-label">Lastname</label>
                    <input type="text" class="form-control" id="elastname" name="lastname" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="text" class="form-control" id="eemail" name="email" required>
                  </div>
                </div>
              </div> -->
              <div class="form-group" style="margin-top:20px;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="text" class="form-control" id="epassword" name="password" required>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="update_password" class="btn btn-primary" style="background:#477256">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

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

        $(document).on('click','.edit_student',function(){
            var id = $(this).data('id');
            var password = $('.admin_'+id+' .password').val();
            $('#epassword').val(password);          
            $('.id').val(id);
            $('#studentEditModal').modal('show');
        });

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

