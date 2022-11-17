<?php
include_once 'db_conn.php';
session_start();

if(isset($_GET['id'])){	

	$id = $_GET['id'];
	@mysqli_query($conn,"DELETE FROM `chat_room_messages` WHERE `chat_room_id` =".$id);
    @mysqli_query($conn,"DELETE FROM `chat_room_students` WHERE `chat_room_id` =".$id);
    @mysqli_query($conn,"DELETE FROM `chat_room` WHERE `id` = " . $id);

    echo "<script>alert('Chat Room Deleted Successfully');
        window.location.href='chat.php';</script>";

    /*$msg = "Chat Room deleted Successfully!";
    header("Location: chat.php?msg=$msg"); */	
}
?>