<?php
include 'dbconfig.php';
//

//checking the delete button
if (isset($_GET['action']) && $_GET['action'] === 'delete') {

    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $query = "DELETE FROM people WHERE id ='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Deleted successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Not deleted";
        header("Location: index.php");
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
    <title>Employee&project MANAGER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container bg-warning mt-4">
    <?php
    include 'message.php';


    $sql = "SELECT people.id, first_name, last_name, Project_ID, projects.project_name FROM people 
            LEFT JOIN projects ON projects.Id = people.Project_ID ";
    $result = mysqli_query($conn, $sql);

    include 'nav.php';

    print("<table class='table table-bordered table-striped'>
    <thead>");
    print("<tr><th class='fs-3'>Employee id</th><th class='fs-3'>Employee</th><th class='fs-3'>Project</th></tr>");
    print("</thead>");
    print("<td>
            <a href='add.php' class='btn btn-success text-light text-decoration-none'>Add employee<a>
            
            </td>"

    );
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            print("<tr><td class='fs-4' >{$row["id"]}</td><td class='fs-4'>" . $row["first_name"] . ' ' . $row["last_name"] . "</td><td class='fs-4' >{$row["project_name"]}</td>
            <td>
            <a href='edit.php?id={$row["id"]}' class='btn btn-success text-light text-decoration-none'>Edit employee<a>
            
            </td>
            <td>
             <a href='index.php?action=delete&id={$row["id"]}' class='btn btn-danger text-light text-decoration-none'>Delete<a>
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