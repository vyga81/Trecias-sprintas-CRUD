<?php
include 'dbconfig.php';



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//checking the delete button
if (isset($_GET['action']) && $_GET['action'] === 'delete') {

    $Id = mysqli_real_escape_string($conn, $_GET["Id"]);

    $query = "DELETE FROM projects WHERE Id ='$Id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Deleted successfully";
        header("Location: projects.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Not deleted";
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
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container bg-info">
    <?php

    $sql = "SELECT pr.id as id, pr.project_name as project_name, pe.first_name as first_name, pe.last_name as last_name, pe.id as people_id FROM projects pr LEFT JOIN people pe ON pr.id = pe.project_id";
    $result = mysqli_query($conn, $sql);
    //SELECT projects.project_name, projects.Id AS project_id, people.first_name, people.last_name, people.id FROM projects
    //INNER JOIN people ON people.Project_ID = projects.Id


    include 'nav.php';
    // require_once 'project_update.php';

    print("<table class='table table-bordered table-striped'>
    <thead>");
    print("<td>
            <a href='add_project.php' class='btn btn-success text-light text-decoration-none'>Add project<a>
            </td>");
    print("<tr><th class='fs-3'>Project id</th><th class='fs-3'>Employee</th><th class='fs-3'>Project</th></tr>");
    print("</thead>");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // $sql = "SELECT * FROM people WHERE Project_ID = " . $row['id'];
            // $res = mysqli_query($conn, $sql);
            // $employee = mysqli_fetch_row($res);

            // $name = '';
            // if (isset($employee[1]) and isset($employee[2]))
            //     $name = $employee[1] . ' ' . $employee[2];

            $name = $row["first_name"] . ' ' . $row["last_name"];

            print("<tr>
            <td class='fs-4' >{$row["id"]}</td>
            <td class='fs-4' >{$name}</td>
            <td class='fs-4' >{$row["project_name"]}</td>
            <td>
            <a href='project_update.php?id={$row["people_id"]}' class='btn btn-success text-light text-decoration-none'>Edit project<a>
            
            </td>
            <td>
             <a href='?action=delete&Id={$row["people_id"]}' class='btn btn-danger text-light text-decoration-none'>Delete project<a>
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