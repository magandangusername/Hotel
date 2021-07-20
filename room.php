<?php
try {
if(isset($_GET['room'])) {
    $room_name = $_GET['room'];
    $room_info = "SELECT 
    rd.room_name,
    rd.room_short_description,
    rd.room_long_description,
    am.a1,
    am.a2,
    am.a3,
    am.a4,
    am.a5,
    am.a6,
    am.a7,
    am.a8,
    am.a9,
    am.a10
    FROM room_description rd
    INNER JOIN amenities am
    ON rd.amenities_number = am.amenities_number
    WHERE 
    rd.room_name = '$room_name'";
}
if(isset($_GET['suite'])) {
    $room_name = $_GET['suite'];
    $room_info = "SELECT 
    sd.suite_name,
    sd.suite_short_description,
    sd.suite_long_description,
    am.a1,
    am.a2,
    am.a3,
    am.a4,
    am.a5,
    am.a6,
    am.a7,
    am.a8,
    am.a9,
    am.a10
    FROM suite_description sd
    INNER JOIN amenities am
    ON sd.amenities_number = am.amenities_number
    WHERE 
    sd.suite_name = '$room_name'";
}

$room_info = $conn->query($room_info);
$room_info = $room_info->fetch_row();
if ($room_info) {
    $short_descripton = $room_info[1];
    $long_descripton = $room_info[2];
    $a1 = $room_info[3];
    $a2 = $room_info[4];
    $a3 = $room_info[5];
    $a4 = $room_info[6];
    $a5 = $room_info[7];
    $a6 = $room_info[8];
    $a7 = $room_info[9];
    $a8 = $room_info[10];
    $a9 = $room_info[11];
    $a10 = $room_info[12];
} else {
    $room_name = 
    $short_descripton = 
    $long_descripton = 
    $a1 = 
    $a2 = 
    $a3 = 
    $a4 = 
    $a5 = 
    $a6 = 
    $a7 = 
    $a8 = 
    $a9 = 
    $a10 = 'ERROR: Room not found. Please try again later.';
}


?>
        <section id ="standroomtitle">
            <div class="containersdeluxe">
                <div class="titless">
                    <a href="roomtab.php"  input type="button"  id="backmod" class="btn btn-primary"> Back </a>
                    <h1 class="standardtitle" id ="gitna"><?php echo $room_name ?></h1>
              </div>
            </div>  
        </section>


         <!---------------------------------slider------------------------------->
    <section id ="slider">
        <div class ="col-lg-11 mx-auto d-block"> 
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
           
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="photos/deluxee1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="photos/deluxee2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="photos/deluxee3.jpg" class="d-block w-100" alt="...">
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
    
    <!---------------------------------description------------------------------->

    <section id ="roomtab">
        <div class="container4">
            <div class="row row-cols-2 row-cols-lg-2">

                <div class="col-md-6" id="standstand">
                    <h3 class="standesc">Description</h3>
                    <p class="standesc"><?php echo $short_descripton ?></p>
                    <h3 class="stanAmenities">Details & Amenities</h3>
                    <p class="standesc"><?php echo $long_descripton ?></p>
                    <?php
                        if($a1 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a1 ?></p>
                    <?php } ?>

                    <?php
                        if($a2 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a2 ?></p>
                    <?php } ?>

                    <?php
                        if($a3 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a3 ?></p>
                    <?php } ?>

                    <?php
                        if($a4 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a4 ?></p>
                    <?php } ?>

                    <?php
                        if($a5 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a5 ?></p>
                    <?php } ?>

                    <?php
                        if($a6 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a6 ?></p>
                    <?php } ?>

                    <?php
                        if($a7 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a7 ?></p>
                    <?php } ?>

                    <?php
                        if($a8 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a8 ?></p>
                    <?php } ?>

                    <?php
                        if($a9 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a9 ?></p>
                    <?php } ?>

                    <?php
                        if($a10 != '') {
                    ?>
                        <p class="standesc">&bull; <?php echo $a10 ?></p>
                    <?php } ?>

                </div>


                <?php include_once 'checkavailability.php';?>
            </div>
        </div>            
    </section>    

</section>
<?php
} catch (Exception $e) { ?>

    <h6>AN ERROR OCCURED TRYING TO GET INFORMATION. PLEASE TRY AGAIN LATER.</h6>

<?php
echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
</body>
</html>
