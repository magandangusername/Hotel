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

     <!---------------------------------rooms-------------------------------> 
    <section id ="roomtab">
        <div class="container4">
            <div class="row row-cols-3 row-cols-lg-3">


                <div class="col">
                    <a href="standard.php"> <img src="photos/single.jpg"></a>
                </div>
                <div class="col">
                    <h3>Standard Room</h3>
                    <p>this is standard</p>
                </div>
                <div class="col-lg-2" id="availnow">
                    <h3> Room</h3>
                    <p>this is standard</p>
                    <a href="">see latest room offers</a>
                </div>


                <div class="col">
                    <a href="deluxe.php"><img src="photos/single.jpg"></a>
                </div>
                <div class="col">
                    <h3>Deluxe Room</h3>
                    <p>this is standard</p>
                   
                </div>
                <div class="col-lg-3" id="availnow">
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
                            <input class="form-control-num" type="number" name="guestcount" id ="childadult" value="1" min="1">
                        </div>
                    </div>
                        <div class="col-auto">
                        <button type="button" id ="roomcheck" class="btn btn-primary"> Check Availability </button>
                    </div>
                </div>

                <div class="col">
                    <a href="joint.php"><img src="photos/single.jpg"></a>
                </div>
                <div class="col">
                    <h3>Joint Room</h3>
                    <p>this is standard</p>
                </div>

            </div>
        </div>
    </section>


</section>
</body>
</html>    