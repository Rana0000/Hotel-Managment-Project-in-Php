<?php
session_start();
if (isset($_SESSION['username'])) {
	header("Location: ../index.php");
	die;
}
require_once "../config/config.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$conpassword = $_POST['conpassword'];
	if (!empty($username) && !empty($password) && !empty($conpassword) && !is_numeric($username)) {
		if ($password != $conpassword) {
			echo "<div class='alert alert-danger'>Passwords do not match</div>";
		} else {
			$checkQuery = "SELECT * FROM users WHERE username = '$username'";
			$result = mysqli_query($conn, $checkQuery);
			if (mysqli_num_rows($result) > 0) {
				echo "<div class='alert alert-danger'>This username already exists</div>";
				mysqli_close($conn);
			} else {
				$password = md5($password);
				$query = "insert into users (username,password) values ('$username','$password')";
				mysqli_query($conn, $query);
				header("Location: login.php");
				die;
			}
		}
	} else {
		echo "<div class='alert alert-danger'>Please fill in all fields</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hotel Management System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
	<link rel="stylesheet" href="../src/css/bootstrap.min.css">
	<link rel="stylesheet" href="../src/css/animate.css">
	<link rel="stylesheet" href="../src/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../src/css/aos.css">
	<link rel="stylesheet" href="../src/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="../src/css/jquery.timepicker.css">
	<link rel="stylesheet" href="../src/css/fancybox.min.css">
	<link rel="stylesheet" href="../src/fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../src/fonts/fontawesome/css/font-awesome.min.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="../src/css/style.css">
	<style>
		body{
			background-image: url("../src/images/r.jpg");
		}
</style>
</head>
<body>
	<section class="section contact-section" id="next" >
		<div class="container" style="background-color:transparent">
			<div class="row" style="margin-left:280px;">
				<div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
					<form action="#" method="post" class="p-md-5 p-4 mb-5 " style="width: 600px; height: 400px;">
						<div class="row">
							<div class="col-md-12 form-group">
								<label class="text-black font-weight-bold" for="username">Username</label>
								<input type="username" id="username" name="username" class="form-control " >
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label class="text-black font-weight-bold" for="password">Password</label>
								<input type="password" id="password" name="password" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label class="text-black font-weight-bold" for="confirm">Repeat Password</label>
								<input type="password" id="confirm" name="conpassword" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<input type="submit" value="Submit" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="../src/js/jquery-3.3.1.min.js"></script>
	<script src="../src/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../src/js/popper.min.js"></script>
	<script src="../src/js/bootstrap.min.js"></script>
	<script src="../src/js/owl.carousel.min.js"></script>
	<script src="../src/js/jquery.stellar.min.js"></script>
	<script src="../src/js/jquery.fancybox.min.js"></script>
	<script src="../src/js/aos.js"></script>
	<script src="../src/js/bootstrap-datepicker.js"></script>
	<script src="../src/js/jquery.timepicker.min.js"></script>
	<script src="../src/js/main.js"></script>
</body>
</html>