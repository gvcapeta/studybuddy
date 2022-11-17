<?php
include_once 'db_conn.php';
session_start();

$id = $_POST['id'];
$student_id = $_SESSION['id'];

// $sql_count = "SELECT * FROM chat_room_students WHERE student_id ='$student_id' AND chat_room_id=".$id;
// $result_count = mysqli_query($conn, $sql_count);
// $count = mysqli_num_rows($result_count);

// if($count>0){
// 	$sql = "UPDATE chat_room_students set name = '$name' where id = ".$id;
// 	if (mysqli_query($conn, $sql)) {
// 		// echo "<script>alert('Chat Room Updated Successfully');
// 		// window.location.href='buddy.php';</script>";
// 	}
// 	else{
// 		echo "Error: " . $sql . "" . mysqli_error($conn);
// 	}
// 	mysqli_close($conn);
// }
// else{
	
// }
$sql = "INSERT INTO chat_room_students (chat_room_id,student_id)
	VALUES ('$id','$student_id')";
	 
if (mysqli_query($conn, $sql)) {
	$lastid = mysqli_insert_id($conn);
	echo '<button class="btn btn-primary leave" data-room="'.$id.'" data-id="'.$lastid.'" type="button">Leave Room</button>';
	exit;
 }
 else{
	echo "Error: " . $sql . "" . mysqli_error($conn);
 }
 mysqli_close($conn);

?>