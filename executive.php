<?php 
include_once 'header.php';
?>
        <section id ="standroomtitle">
            <div class="containerss">
                <div class="titless">
                  <h1 class="standardtitle">Executive Suite</h1>
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
    
    <!---------------------------------description------------------------------->
    <section id ="roomtab">
        <div class="container4">
            <div class="row row-cols-2 row-cols-lg-2">

                <div class="col-md-6" id="standstand">
                    <h3 class="standesc">Description</h3>
                    <p class="standesc">desciption dito</p>
                    <h3 class="stanAmenities">Details & Amenities</h3>
                    <p class="standesc">desciption dito</p>

                </div>


                <div class="col-lg-3" id="availnows">
                    <div class="col-auto">
                        <label for="inputCheckIn" class="col-form-label">Check-In</label>
                    </div>
                    <div class="col-auto">
                        <input class="form-control" type ="date" id="CheckIn" name="date"  type="text"/>
                    </div>  
                    
                    <div class="col-auto">
                        <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control" type ="date" id="CheckOut" name="date"  type="text"/>
                    </div> 

                    <div class="row row-cols-4">
                        <div class="col">
                            <label for="inputRoom" class="col-form-label">Room</label>          
                            <input class="form-control-num" type="number" name="roomcount" id ="roomcount" value="1" min="1">
                        </div>
                
                        <div class="col">
                            <label for="inputAdult" class="col-form-label">Adult</label>                       
                            <input class="form-control-num" type="number" name="guestcount" id ="adultcount" value="1" min="1">
                        </div>
                    
                        <div class="col">
                            <label for="inputChild" class="col-form-label">Child</label>
                            <input class="form-control-num" type="number" name="guestcount" id ="childadult" value="1" min="0">
                        </div>
                    </div>
                        <div class="col-auto">
                        <button type="button" id ="roomcheck" class="btn btn-primary"> Check Availability </button>
                    </div>
                </div>
            </div>
        </div>            
    </section>    

</section>
</body>
</html>
