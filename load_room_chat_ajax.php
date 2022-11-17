<?php
include_once 'db_conn.php';
session_start();
$id = $_POST['id'];
$student_id = $_SESSION['id'];
$name = $_POST['name'];

$sql = "SELECT `chat_room_messages`.*,`students`.`firstname`,`students`.`lastname` ,`students`.`middlename`
		FROM `chat_room_messages`
		-- LEFT JOIN `chat_room_students` ON `chat_room_messages`.`chat_room_id` = `chat_room_students`.`chat_room_id`
		LEFT JOIN `chat_room` ON `chat_room_messages`.`chat_room_id` = `chat_room`.`id`
		LEFT JOIN `students` ON `chat_room_messages`.`student_id` = `students`.`id`
		WHERE `chat_room_messages`.`chat_room_id` ='$id'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$html = '';

// <div class="col-md-6 text-right">
// 	<button class="btn btn-primary leave" data-room="'.$id.'" data-id="'.$id.'" type="button" style="margin-top:20px;">Leave Room</button>
// </div>
$html .= '<div class="row" style="background: #c7d6bf;color: #39493e;">
	        <div class="col-md-6">
	            <h3 class="text chat_screen_title" style="padding: 10px;">' . $name . '</h3>
	        </div>
	        <div class="col-md-6 text-right">
                <button class="btn btn-primary lobby" style="margin-top:20px;">LOBBY</button>
            </div>

	    </div>
	    <div class="row" style="background:#f7f6f2">
	        <div class="col-md-12">
	        	<div class="messages" style="height: 400px;overflow-x: scroll;">';
while ($inner_row = mysqli_fetch_array($result)) {
	$html .= '<div class="student_name input-group">
	        					<h5>' . $inner_row['firstname'] . ' ' . $inner_row['middlename'] . ' ' . $inner_row['lastname'] . '</h5>
	        					<span class="date">' . date('M d, Y h:i A', strtotime($inner_row['created_at'])) . '</span>
        					</div>';

	switch ($inner_row['message_type']) {
		case 'message':
			$html .= '<div class="student_message">' . $inner_row['message'] . '</div>';
			break;
		case 'image':
			$html .= '<div class="student_message"><img src="uploads/message/' . $inner_row['chat_room_id'] . '/' . $inner_row['message'] . '"/></div>';
			break;
		case 'video':
			$html .= '<div class="student_message"><video src="uploads/message/' . $inner_row['chat_room_id'] . '/' . $inner_row['message'] . '" controls/></div>';
			break;
		default:
			$html .= '<div class="student_message">
				<p><button onclick="window.open(\'uploads/message/' . $inner_row['chat_room_id'] . '/' . $inner_row['message'].'\',\'_blank\')" style="margin-right: 20px;">Open File</button>'.
				$inner_row['message'] . '</p></div>';
	}
}
$html .= '</div>
	        </div>
	        <div class="col-md-12" style="background: #ebebeb;padding: 10px;">
	        	<div class="input-group">
				   <input type="text" name="message" class="form-control message" style="border: none;">
				   <input type="hidden" class="chat_room_id" value="' . $id . '"/>
				   <span class="input-group-btn">
				        <button class="btn btn-default sendFile" type="button" style="border:none;background: transparent;"><img src="file.png" width="24"/></button>
						<input type="file" id="file_upload_input" style="display:none;">
				   </span>
				   <span class="input-group-btn">
				        <button class="btn btn-default sendMessage" type="button" style="border:none;background: transparent;"><img src="send.png" width="24"/></button>
				   </span>
				</div>

	        </div>
	    </div>';
echo $html;
exit;



?>

<!-- Evan: 📎💿 <- signifies message is a photo/file media -->