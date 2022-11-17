<?php
session_start();
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($email)) {
		header("Location: adminlogin.php?error=Email is required");
		exit();
	} else if (empty($pass)) {
		header("Location: adminlogin.php?error=Password is required");
		exit();
	} else {
		$sql = "SELECT * FROM admins WHERE email='$email' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['email'] === $email && $row['password'] === $pass) {
				$_SESSION['email'] = $row['email'];
				$_SESSION['id'] = $row['id'];

				$sql = "INSERT INTO activity(ts, id, email, activity) VALUES('". time() ."', '". $_SESSION['id'] ."', '". $_SESSION['email'] ."','". $_SESSION['email'] ." has logged in')";
																													

				$result = mysqli_query($conn, $sql);

				header("Location: admindashboard.php");
				exit();
			} else {
				header("Location: adminlogin.php?error=Incorrect Email or password");
				exit();
			}
		} else {
			header("Location: adminlogin.php?error=Incorrect Email or password");
			exit();
		}
	}
} else {
	header("Location: adminlogin.php");
	exit();
}
