<?php 
include_once 'header.php';
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

 <!---------------------------------availability------------------------------->
    <?php include_once 'checkavailability.php' ?>
    <div class="containers">
        <div class ="col-md">
            <p class = "location"> <a href="#">Justin Street, Brngy Anemo, Makati Avenue, Jean Kazama City 1299, Philippines. </a> <i class="fas fa-map-pin"></i></p>
            <p class = "num">+63819272869</p>
        </div>
    </div> 
    <!-----About------>
    <section id ="about">
        <div class ="container text-center">
            <h1 class ="hotelname"> Mondstadt Hotel</h1>
            <div class ="row text-center">      
                <p class = "desc">A one of a kind experience in hotel service and rooms. Mondstadt hotel has been serving travelers and such since 1990, with over 3 awards and a billion satisfied customers we guarantee and premium service like no other hotels can offer.</p>
            </div>
        </div>   
    </section>
    
    <!-----service------>
    <section id="service">
        <div class ="container1">
            <div class ="row">
              <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/bonus stay.png" alt="">
                    <div class="card-text">
                        <h4>Luxurious Experience</h4>
                        <h6>infoss</h6>
                    </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/early bird.png" alt="">
                    <div class="card-text">
                        <h4>Top Notch Service</h4>
                        <h6>A level service like no other</h6>
                    </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="photos/bonus stay1.png" alt="">
                    <div class="card-text">
                        <h4>Well-Maintained</h>
                        <h6>infoss</h6>
                    </div>
                </div>
              </div>
            </div>      
        </div>    
    </section> 



    <!-----roomandsuites------>
    <section id="roomandsuites">
        <div class ="container2">
            <div class="title">
                <h1 class="roomites">Room and Suites</h1>
            </div>
            
            <div class ="row">
                <div class="col-md-3 ">
                    <div class="card text-center">
                        <img src="photos/single.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class ="card-title">Standard room</h5>
                                <p class="card-text">King, Queen</p>
                                <p class="card-texts">ito ay standard</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card text-center">
                        <img src="photos/single.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class ="card-title">Deluxe room</h5>
                                <p class="card-text">King, Queen</p>
                                <p class="card-texts">ito ay standard</p>
                            </div>
                    </div>
                </div>
                    <div class="col-md-3 ">
                        <div class="card text-center ">
                            <img src="photos/presidential.jpg" class="card-img-top">
                             <div class="card-body">
                                <h5 class ="card-title">Suite room</h5>
                                <p class="card-text">King, Queen</p>
                                <p class="card-texts">ito ay standard</p>
                             </div>
                        </div>
                    </div>
                        <div class="col text-center">
                        <button type="button" id="seeall" class="btn btn-outline-info justify-content-center">See All Rooms & Suites</button>
                    </div>
            </div>      
        </div>    
    </section> 
  
    <!-----special offer------>
    <section id="roomandsuites">
        <div class ="container3">
            <div class="title">
                <h1 class="special">Special Offers</h1>
            </div>
            
            <div class ="row">
                <div class="col-md-3 ">
                    <div class="card text-center">
                        <img src="photos/single.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class ="card-title">Standard room</h5>
                                <p class="card-texts">ito ay standard</p>
                            </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card text-center">
                        <img src="photos/single.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class ="card-title">Deluxe room</h5>
                                <p class="card-texts">ito ay standard</p>
                            </div>
                    </div>
                </div>
                    <div class="col-md-3 ">
                        <div class="card text-center ">
                            <img src="photos/presidential.jpg" class="card-img-top">
                             <div class="card-body">
                                <h5 class ="card-title">Suite room</h5>
                                <p class="card-texts">ito ay standard</p>
                             </div>
                        </div>
                    </div>
                        <div class="col text-center">
                        <button type="button" id ="seeall" class="btn btn-outline-info justify-content-center">See All Special Offers</button>
                    </div>
            </div>      
        </div>    
    </section> 

</section>
</body>
</html>   