<?php
session_start();
require 'dbconfig.php';
?>'
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-secondary ">
    <?php include('message.php'); ?>
    <div class="container mt-5">
        <div class="row md-15 ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Update project
                            <a href="index.php" class="btn btn-info float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        //var_dump($_GET['id'] . $_GET['Id']);
                        if (isset($_GET['id'])) {
                            //protecting from mysqli injection
                            // $person_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $project_id = mysqli_real_escape_string($conn, $_GET['id']);

                            $query = "SELECT * FROM people WHERE Project_Id='{$project_id}' ";
                            $query_project = "SELECT * FROM projects WHERE Id='{$project_id}' ";

                            $query_run = mysqli_query($conn, $query);
                            $query_run_project = mysqli_query($conn, $query_project);

                            if (mysqli_num_rows($query_run_project) && (mysqli_num_rows($query_run_project))  > 0) {

                                $employee = mysqli_fetch_array($query_run);
                                $project = mysqli_fetch_array($query_run_project);
                        ?>
                                <form action="index.php?id=<?= $project_id; ?>" method="POST">

                                    <input type="hidden" name="id" value="<?= $project_id; ?>">
                                    <div class="mb-3">
                                        <label class="fs-3">Employee name</label>
                                        <p class="form-control"><?= $employee['first_name'] ?></p>
                                    </div>

                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label class="fs-3">Last name</label>
                                            <p type="text" name="last_name" class="form-control"><?= $employee['last_name'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fs-3">Project</label>
                                            <input type="text" name="project" value="<?= $project['project_name'] ?>" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" name="update_project" class="btn btn-primary">Update project</button>
                                        </div>

                                    </form>
                            <?php
                            } else {
                                echo "<h4>No project  found</h4>";
                            }
                        }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>