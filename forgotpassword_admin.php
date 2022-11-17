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
           Forgot Password
         </div>
     <form action="forgot_password_process_a.php" method="post">
        
        <div class="field">
               <input type="email" name="email">
               <label>Email Address</label>
            </div>
               <div class="field">
               <input type="submit" value="Reset" name="reset" style="background: #be6546;">
            </div>
     </form>
     </div>
</body>
</html>