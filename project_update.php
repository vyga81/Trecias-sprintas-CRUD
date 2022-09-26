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
                        if (isset($_GET['id']['Id'])) {
                            //protecting from mysqli injection
                            $row["id"] = mysqli_real_escape_string($conn, $_GET['id']);
                            $row_project["Id"] = mysqli_real_escape_string($conn, $_GET['Id']);

                            $query = "SELECT * FROM people WHERE id='{$row["id"]}' ";
                            $query_project = "SELECT * FROM projects WHERE Id='{$row_project["Id"]}' ";

                            $query_run = mysqli_query($conn, $query);
                            $query_run_project = mysqli_query($conn, $query_project);

                            if (mysqli_num_rows($query_run) && (mysqli_num_rows($query_run_project))  > 0) {

                                $employee = mysqli_fetch_array($query_run);
                                $project = mysqli_fetch_array($query_run_project);
                        ?>
                                <form action="index.php?id=<?= $row['id']; ?>" method="POST">

                                    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                                    <div class="mb-3">
                                        <label class="fs-3">Employee name</label>
                                        <p value="<?= $employee['first_name'] ?>" class="form-control"></p>
                                    </div>

                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label class="fs-3">Last name</label>
                                            <p type="text" name="last_name" value="<?= $employee['last_name'] ?>" class="form-control"></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fs-3">Project</label>
                                            <input type="text" name="project" value="<?= $project['project'] ?>" class="form-control">
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