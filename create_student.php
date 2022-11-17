<?php
session_start(); 
include "db_conn.php";

if (isset($_POST['submit']))
{
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$password=$_POST['password'];

	$sql = "INSERT into activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." added a student')";

	$result = mysqli_query($conn, $sql);

	mysqli_query($conn, "INSERT into students(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')") or die(mysqli_error());


echo "<script>alert('SUCCESSFULLY CREATED ACCOUNT FOR STUDENT');
      	window.location.href='admindashboard_useraccounts_s.php';</script>";
}
?>