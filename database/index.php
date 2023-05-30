<?php
require_once "header.php";

require_once "../config/config.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tablesSql = "SHOW TABLES";
$tablesResult = mysqli_query($conn, $tablesSql);

if ($tablesResult) {
    while ($tableRow = mysqli_fetch_array($tablesResult)) {
        $tableName = $tableRow[0];

        echo "<h3>Table: $tableName</h3>";

        $contentSql = "SELECT * FROM $tableName";
        $contentResult = mysqli_query($conn, $contentSql);

        if ($contentResult && mysqli_num_rows($contentResult) > 0) {
            echo "<table><tr>";
            $fieldInfo = mysqli_fetch_fields($contentResult);
            foreach ($fieldInfo as $field) {
                echo "<th>{$field->name}</th>";
            }
            echo "</tr>";

            while ($contentRow = mysqli_fetch_array($contentResult)) {
                echo "<tr>";
                foreach ($fieldInfo as $field) {
                    $fieldName = $field->name;
                    echo "<td>{$contentRow[$fieldName]}</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No data found in the table.";
        }
    }
} else {
    echo "No tables found in the database.";
}
mysqli_close($conn);