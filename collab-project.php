<?php
session_start();
// error_reporting(0);
include('db_conn.php');
include('previewClass.php');

if (isset($_POST['inviteUser'])) {
	$stdID = $_POST['stdID'];
	$grpID = $_GET['groupID'];
	// Fetch student data
	$queryStudentID = "SELECT `id`, `firstname`, `lastname` FROM students WHERE `student_id` = '" . $stdID . "'";

	$result_questions = mysqli_query($conn, $queryStudentID);
	$count = mysqli_num_rows($result_questions);
	$data = mysqli_fetch_array($result_questions);

	if ($count > 0) {
		// Fetch collab data
		$queryStudentID = "SELECT `collaborators` FROM collab_group WHERE `id` = " . $grpID;

		$result_questions = mysqli_query($conn, $queryStudentID);
		$data1 = mysqli_fetch_array($result_questions);

		$collabs = $data[0] . "," . $data[1] . " " . $data[2];

		if (!str_contains($data1[0] ? $data1[0] : '', $collabs)) {
			$sql = "UPDATE `collab_group` SET `collaborators`=CONCAT(COALESCE(`collaborators`,''),'" . $collabs . "|') WHERE `id` = " . $grpID;
			$err = mysqli_query($conn, $sql);
			// var_dump($err);
		} else {
			echo "<script>alert('User has already been invited!')</script>";
		}
	} else {
		echo "<script>alert('User not found! Student Number: '". $stdID .")</script>";
	}
}

if (isset($_POST['deleteFile'])) {
	$id = $_POST['id'];
	$name = $_POST['deleteFile'];
	$grpID = $_GET['groupID'];

	$sql = "DELETE FROM `collab_files` WHERE `fileID` = " . $id;
	mysqli_query($conn, $sql);

	unlink('uploads/group/' . $grpID . '/' . $name);
	echo 'Successfully deleted!';
	exit();
}

if (isset($_POST['removeUser'])) {
	$code = $_POST['code'];
	$grpID = $_GET['groupID'];

	$sql = "UPDATE `collab_group` SET `collaborators`=REPLACE(`collaborators`, '" . $code . "|', '') WHERE `id` = " . $grpID . ";";
	mysqli_query($conn, $sql);
	exit();
}

