<?php 
include_once 'header.php';
?>
<section id ="all">
    <!-----------availability----------->

    <section id ="availabilityrese">
        <div class="containerrese">
            <div class="titlecheck">
                <h1 class="reservetitle">Rooms & Rates</h1>
            </div> 
    </section>            

    <section id="useredits">
            <div class="containerchecks">
                <div class="row g-2 justify-content-center">

                    <div class="col-auto">
                        <p class="label">Your Stay</p>
                    </div>
                    <div class="col-auto">
                        <p class="label vertical" >room</p>
                    </div>
                    <div class="col-auto">
                        <p class="label vertical" >adult</p>
                    </div>
                    <div class="col-auto">
                        <p class="label">children</p>
                    </div>
                    <div class="col-auto">
                        <p class="label">total rate</p>
                    </div>
                </div>
            </div>
    </section>       



    <!--     EARLY BIRD   -->
    <section id="sliderish">
        <div class="containerish">
            <div class="row">
                <div class="col-md-5 ">
                    <h3 class="roomeb"> Early Bird </h3>
                    <p class="roomeb">30% discount charge per night</p>
                    <p class="roomeb">Free WiFi</p>
                </div>
                <div class="col-md-6 ">
                    <div class="termss"> 
                        <h4 class="policies"> Policies </h4>
                        <p class="policies">Must cancel prior to 4:00PM one day before arrival to avoid a one night room charge plus surcharge. </p>
                        <p class="policies">Reservation must be guaranteed with credit card at time of booking. Room will be held until 12 midnight on the day of the arrival (hotel local time).</p>
                    </div>
                </div>          
            </div>
        </div>
    </section>

    <section id="sliderearly">
        <div class="containerearly">
            <div class="titlesa">
                <h4 class="availroom"> Available Rooms </h4>
            </div>
        

            <div class="row slider">

                <?php 
                $roomtype = "SELECT DISTINCT room_suite_name FROM room_status";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['room_suite_name']; ?></h5>
                                    <?php 
                                        $type = $result['room_suite_name'];
                                        $base_price = "SELECT base_price FROM room_description WHERE room_name LIKE '%$type%'";
                                        $base_price = $conn->query($base_price);
                                        $base_price = $base_price->fetch_row();
                                        $base_price = $base_price[0];
                                        
                                        $roomprice = "SELECT base_discount, service_rate, city_tax, vat FROM rate_description WHERE rate_name LIKE '%Best Available Rate%'";
                                        $roomprice = $conn->query($roomprice);
                                        $roomprice = $roomprice->fetch_row();

                                        
                                        
                                        $base_discount = $roomprice[0];
                                        $service_rate = $roomprice[1];
                                        $city_tax = $roomprice[2];
                                        $vat = $roomprice[3];

                                        if($base_discount === 0){
                                            $base_discount = $base_price;
                                        }
                                        $base_discount = $base_price*$base_discount;

                                        $totalprice = ($base_discount*$service_rate) + ($base_discount*$city_tax) + ($base_discount*$vat);
                                        $totalprice = number_format($totalprice, 2);
                                    ?>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey"><?php echo $totalprice ?> PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    <div class="radiobut">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bed" value="Queen" checked>
                                            <label class="form-check-label">Queen Bed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bed" value="King">
                                            <label class="form-check-label">King Bed</label>
                                        </div>
                                    </div>
                                    <button type="submit" name="chooseroomeb" id="butbut" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--     ONLINE EXCLUSIVE    -->
    <section id="sliderishh">
        <div class="containerish">
            <div class="row">
                <div class="col-md-5 ">
                    <h3 class="roomeb"> Online Exclusive</h3>
                    <p class="roomeb">30% discount charge per night</p>
                    <p class="roomeb">Free WiFi</p>
                </div>
                <div class="col-md-6 ">
                    <div class="termss"> 
                        <h4 class="policies"> Policies </h4>
                        <p class="policies">Must cancel prior to 4:00PM one day before arrival to avoid a one night room charge plus surcharge. </p>
                        <p class="policies">Reservation must be guaranteed with credit card at time of booking. Room will be held until 12 midnight on the day of the arrival (hotel local time).</p>
                    </div>
                </div>          
            </div>
        </div>
    </section>

    <section id="sliderearly">
        <div class="containerearly">
            <div class="titlesa">
                <h4 class="availroom"> Available Rooms </h4>
            </div>
            <div class="row slider">
            <p>sample text</p>


            </div>
        </div>
    </section>

<!--     BONUS STAY   -->
    <section id="sliderishh">
        <div class="containerish">
            <div class="row">
                <div class="col-md-5 ">
                    <h3 class="roomeb"> Bonus Stay </h3>
                    <p class="roomeb">30% discount charge per night</p>
                    <p class="roomeb">Free WiFi</p>
                </div>
                <div class="col-md-6 ">
                    <div class="termss"> 
                        <h4 class="policies"> Policies </h4>
                        <p class="policies">Must cancel prior to 4:00PM one day before arrival to avoid a one night room charge plus surcharge. </p>
                        <p class="policies">Reservation must be guaranteed with credit card at time of booking. Room will be held until 12 midnight on the day of the arrival (hotel local time).</p>
                    </div>
                </div>          
            </div>
        </div>
    </section>

    <section id="sliderearly">
        <div class="containerearly">
            <div class="titlesa">
                <h4 class="availroom"> Available Rooms </h4>
            </div>
            <div class="row slider">
            
                <p>sample text</p>

            </div>
        </div>
    </section>


    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">X</button>
                    <h3>Price Breakdown</h3>
                </div>
                <div class="modal-body">
                    <h4>this is my body</h4>
                </div>
            </div>
        </div>
    </div>

    
    

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    

    <script type="text/javascript">

        $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerPadding: 5,
        infinite: false,
        });

    </script>
</body>
</html>

