<?php
include_once 'db_conn.php';
session_start();
if(isset($_POST['submit'])){	
	
	$name = $_POST['name'];
	$student_id = $_SESSION['id'];
	 
	$sql = "INSERT INTO chat_room (student_id,name)
	VALUES ('$student_id','$name')";
	 
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Chat Room Created Successfully');
      	window.location.href='sample.php';</script>";
	 }
	 else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
if(isset($_POST['update_submit'])){
	// $sub_year = $_POST ['sub_year'];
	$name = $_POST['name'];
	$id = $_POST['id'];
	$student_id = $_SESSION['id'];
	
	$sql = "UPDATE subjects set name = '$name' where id = ".$id;
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Chat Room Updated Successfully');
      	window.location.href='sample.php';</script>";
	 }
	 else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);	
}
?>