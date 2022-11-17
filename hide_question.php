<?php 

include_once 'db_conn.php';
session_start();

$id = $_POST['id'];
$status = $_POST['status'];

$sql_class = "UPDATE student_questions set  status = '$status' where id = ".$id;
if (mysqli_query($conn, $sql_class)) {
	echo "<script>alert('Question Hide from listing');
	window.location.href='questions.php';</script>";	
}
else{
	echo "Error: " . $sql_class . "" . mysqli_error($conn);
 }

mysqli_close($conn);	

?>