if (isset($_POST['respondRequest'])) {
	$action = $_POST['respondRequest'];
	$code = $_POST['code'];
	$grpID = $_GET['groupID'];

	$sql = "UPDATE `collab_group` 
	SET `requests`=REPLACE(`requests`, '" . $code . "|', '') 
	WHERE `id` = " . $grpID . ";";

	mysqli_query($conn, $sql);

	if ($action == 'accept') {
		$sql = "
		UPDATE `collab_group` 
		SET `collaborators` = CONCAT(COALESCE(`collaborators`, ''), '" . $code . "|') 
		WHERE `id` = " . $grpID . ";";

		mysqli_query($conn, $sql);
		echo "Request has been accepted!";
	} else {
		echo "Request has been denied!";
	}

	exit();
}

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
	$grpID = $_GET['groupID'];
	$sql = "SELECT * FROM `collab_group` WHERE `id` = " . $grpID . "";

	$result_questions = mysqli_query($conn, $sql);
	$count_questions = mysqli_num_rows($result_questions);
	$groupData = mysqli_fetch_array($result_questions)
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

			/* Style the tab */
			.tab {
				overflow: hidden;
				background-color: #f1f1f1;
			}

			/* Style the buttons that are used to open the tab content */
			.tab button {
				background-color: inherit;
				float: left;
				border: none;
				outline: none;
				cursor: pointer;
				padding: 14px 16px;
				transition: 0.3s;
			}

			/* Change background color of buttons on hover */
			.tab button:hover {
				background-color: #ddd;
			}

			/* Create an active/current tablink class */
			.tab button.active {
				background-color: #ccc;
			}

			/* Style the tab content */
			.tabcontent {
				padding: 6px 12px;
				border-top: none;
				width: 100%;
				display: none;
			}

			.project-content {
				width: 100%;
				margin-bottom: 15px;
			}

			.project-file {
				width: 100%;
			}

			tr td,
			tr th {
				padding: 10px 0px;
			}

			tr:nth-child(odd) {
				background: #f1f1f1;
			}

			tr:first-child {
				background: #477256;
				color: white;
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
								<h2 class="my-0"><?php echo $groupData['name'] ?></h2>
							</div>
							<!-- <br> -->
							<div class="project-desc">
								<span style="position: relative; top: 5px; font-size:14.0pt; "><i><?php echo $groupData['description'] ?></i></span>
							</div>
						</div>
						<div class="card bg-card left-card project-file">
							<div class="p-1">
								<div class="tab">
									<button type="button" class="tablinks" id="filesLink" onclick="setDisplay('files');">Files</button>
									<button type="button" class="tablinks" id="membersLink" onclick="setDisplay('members');">Members</button>
								</div>
								<div class="bg-white px-4 py-3">
									<div class="tabcontent" id="filesTab">
										<div class="project-content">
											<div class="create-upload">
												<button onclick="location.href='collab-create-new-file.php?groupID=<?php echo $grpID; ?>'" class="create-new">Create New File</button>
												<button data-bs-toggle="modal" data-bs-target="#uploadFile" class="upload">Upload File</button>
											</div>
										</div>
										<div class="card bg-card left-card project-file">
											<div class="p-1">
												<div class="bg-white px-4 py-3">
													<table style="width: 100%; border-collapse: collapse;">
														<tr>
															<th>File name</th>
															<th>Uploaded by</th>
															<th>Actions</th>
														</tr>
														<?php
														$sql = "SELECT * FROM `collab_files` WHERE `groupID` = " . $grpID . " ORDER BY `filename` DESC";
														$resultFiles = mysqli_query($conn, $sql);
														$countFiles = mysqli_num_rows($resultFiles);

														if ($countFiles > 0) {
															while ($data = mysqli_fetch_array($resultFiles)) {
																$display = in_array(end(explode('.', $data['filename'])), array('jpg', 'jpeg', 'gif', 'pdf', 'png')) ? 'none' : 'unset';
																echo <<<HTML
																	<tr>
																		<td onclick="window.open('uploads/group/{$grpID}/{$data['filename']}')">{$data['filename']}</td>
																		<td onclick="window.open('uploads/group/{$grpID}/{$data['filename']}')">{$data['uploadBy']}</td>
																		<th><button onclick="window.open('uploads/group/{$grpID}/{$data['filename']}')">View</button><button style="display: {$display}" onclick="window.open('collab-create-new-file.php?fileID={$data['fileID']}&groupID={$data['groupID']}&filename={$data['filename']}', '_self');">Edit</button><button onclick="deleteFile({$data['fileID']}, '{$data['filename']}')">Delete</button></th>
																	</tr>
																	HTML;
															}
														} else {
															echo <<<HTML
															<th colspan="3"><h3 style="color:rgb(202, 195, 199)"><i>Project is empty</i></h3></th>
															HTML;
														}
														?>
													</table>
													<!-- <a>edit</a> -->
												</div>
											</div>
										</div>
									</div>
									<div id="membersTab" class="tabcontent">
										<div class="create-upload">
											<button data-bs-toggle="modal" data-bs-target="#accessRequest" class="create-new">Access Requests</button>
											<button data-bs-toggle="modal" data-bs-target="#inviteUser" class="upload">Invite User</button>
										</div>
										<br>
										<table style="width: 100%; border-collapse: collapse;">
											<tr>
												<th>Name</th>
												<th>Action</th>
											</tr>
											<?php
											if ($groupData['collaborators'] != NULL) {
												$asArr = explode('|', $groupData['collaborators']);

												foreach ($asArr as $val) {
													if ($val != '') {
														$tmp = explode(',', $val);
														echo <<<HTML
														<tr>
															<td>$tmp[1]</td>
															<th><button onclick="removeUser('$val');">Remove</button></th>
														</tr>
													HTML;
													}
												}
											} else {
												echo "<tr><th colspan=\"2\">No data found! Try inviting users to your project.</th></tr>";
											}
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<!-- ############ CONTENT HTML CODE : END ############-->

		<!-- ############ Upload File: MODAL POPUP HTML CODE : START ############-->
		<div class="modal fade" id="uploadFile" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="my-0">Upload File</h1>
						<a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<svg width="20px" viewBox="0 0 320 512">
								<path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
							</svg>
						</a>
					</div>
					<div class="modal-body">
						<form action="upload.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="groupID" value="<?php echo $grpID; ?>">
							<div class="card bg-card left-card project-file">
								<div class="p-1">
									<div class="bg-white px-4 py-3 choose-file">
										<input type="file" name="file" id="choose-file" hidden />
										<label for="choose-file">Choose your files</label>
									</div>
								</div>
							</div>

							<div class="card bg-card left-card project-file">
								<div class="p-1">
									<div class="bg-white px-4 py-3">
										<span id="file-chosen">No file chosen</span>

									</div>
								</div>
							</div>

							<div class="save-cancel-btn project-file">
								<button type="submit" class="save-changes">Upload</button>
								<button type="button" class="cancel">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ############ MODAL POPUP HTML CODE : END ############-->

		<!-- ############ Access Request: MODAL POPUP HTML CODE : START ############-->
		<div class="modal fade" id="accessRequest" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="my-0">Access Request(s)</h1>
						<a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<svg width="20px" viewBox="0 0 320 512">
								<path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
							</svg>
						</a>
					</div>
					<div class="modal-body">
						<table style="width: 100%; border-collapse: collapse;">
							<tr>
								<th>Name</th>
								<th>Action</th>
							</tr>
							<?php
							if ($groupData['requests'] != NULL) {
								$asArr = explode('|', $groupData['requests']);

								foreach ($asArr as $val) {
									if ($val != '') {
										$tmp = explode(',', $val);
										echo <<<HTML
											<tr>
												<td>{$tmp[1]}</td>
												<th><button onclick="respondRequest('{$val}', 'accept');">Accept</button><button onclick="respondRequest('{$val}', 'reject');">Decline</button></th>
											</tr>
										HTML;
									}
								}
							} else {
								echo "<tr><th colspan=\"2\">No data found! Please try again later.</th></tr>";
							}
							?>
						</table>
						<div class="save-cancel-btn project-file">
							<button type="button" class="cancel" data-bs-dismiss="modal" aria-label="Close">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ############ MODAL POPUP HTML CODE : END ############-->

		<!-- ############ Invite User: MODAL POPUP HTML CODE : START ############-->
		<div class="modal fade" id="inviteUser" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="my-0">Invite Users</h1>
						<a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<svg width="20px" viewBox="0 0 320 512">
								<path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
							</svg>
						</a>
					</div>
					<div class="modal-body">
						<form action="collab-project.php?groupID=<?php echo $grpID; ?>" method="post">
							<label for="stdID">Student Number:</label>
							<input type="text" name="stdID" id="stdID" required>

							<div class="save-cancel-btn project-file">
								<button type="submit" name="inviteUser" class="save-changes">Invite User</button>
								<button type="button" class="cancel">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ############ MODAL POPUP HTML CODE : END ############-->


		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

		<script>
			function setDisplay(sel) {
				if (sel == 'files') {
					on = 'files';
					off = 'members';
				} else {
					on = 'members';
					off = 'files';
				}

				$('#' + on + 'Tab').css('display', 'block');
				$('#' + off + 'Tab').css('display', 'none');
				$('#' + on + 'Link').css('background', '#ddd');
				$('#' + off + 'Link').css('background', 'unset');
				console.log(on);
			}

			setDisplay('files');
			const actualBtn = document.getElementById('choose-file');

			const fileChosen = document.getElementById('file-chosen');

			actualBtn.addEventListener('change', function() {
				fileChosen.textContent = this.files[0].name
			});

			function deleteFile(id, name) {
				if (confirm('Are you sure you want to delete file "' + name + '"? This action is permanent.')) {
					$.ajax({
						url: 'collab-project.php?groupID=<?php echo $grpID; ?>',
						method: 'POST',
						type: 'POST',
						data: {
							'deleteFile': name,
							'id': id
						}
					}).done(function(data) {
						alert(data);
						window.location.href = window.location.href;
					});
				}
			}

			function removeUser(code) {
				if (confirm("Are you sure you want to remove user access?")) {
					$.ajax({
						url: 'collab-project.php?groupID=<?php echo $grpID; ?>',
						method: 'POST',
						type: 'POST',
						data: {
							'removeUser': 1,
							'code': code,
						}
					}).done(function(data) {
						// alert(data);
						window.location.href = window.location.href;
					});
				}
			}

			function respondRequest(code, action) {
				$.ajax({
					url: 'collab-project.php?groupID=<?php echo $grpID; ?>',
					method: 'POST',
					type: 'POST',
					data: {
						'respondRequest': action,
						'code': code,
					}
				}).done(function(data) {
					alert(data);
					window.location.href = window.location.href;
				});
			}
		</script>
	</body>

	</html>
<?php
} else {
	header("Location: studentlogin.php");
	exit();
}
?>