<?php
session_start();
error_reporting(0);
include('db_conn.php');
include('previewClass.php');


if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

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
						<div class="project-content">
							<div class="project-name">
								<h2 class="my-0">Project Name</h2>
							</div>

							<div class="project-desc">
								<span STYLE="position: relative; top: 5px; font-size:14.0pt; "><i>project description</i></span>
							</div>

							<div class="create-upload">
								<button onclick="location.href='collab-create-new-file.php'" class="create-new">Create New File</button>
								<button onclick="location.href='collab-upload-file.php'" class="upload">Upload File</button>
							</div>
						</div>
						<div class="card bg-card left-card project-file">
							<div class="p-1">
								<div class="bg-white px-4 py-3">
									<h3 style="color:rgb(202, 195, 199)"><i>Project is empty</i></h3>
									<!-- <a>edit</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<!-- ############ CONTENT HTML CODE : END ############-->


		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

	</body>

	</html>
<?php
} else {
	header("Location: studentlogin.php");
	exit();
}
?>