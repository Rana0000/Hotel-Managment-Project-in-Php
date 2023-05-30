<?php
require_once "header.php";
mysqli_select_db($conn, $dbname);
$tablesSql = "SHOW TABLES";
$result = mysqli_query($conn, $tablesSql);
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $tableName = $row[0];
        $dropSql = "DROP TABLE $tableName";
        mysqli_query($conn, $dropSql);
        echo "<br>Table $tableName dropped<br>";
    }
}
mysqli_close($conn);
?>
