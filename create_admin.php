<?php
session_start(); 
include "db_conn.php";

if (isset($_POST['submit']))
{
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$password=$_POST['password'];

	$sql = "INSERT INTO activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." has added an admin')";
	$result = mysqli_query($conn, $sql);

	mysqli_query($conn, "INSERT into admins(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')") or die(mysqli_error());


echo "<script>alert('SUCCESSFULLY CREATED ACCOUNT FOR ADMIN');
      	window.location.href='admindashboard_useraccounts_a.php';</script>";
}


if(isset($_POST['update_submit'])){
	
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$password=$_POST['password'];

	$id = $_POST['id'];

	$sql_class = "UPDATE `admins` set  firstname = '$firstname',lastname = '$lastname',email = '$email',password = '$password' where id = ".$id;
	
	if (mysqli_query($conn, $sql_class)) {
		echo "<script>alert('Class Record Updated Successfully');
		window.location.href='admindashboard_useraccounts_a.php';</script>";	
	}
	else{
		echo "Error: " . $sql_class . "" . mysqli_error($conn);
	 }
	
	mysqli_close($conn);
}
?>