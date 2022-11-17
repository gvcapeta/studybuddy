<?php
include_once 'db_conn.php';
session_start();
if(isset($_POST['submit'])){	
	$student_id = $_POST ['student_id'];
	$student_email = $_POST ['student_email'];
	$student_fname = strtoupper($_POST['student_fname']);
	$student_mname = strtoupper($_POST['student_mname']);
	$student_lname = strtoupper($_POST['student_lname']);
	$birth_date = $_POST['birth_date'];
	$yearlvl = $_POST['yearlvl'];
	$nationality = strtoupper($_POST['nationality']);
	$phone = $_POST['phone'];
	$gender = strtoupper($_POST['gender']);
	$sql_count = "SELECT * FROM students WHERE email LIKE '$student_email'";
	$sql = "INSERT into activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." added a student record')";
	$result = mysqli_query($conn, $sql);
    $result_count = mysqli_query($conn, $sql_count);

    $sql_count_sid = "SELECT * FROM students WHERE student_id LIKE '$student_id'";
    $result_count_sid = mysqli_query($conn, $sql_count_sid);

    if (mysqli_num_rows($result_count) > 0 || mysqli_num_rows($result_count_sid) > 0 ) {
    	echo "<script>alert('Student is already registered with same email id or student id');
	      	window.location.href='admindashboard_students.php';</script>";
    }else{
    	$sql = "INSERT INTO students (student_id, firstname,lastname,middlename, birth_date,yearlvl,nationality,gender,phone,email,password)
		VALUES ('$student_id','$student_fname','$student_mname','$student_lname','$birth_date','$yearlvl','$nationality','$gender','$phone','$student_email','$student_id')";
		 
		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Student Record Created Successfully');
	      	window.location.href='admindashboard_students.php';</script>";
		 }
		 else{
			echo "Error: " . $sql . "" . mysqli_error($conn);
		 }
		 mysqli_close($conn);
    }
}
if(isset($_POST['update_submit'])){

	$student_id = $_POST ['student_id'];
	$student_email = $_POST ['student_email'];
	$student_fname = strtoupper($_POST['student_fname']);
	$student_mname = strtoupper($_POST['student_mname']);
	$student_lname = strtoupper($_POST['student_lname']);
	$birth_date = $_POST['birth_date'];
	$yearlvl = $_POST['yearlvl'];
	$nationality = strtoupper($_POST['nationality']);
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];

	$sfirst = strtoupper($_POST['student_fname']);
	$slast = strtoupper($_POST['student_lname']);
	// $teacher_id = $_POST['teacher_id'];
	// $subject = explode('-', $_POST['subject_code']);
	// $subject_code = trim($subject[0]);
	// $description = trim($subject[1]);
	// $subject_code = $_POST['subject_code'];
	// $description = $_POST['description'];
	
	// $Year_lvl_and_block = $_POST['Year_lvl_and_block'];
	// $teacher = $_POST['teacher'];
	// $class_id = $_POST['class_id'];

	$id = $_POST['id'];
	$sql = "INSERT into activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." added a student record')";

	$sql_count = "SELECT * FROM students WHERE email LIKE '$student_email'";
    $result_count = mysqli_query($conn, $sql_count);

    $sql_count_sid = "SELECT * FROM students WHERE student_id LIKE '$student_id'";
    $result_count_sid = mysqli_query($conn, $sql_count_sid);

	$sql = "UPDATE students set student_id = '$student_id',firstname = '$student_fname',middlename = '$student_mname',lastname = '$student_lname',birth_date = '$birth_date',yearlvl = '$yearlvl',nationality = '$nationality',phone = '$phone',gender = '$gender' ,password = '$student_id' where id = ".$id;
	if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Student Record Updated Successfully');
			window.location.href='admindashboard_students.php';</script>";
	 }
	 else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);	
}
if(isset($_POST['update_password'])){

	$password = $_POST['password'];

	$id = $_POST['id'];
	
	$sql = "UPDATE students set password = '$password' where id = ".$id;
	if (mysqli_query($conn, $sql)) {			
		echo "<script>alert('Student Password Updated Successfully');
			window.location.href='admindashboard.php';</script>";
	}
	else{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}
	mysqli_close($conn);	
}
?>