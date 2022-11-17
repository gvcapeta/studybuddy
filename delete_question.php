<?php 

include_once 'db_conn.php';
session_start();

$id = $_POST['id'];

@mysqli_query($conn,"DELETE FROM `student_answer` WHERE `question_id` =".$id);
@mysqli_query($conn,"DELETE FROM `student_questions` WHERE `id` =".$id);
    
$msg = "Question deleted Successfully!";
header("Location: questions.php?msg=$msg");	
	
mysqli_close($conn);	

?>