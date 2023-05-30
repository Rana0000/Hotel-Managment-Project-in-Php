<?php require_once "inc/header.php"; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Create a new database
$sql = "CREATE DATABASE IF NOT EXISTS hotels";
if ($conn->query($sql) === TRUE) {
}

// Close the connection
$conn->close();
?>
<?php
    $database = "hotels";
	$conn = new mysqli($servername, $username, $password, $database);
	$sqlFile = 'database/sql/hotels.sql';
	$sql = file_get_contents($sqlFile);
	if ($conn->multi_query($sql) === TRUE) {
	}
	$conn->close();

  ?>
<!-- END head -->
<section class="site-hero overlay" style="background-image: url(src/images/home.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade-up">
        <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To Garia Hotel Management System</span>
        <h1 class="heading">A Best Place To Reserve</h1>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<div class="align-items-center justify-content-end text-warning"> <p> Welcome ' . $_SESSION['username'] . '</p></div>';
        }
        ?>
      </div>
    </div>
  </div>
  <a class="mouse smoothscroll" href="#next">
    <div class="mouse-icon">
      <span class="mouse-wheel"></span>
    </div>
  </a>
</section>
<!-- END section -->
<section class="section bg-light pb-0">
  <div class="container">
    <div class="row check-availabilty" id="next">
      <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
        <form action="#">
          <div class="row">
            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
              <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
              <div class="field-icon-wrap">
                <div class="icon"><span class="icon-calendar"></span></div>
                <input type="text" id="checkin_date" class="form-control">
              </div>
            </div>
            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
              <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
              <div class="field-icon-wrap">
                <div class="icon"><span class="icon-calendar"></span></div>
                <input type="text" id="checkout_date" class="form-control">
              </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
              <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="adults" class="font-weight-bold text-black">Adults</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="" id="adults" class="form-control">
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                      <option value="">4+</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="children" class="font-weight-bold text-black">Children</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="" id="children" class="form-control">
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                      <option value="">4+</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 align-self-end">
              <button class="btn btn-primary btn-block text-white">Check Availabilty</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
        <figure class="img-absolute">
          <img src="src/images/food-1.jpg" alt="Image" class="img-fluid">
        </figure>
        <img src="src/images/welcome.jpg" alt="Image" class="img-fluid rounded">
      </div>
      <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
        <h2 class="heading">Welcome, <?php if (isset($_SESSION['username'])) {
                                      echo $_SESSION["username"];
                                    } ?>!</h2>
        <p class="mb-4">Step into a world of seamless hotel operations and exceptional guest experiences. With Garia, managing your hotel becomes effortless and efficient. From reservations to check-ins, room availability to guest services, our system empowers you to navigate every aspect of your hotel with ease. Join us on this transformative journey, where excellence in hospitality management awaits. Welcome to Garia Hotel Management System, your gateway to success.</p>
        <p><a href="#" class="btn btn-primary text-white py-2 mr-3" style="margin-left:50px;" >Learn More</a></p>
      </div>
    </div>
  </div>
