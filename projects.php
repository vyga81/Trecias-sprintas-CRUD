<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    $sql = "SELECT id, first_name, last_name FROM people";
    $result = mysqli_query($conn, $sql);
    include 'nav.php';
    print("<table class='table'>
    <thead>");
    print("<tr><th class='fs-3'>Id</th><th class='fs-3'>Name</th><th class='fs-3'>Lastname</th></tr>");
    print("</thead>");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "id: " . $row["id"] . " - Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
            print("<tr><td class='fs-4'>{$row["id"]}</td><td class='fs-4'>{$row["first_name"]}</td><td class='fs-4'>{$row["last_name"]}</td></tr>");
        }
    } else {
        echo "0 results";
    }
    print("</table>");
    mysqli_close($conn);
    ?>
</body>

</html>