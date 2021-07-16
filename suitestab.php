<?php 
include_once 'header.php';
/*
notes to designer:
- fix the design, u can notice whats wrong
*/

if(isset($_GET['suite'])){
    include_once 'room.php';
} else {
?>
         <!---------------------------------slider------------------------------->
    <section id ="slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
    </section>

     <!---------------------------------rooms-------------------------------> 
    <section id ="roomtab">
        <div class="container4">
            <div class="row row-cols-3 row-cols-lg-3">


            <?php
                    $rooms = "SELECT suite_name, suite_short_description, image_name FROM suite_description";
                    $rooms = $conn->query($rooms);
                    while($room = $rooms->fetch_assoc()) {
                ?>
                    <div class="col">
                        <a href="suitestab.php?suite=<?php echo $room['suite_name'] ?>"> <img src="photos/<?php echo $room['image_name'] ?>"></a>
                    </div>
                    <div class="col">
                        <h3><?php echo $room['suite_name'] ?></h3>
                        <p><?php echo $room['suite_short_description'] ?></p>
                    </div>
                    
                <?php
                    }
                ?>
                <div class="col-lg-2" id="availnow">
                    <h3> Room</h3>
                    <p>this is standard</p>
                    <a href="">see latest room offers</a>
                </div>
                <?php include_once 'checkavailability.php'?>

            </div>
        </div>
    </section>


</section>
</body>
</html>    

<?php } ?>