</section>
<section class="section blog-post-entry bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Hotels</h2>
        <p data-aos="fade-up"> With Garia, managing your hotel becomes effortless and efficient. From reservations to check-ins, room availability to guest services, our system empowers you to navigate every aspect of your hotel with ease.</p>
      </div>
      <div class="row">
        <?php
        require_once "functions/connection.php";
        $selectSql = "SELECT * FROM hotels";
        $result = mysqli_query($conn, $selectSql);
        $numRows = mysqli_num_rows($result);
        $postsPerPage = 6;
        $numPages = ceil($numRows / $postsPerPage);
        if (isset($_GET['page'])) {
          $currentPage = $_GET['page'];
        } else {
          $currentPage = 1;
        }
        $start = ($currentPage - 1) * $postsPerPage;
        $end = $start + $postsPerPage - 1;
        if ($numRows > 0) {
          for ($i = $start; $i <= $end; $i++) {
            if ($i >= $numRows) {
              break;
            }
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_assoc($result);
            $hotelName = $row["hotel_name"];
            $rate = $row["rate"];
            $facilities = $row["facilities"];
            $imageUrl = $row['image_url'];
            $id = $row['id'];
            $colClasses = "col-lg-4 col-md-6 col-sm-6 col-12";
            if ($numRows == 2) {
              $colClasses = "col-lg-6 col-md-6 col-sm-6 col-12";
            } elseif ($numRows == 1) {
              $colClasses = "col-lg-12 col-md-12 col-sm-12 col-12";
            }
        ?>
            <div class="<?= $colClasses ?> post mb-5" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
              <div class="media media-custom d-block mb-4 h-100">
                <a href="hotels.php?id=<?= $id ?>" class="mb-4 d-block"><img src="<?= $imageUrl ?>" alt="hotel image" class="img-fluid"></a>
                <div class="media-body">
                  <span class="meta-post"><?= $hotelName ?></span>
                  <h2 class="mt-0 mb-3"><a href="#"><?= $rate ?> <span class="fa fa-star text-primary"></span></a></h2>
                  <p><?= $facilities ?></p>
                  <p><a href="hotels.php?id=<?= $id ?>">More Details</a></p>
                </div>
              </div>
            </div>
        <?php
          }
        } else {
          echo "No Hotels found";
        }
        ?>
      </div>
      <div class="row" data-aos="fade">
        <div class="col-12">
          <div class="custom-pagination">
            <ul class="list-unstyled">
              <?php
              $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
              $numPagesToShow = 5; 
              $startPage = max($currentPage - floor($numPagesToShow / 2), 1);
              $endPage = min($startPage + $numPagesToShow - 1, $numPages);
              if ($endPage - $startPage + 1 < $numPagesToShow) {
                $startPage = max($endPage - $numPagesToShow + 1, 1);
              }
              if ($currentPage > 1) {
                echo '<li><a href="?page=1"><span>&laquo;</span></a></li>';
              }
              if ($startPage > 1) {
                echo '<li><span>...</span></li>';
              }
              for ($page = $startPage; $page <= $endPage; $page++) {
                echo '<li';
                if ($page == $currentPage) {
                  echo ' class="active"';
                }
                echo '><a href="?page=' . $page . '">' . $page . '</a></li>';
              }
              if ($endPage < $numPages) {
                echo '<li><span>...</span></li>';
              }
              if ($currentPage < $numPages) {
                echo '<li><a href="?page=' . $numPages . '"><span>&raquo;</span></a></li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section slider-section bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Photos from Hotels</h2>
        <p data-aos="fade-up" data-aos-delay="100">With Garia, managing your hotel becomes effortless and efficient. From reservations to check-ins, room availability to guest services, our system empowers you to navigate every aspect of your hotel with ease.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
          <?php
          $selectSql = "SELECT * FROM hotels";
          $result = mysqli_query($conn, $selectSql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $imagePath = $row['image_url'];
          ?>
              <div class="slider-item">
                <a href="<?= $imagePath ?>" data-fancybox="images" data-caption="<?= $caption ?>"><img src="<?= $imagePath ?>" alt="Image placeholder" class="img-fluid"></a>
              </div>
          <?php
            }
          }
          ?>
        </div>
        <!-- END slider -->
      </div>
    </div>
  </div>
</section>
<!-- END section -->
<section class="section testimonial-section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">People Says</h2>
      </div>
    </div>
    <div class="row">
      <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; Jean Smith</em></p>
        </div>
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; John Doe</em></p>
        </div>
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; John Doe</em></p>
        </div>
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; Jean Smith</em></p>
        </div>
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; John Doe</em></p>
        </div>
        <div class="testimonial text-center slider-item">
          <div class="author-image mb-3">
            <img src="src/images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
          </div>
          <blockquote>
            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
          </blockquote>
          <p><em>&mdash; John Doe</em></p>
        </div>
      </div>
      <!-- END slider -->
    </div>
  </div>
</section>
<footer class="section footer-section">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-3 mb-5">
        <ul class="list-unstyled link">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Terms &amp; Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-5">
        <ul class="list-unstyled link">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-5 pr-md-5 contact-info">
        <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> Kolkata, Garia</span></p>
        <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+994) 55 555 55 55</span></p>
        <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> garia@domain.com</span></p>
      </div>
      <div class="col-md-3 mb-5">
        <p>Sign up for our newsletter</p>
        <form action="#" class="footer-newsletter">
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email...">
            <button type="submit" class="btn"><span class="fa fa-paper-plane"></span></button>
          </div>
        </form>
      </div>
    </div>
    <div class="row pt-5">
      <p class="col-md-6 text-right social" style="margin-left: 520px;">
        <a href="#"><span class="fa fa-tripadvisor"></span></a>
        <a href="#"><span class="fa fa-facebook"></span></a>
        <a href="#"><span class="fa fa-twitter"></span></a>
        <a href="#"><span class="fa fa-linkedin"></span></a>
        <a href="#"><span class="fa fa-vimeo"></span></a>
      </p>
    </div>
  </div>
</footer>
<?php include 'inc/footer.php'; ?>