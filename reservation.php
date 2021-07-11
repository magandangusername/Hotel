<?php 
include_once 'header.php';
?>
    
    <!-----------availability----------->

    <section id ="availabilityrese">
        <div class="containerrese">
            <div class="titlecheck">
                <h1 class="reservetitle">Check Availability</h1>
            </div> 
            <div class="shadow-sm p-1 bg-body rounded">
                <form action="" method="POST" onsubmit="">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="inputCheckIn" class="col-form-label">Check-In</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type ="date" id="CheckIn" name="CheckIn"  type="text" onchange="checkcalendar()"/>
                        </div>  
                        
                        <div class="col-auto">
                            <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                        </div>

                        <div class="col-auto">
                            <input class="form-control" type ="date" id="CheckOut" name="CheckOut"  type="text" onchange="checkcalendar()"/>
                        </div> 

                        <div class="col-auto vertical">
                            <label for="inputAdult" class="col-form-label">Adult</label>
                        </div> 

                        <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcount" id ="adultcount" value="1" min="1">
                        </div>


                        <div class="col-auto">
                            <label for="inputChild" class="col-form-label">Child</label>
                        </div> 

                        <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcount" id ="childadult" value="0" min="0" max="3">
                        </div>

                        <div class="col-auto">
                            <button type="submit" name="checkavail" class="btn btn-primary"> Check Availability </button>
                        </div>
                    </div>
                </form>
            </div>  
        </div>   
    </section>

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
    <!-------promo and rates-------->
    <div class="roomrates">
        <div class="row">
            <div class="col-md-3">
                <h3 class="roomtxt">Room 1</h3>
            </div> 
            <div class="col-md-6">
                <h1 class="pandr">Promotion and Rates</h1>
            </div>
        </div>
    </div>
    <!-------sliderish-------->

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
                $roomtype = "SELECT DISTINCT room_type FROM room_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['room_type']; ?> Room</h5>
                                    <?php 
                                        $type = $result['room_type'];
                                        $roomprice = "SELECT total FROM calculated_rate WHERE rate_code LIKE '%EB' AND room_type LIKE '%$type%'";
                                        $roomprice = $conn->query($roomprice);
                                        $roomprice = $roomprice->fetch_row();
                                        $roomprice = $roomprice[0];
                                        $roomprice = number_format($roomprice, 2);
                                    ?>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey"><?php echo $roomprice ?> PHP/Night</p>
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
                <?php 
                $roomtype = "SELECT DISTINCT suite_type FROM suite_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['suite_type']; ?> Room</h5>
                                    <?php 
                                        $type = $result['suite_type'];
                                        $roomprice = "SELECT total FROM calculated_rate WHERE rate_code LIKE '%EB' AND room_type LIKE '%$type%'";
                                        $roomprice = $conn->query($roomprice);
                                        $roomprice = $roomprice->fetch_row();
                                        $roomprice = $roomprice[0];
                                        $roomprice = number_format($roomprice, 2);
                                    ?>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey"><?php echo $roomprice ?> PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    
                                    <button type="submit" name="chooseroomeb" id="butbut" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!--
                <div class="col-md-12" id="avilnows">
                    <div class="cards">
                        <img src="photos/bonus stay.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Joint Room</h5>
                            <p class="sizey">34-36 sqm</p>
                            <p class ="none">City View, Free Wifi</p>
                            <a href="#" class="none">Read More</a>
                            <p class="pricey">2,800 PHP/Night</p>
                            <p class="sizeys">Excluding Taxes and Fee</p>
                            <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                            <div class="radiobut">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">Queen Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">King Bed</label>
                                </div>
                            </div>    
                            <a href="checkout.php" input type="button"  id="butbut" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="avilnows">
                    <div class="cards">
                        <img src="photos/bonus stay.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Deluxe Room</h5>
                            <p class="sizey">34-36 sqm</p>
                            <p class ="none">City View, Free Wifi</p>
                            <a href="#" class="none">Read More</a>
                            <p class="pricey">2,800 PHP/Night</p>
                            <p class="sizeys">Excluding Taxes and Fee</p>
                            <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                            <div class="radiobut">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">Queen Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">King Bed</label>
                                </div>
                            </div>    
                            <a href="checkout.php" input type="button"  id="butbut" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="avilnows">
                    <div class="cards">
                        <img src="photos/bonus stay.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Junior Room</h5>
                            <p class="sizey">34-36 sqm</p>
                            <p class ="none">City View, Free Wifi</p>
                            <a href="#" class="none">Read More</a>
                            <p class="pricey">2,800 PHP/Night</p>
                            <p class="sizeys">Excluding Taxes and Fee</p>
                            <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                            <div class="radiobut">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">Queen Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">King Bed</label>
                                </div>
                            </div>    
                                <a href="checkout.php" input type="button"  id="butbut" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="avilnows">
                    <div class="cards">
                        <img src="photos/bonus stay.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Executive Room</h5>
                            <p class="sizey">34-36 sqm</p>
                            <p class ="none">City View, Free Wifi</p>
                            <a href="#" class="none">Read More</a>
                            <p class="pricey">2,800 PHP/Night</p>
                            <p class="sizeys">Excluding Taxes and Fee</p>
                            <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                            <div class="radiobut">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">Queen Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">King Bed</label>
                                </div>
                            </div>    
                            <a href="checkout.php" input type="button"  id="butbut" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="avilnows">
                    <div class="cards">
                        <img src="photos/bonus stay.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Presidential Room</h5>
                            <p class="sizey">34-36 sqm</p>
                            <p class ="none">City View, Free Wifi</p>
                            <a href="#" class="none">Read More</a>
                            <p class="pricey">2,800 PHP/Night</p>
                            <p class="sizeys">Excluding Taxes and Fee</p>
                            <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                            <div class="radiobut">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">Queen Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">King Bed</label>
                                </div>
                            </div>    
                            <a href="checkout.php" input type="button"  id="butbut" class="btn btn-primary">Select</a>
                        </div>
                    </div>
                </div>-->
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
            <?php 
                $roomtype = "SELECT DISTINCT room_type FROM room_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['room_type']; ?> Room</h5>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey">2,800 PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    <div class="radiobut">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio">
                                            <label class="form-check-label">Queen Bed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio">
                                            <label class="form-check-label">King Bed</label>
                                        </div>
                                    </div>    
                                    <!--<a href="checkout.php" input type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</a>-->
                                    <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php 
                $roomtype = "SELECT DISTINCT suite_type FROM suite_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['suite_type']; ?> Room</h5>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey">2,800 PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    
                                    <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</button>
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
            <?php 
                $roomtype = "SELECT DISTINCT room_type FROM room_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['room_type']; ?> Room</h5>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey">2,800 PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    <div class="radiobut">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio">
                                            <label class="form-check-label">Queen Bed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio">
                                            <label class="form-check-label">King Bed</label>
                                        </div>
                                    </div>    
                                    <!--<a href="checkout.php" input type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</a>-->
                                    <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php 
                $roomtype = "SELECT DISTINCT suite_type FROM suite_list";
                $roomtype = $conn->query($roomtype);
                while($result = $roomtype->fetch_assoc()) { ?>
                
                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <img src="photos/bonus stay.png" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['suite_type']; ?> Room</h5>
                                    <p class="sizey">34-36 sqm</p>
                                    <p class ="none">City View, Free Wifi</p>
                                    <a href="#" class="none">Read More</a>
                                    <p class="pricey">2,800 PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a href="#" class="sizeyss"><p style="text-align:center">Price Breakdown</p></a>
                                    
                                    <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</button>
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

