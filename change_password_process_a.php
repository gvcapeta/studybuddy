<?php
    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $conn = new mySqli('localhost', 'root', '', 'login');
        if($conn->connect_error) {
            die('Could not connect to the database');
        }

        $verifyQuery = $conn->query("SELECT * FROM admins WHERE code = '$code' and updated_time >= NOW() - Interval 1 DAY");

        if($verifyQuery->num_rows == 0) {
            header("Location: adminlogin.php");
            exit();
        }

        if(isset($_POST['change'])) {
            $email = $_POST['email'];
            $new_password = $_POST['new_password'];

            $sql = "INSERT into activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." has changed password')";

            $result = mysqli_query($conn, $sql);

            $changeQuery = $conn->query("UPDATE admins SET password = '$new_password' WHERE email = '$email' and code = '$code' and updated_time >= NOW() - INTERVAL 1 DAY");

            if($changeQuery) {
                header("Location: forgotpassword_success_a.php");
            }
        }
        $conn->close();
    }
    else {
        header("Location: adminlogin.php");
        exit();
    }
?>