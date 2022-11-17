<?php
include_once 'db_conn.php';
session_start();

$id = $_POST['id'];

// var_dump($_POST);
// var_dump($_FILES);

$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];


$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));

if ($fileError === 0) {
    if ($fileSize < 5000000) {
        if (!is_dir('uploads/message/' . $id)) mkdir('uploads/message/' . $id, 0777, true);
        $fileDestination = 'uploads/message/' . $id . '/' . $fileName;
        if (file_exists($fileDestination)) {
            echo "File exists! Please try again.";
            exit();
        }
        move_uploaded_file($fileTmpName, $fileDestination);

        $sql = "INSERT INTO `chat_room_messages` (`chat_room_id`, `student_id`, `message`, `message_type`) VALUES ('" . $id . "', '" . $_SESSION['id'] . "','" . $fileName . "','" . explode('/',$fileType)[0] . "');";
        // echo $sql;
        mysqli_query($conn, $sql);
        echo 'Success';
    } else {
        echo "File too big! Please try again.";
        exit();
    }
} else {
    echo "There was an error uploading file! Please try again.";
    exit();
}
?>
