<?php 
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include ('db_conn.php');

if(isset($_POST['chk_id'])){

    $arr = $_POST['chk_id'];

    foreach ($arr as $id) {
        @mysqli_query($conn,"DELETE FROM students WHERE id = " . $id);
    }
    $msg = "Deleted Successfully!";
    header("Location: admindashboard_students.php?msg=$msg");
}

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Students</title>
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
        <a href="admindashboard_students.php" class="active">
          <i class='bx bxs-book-reader'style="text-shadow: none;"></i>
          <span class="link_name">Students</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admindashboard_students.php" style="font-weight: 100;">Students</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="admindashboard_useraccounts_a.php">
            <i class="fas fa-user-friends" style="text-shadow: none;"></i>
            <span class="link_name">User Accounts</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="admindashboard_useraccounts_a.php" style="font-weight: 100;">Admins</a></li>
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
          <span class="text">Students</span>
        </div>
      </nav>
      <div class="container home-teacher container-flex" style="padding: 0px 30px;">
        <div class="d-flex table-filter">
            <!-- <button>Import</button> -->

            <div class="d-flex">
                <div class="row">
                  <div class="col-md-12">
                    <form action="import_student_data.php" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data"> 
                      <div style="width: 350px;background: #fff;padding: 20px;">
                        <label>Import CSV/Excel File</label> <input type="file" name="excel" id="file" accept=".xls,.xlsx,.csv">
                        <input type="submit" name="import" value="Import" style="padding:2px 20px;position: absolute;right: 40px;top: 45px;border-radius:0px;"/>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="d-flex">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">Add Record</button>
            </div>
        </div>
        <form action="admindashboard_students.php" method="post" id="delete_form">
          <?php if (isset($_GET['msg'])) { ?>
            <p class="alert alert-success"><?php echo $_GET['msg']; ?></p>
          <?php } ?>
          <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
              <thead>
                  <tr>
                      <th><input type="checkbox" name="chk_all" value="" id="chk_all"/></th>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Birth Date</th>
                      <th>Year Level</th>
                      <th>Nationality</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                    $sql = "SELECT * FROM students";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){?>
                  <tr>
                      <td><input class="chkbox" type="checkbox" name="chk_id[]" value="<?php echo $inner_row['id']; ?>" /></td>
                      <td><?php echo $inner_row['student_id']; ?></td>
                      <td><?php echo $inner_row['firstname']." ".$inner_row['middlename']." ".$inner_row['lastname']; ?></td>
                      <td><?php echo $inner_row['email']; ?></td>
                      <td><?php echo $inner_row['gender']; ?></td>
                      <td>
                        <?php
                        if($inner_row['birth_date']!=''){
                          $timestamp = strtotime($inner_row['birth_date']);
                          $today = date("F j, Y",$timestamp);
                          echo $today;   
                        } 
                        else{
                          echo '-';
                        }
                        ?>
                      </td>
                      <td><?php echo $inner_row['yearlvl']; ?></td>
                      <td><?php echo $inner_row['nationality']; ?></td>
                      <td><?php echo $inner_row['phone']; ?></td>
                      <td>
                          <?php
                            $sql_course = "SELECT * FROM admin_forstudent WHERE student_id =".$inner_row['id'];
                            $result_course = mysqli_query($conn, $sql_course);
                            $row_course = mysqli_fetch_assoc($result_course);
                          ?>
                          <div class="d-flex justify-content-center student_<?php echo $inner_row['id']; ?>">
                            <input type="hidden" name="student_id" class="student_id" value="<?php echo $inner_row['student_id']; ?>">
                            <input type="hidden" name="email" class="email" value="<?php echo $inner_row['email']; ?>">
                            <input type="hidden" name="firstname" class="firstname" value="<?php echo $inner_row['firstname']; ?>">
                            <input type="hidden" name="lastname" class="lastname" value="<?php echo $inner_row['lastname']; ?>">
                            <input type="hidden" name="middlename" class="middlename" value="<?php echo $inner_row['middlename']; ?>">
                            <input type="hidden" name="birth_date" class="birth_date" value="<?php echo $inner_row['birth_date']; ?>">
                            <input type="hidden" name="gender" class="gender" value="<?php echo $inner_row['gender']; ?>">
                            <input type="hidden" name="yearlvl" class="yearlvl" value="<?php echo $inner_row['yearlvl']; ?>">
                            <input type="hidden" name="nationality" class="nationality" value="<?php echo $inner_row['nationality']; ?>">
                            <input type="hidden" name="phone" class="phone" value="<?php echo $inner_row['phone']; ?>">
                      
                            <input type="hidden" name="class_id" class="class_id" value="<?php echo $row_course['id'] ?>">
                            <button class="btn edit edit_student" data-id="<?php echo $inner_row['id']; ?>" type="button" id="">Edit</button>
                            
                            <a href="delete_student_record.php?id=<?php echo $inner_row['id'];?>" class="btn delete" style="background: #be6646;color:#000;">Delete</a>
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
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="addstudent_record.php">
        <div class="modal-body">
            <h3 class="modal-title" id="exampleModalLongTitle">Add Record</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group" style="margin-top:20px;">
              <div class="row">
                <div class="col-md-12">
                  <label for="student_id" class="col-form-label">Student ID</label>
                  <input type="text" class="form-control" id="student_id" name="student_id" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="student_email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" id="student_email" name="student_email" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="student_fname" class="col-form-label">First Name</label>
                  <input type="text" class="form-control" id="student_fname" name="student_fname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="student_mname" class="col-form-label">Middle Name</label>
                  <input type="text" class="form-control" id="student_mname" name="student_mname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="student_lname" class="col-form-label">Last Name</label>
                  <input type="text" class="form-control" id="student_lname" name="student_lname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="birth_date" class="col-form-label">Birth Date</label>
                  <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="yearlvl" class="col-form-label">Year Level</label>
                  <select class="form-control" name="yearlvl" id="yearlvl">
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="nationality" class="col-form-label">Nationality</label>
                  <input type="text" name="nationality" class="form-control" id="nationality" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="gender" class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                    <option value="OTHER">OTHER</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="phone" class="col-form-label">Phone Number</label>
                  <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Subject Code</label>
                  <select class="form-control" name="subject_code">
                      <option disabled selected>--</option>
                      <option disabled>-- 1ST YEAR --</option>
                      <option>ITE 289</option>
                      <option>ITE 288</option>
                      <option>ITE 186 </option>
                      <optiion>ITE 291</optiion>
                      <option disabled>-- 2ND YEAR --</option>
                      <option>ITE 031</option>
                      <option>ITE 048</option>
                      <option>ITE 299</option>
                      <option>ITE 292</option>
                      <option>ITE 300</option>
                      <option>ITE 232</option>
                      <option>ITE 302</option>
                      <option>ITE 298</option>
                      <option>ITE 304</option>
                      <option>ITE 303</option>
                      <option>SSP 005</option>
                      <option>SSP 006</option>
                      2nd year sys dev and animation MAJOR subj
                      <option disabled>-- 3RD YEAR --</option>
                      <option>ITE 314</option>
                      <option>ITE 233</option>
                      <option>ITE 301</option>
                      <option>ITE 309</option>
                      <option>ITE 306</option>
                      <option>ITE 307</option>
                      <option>ITE 308</option>
                      <option>ITE 310</option>
                      <option>ITE 305</option>
                      <option>ITE 333</option>
                      <option>ITE 335</option>
                      <option>ITE 293</option>
                      <option>SSP 007</option>
                      <option>SSP 008</option>
                      <option disabled>-- 4YH YEAR --</option>
                      <option>ITE 322</option>
                      <option>ITE 351</option>
                      <option>ITE 311</option>
                      <option>SSP 009</option>
                  </select>
                  <select class="form-control" name="subject_code">
                      <?php 
                    $sql = "SELECT * FROM `subjects`";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){?>
                          <option><?php echo $inner_row['code']." - ".$inner_row['name'];?></option>
                        <?php }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Description</label>
                  <select class="form-control" name="description">
                      <option disabled selected>--</option>
                      <option disabled>-- 1ST YEAR --</option>
                      <option>Computer Programming 1</option>
                      <option>Introduction to Computing</option>
                      <option>Computer Programming 2</option>
                      <option>Human Computer Interaction</option>
                      <option disabled>-- 2ND YEAR --</option>
                      <option>Data Structures and Algorithms</option>
                      <option>Discrete Structures</option>
                      <option>Ethics for IT (Including Social and Professional Issues)</option>
                      <option>Networking 1</option>
                      <option>Object-Oriented Programming</option>
                      <option>Advanced Web Development 1</option>
                      <option>Information Assurance and Security 1</option>
                      <option>Information Management (Including Fundamentals of Database Systems)</option>
                      <option>Networking 2</option>
                      <option>Systems Integration and Architecture 1</option>
                      <option>Student Success Program 1</option>
                      <option>Student Success Program 2</option>
                      <option disabled>-- 3RD YEAR --</option>
                      <option>Advanced Database Systems</option>
                      <option>Advanced Web Development 2</option>
                      <option>Application Development and Emerging Technologies</option>
                      <option>Capstone Project and Research 1</option>
                      <option>Integrative Programming and Technologies</option>
                      <option>Quantitative Methods (including Modeling and Simulation)</option>
                      <option>Web System and Technologies </option>
                      <option>Capstone Project and Research 2</option>
                      <option>Information Assurance and Security 2</option>
                      <option>Intelligent Systems</option>
                      <option>Platform Technologies</option>
                      <option>Systems Administration and Maintenance</option>
                      <option>Student Success Program 3</option>
                      <option>Student Success Program 4</option>
                      <option disabled>-- 4TH YEAR --</option>
                      <option>Managing IT Resouces</option>
                      <option>New Venture Creation (4 units)</option>
                      <option>IT Practicum</option>
                      <option>Student Success Program 5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Year lvl & block</label>
                  <select class="form-control" name="Year_lvl_and_block">
                      <option disabled selected>--</option>
                      <option>1st Year - BLK 1</option>
                      <option>1st Year - BLK 2</option>
                      <option>1st Year - BLK 3</option>
                      <option>1st Year - BLK 4</option>
                      <option>1st Year - BLK 5</option>
                      <option>1st Year - BLK 6</option>
                      <option>1st Year - BLK 7</option>
                      <option>2nd Year - BLK 1</option>
                      <option>2nd Year - BLK 2</option>
                      <option>2nd Year - BLK 3</option>
                      <option>2nd Year - BLK 4</option>
                      <option>2nd Year - BLK 5</option>
                      <option>2nd Year - BLK 6</option>
                      <option>2nd Year - BLK 7</option>
                      <option>3rd Year - BLK 1</option>
                      <option>3rd Year - BLK 2</option>
                      <option>3rd Year - BLK 3</option>
                      <option>3rd Year - BLK 4</option>
                      <option>3rd Year - BLK 5</option>
                      <option>3rd Year - BLK 6</option>
                      <option>3rd Year - BLK 7</option>
                      <option>4th Year - BLK 1</option>
                      <option>4th Year - BLK 2</option>
                      <option>4th Year - BLK 3</option>
                      <option>4th Year - BLK 4</option>
                      <option>4th Year - BLK 5</option>
                      <option>4th Year - BLK 6</option>
                      <option>4th Year - BLK 7</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Teacher</label>
                  <select name="teacher" class="form-control">
                    <option disabled selected>--</option>
                      <?php 
                        $sql = "SELECT * FROM teachers";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){
                      ?>
                      <option value="<?php echo $inner_row['id']; ?>"><?php echo $inner_row['firstname']; ?> <?php echo $inner_row['middlename']; ?> <?php echo $inner_row['lastname']; ?></option>
                      <?php } ?>
                  </select>
                </div>
              </div>
            </div> -->
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
<div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="studentEditModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="addstudent_record.php">
        <div class="modal-body">
            <h3 class="modal-title" id="exampleModalLongTitle">Edit Record</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <input type="hidden" name="id" value="" class="id">
            <input type="hidden" name="class_id" value="" class="class_id">
            <div class="form-group" style="margin-top:20px;">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_id" class="col-form-label">Student ID</label>
                  <input type="text" class="form-control" id="estudent_id" name="student_id" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" id="estudent_email" name="student_email" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_fname" class="col-form-label">First Name</label>
                  <input type="text" class="form-control" id="estudent_fname" name="student_fname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_mname" class="col-form-label">Middle Name</label>
                  <input type="text" class="form-control" id="estudent_mname" name="student_mname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_lname" class="col-form-label">Last Name</label>
                  <input type="text" class="form-control" id="estudent_lname" name="student_lname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ebirth_date" class="col-form-label">Birth Date</label>
                  <input type="date" class="form-control" id="ebirth_date" name="birth_date" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="yearlvl" class="col-form-label">Year Level</label>
                  <select class="form-control" name="yearlvl" id="yearlvl">
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="enationality" class="col-form-label">Nationality</label>
                  <input type="text" name="nationality" id="enationality" class="form-control">
                  <!-- <textarea name="address" class="form-control" id="eaddress" required></textarea> -->
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="egender" class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="egender">
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                    <option value="OTHER">OTHER</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ephone" class="col-form-label">Phone Number</label>
                  <input type="text" class="form-control" id="ephone" name="phone" required>
                </div>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Subject Code</label>
                  <select class="form-control" name="subject_code" id="esubject_code">
                      <option disabled>--</option>
                      <option disabled>-- 1ST YEAR --</option>
                      <option value="ITE 289">ITE 289</option>
                      <option value="ITE 288">ITE 288</option>
                      <option>ITE 186 </option>
                      <optiion>ITE 291</optiion>
                      <option disabled>-- 2ND YEAR --</option>
                      <option>ITE 031</option>
                      <option>ITE 048</option>
                      <option>ITE 299</option>
                      <option>ITE 292</option>
                      <option>ITE 300</option>
                      <option>ITE 232</option>
                      <option>ITE 302</option>
                      <option>ITE 298</option>
                      <option>ITE 304</option>
                      <option>ITE 303</option>
                      <option>SSP 005</option>
                      <option>SSP 006</option>
                      <option disabled>-- 3RD YEAR --</option>
                      <option>ITE 314</option>
                      <option>ITE 233</option>
                      <option>ITE 301</option>
                      <option>ITE 309</option>
                      <option>ITE 306</option>
                      <option>ITE 307</option>
                      <option>ITE 308</option>
                      <option>ITE 310</option>
                      <option>ITE 305</option>
                      <option>ITE 333</option>
                      <option>ITE 335</option>
                      <option>ITE 293</option>
                      <option>SSP 007</option>
                      <option>SSP 008</option>
                      <option disabled>-- 4YH YEAR --</option>
                      <option>ITE 322</option>
                      <option>ITE 351</option>
                      <option>ITE 311</option>
                      <option>SSP 009</option>
                  </select>
                  <select class="form-control" name="subject_code">
                      <?php 
                    $sql = "SELECT * FROM `subjects`";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){?>
                          <option><?php echo $inner_row['code']." - ".$inner_row['name'];?></option>
                        <?php }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Description</label>
                  <select class="form-control" name="description" id="edescription">
                      <option disabled selected>--</option>
                      <option disabled>-- 1ST YEAR --</option>
                      <option>Computer Programming 1</option>
                      <option>Introduction to Computing</option>
                      <option>Computer Programming 2</option>
                      <option>Human Computer Interaction</option>
                      <option disabled>-- 2ND YEAR --</option>
                      <option>Data Structures and Algorithms</option>
                      <option>Discrete Structures</option>
                      <option>Ethics for IT (Including Social and Professional Issues)</option>
                      <option>Networking 1</option>
                      <option>Object-Oriented Programming</option>
                      <option>Advanced Web Development 1</option>
                      <option>Information Assurance and Security 1</option>
                      <option>Information Management (Including Fundamentals of Database Systems)</option>
                      <option>Networking 2</option>
                      <option>Systems Integration and Architecture 1</option>
                      <option>Student Success Program 1</option>
                      <option>Student Success Program 2</option>
                      <option disabled>-- 3RD YEAR --</option>
                      <option>Advanced Database Systems</option>
                      <option>Advanced Web Development 2</option>
                      <option>Application Development and Emerging Technologies</option>
                      <option>Capstone Project and Research 1</option>
                      <option>Integrative Programming and Technologies</option>
                      <option>Quantitative Methods (including Modeling and Simulation)</option>
                      <option>Web System and Technologies </option>
                      <option>Capstone Project and Research 2</option>
                      <option>Information Assurance and Security 2</option>
                      <option>Intelligent Systems</option>
                      <option>Platform Technologies</option>
                      <option>Systems Administration and Maintenance</option>
                      <option>Student Success Program 3</option>
                      <option>Student Success Program 4</option>
                      <option disabled>-- 4TH YEAR --</option>
                      <option>Managing IT Resouces</option>
                      <option>New Venture Creation (4 units)</option>
                      <option>IT Practicum</option>
                      <option>Student Success Program 5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Year lvl & block</label>
                  <select class="form-control" name="Year_lvl_and_block" id="eYear_lvl_and_block">
                      <option disabled selected>--</option>
                      <option>1st Year - BLK 1</option>
                      <option>1st Year - BLK 2</option>
                      <option>1st Year - BLK 3</option>
                      <option>1st Year - BLK 4</option>
                      <option>1st Year - BLK 5</option>
                      <option>1st Year - BLK 6</option>
                      <option>1st Year - BLK 7</option>
                      <option>2nd Year - BLK 1</option>
                      <option>2nd Year - BLK 2</option>
                      <option>2nd Year - BLK 3</option>
                      <option>2nd Year - BLK 4</option>
                      <option>2nd Year - BLK 5</option>
                      <option>2nd Year - BLK 6</option>
                      <option>2nd Year - BLK 7</option>
                      <option>3rd Year - BLK 1</option>
                      <option>3rd Year - BLK 2</option>
                      <option>3rd Year - BLK 3</option>
                      <option>3rd Year - BLK 4</option>
                      <option>3rd Year - BLK 5</option>
                      <option>3rd Year - BLK 6</option>
                      <option>3rd Year - BLK 7</option>
                      <option>4th Year - BLK 1</option>
                      <option>4th Year - BLK 2</option>
                      <option>4th Year - BLK 3</option>
                      <option>4th Year - BLK 4</option>
                      <option>4th Year - BLK 5</option>
                      <option>4th Year - BLK 6</option>
                      <option>4th Year - BLK 7</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Teacher</label>
                  <select name="teacher" class="form-control" id="eteacher">
                    <option disabled selected>--</option>
                      <?php 
                        $sql = "SELECT * FROM teachers";
                        $result = mysqli_query($conn, $sql);
                        $inner_ctr = mysqli_num_rows($result);
                        while($inner_row = mysqli_fetch_array($result)){
                      ?>
                      <option value="<?php echo $inner_row['id']; ?>"><?php echo $inner_row['firstname']; ?> <?php echo $inner_row['middlename']; ?> <?php echo $inner_row['lastname']; ?></option>
                      <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="estudent_name" class="col-form-label">Student Name</label>
                  <input type="text" class="form-control" id="estudent_name" name="student_name" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ebirth_date" class="col-form-label">Birth Date</label>
                  <input type="date" class="form-control" id="ebirth_date" name="birth_date" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="eaddress" class="col-form-label">Address</label>
                  <textarea name="address" class="form-control" id="eaddress" required></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="ephone" class="col-form-label">Phone Number</label>
                  <input type="text" class="form-control" id="ephone" name="phone" required>
                </div>
              </div>
            </div> -->
        </div>
        <div class="modal-footer">
          <button type="submit" name="update_submit" class="btn btn-primary" style="background:#477256">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" role="dialog" aria-labelledby="studentViewModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h3 class="modal-title" id="exampleModalLongTitle" style="margin-bottom: 20px;">Student Classes Record</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <input type="hidden" name="id" value="" class="id">
            <input type="hidden" name="class_id" value="" class="class_id">
            
            <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="studentView">
              <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Year lvl and block</th>
                    <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

        </div>
        <!-- <div class="modal-footer">
          <button type="submit" name="update_submit" class="btn btn-primary" style="background:#477256">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> -->
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

        $(document).on('click','.edit_student',function(){
          var id = $(this).data('id');

          var student_id = $('.student_'+id+' .student_id').val();
          var student_email = $('.student_'+id+' .email').val();
          var student_fname = $('.student_'+id+' .firstname').val();
          var student_lname = $('.student_'+id+' .lastname').val();
          var student_mname = $('.student_'+id+' .middlename').val();
          var birth_date = $('.student_'+id+' .birth_date').val();
          var nationality = $('.student_'+id+' .nationality').val();
          var phone = $('.student_'+id+' .phone').val();
          var gender = $('.student_'+id+' .gender').val();
          var subject_code = $('.student_'+id+' .subject_code').val();
          var description = $('.student_'+id+' .description').val();
          var Year_lvl_and_block = $('.student_'+id+' .Year_lvl_and_block').val();
          // var teacher_id = $('.student_'+id+' .teacher_id').val();
          var class_id = $('.student_'+id+' .class_id').val();

          $('#estudent_id').val(student_id);
          $('#estudent_email').val(student_email);
          $('#estudent_fname').val(student_fname);
          $('#estudent_mname').val(student_mname);
          $('#estudent_lname').val(student_lname);
          $('#ebirth_date').val(birth_date);
          $('#enationality').val(nationality);
          $('#ephone').val(phone);


          $('#esubject_code [value="'+subject_code+'"]').attr('selected', 'true');
          $('#egender [value="'+gender+'"]').attr('selected', 'true');
          $('#edescription [value="'+description+'"]').attr('selected', 'true');
          $('#eYear_lvl_and_block [value="'+Year_lvl_and_block+'"]').attr('selected', 'true');
          $('#eYear_lvl_and_block').val(Year_lvl_and_block);
          
          // $('#eteacher [value="'+teacher_id+'"]').attr('selected', 'true');
          // $('#eteacher>option:eq('+teacher_id+')').attr('selected', true);

          $('.id').val(id);
          $('.class_id').val(class_id);

          $('#studentEditModal').modal('show');
        })

      $('#studentView').DataTable(); 
      $(document).on('click','.view_student',function(){
        var id = $(this).data('id');
        $.ajax({
            type:"post",
            url:"getStudentClass.php",
            data:{id:id},
            success:function(data){
            if(data){
              $('#studentView tbody').html(data);
              
                
            }
          }
        });
        $('#studentViewModal').modal('show');
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