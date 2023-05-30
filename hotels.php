<?php
require_once "functions/connection.php";
?>

<div><a href="index.php">Back</a></div>

<?php
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];
    $selectSql = "SELECT * FROM hotels WHERE id = $hotelId";
} else {
    $selectSql = "SELECT * FROM hotels";
}

$result = mysqli_query($conn, $selectSql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hotelName = $row["hotel_name"];
        $rate = $row["rate"];
        $facilities = $row["facilities"];
        $moreDetails = $row["more_details"];
        $imageUrl = $row['image_url'];
?>
<style>
body{
    font-family: "Playfair Display", times, serif;
}
.container{
    background-color: rgb(240, 209, 162) !important;
    border-radius: 10px;
    padding-top: 80px;
    padding-bottom: 115px;
}

div a{
    display: block;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    background-color: rgb(199, 120, 29);
    color: #fff;
    border-radius: 10px;
    font-size: 20px;
    margin: 10px 0 30px 0;
}

img{
    width: 40%;
    height: auto;
    border: 1px solid rgb(199, 120, 29);
    display: inline-block;
    margin: 0 30px;
}
.card-body{
    width: 50%;
    display: inline-block;
}

h5{
    font-size: 20px;
    color: rgb(199, 120, 29);
}

.card-text{
    font-size: 17px;
    font-weight: 700;
    color: rgb(199, 120, 29);
}
</style>
        <div class="card mb-3">
            <img style="max-width: 300px;" src="<?php echo $imageUrl; ?>" class="card-img-top" alt="hotel image">
            <div class="card-body">
                <h5 class="card-title"><?php echo $hotelName; ?></h5>
                <p class="card-text" >Rate: <?php echo $rate; ?> </p>
                <p class="card-text">Facilities: <?php echo $facilities; ?></p>
                <p class="card-text">More Details: <?php echo $moreDetails; ?></p>
            </div>
        </div><br><br><br>
<?php
    }
} else {
    echo "No hotels found";
}

mysqli_close($conn);

?>