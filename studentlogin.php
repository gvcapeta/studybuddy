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
           <i class="fas fa-book-reader"></i>Student Login
         </div>

     <form action="login_code_student.php" method="post">
      
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
               <input type="submit" value="Login">
            </div>
            <div class="forgotpass">
           <a href="forgotpassword_student.php">Forgot Password?</a>
            </div>
     </form>
     </div>
</body>
</html>