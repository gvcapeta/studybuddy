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
		<link rel="stylesheet" href="css/materialize.min.css">
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
                            <div class="card bg-card left-card project-file">
                                <div class="p-1">
                                    <div class="bg-white px-4 py-3">  
                                        <div class="col-md-6 col-sm-9">

                                            <div class="">
                                                <a href="#" style="text-decoration: none;" >
                                                <svg width="35px" height="35px" viewBox="0 0 16 16"> <path d="M5.854 4.854a.5.5 0 1 0-.708-.708l-3.5 3.5a.5.5 0 0 0 0 .708l3.5 3.5a.5.5 0 0 0 .708-.708L2.707 8l3.147-3.146zm4.292 0a.5.5 0 0 1 .708-.708l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.146z"/> </svg>
                                                    <span class="span-style">
                                                        Code
                                                    </span>
                                                </a>
                                                <a href="#" style="text-decoration: none;" >
                                                <svg width="35px" height="35px" viewBox="0 0 16 16"> <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/> <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/> <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/> </svg>
                                                    <span class="span-style">
                                                        Contributer
                                                    </span>
                                                </a>

                                                <!-- delete-icon -->
                                                <a href="#" style="text-decoration: none;" fill="red" >
                                                    <svg STYLE="float: right; margin-left:10px;"width="35px" height="35px" viewBox="0 0 24 24"> <path d="M7 6V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5zm2-2v2h6V4H9z"/> </svg>
                                                </a>

                                                <!-- edit-icon -->
                                                <a href="#" style="text-decoration: none;" fill="blue" >
                                                    <svg STYLE="float: right;"width="35px" height="35px" viewBox="0 0 24 24"> <path d="M13.0207 5.82839L15.8491 2.99996L20.7988 7.94971L17.9704 10.7781M13.0207 5.82839L3.41405 15.435C3.22652 15.6225 3.12116 15.8769 3.12116 16.1421V20.6776H7.65669C7.92191 20.6776 8.17626 20.5723 8.3638 20.3847L17.9704 10.7781M13.0207 5.82839L17.9704 10.7781" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                                                </a>
                                            </div>

											<div class="container">
												<textarea name="content"></textarea>
											</div>


                                            <div class="save-cancel-btn">
												<button type="button" class="save-changes">Save Changes</button>
												<button type="button" class="cancel">Cancel</button>
                                            </div>

                                            

                                        </div>
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
		<script src="ckeditor/ckeditor.js"></script>
		<script>
			CKEDITOR.replace('content');
		</script>
	</body>
	</html>
	<?php 
}else{
	header("Location: studentlogin.php");
	exit();
}
?>