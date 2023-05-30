<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    die;
}
require_once "../config/config.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$maxFileSize = 8388608; //(8 MB)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contentLength = (int)$_SERVER['CONTENT_LENGTH'];
    if ($contentLength > $maxFileSize) {
        echo "The file size exceeds the maximum allowed limit.";
        exit;
    }
    $hotelName = $_POST["hotel_name"];
    $address = $_POST["address"];
    $facilities = $_POST["facilities"];
    $rate = $_POST["rate"];
    $moreDetails = $_POST["more_details"];
    $targetFile = 'null';
    if (isset($_FILES['hotel_images']) && $_FILES['hotel_images']['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../src/images/hotel_images/'; // The folder where the images will be saved
        $tempFile = $_FILES['hotel_images']['tmp_name'];
        $fileSize = $_FILES['hotel_images']['size'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($fileSize > $maxFileSize) {
            echo "File size cannot be larger than 5MB.";
            exit;
        }
        $fileName = uniqid() . '_' . $_FILES['hotel_images']['name'];
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($tempFile, $targetFile)) {
            echo "Image uploaded successfully.";
            $targetFile = 'src/images/hotel_images/' . $fileName;
            $insertSql = "INSERT INTO hotels (hotel_name, address, facilities, rate, more_details, image_url)
            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($stmt, "ssssss", $hotelName, $address, $facilities, $rate, $moreDetails, $targetFile);
            if (mysqli_stmt_execute($stmt)) {
                echo "Data added.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error loading image.";
        }
    } else {
        echo "Invalid image file.";
    }
}
mysqli_close($conn);
require_once "inc/header.php";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <link rel="stylesheet" type="text/css" href="add_hotel_style.css">
    <script src="add_hotel.js" type="text/javascript"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST" action="add_hotel.php" enctype="multipart/form-data">
        <label for="hotel_images">Hotel Image:</label>
        <input type="file" id="hotel_images" name="hotel_images" accept="image/*">
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <label for="facilities">Room Facilities:</label>
        <input type="text" id="facilities" name="facilities" required>
        <label for="rate">Rate:</label>
        <select name="rate" id="rate" required>
            <option disabled selected value="">Select a rate</option>
            <option value="1">1 star</option>
            <option value="2">2 stars</option>
            <option value="3">3 stars</option>
            <option value="4">4 stars</option>
            <option value="5">5 stars</option>
        </select>
        <label for="more_details">More Details:</label>
        <textarea id="more_details" name="more_details"></textarea>
        <input type="submit" value="Add Hotel">
    </form>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.querySelector('select[name="rate"]');
            selectElement.addEventListener('click', function() {
                this.options[0].style.display = 'none';
            });
        });
    </script>
</body>
</html>