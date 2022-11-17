<?php
include_once 'db_conn.php';
session_start();

if(isset($_GET['id'])){	

	$sql = "DELETE FROM students WHERE id=".$_GET['id'];
	
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Student Record Deleted Successfully');
      	window.location.href='admindashboard_students.php';</script>";
	}
	else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}
	$sql = "INSERT into activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." deleted a student record')";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
}
?>