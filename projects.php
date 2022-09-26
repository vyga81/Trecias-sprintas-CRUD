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

    include 'dbconfig.php';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT people.id, first_name, last_name, Project_ID, projects.project_name FROM people 
            LEFT JOIN projects ON projects.Id = people.Project_ID ";
    $result = mysqli_query($conn, $sql);

    include 'nav.php';
    // require_once 'project_update.php';

    print("<table class='table table-bordered table-striped'>
    <thead>");
    print("<tr><th class='fs-3'>Employee id</th><th class='fs-3'>Employee</th><th class='fs-3'>Project</th></tr>");
    print("</thead>");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            print("<tr><td class='fs-4' >{$row["id"]}</td><td class='fs-4'>" . $row["first_name"] . ' ' . $row["last_name"] . "</td></td><td class='fs-4' >{$row["project_name"]}</td>
            <td>
            <a href='project_update.php?id={$row["id"]}' class='btn btn-success text-light text-decoration-none'>Edit project<a>
            
            </td>
            <td>
             <a href='projects.php?action=delete&Id={$row["Id"]}' class='btn btn-danger text-light text-decoration-none'>Delete project<a>
            </td>
            </tr>");
        }
    } else {
        echo "0 results";
    }
    print("</table>");
    mysqli_close($conn);


    //checking the delete button
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {

        $Id = mysqli_real_escape_string($conn, $_GET["Id"]);

        $query = "DELETE FROM project WHERE Id ='$Id'";
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
</body>

</html>