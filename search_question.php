<?php
session_start();
include('db_conn.php');

date_default_timezone_set('Asia/Kuala_Lumpur');

function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<link rel='stylesheet' href='https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css'>
		<!-- 
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
		<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'> -->
		<title>Student Question</title>
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
		</style>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<?php include('header.php'); ?>
		<!-- ############ CONTENT HTML CODE : START ############-->
		<section>
			<div class="container-fluid">
				<div class="row gx-5">
					<div class="col-lg-3"></div>
					<div class="col-lg-5">
						<div class="search">
							<form action="search_question.php" method="post" style="display: inline-flex;width: 100%;">
								<input type="search" name="search" id="search" placeholder="Search.." required>
								<button type="button" data-bs-toggle="modal" data-bs-target="#AskQuestions">Ask Questions</button>
							</form>
						</div>
						<?php
						if (isset($_POST['search'])) {
							$q = $_POST['search'];
							$sql_questions = "SELECT student_questions.*,students.firstname ,students.lastname,students.id as s_id FROM `student_questions` INNER JOIN `students` ON `student_questions`.`student_id` = `students`.`id` WHERE `student_questions`.`question` LIKE '%$q%' OR `student_questions`.`tag` LIKE '%$q%'  ORDER BY `student_questions`.`id` DESC";
						} else {
							$sql_questions = "SELECT student_questions.*,students.firstname ,students.lastname,students.id as s_id FROM `student_questions` INNER JOIN `students` ON `student_questions`.`student_id` = `students`.`id` ORDER BY `student_questions`.`id` DESC";
						}

						$student_id = $_SESSION['id'];

						$result_questions = mysqli_query($conn, $sql_questions);
						$count_questions = mysqli_num_rows($result_questions);

						if ($count_questions > 0) {
							while ($question = mysqli_fetch_array($result_questions)) {
								if ($_SESSION['id'] == $question['student_id'] || $question['status'] == 1) { ?>
									<div class="card bg-card">
										<div class="p-1">
											<div class="bg-white p-4 d-flex justify-content-between">
												<div>
													<h1 class="my-0">Asked by
														<?php
														// Added isAnonymous condition; If "isAnonymous" == 1(hence, true), then print Anonymous.
														// Else, print full name of User.
														if ($question['isAnonymous'] == 1)
															echo '<em>Anonymous</em>';
														else
															echo $question['firstname'] . " " . $question['lastname'];

														?>
														<sup><?php echo time_elapsed_string($question['created_date']); ?></sup>
													</h1>
													<?php
													if ($question['tag'] != '') {
														echo '<ul class="label-badge">';
														$tags = explode(',', $question['tag']);
														foreach ($tags as $key => $value) {
															echo "<li><a href='questions.php?q=" . $value . "' style='color:#000;'>" . $value . "</a></li>";
														}
														echo '</ul>';
													}
													?>
													<h4 class="mb-0"><?php echo $question['question']; ?></h4>
												</div>
												<?php if ($_SESSION['id'] == $question['student_id']) { ?>
													<div class="dropdown tooltips-dropdwon">
														<a class="dropdown-toggle" data-bs-toggle="dropdown">
															<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
																<path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
															</svg>
														</a>
														<ul class="dropdown-menu">
															<?php
															$id = $question['id'];
															if ($question['status']) {
																echo '<li><a href="javascript:void(0);" data-status="0" data-id="' . $id . '" class="hide hide_show_btn">Hide</a></li>';
															} else {
																echo '<li><a href="javascript:void(0);" data-status="1" data-id="' . $id . '" class="hide hide_show_btn">Show</a></li>';
															}
															?>
															<li><a href="javascript:void(0);" data-id="<?php echo $question['id']; ?>" class="delete_question">Delete</a></li>
														</ul>
													</div>
												<?php } ?>
											</div>
										</div>
										<div class="commnet-area">
											<form action="post_answer.php" method="post" style="display: inline-flex;width: 100%;">
												<input type="text" name="answer" placeholder="Your answer" required>
												<input type="hidden" name="id" value="<?php echo $question['id']; ?>" class="form-control">
												<button type="submit" name="submit" class="post" id="post" data-id="<?php echo $question['id']; ?>">Post</button>
											</form>
										</div>

										<?php
										$sql_answers = "SELECT student_answer.*,students.firstname ,students.lastname,students.id as s_id FROM `student_answer` LEFT JOIN `students` ON `student_answer`.`student_id` = `students`.`id` WHERE `student_answer`.`question_id` = " . $question['id'] . "  ORDER BY `student_answer`.`id` DESC";
										$result_answers = mysqli_query($conn, $sql_answers);
										$count_answers = mysqli_num_rows($result_answers);

										if ($count_answers > 0) {
											while ($answer = mysqli_fetch_array($result_answers)) {
										?>
												<div class="p-1">
													<div class="bg-white p-4">
														<h3 class="my-0"><?php echo $answer['firstname'] . ' ' . $answer['lastname']; ?><sub><?php echo time_elapsed_string($answer['created_at']); ?></sub></h3>
														<h5 class="my-0"><?php echo $answer['answer']; ?></h5>
													</div>
												</div>
										<?php }
										}
										?>
									</div>
						<?php }
							}
						}
						?>
					</div>
					<div class="col-lg-3 left-card">
						<div class="card bg-card">
							<div class="p-1">
								<div class="bg-white px-4 py-3">
									<div class="d-flex justify-content-between">
										<h4 class="my-0">Tags</h4>
										<a>edit</a>
									</div>
									<div>
										<?php
										$sql_tags = "SELECT * FROM `student_questions`";
										$result_tags = mysqli_query($conn, $sql_tags);
										$count_tags = mysqli_num_rows($result_tags);

										if ($count_tags > 0) {
											$tag_array = [];
											while ($tag = mysqli_fetch_array($result_tags)) {
												$tags_array = explode(',', $tag['tag']);
												foreach ($tags_array as $key => $value) {
													$tag_array[] = $value;
												}
										?>

										<?php }
											$final_array = array_unique($tag_array);
											echo '<ul class="label-badge">';
											foreach ($final_array as $key => $value) {
												echo "<li><a href='questions.php?q=" . $value . "' style='color:#000;'>" . $value . "</a></li>";
											}
											echo "</ul>";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ############ CONTENT HTML CODE : END ############-->

		<!-- ############ MODAL POPUP HTML CODE : START ############-->
		<div class="modal fade" id="AskQuestions" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<form action="add_question.php" method="post">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="my-0">Ask Questions</h1>
							<a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<svg width="20px" viewBox="0 0 320 512">
									<path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
								</svg>
							</a>
						</div>
						<div class="modal-body">
							<textarea name="question" id="question" rows="5" placeholder="Explain the details of your problem"></textarea>
							<h4>Tags</h4>
							<input type="text" name="tags" value="" data-role="tagsinput" class="form-control" />
							<div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="submit" class="btn-post">Post</button>
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
		<script type="text/javascript">
			$(document).ready(function() {
				$(document).on('click', '.hide_show_btn', function() {
					var id = $(this).data('id');
					var status = $(this).data('status');
					$.ajax({
						type: "post",
						url: "hide_question.php",
						// dataType:'json',
						data: {
							id: id,
							status: status
						},
						success: function(data) {
							if (data) {
								window.location.reload();
							}
						}
					});
				});

				$(document).on('click', '.delete_question', function() {
					var id = $(this).data('id');
					$.ajax({
						type: "post",
						url: "delete_question.php",
						data: {
							id: id,
							status: status
						},
						success: function(data) {
							if (data) {
								window.location.reload();
							}
						}
					});
				});
				$('#search').on("keypress", function(e) {
					if (e.keyCode == 13) {
						$('#search_form').submit();
					}
				});

			});
		</script>
	</body>

	</html>
<?php
} else {
	header("Location: studentlogin.php");
	exit();
}
?>