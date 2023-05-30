<?php

require_once "header.php";
require_once "../config/config.php";
error_reporting(0);

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sqlFile = 'sql/hotels.sql';
$sql = file_get_contents($sqlFile);

$statements = explode(';', $sql);

$tables = [];

foreach ($statements as $statement) {
    if (preg_match('/CREATE TABLE `([^`]+)`/i', $statement, $matches)) {
        $tableName = $matches[1];
        $tables[] = $tableName;

        $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
        $checkTableResult = mysqli_query($conn, $checkTableQuery);

        if (mysqli_num_rows($checkTableResult) > 0) {
            echo "<br>Table '$tableName' already exists.<br>";
            continue;
        }
    }

    if (!empty($statement)) {
        if ($conn->query($statement) === TRUE) {
        } else {
            echo "<br>Error executing SQL statement: " . $conn->error;
        }
    }
}

if (!empty($tables)) {
    echo "<br>The following tables were created: <br>";
    foreach ($tables as $table) {
        echo $table . "<br>";
    }
} else {
    echo "<br>No tables were created in the SQL file.";
}

$conn->close();

?>
