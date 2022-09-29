<?php
require 'dbconfig.php';

$query = "SELECT * FROM projects";

$query_run = mysqli_query($conn, $query);

$projects = mysqli_fetch_all($query_run);

//adding new user
if (isset($_POST['add_project_save'])) {
    // $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    // $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $project = mysqli_real_escape_string($conn, $_POST['add_new_project']);
    // print_r($project);
    $query = "INSERT INTO projects (project_name ) VALUES ('$project')";
    // $query = "INSERT INTO people (first_name, last_name, Project_ID ) VALUES ('$first_name','$last_name', '$project')";
    //adding project
    // if (isset($_POST['add_save'])) {

    //     echo $project;
    //     echo $last_name;
    //     $query = "INSERT INTO people (first_name,last_name) VALUES ('$first_name','$last_name')";


    //Message to inform user added successfully or not
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "New project added successfully";
        header("Location: projects.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Project not saved";
        header("Location: projects.php");
        exit(0);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-info ">
    <?php include('message.php'); ?>
    <div class="container mt-5">
        <div class="row md-15 ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Add new project
                            <a href="projects.php" class="btn btn-info float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="add_project.php" method="POST">
                            <div class="mb-3">
                                <label class="fs-3">Add new project</label>
                                <input type="text" name="add_new_project" class="form-control">
                            </div>
                            <!-- <div class="mb-3">
                                <label class="fs-3">Last name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="mb-3"> -->
                            <!-- <label class="fs-3">Project</label> -->
                            <!-- <select name="project" class="form-control">
                                    <!-- <?php foreach ($projects as $project) : ?> -->
                            <!-- <option value="<?= $project[0] ?>"><?= $project[1] ?></option> -->
                            <!-- <?php endforeach; ?> -->
                            <!-- </select> -->
                            <!-- </div> -->
                            <div class="mb-3">
                                <button type="submit" name="add_project_save" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>