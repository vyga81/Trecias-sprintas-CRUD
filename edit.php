<?php
require 'dbconfig.php';

if (isset($_POST['edit_save'])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $project = mysqli_real_escape_string($conn, $_POST['project']);

    $query = "UPDATE people SET first_name = '{$first_name}', last_name = '{$last_name}', Project_ID = '{$project}' WHERE id = {$id}";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Edited successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = " Not edited";
        header("Location: index.php");
        exit(0);
    }
}
?>'
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-secondary ">
    <?php include('message.php'); ?>
    <div class="container mt-5">
        <div class="row md-15 ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Update employee
                            <a href="index.php" class="btn btn-info float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            //protecting from mysqli injection
                            $row["id"] = mysqli_real_escape_string($conn, $_GET['id']);

                            $query = "SELECT * FROM people WHERE id='{$row["id"]}' ";
                            $query_run = mysqli_query($conn, $query);

                            // include 'update_project.php';

                            if (mysqli_num_rows($query_run) > 0) {
                                $employee = mysqli_fetch_array($query_run);


                                $query_p = "SELECT * FROM projects";

                                $query_run_p = mysqli_query($conn, $query_p);

                                $projects = mysqli_fetch_all($query_run_p);

                        ?>
                                <form action="edit.php?id=<?= $row['id']; ?>" method="POST">
                                    <div class="mb-3">
                                        <label class="fs-3">First name</label>
                                        <input type="text" name="first_name" value="<?= $employee['first_name'] ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="fs-3">Last name</label>
                                        <input type="text" name="last_name" value="<?= $employee['last_name'] ?>" class="form-control">
                                    </div>
                                    <select name="project" class="form-control">
                                        <?php foreach ($projects as $project) : ?>
                                            <option value="<?= $project[0] ?>" <?php echo $employee['Project_ID'] === $project[0] ? 'selected="selected"' : ''; ?>>
                                                <?= $project[1] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="mb-3">
                                        <button type="submit" name="edit_save" class="btn btn-primary">Save</button>
                                    </div>

                                </form>
                        <?php
                            } else {
                                echo "<h4>No id found</h4>";
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