<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css'>

<style>
    .project-content{
        width: 100%;
        margin-bottom: 15px;
    }

    .project-file{
    width: 100%;
}
</style>

<?php 
    $grpID = $_GET['gr']
?>

<div class="project-content">
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