<?php
session_start();
include 'dbconfig.php';

//add new user
if (isset($_POST['add_save'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    echo $first_name;
    echo $last_name;
    $query = "INSERT INTO people (first_name,last_name) VALUES ('$first_name','$last_name')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Employee added successfully";
        header("Location: add.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Employee not added";
        header("Location: add.php");
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container bg-warning">
    <?php



    $sql = "SELECT id, first_name, last_name FROM people";
    $result = mysqli_query($conn, $sql);

    include 'nav.php';

    print("<table class='table table-bordered table-striped'>
    <thead>");
    print("<tr><th class='fs-3'>Id</th><th class='fs-3'>Name</th><th class='fs-3'>Lastname</th></tr>");
    print("</thead>");
    print("<td>
            <a href='add.php' class='btn btn-success text-light text-decoration-none'>Add<a>
            
            </td>"

    );
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "id: " . $row["id"] . " - Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
            print("<tr><td class='fs-4' >{$row["id"]}</td><td class='fs-4'>{$row["first_name"]}</td><td class='fs-4'>{$row["last_name"]}</td>
            <td>
            <a href='edit.php' class='btn btn-success text-light text-decoration-none'>Edit<a>
            
            </td>
            <td>
            <a href='' class='btn btn-danger text-light text-decoration-none'>Delete<a/>
            </td>
            </tr>");
        }
    } else {
        echo "0 results";
    }
    print("</table>");
    mysqli_close($conn);


    ?>
</body>

</html>