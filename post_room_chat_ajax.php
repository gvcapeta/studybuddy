<?php
include_once 'db_conn.php';
session_start();

$id = $_POST['id'];
$student_id = $_SESSION['id'];
$message = $_POST['message'];

$sql = "INSERT INTO chat_room_messages (chat_room_id,student_id,message,message_type)
	VALUES ('$id','$student_id','$message','message')";
	 
if (mysqli_query($conn, $sql)) {
	// $lastid = mysqli_insert_id($conn);
	// echo '<button class="btn btn-primary leave" data-room="'.$id.'" data-id="'.$lastid.'" type="button">Leave Room</button>';
	// exit;
 }
 else{
	echo "Error: " . $sql . "" . mysqli_error($conn);
 }
 mysqli_close($conn);

?>