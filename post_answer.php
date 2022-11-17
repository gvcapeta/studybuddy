<?php 
	include_once 'db_conn.php';
	session_start();

	if(isset($_POST['submit'])){
	 
		$student_id = $_SESSION['id'];
		$question_id = $_POST['id'];
		$answer = $_POST['answer'];
		// $tag = $_POST['tags'];
		
		$sql = "INSERT INTO `student_answer` (question_id,student_id,answer) VALUES ('$question_id','$student_id','$answer')";

		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Answer Posted Successfully!');
			window.location.href='questions.php';</script>";
		} else {
			echo "Error: " . $sql . "" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>