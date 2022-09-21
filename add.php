<?php
session_start();
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

<body class="bg-warning ">
    <?php include('message.php'); ?>
    <div class="container mt-5">
        <div class="row md-15 ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Add employee
                            <a href="index.php" class="btn btn-danger float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="mb-3">
                                <label class="fs-3">First name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="fs-3">Last name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="add_save" class="btn btn-primary">Save</button>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>