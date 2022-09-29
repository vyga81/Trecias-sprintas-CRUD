<?php
$query = "SELECT * FROM projects";

$query_run = mysqli_query($conn, $query);

$projects = mysqli_fetch_all($query_run);
$project = mysqli_real_escape_string($conn, $_POST['project']);



//adding new project
if (isset($_POST['add_save'])) {
    if (!empty($_POST[$project])) {

        

        $query = "INSERT INTO projects  
                 VALUES '$project'";



        //Message to inform user added successfully or not
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['message'] = "Project added successfully";
            header("Location: projects.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Project not added";
            header("Location: projects.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Cannot save empty fields";
        header("Location: project.php");
        exit(0);
    }
}
