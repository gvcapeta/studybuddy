<?php include 'change_password_process_a.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="login.style.css">
<title>Forgot Password</title>
</head>

 <body>
      <div style = "position:relative; left:400px; top:2px; text-align: center;" class="wrapper">
        <div class="appname"><a href="index.php" style="text-decoration: none; color: #477256;">StudyBuddy</a></div>
         <div class="title" style="color: #be6546;">
           Change Password
         </div>
     <form action="" method="post">
        
        <div class="field">
               <input type="text" name="email">
               <label>Email Address</label>
        </div>
        <div class="field">
               <input type="password" name="new_password">
               <label>New Password</label><br>
            </div>
               <div class="field">
               <input type="submit" name="change" value="Change" style="background: #be6546;">
            </div>
     </form>
     </div>
</body>
</html>