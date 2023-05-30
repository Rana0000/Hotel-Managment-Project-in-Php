<?php
require_once "../config/config.php";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SHOW DATABASES");
$existingDBs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $existingDBs[] = $row['Database'];
}
if (!in_array($dbname, $existingDBs)) {
    $sql = "CREATE DATABASE $dbname";
    if (mysqli_query($conn, $sql)) {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "New database created successfully! - $dbname <hr>";
    } else {
        die("Error creating database: " . mysqli_error($conn));
    }
} else {
    echo "Database Name - $dbname <hr>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Database</title>
</head>
<body>
    <a href="index.php">Tables</a>
    &nbsp;&nbsp;&nbsp;
    <a href="clearDB.php">Clear Database</a>
    &nbsp;&nbsp;&nbsp;
    <a href="migration.php">Import Data</a>
</body>
</html>