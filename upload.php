<?php
session_start();
// error_reporting(0);
include('db_conn.php');

if (isset($_POST['groupID'])) {
	var_dump($_POST);
	$grpID = $_POST['groupID'];
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];


	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	// $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

	// if (in_array($fileActualExt, $allowed)) {
	if ($fileError === 0) {
		if ($fileSize < 500000) {
			if (!is_dir('uploads/group/' . $grpID)) mkdir('uploads/group/' . $grpID, 0777, true);
			// $fileNameNew = uniqid('', true).".".$fileActualExt;
			$fileDestination = 'uploads/group/' . $grpID . '/' . $fileName;
			if (file_exists($fileDestination)) {
				echo "<script>
						alert('File exists! Please try again.');
						window.open(document.referrer, '_self');
					</script>";
				exit();
			}
			move_uploaded_file($fileTmpName, $fileDestination);

			$sql = "INSERT INTO `collab_files` (`fileID`, `groupID`, `filename`, `uploadByID`, `uploadBy`, `uploadAt`) VALUES (NULL, '" . $grpID . "', '" . $fileName . "', '" . $_SESSION['id'] . "', '" . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "', current_timestamp());";
			echo $sql;
			mysqli_query($conn, $sql);
			header("Location: collab-project.php?groupID=" . $grpID);
		} else {
			echo "<script>
						alert('File too big! Please try again.');
						window.open(document.referrer, '_self');
					</script>";
			exit();
		}
	} else {
		echo "<script>
					alert('There was an error uploading file! Please try again.');
					window.open(document.referrer, '_self');
				</script>";
		exit();
	}
	// } else {
	// 	echo "<script>
	// 			alert('You can\'t upload this kind of file!\nAccepted file types: jpg, jpeg, png, gif, and pdf');
	// 			window.open(document.referrer, '_self');
	// 		</script>";
	// 	exit();
	// }
}
