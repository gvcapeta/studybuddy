<?php 
session_start();
error_reporting(0);
include ('db_conn.php');
include ('previewClass.php');


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
			.bootstrap-tagsinput{
			    padding: 8px 6px;
			    width: 100%;
			}
			.card ul.label-badge > li{
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
                            <span STYLE="font-size:19.0pt; margin-left:-28px">/index.html</span>
						</div>
					
                    </div>
						<form action="collab-upload-file.php">
                            <div class="card bg-card left-card project-file">
                                <div class="p-1">
                                    <div class="bg-white px-4 py-3 choose-file">  
                                        <input type="file" id="choose-file" hidden/>
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

						<!-- <form method="post" enctype="multipart/form-data">
							<input type="file" name="my_file[]" multiple>
							<input type="submit" value="Upload">
						</form>
						<?php
							if (isset($_FILES['my_file'])) {
								$myFile = $_FILES['my_file'];
								$fileCount = count($myFile["name"]);

								for ($i = 0; $i < $fileCount; $i++) {
									?>
										
										<p><?= $myFile["name"][$i] ?><br>
											
										</p>
									<?php
								}
							}
						?> -->
				</div>
			</div>
						
		</div>
		</section>
		<!-- ############ CONTENT HTML CODE : END ############-->

		<!-- ############ MODAL POPUP HTML CODE : START ############-->
		<div class="modal fade" id="CreateNewProject" tabindex="-1"   aria-hidden="true">
			<div class="modal-dialog">
				<form action="" method="post" enctype="multipart/form-data" >
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="my-0">Create New Project</h1>
							<a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<svg  width="20px" viewBox="0 0 320 512">
									<path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/>
								</svg>
							</a>
						</div>
						<div class="modal-body">
						<div class="field">
						<label>Name</label>
							<input type="text" name="name">
						</div>
						<br>
						<div class="field">
						<label>Description (<i>optional</i>)</label>
							<input type="text" name="description">
							
						</div>
						<br><br>
						<div class="modal-footer">
							<button type="submit" name="submit" class="btn-post">Create</button>
							<button type="button" class="btn-close" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- ############ MODAL POPUP HTML CODE : END ############-->

		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/popper.min.js"></script>    
		<script src="js/bootstrap.min.js"></script>
		<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>
		<script>
            const actualBtn = document.getElementById('choose-file');

            const fileChosen = document.getElementById('file-chosen');

            actualBtn.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
            })
        </script>
	</body>
	</html>
	<?php 
}else{
	header("Location: studentlogin.php");
	exit();
}
?>