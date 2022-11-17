<?php 
session_start();
include ('db_conn.php');

if(isset($_POST['chk_id'])){

    $arr = $_POST['chk_id'];

    foreach ($arr as $id) {
        @mysqli_query($conn,"DELETE FROM `chat_room` WHERE `id` = " . $id);
    }
    $msg = "Deleted Successfully!";
    header("Location: student_chat_rooms.php?msg=$msg");
}

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Subjects</title>
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
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard.php" style="font-weight: 100;">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_students.php">
          <i class='bx bxs-book-reader'style="text-shadow: none;"></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_students.php" style="font-weight: 100;">Students</a></li>
        </ul>
      </li>
      <li>
        <a href="admindashboard_teachers.php" class="active">
          <i class="fas fa-chalkboard-teacher" style="text-shadow: none;"></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_teachers.php" style="font-weight: 100;">Teachers</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="admindashboard_classes.php">
            <i class="fas fa-apple-alt" style="text-shadow: none;"></i>
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
          <a href="#">
            <i class="fas fa-user-friends" style="text-shadow: none;"></i>
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
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_userlogs.php" style="font-weight: 100;">User Logs</a></li>
        </ul>
      </li>

      <li>
        <a href="admindashboard_settings.php">
          <i class='bx bx-cog' style="text-shadow: none;"></i>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_settings.php" style="font-weight: 100;">Settings</a></li>
        </ul>
      </li>
      <li class="log_out">
        <a href="logout_admin.php">
      <i class='bx bx-log-out' style="text-shadow: none;"></i>
        </a>
      </li>
  </div>
  <section class="home-section">
      <nav>
        <div class="home-content">
                <span class="text">Find your Study Buddy</span>
        </div>
        </nav>
        <div class="container home-teacher container-flex" style="padding: 0px 30px;">
        <div class="d-flex table-filter">
            <!-- <button>Import</button> -->
            <div class="d-flex">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chatroomModal">Add Record</button>
            </div>
        </div>
        <form action="admindashboard_subjects.php" method="post" id="delete_form">
          <?php if (isset($_GET['msg'])) { ?>
            <p class="alert alert-success"><?php echo $_GET['msg']; ?></p>
          <?php } ?>
          <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
              <thead>
                  <tr>
                      <!-- <th><input type="checkbox" name="chk_all" value="" id="chk_all"/></th> -->
                      <th>Chat Room Name</th>
                      <th>Date Created</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                    $sql = "SELECT * FROM `chat_room`";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){?>
                  <tr>
                      <td>
                        <?php echo $inner_row['name']; ?>
                      </td>
                      <td><?php echo $inner_row['created_at']; ?></td>
                      <td>
                          <div class="d-flex justify-content-center chat_room_<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="id" class="id" value="<?php echo $inner_row['id']; ?>">
                            <button class="btn join" data-id="<?php echo $inner_row['id']; ?>" type="button">Join</button>
                          </div>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>
        </form>
    </div>
  </section>
  <!-- Modal -->
<div class="modal fade" id="chatroomModal" tabindex="-1" role="dialog" aria-labelledby="chatroomModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="addsubject_record.php">
        <div class="modal-body">
            <h3 class="modal-title" id="exampleModalLongTitle">Create Room</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group" style="margin-top:20px;">
              <div class="row">
                <div class="col-md-12">
                  <label for="code" class="col-form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary" style="background:#477256">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="chatroomEditModal" tabindex="-1" role="dialog" aria-labelledby="chatroomEditModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="addsubject_record.php">
        <div class="modal-body">
            <h3 class="modal-title" id="exampleModalLongTitle">Edit Record</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <input type="hidden" name="id" value="" class="id">
            <div class="form-group" style="margin-top:20px;">
              <div class="row">
                <div class="col-md-12">
                  <label for="sub_year" class="col-form-label">Subject Code</label>
                  <!-- <select class="form-control" name="sub_year" id="esub_year">
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                  </select> -->
                  <input type="text" class="form-control" id="ecode" name="code" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ename" class="col-form-label">Description</label>
                  <input type="text" class="form-control" id="ename" name="name" required>
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
  </style>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                'colvis'
            ],
        } );

        $('.dt-buttons').append('<input id="submit" name="submit" type="submit" class="btn btn-danger" value="Delete Selected Row(s)" />');

        $('#chk_all').click(function(){
            if(this.checked)
                $(".chkbox").prop("checked", true);
            else
                $(".chkbox").prop("checked", false);
        });

        $('#delete_form').submit(function(e){
            if(!confirm("Confirm Delete?")){
                e.preventDefault();
            }
        });

        $('.edit_subject').on('click',function(){
          
          var id = $(this).data('id');
          var code = $('.subject_'+id+' .code').val();
          var name = $('.subject_'+id+' .name').val();
          
          $('#ecode').val(code);
          $('#ename').val(name);
          $('.id').val(id);

          $('#chatroomEditModal').modal('show');
        })
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