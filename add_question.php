<?php 
	
	include_once 'db_conn.php';
	session_start();

	if(isset($_POST['submit'])){
	 
		$student_id = $_SESSION['id'];
		$question = $_POST['question']; 		
		$tag = $_POST['tags'];
		$file = $_FILES['image'];
		$isAnonymous = $_POST['isAnonymous'] ? 1 : 0;
		var_dump($isAnonymous);

		$fileName = $_FILES['image']['name'];
		$fileTmpName = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$fileError = $_FILES['image']['error'];
		$fileType = $_FILES['image']['type'];


		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		/* 
		* EVAN:
		* I've removed $allowed since you guys are now allowing file uploads
		* If you want to limit what files can be uploaded
		* Just un-comment the ff. code on lines: 33, 45-47 within this file ;) Goodluck! 💖💖
		*/
		// $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

		// if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 5000000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
			} else {
				echo "Your file is too big!";
			}
		} else {
			echo "There was an error uploading your file!";
		}
	// } else {
	// 	echo "You cannot upload this type of file";
	// }
		$sql = "INSERT INTO `student_questions` (student_id,question,tag,image,isAnonymous) VALUES ('$student_id','$question','$tag','$fileNameNew','$isAnonymous')";

		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Question Posted Successfully!');
			window.location.href='questions.php';</script>";

		} else {
			echo "Error: " . $sql . "" . mysqli_error($conn);
		}


		
		/*$image = $_FILES['image']['name'];
    	$ext = $_FILES['image']['type'];
    	$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
    	if ($_FILES['image']['name'] !== ""){
    		$query = "INSERT INTO student_questions (student_id,question,tag,image) VALUES ('$student_id','$question','$tag','$picture') ";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
	            if (mysqli_affected_rows($conn) > 0) {
	                echo "<script> alert('Successfully posted!');
	                window.location.href='questions.php';</script>";
	            }
	            else {
	                "<script> alert('Error while posting..try again');</script>";
	            }
	        }
	    else {
	    	if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
    			{
				echo "<script>alert('Image size too big'); window.location.href='questions.php';</script>";
    			}
    		else if (!in_array($ext, $validExt)){
        		echo "<script>alert('File type not supported');window.location.href='questions.php';</script>";

    			}
   	 	
        	$folder  = 'uploads/';
        	$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
        	$picture = rand(1000 , 1000000) .'.'.$imgext;
        	if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
            $query = "INSERT INTO student_questions (student_id,question,tag,image) VALUES ('$student_id','$question','$tag','$picture') ";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script> alert('Successfully posted!');
                window.location.href='questions.php';</script>";
            }
            else {
                "<script> alert('Error while posting..try again');</script>";
            }
        }
    }

		/*$sql = "INSERT INTO `student_questions` (student_id,question,tag) VALUES ('$student_id','$question','$tag')";


		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Question Posted Successfully!');
			window.location.href='questions.php';</script>";
		} else {
			echo "Error: " . $sql . "" . mysqli_error($conn);
		}*/
		mysqli_close($conn);
	}
?>