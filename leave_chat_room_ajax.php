<?php

include_once 'db_conn.php';
session_start();
$id = $_POST['id'];
$student_id = $_SESSION['id'];

// @mysqli_query($conn,"DELETE FROM `chat_room_students` WHERE `id` = " . $id." AND student_id = ".$student_id);

    $sql = "DELETE FROM `chat_room_students` WHERE `chat_room_id` = " . $id." AND student_id = ".$student_id;

    if (mysqli_query($conn, $sql)) {
    }
    else{
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);

?>