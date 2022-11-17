<?php
session_start();
include('db_conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

  $teacher_name = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
?>

  <!DOCTYPE html>
  <html>

  <head>
    <!-- <php include('header1.php'); ?> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sample</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="classroom-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style type="text/css">
      html {
        height: 100%;
      }

      body {
        margin: 0;
        height: 100%;
      }

      #outer-container {
        display: table;
        width: 100%;
        height: 100%;
      }

      #sidebar {
        display: table-cell;
        width: 15%;
        vertical-align: top;
        background: rgb(71, 114, 86);
        color: #fff;
      }

      #content {
        display: table-cell;
        width: 85%;

      }

      #table {
        border: none;
      }

      th,
      tr,
      td {
        border-color: #e5e5e5;
      }

      thead {
        background: #e5e5e5;
      }

      #table_length,
      #table_filter {
        display: none;
      }

      #table_filter label {
        font-weight: bold;
      }

      #table_filter {
        padding-bottom: 10px;
      }

      #table_filter input {
        background-color: #fff;
      }

      input[type="text"],
      input[type="date"],
      textarea#address {
        width: 100%;
        border: 1px solid;
        border-radius: 0;
      }

      button.close span {
        color: #000;
      }

      button.close {
        position: absolute;
        right: 20px;
        top: 20px;
      }

      .col-form-label {
        font-weight: normal;
      }

      div.dt-buttons {
        margin-top: 5px;
      }

      #chat {
        border: none;
      }

      #chat td {
        background-color: #b7c4ba;
      }

      #chat_wrapper #chat_length,
      #chat_wrapper #chat_filter {
        display: none;
      }

      #chat .sorting.sorting_asc,
      #chat_info {
        display: none;
      }

      #chat thead tr {
        display: none;
      }

      .student_name h5 {
        font-weight: bold;
      }

      .student_name {
        width: 100%;
        display: inline-flex;
      }

      .date {
        margin-top: 8px;
        margin-left: 10px;
      }

      .student_message {
        margin-bottom: 10px;
      }

      .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #000;
        background: rgb(222, 236, 217);
        padding: 5px;
      }

      .bootstrap-tagsinput {
        padding: 8px 6px;
        width: 100%;
      }

      .card ul.label-badge>li {
        margin-right: 5px;
      }

      a.active {
        padding: 25px 30px;
        border-radius: unset;
      }

      .hbottom {
        line-height: unset;
        font-weight: bold;
      }

      section {
        width: calc(100vw - 300px);
        transform: translateX(150px);
      }

      .dropdown-header a>span {
        margin-right: 10px;
        text-decoration: none;
      }

      .dropdown-header>a {
        display: flex;
        align-items: center;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
      }

      .modal {
        overflow: unset !important;
        overflow-y: unset !important;
        overflow-x: unset !important;
      }
    </style>
  </head>

  <body>
    <?php include('sidebar1.php'); ?>
    <?php include('header.php'); ?>
    <!-- <div id="sidebar">
        <div>
          <a class="active" href="questions.php">
            <svg width="35px" height="35px" fill="#fff" viewBox="0 0 320 512">
              <path d="M204.3 32.01H96c-52.94 0-96 43.06-96 96c0 17.67 14.31 31.1 32 31.1s32-14.32 32-31.1c0-17.64 14.34-32 32-32h108.3C232.8 96.01 256 119.2 256 147.8c0 19.72-10.97 37.47-30.5 47.33L127.8 252.4C117.1 258.2 112 268.7 112 280v40c0 17.67 14.31 31.99 32 31.99s32-14.32 32-31.99V298.3L256 251.3c39.47-19.75 64-59.42 64-103.5C320 83.95 268.1 32.01 204.3 32.01zM144 400c-22.09 0-40 17.91-40 40s17.91 39.1 40 39.1s40-17.9 40-39.1S166.1 400 144 400z" />
            </svg>
            <span>
              Questions
            </span>
          </a>
        </div>
        <div>
          <a href="sample.php">
            <svg width="35px" height="35px" fill="#fff" viewBox="0 0 640 512">
              <path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3c-95.73 0-173.3 77.6-173.3 173.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM479.1 320h-73.85C451.2 357.7 480 414.1 480 477.3C480 490.1 476.2 501.9 470 512h138C625.7 512 640 497.6 640 479.1C640 391.6 568.4 320 479.1 320zM432 256C493.9 256 544 205.9 544 144S493.9 32 432 32c-25.11 0-48.04 8.555-66.72 22.51C376.8 76.63 384 101.4 384 128c0 35.52-11.93 68.14-31.59 94.71C372.7 243.2 400.8 256 432 256z" />
            </svg>
            <span>
              Chatrooms
            </span>
          </a>
        </div>
      </div> -->
    <!-- <header class="header">
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </header>-->
    <section>
      <div id="content">
        <section>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="row" style="background: #9eb0a4;color: #39493e;">
                  <div class="col-md-12">
                    <h3 class="text" style="padding: 10px;">My Chat Rooms</h3>
                  </div>
                  <div class="col-md-12">
                    <table width="100%" border="0" cellspacing="0" cellpadding="10" align="center" id="chat">
                      <?php
                      $student_id = $_SESSION['id'];
                      $sql_chats = "SELECT * FROM chat_room_students INNER JOIN `chat_room` ON `chat_room_students`.`chat_room_id` = `chat_room`.`id` WHERE `chat_room_students`.`student_id` ='$student_id'";
                      $result_chats = mysqli_query($conn, $sql_chats);
                      $count_chat = mysqli_num_rows($result_chats);

                      if ($count_chat > 0) {
                        while ($chat_row = mysqli_fetch_array($result_chats)) {
                      ?>
                          <thead>
                            <tr>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <ul style="margin-top: 10px;">
                                  <li><a href="javascript:void(0);" class="load_chat" data-name="<?php echo $chat_row['name']; ?>" data-id="<?php echo $chat_row['chat_room_id']; ?>" style="color:#39493e;text-decoration: none;"><?php echo $chat_row['name']; ?></a></li>
                                </ul>
                              </td>
                            </tr>
                          </tbody>
                      <?php }
                      }
                      ?>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <input type="hidden" name="room_chat_id" class="room_chat_id" value="">
                <input type="hidden" name="room_chat_name" class="room_chat_name" value="">
                <div class="chat_load_screen">
                  <!-- <div class="row" style="background: #c7d6bf;color: #39493e;">
                            <div class="col-md-12">
                                <h3 class="text chat_screen_title" style="padding: 10px;"></h3>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="">
                        </div> -->
                </div>
                <form action="buddy.php" method="post" id="delete_form">
                  <div class="room_list">
                    <div class="row" style="background: #c7d6bf;color: #39493e;">
                      <div class="col-md-6">
                        <h3 class="text" style="padding: 10px;">Find your Study Buddy</h3>
                      </div>
                      <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chatroomModal" style="margin-top: 20px;">Create Room</button>
                      </div>
                    </div>
                    <div class="" style="margin-top: 30px;">
                      <?php if (isset($_GET['msg'])) { ?>
                        <p class="alert alert-success"><?php echo $_GET['msg']; ?></p>
                      <?php } ?>
                      <table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" id="table">
                        <thead>
                          <tr>
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
                          while ($inner_row = mysqli_fetch_array($result)) { ?>
                            <tr>
                              <td>
                                <?php echo $inner_row['name']; ?>
                              </td>
                              <td><?php echo date('M d, Y h:i A', strtotime($inner_row['created_at'])); ?></td>
                              <td>
                                <div class="d-flex justify-content-center chat_room_<?php echo $inner_row['id']; ?>">
                                  <input type="hidden" name="id" class="id" value="<?php echo $inner_row['id']; ?>">
                                  <?php
                                  $student_id = $_SESSION['id'];
                                  $sql_cont = "SELECT * FROM `chat_room_students` WHERE student_id ='$student_id' AND chat_room_id=" . $inner_row['id'];
                                  $result_count = mysqli_query($conn, $sql_cont);
                                  $inner_row_ctr = mysqli_num_rows($result_count);
                                  $chat_row = mysqli_fetch_array($result_count);
                                  ?>
                                  <div class="chat_action">
                                    <?php if ($inner_row_ctr > 0) { ?>
                                      <button class="btn btn-primary leave" data-room="<?php echo $inner_row['id']; ?>" data-id="<?php echo $chat_row['chat_room_id']; ?>" type="button">Leave Room</button>
                                    <?php } else { ?>
                                      <button class="btn btn-primary join" data-id="<?php echo $inner_row['id']; ?>" type="button">Join</button>
                                    <?php } ?>
                                    <?php if ($inner_row['student_id'] == $_SESSION['id']) { ?>
                                      <a href="delete_chat_room.php?id=<?php echo $inner_row['id']; ?>" class="btn delete" style="background: #be6646;color:#000;">Delete</a>
                                    <?php } ?>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#table').DataTable();

            $('#chk_all').click(function() {
              if (this.checked)
                $(".chkbox").prop("checked", true);
              else
                $(".chkbox").prop("checked", false);
            });

            $('#delete_form').submit(function(e) {
              if (!confirm("Confirm Delete?")) {
                e.preventDefault();
              }
            });

            <?php if ($count_chat > 0) { ?>
              $('#chat').DataTable();
            <?php } ?>
            $(document).on('click', '.join', function() {
              var id = $(this).data('id');
              $.ajax({
                type: "post",
                url: "join_chat_room_ajax.php",
                data: {
                  id: id
                },
                success: function(data) {
                  location.reload();
                  // $('.chat_action').html(data);
                }
              });
            });

            $(document).on('click', '.leave', function() {
              var id = $(this).data('id');
              var roomId = $(this).data('room');
              $.ajax({
                type: "post",
                url: "leave_chat_room_ajax.php",
                data: {
                  id: id,
                  roomId: roomId
                },
                success: function(data) {
                  // $('.chat_action').html(data);
                  location.reload();
                }
              });
            });

            $(document).on('click', '.load_chat', function() {
              $('.room_list').hide();
              $('.chat_load_screen').show();
              var id = $(this).data('id');
              var name = $(this).data('name');

              $('.room_chat_id').val(id);
              $('.room_chat_name').val(name);

              $.ajax({
                type: "post",
                url: "load_room_chat_ajax.php",
                data: {
                  id: id,
                  name: name
                },
                success: function(data) {
                  $('.chat_load_screen').html(data);
                }
              });
            });

            $(document).on('click', '.sendMessage', function() {
              var id = $('.chat_room_id').val();
              var message = $('.message').val();
              $.ajax({
                type: "post",
                url: "post_room_chat_ajax.php",
                data: {
                  id: id,
                  message: message
                },
                success: function(data) {
                  $('.message').val('');
                  // $('.chat_load_screen').html(data);
                  loadChat();
                }
              });
            });

            function loadChat() {
              var id = $('.room_chat_id').val();
              var name = $('.room_chat_name').val();
              $.ajax({
                type: "post",
                url: "load_room_chat_ajax.php",
                data: {
                  id: id,
                  name: name
                },
                success: function(data) {
                  $('.chat_load_screen').html(data);
                }
              });
            }

            $(document).on('click', '.lobby', function() {
              $('.chat_load_screen').hide();
              $('.room_list').show();
            })

          });
        </script>

      </div>
    </section>
    <!-- Add Chat Room modal -->
    <div class="modal fade" id="chatroomModal" tabindex="-1" role="dialog" aria-labelledby="chatroomModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document" style="margin-top:100px">
            <div class="modal-content">
              <form method="post" action="create_chat_room.php">
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

        <!-- Edit Chat Room modal -->
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

  </body>

  </html>
<?php
} else {
  header("Location: studentlogin.php");
  exit();
}
?>