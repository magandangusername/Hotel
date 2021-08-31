<?php
include_once('header.php');

?>

<!--------------------------------slider------------------------------->
<section id="slider">
    <div class="col-lg-11 mx-auto d-block">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="photos/place1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="photos/place2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="photos/place4.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="photos/place5.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!---------------------------------availability------------------------------->
<?php include_once 'checkavailability.php' ?>
<div class="containers">
    <div class="col-md">
        <p class="location"> <a href="#">Justin Street, Brngy Anemo, Makati Avenue, Jean Kazama City 1299, Philippines. </a> <i class="fas fa-map-pin"></i></p>
        <p class="num">+63819272869</p>
    </div>
</div>
<!-----About------>
<section id="about">
    <div class="container text-center">
        <h1 class="hotelname"> Mondstadt Hotel</h1>
        <div class="row text-center">
            <p class="desc">A one of a kind experience in hotel service and rooms. Mondstadt hotel has been serving travelers and such since 1990, with over 3 awards and a billion satisfied customers we guarantee and premium service like no other hotels can offer.</p>
        </div>
    </div>
</section>

<!-----service------>
<section id="service">
    <div class="container1">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/experiences.png" alt="">
                    <div class="card-text">
                        <h4>Luxurious Experience</h4>
                        <h6>A level of experience like no other</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/service.jpg" alt="">
                    <div class="card-text">
                        <h4>Top Notch Service</h4>
                        <h6>A level of service like no other</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/maintains.png" alt="">
                    <div class="card-text">
                        <h4>Well-Maintained </h>
                            <h6>A Well-Maintained place like no other</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-----roomandsuites------>
<section id="roomandsuites">
    <div class="container2">
        <div class="title">
            <h1 class="roomites">Room and Suites</h1>
        </div>

        <div class="row">
            <?php
            $roomtype = "SELECT DISTINCT room_suite_name FROM room_status LIMIT 3";
            $roomtype = $conn->query($roomtype);

            while ($result = $roomtype->fetch_assoc()) {
                $type = $result['room_suite_name'];
                $base_price = "SELECT room_short_description, image_name, bed_type FROM room_description WHERE room_name LIKE '%$type%'";

                $base_price = $conn->query($base_price);
                $base_price = $base_price->fetch_row();

                $bed_type = '';


                if ($base_price) {
                    $file_name = $base_price[1];
                    $short_desc = $base_price[0];
                    $bed_type = $base_price[2];
                } else {
                    $base_price = "SELECT suite_short_description, image_name, bed_type FROM suite_description WHERE suite_name LIKE '%$type%'";

                    $base_price = $conn->query($base_price);
                    $base_price = $base_price->fetch_row();
                    $file_name = $base_price[1];
                    $short_desc = $base_price[0];
                    $bed_type = $base_price[2];
                }

                $k = 'K';
                $q = 'Q';
                $kq = 'King Bed';
                $beds = '';
                if (preg_match("/{$k}/i", $bed_type)) {
                    $beds = $beds . 'King Bed';
                }

                if (preg_match("/{$q}/i", $bed_type)) {
                    if (preg_match("/{$kq}/i", $beds)) {
                        $beds = $beds . ', ';
                    }
                    $beds = $beds . 'Queen Bed';
                }

            ?>
                <div class="col-md-3 ">
                    <a href="<?php
                                $rooms = "SELECT room_name FROM room_description WHERE room_name ='" . $result['room_suite_name'] . "'";
                                $rooms = $conn->query($rooms);
                                $rooms = $rooms->fetch_row();
                                if ($rooms) {
                                    echo "roomtab.php?room=" . $rooms[0];
                                } else {
                                    echo "suitestab.php?suite=" . $result['room_suite_name'];
                                }
                                ?>" class="text-decoration-none link-dark">
                        <div class="card text-center">
                            <img src="photos/<?php echo $file_name ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $result['room_suite_name'] ?></h5>
                                <p class="card-text"><?php echo $beds ?></p>
                                <p class="card-texts"><?php echo $short_desc ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="col text-center">
                <a href="roomtab.php" input type="button" id="seeall" class="btn btn-outline-info justify-content-center">See All Rooms & Suites</a>
            </div>
        </div>
    </div>
</section>

<!-----special offer------>
<section id="roomandsuites">
    <div class="container3">
        <div class="title">
            <h1 class="special">Special Offers</h1>
        </div>

        <div class="row">
            <?php
            $date = date("Y-m-d h:i:sa");
            $promos = "SELECT * FROM promotion_description WHERE promotion_start <= '$date' AND promotion_end >= '$date' LIMIT 3";
            $promos = $conn->query($promos);

            $rows = 0;

            while ($promo = $promos->fetch_assoc()) {
            ?>
                <div class="col-md-3 ">
                    <a href="promo.php?promo=<?php echo $promo['promotion_name'] ?>" class="text-decoration-none link-dark">
                        <div class="card text-center">
                            <img src="photos/<?php echo $promo['image_name'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $promo['promotion_name'] ?></h5>
                                <p class="card-texts"><?php echo $promo['promotion_short_description'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>

            <?php } ?>
            <div class="col text-center">
                <a href="promo.php" input type="button" id="seeall" class="btn btn-outline-info justify-content-center">See All Special Offers</a>
            </div>
        </div>
    </div>
</section>



</body>

</html>