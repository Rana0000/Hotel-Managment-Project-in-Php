<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Management Sytem</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
  <link rel="stylesheet" href="src/css/bootstrap.min.css">
  <link rel="stylesheet" href="src/css/animate.css">
  <link rel="stylesheet" href="src/css/owl.carousel.min.css">
  <link rel="stylesheet" href="src/css/aos.css">
  <link rel="stylesheet" href="src/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="src/css/jquery.timepicker.css">
  <link rel="stylesheet" href="src/css/fancybox.min.css">
  <link rel="stylesheet" href="src/fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="src/fonts/fontawesome/css/font-awesome.min.css">
  <!-- Theme Style -->
  <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
  <header class="site-header js-site-header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.php">Garia</a></div>
        <div class="col-6 col-lg-8">
          <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="site-navbar js-site-navbar">
            <nav role="navigation">
              <div class="container">
                <div class="row full-height align-items-center">
                  <div class="col-md-6 mx-auto">
                    <ul class="list-unstyled menu">
                      <li class="active"><a href="index.php">Home</a></li>
                      <li><a href="contact.php">Contact</a></li>
                      <?php
                      if (isset($_SESSION['username'])) {
                        echo '<li><a href="admin/add_hotel.php">Add Hotel</a></li>';
                      }
                      if (isset($_SESSION['username'])) {
                        echo '<li><a href="auth/logout.php">Logout</a></li>';
                      } else {
                        echo '<li><a href="auth/login.php">Login</a></li>';
                        echo '<li><a href="auth/register.php">Register</a></li>';
                      }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>