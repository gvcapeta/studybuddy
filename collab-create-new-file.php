<?php
session_start();
// error_reporting(0);
include('db_conn.php');
include('previewClass.php');

$file_data = '';

if (isset($_POST['save-data'])) {
	// var_dump($_POST);
	$fileID = $_POST['fileID'];
	$filename = $_POST['filename'];
	$groupID = $_POST['groupID'];
	$filedata = $_POST['file_data'];

	if (!is_dir('uploads/group/' . $groupID)) mkdir('uploads/group/' . $groupID, 0777, true);

	$raw_old_data = explode('&', $_POST['old_get']);
	foreach($raw_old_data as $val) {
		$tmp = explode('=',$val);
		$old_data[$tmp[0]] = urldecode($tmp[1]);
	}


	$ok = 1;
	if ($fileID == "NEW FILE") {
		if (file_exists('uploads/group/' . $groupID . '/' . $filename)) {
			echo "<script>alert('Filename already exists! Please select new filename.')</script>";
			$ok = 0;
		} else {
			file_put_contents('uploads/group/' . $groupID . '/' . $filename, $filedata);

			$sql = "INSERT INTO `collab_files`(`fileID`, `groupID`, `filename`, `uploadByID`, `uploadBy`, `uploadAt`) VALUES (NULL,'".$groupID."','".$filename."','".$_SESSION['id']."','".$_SESSION['firstname']." ". $_SESSION['lastname']."','current_timestamp()');";

			mysqli_query($conn, $sql);

			echo "<script>
			alert('File successfully saved!'); 
			window.open('collab-project.php?groupID=".$groupID."', '_self')
			</script>";
		}
	} else {
		// update if filename was changed
		if ($filename != $old_data['filename']) {
			if (file_exists('uploads/group/' . $groupID . '/' . $filename)) {
				echo "<script>alert('Filename already exists! Please select new filename.')</script>";
				$ok = 0;
			}
			if ($ok == 1) {
				// mysql pls tenks
				$sql = "UPDATE `collab_files` SET `filename`='$filename' WHERE `fileID` = ".$fileID;

				mysqli_query($conn, $sql);
			}
		}
		if ($ok == 1) {
			// updatefile contents
			unlink('uploads/group/' . $groupID . '/' . $old_data['filename']);
			file_put_contents('uploads/group/' . $groupID . '/' . $filename, $filedata);
			echo "<script>
			alert('File successfully saved!'); 
			window.open('collab-project.php?groupID=".$groupID."', '_self')
			</script>";
		}
	}

	if($ok == 0) {
		$fileID = $old_data['fileID'];
		$filename = $old_data['filename'];
		$groupID = $old_data['groupID'];
	}
}

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
	$groupID = $_GET['groupID'];
	if ($_GET['fileID']) {
		// var_dump($_GET);
		// var_dump($_POST);
	
		$fileID = $_GET['fileID'];
		$filename = $_GET['filename'];
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<link rel='stylesheet' href='https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css'>
		<!-- 
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
		<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'> -->
		<title>Collaboration</title>
		<style type="text/css">
			.bootstrap-tagsinput .tag {
				margin-right: 2px;
				color: #000;
				background: rgb(222, 236, 217);
				padding: 5px;
			}

			.bootstrap-tagsinput {
				padding: 8px 6px;
				width: 100%;
			}

			.card ul.label-badge>li {
				margin-right: 5px;
			}

			#anonymous {
				width: unset;
				min-height: unset;
				margin-right: unset;
			}

			textarea {
				width: 100%;
				height: 50vh;
			}
		</style>
	</head>

	<body>
		<?php include('sidebar2.php'); ?>
		<?php include('header.php'); ?>
		<!-- ############ CONTENT HTML CODE : START ############-->
		<section>
			<div class=" left-card">
				<div class="p-1">
					<div class="px-4 py-3">
						<form action="collab-create-new-file.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="groupID" value="<?php echo $groupID; ?>">
							<input type="hidden" name="fileID" value="<?php echo $fileID ? $fileID : "NEW FILE"; ?>">
							<input type="hidden" name="old_get" value="<?php echo end(explode('?', $_SERVER['REQUEST_URI'])) ?>">
							<div class="project-content">
								<div class="project-desc">
									<input type="text" name="filename" class="file-name" placeholder="File name" value="<?php echo $filename ? $filename : '' ?>" required />
								</div>

							</div>
							<div class="card bg-card left-card project-file">
								<div class="p-1">
									<div class="bg-white px-4 py-3">
										<div class="col-md-6 col-sm-9">

											<div class="">

												<svg width="35px" height="35px" viewBox="0 0 16 16">
													<path d="M5.854 4.854a.5.5 0 1 0-.708-.708l-3.5 3.5a.5.5 0 0 0 0 .708l3.5 3.5a.5.5 0 0 0 .708-.708L2.707 8l3.147-3.146zm4.292 0a.5.5 0 0 1 .708-.708l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.146z" />
												</svg>
												<span class="span-style">
													File Editor
												</span>


												<div class="">
													<textarea name="file_data" id="file_data" cols="30" rows="10"><?php
																													$data = file_get_contents('uploads/group/' . $groupID . '/' . $filename);
																													echo $filedata ? $filedata : htmlspecialchars($data);
																													?></textarea>
													<!-- insert text-editor code because I cant find any-->
													<!-- u for real ._. -->
												</div>

												<div class="save-cancel-btn">
													<button type="submit" name="save-data" class="save-changes">Save</button>
													<button type="button" class="cancel" onclick="<?php echo "window.open('collab-project.php?groupID=".$groupID."', '_self');";?>">Cancel</button>
												</div>



											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>

				</div>
		</section>
		<!-- ############ CONTENT HTML CODE : END ############-->

		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

		<!-- <script>
			function loadData() {
				$.ajax({
					url: "<?php echo $_SERVER['REQUEST_URI'] ?>",
					type: "POST",
					method: "POST",
					data: {
						'requestFile': 1
					}
				}).done(function(data) {
					$('#file_data').val() = data;
				});
			}
		</script> -->

	</body>

	</html>
<?php
} else {
	header("Location: studentlogin.php");
	exit();
}
?>