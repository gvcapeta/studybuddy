<?php 
session_start();
include ('db_conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Accounts</title>
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
        <a href="admindashboard.php">
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
          <a href="admindashboard_useraccounts_a.php"  class="active">
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
                <span class="text">Admin Accounts</span>
        </div>
        </nav>
        <div class="container home-teacher container-flex" style="padding: 0px 30px;">
          <div class="d-flex table-filter">
              <div class="d-flex"></div>
              <div class="d-flex">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adminModal">Add Admin</button>
              </div>
          </div>
          <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
            <thead>
                <tr>
                    <th>Admin First Name</th>
                    <th>Admin Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  $sql = "SELECT * FROM `admins`";
                      $result = mysqli_query($conn, $sql);
                      $inner_ctr = mysqli_num_rows($result);
                      while($inner_row = mysqli_fetch_array($result)){?>
                <tr>
                    <td><?php echo $inner_row['firstname']; ?></td>
                    <td><?php echo $inner_row['lastname']; ?></td>
                    <td><?php echo $inner_row['email']; ?></td>
                    <td><?php echo $inner_row['password']; ?></td>
                    <td>
                      <div class="d-flex justify-content-center admin_<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="id" class="id" value="<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="firstname" class="firstname" value="<?php echo $inner_row['firstname']; ?>">
                            <input type="hidden" name="lastname" class="lastname" value="<?php echo $inner_row['lastname']; ?>">
                            <input type="hidden" name="email" class="email" value="<?php echo $inner_row['email']; ?>">
                            <input type="hidden" name="password" class="password" value="<?php echo $inner_row['password']; ?>">
                            <button class="btn edit edit_admin" data-id="<?php echo $inner_row['id']; ?>" type="button">Edit</button>
                            <a href="delete_admin_record.php?id=<?php echo $inner_row['id'];?>" class="btn delete" style="background: #be6646;color:#000;">Delete</a>
                          </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
    </div>
  </section>

  <!-- Add modal -->

  <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="post" action="create_admin.php">
          <div class="modal-body">
              <h3 class="modal-title" id="exampleModalLongTitle">Add Admin</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="form-group" style="margin-top:20px;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="firstname" class="col-form-label">Firstname</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="lastname" class="col-form-label">Lastname</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary" style="background:#477256">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="adminEditModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="post" action="create_admin.php">
          <input type="hidden" name="id" value="" class="id">
          <div class="modal-body">
              <h3 class="modal-title" id="exampleModalLongTitle">Update Admin</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="form-group" style="margin-top:20px;">
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
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="text" class="form-control" id="epassword" name="password" required>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="update_submit" class="btn btn-primary" style="background:#477256">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script> -->
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
    #teacherView_length,#teacherView_filter{
      display: none;
    }
    #table_wrapper{width: 100%;}
  </style>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#table').DataTable();

      $(document).on('click','.edit_admin',function(){
          var id = $(this).data('id');

          var email = $('.admin_'+id+' .email').val();
          var fname = $('.admin_'+id+' .firstname').val();
          var lname = $('.admin_'+id+' .lastname').val();
          var password = $('.admin_'+id+' .password').val();
          
          $('#eemail').val(email);
          $('#efirstname').val(fname);
          $('#elastname').val(lname);
          $('#epassword').val(password);          
          $('.id').val(id);
          $('#adminEditModal').modal('show');
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