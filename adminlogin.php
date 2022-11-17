<?php
session_start(); 
include "db_conn.php";

$result = mysqli_query($conn, "SELECT * FROM admins");

if(mysqli_num_rows($result) == 0) {

   $firstname='admin';
   $lastname='admin';
   $email="admin";
   $password="admin";

   mysqli_query($conn, "INSERT into admins(firstname,lastname,email,password) VALUES('".$firstname."','".$lastname."','".$email."','".$password."')") or die(mysqli_error()); 
       
};
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   <link rel="stylesheet" href="login.style.css">
   <title>Login</title>
</head>

 <body>
      <div style = "position:relative; left:400px; top:2px" class="wrapper">
         <div class="title">
            <div class="appname"><a href="index.php" style="text-decoration: none; color: #477256;">StudyBuddy</a></div>
            <a style="color: #67A67D;"><i class="fas fa-user-secret"></i> Admin Login</a>  

         </div>
        <form action="login_code_admin.php" method="post">
      
      <?php if (isset($_GET['error'])) { ?>
         <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <div class="field">
               <input type="text" name="email">
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" name="password">
               <label>Password</label>
            </div>
            <div class="field">
               <input type="submit" value="Login" style="background-color: #67A67D;">
            </div>
            <div class="forgotpass">
            <a href="forgotpassword_admin.php">Forgot Password?</a>
            </div>
         </form>
      </div>
   </body>
</html>