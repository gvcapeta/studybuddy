<?php
include_once 'db_conn.php';
session_start();

if(isset($_GET['id'])){	

	$sql = "DELETE FROM `admins` WHERE `id`=".$_GET['id'];
	
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Admin Deleted Successfully');
      	window.location.href='admindashboard_useraccounts_a.php';</script>";
	}
	else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}
	$sql = "INSERT INTO activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." has deleted an admin')";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
}

?>