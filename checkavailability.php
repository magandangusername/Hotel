<?php 

?>
<?php if ($url === 'index.php' || $url === 'reservation.php') { 
    ?>
    
<section id="availability">
    <div class="container">
        <div class="shadow-sm p-1 bg-body rounded">
            <form action="" method="POST" onsubmit="">
                <div class="row g-2 align-items-center ">
                    <div class="col-auto">
                        <label for="inputCheckIn" class="col-form-label">Check-In</label>
                    </div>
                    <div class="col-auto">
                        <input class="form-control" type="date" id="CheckIn" name="CheckIn" type="text" onchange="checkcalendarin()"/>
                    </div>

                    <div class="col-auto">
                        <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control" type="date" id="CheckOut" name="CheckOut" type="text" onchange="checkcalendarout()"/>
                    </div>

                    <div class="col-auto vertical">
                        <label for="inputRoom" class="col-form-label">Room</label>
                    </div> 

                    <div class="col-auto">
                        <input class="form-control-num" type="number" name="roomcount" id ="roomcount" value="1" min="1" max="3">
                    </div>

                    <div class="col-auto ">
                        <label for="inputAdult" class="col-form-label">Adult</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcount" id="adultcount" value="1" min="1">
                    </div>


                    <div class="col-auto">
                        <label for="inputChild" class="col-form-label">Child</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcountchild" id="childadult" value="0" min="0">
                    </div>

                    <div class="col-auto">
                        <button type="submit" name="checkavail" class="btn btn-primary"> Check Availability </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php } ?>




<?php if ($url === 'roomtab.php' || $url === 'suitestab.php') { 
    if (isset($_SESSION['availabilityCheck'])) {
        if ($_SESSION['availabilityCheck'] === false) { ?>
            <div class="col-lg-3" id="availnow">
            <div class="col-auto">
                <label for="inputCheckIn" class="col-form-label">Check-In</label>
            </div>
            <div class="col-auto">
                <input class="form-control" type ="date" id="CheckIn" name="CheckIn"  type="text" onchange="checkcalendarin()"/>
            </div>  
            
            <div class="col-auto">
                <label for="inputCheckOut" class="col-form-label">Check-Out</label>
            </div>

            <div class="col-auto">
                <input class="form-control" type ="date" id="CheckOut" name="CheckOut"  type="text" onchange="checkcalendarout()"/>
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
                    <input class="form-control-num" type="number" name="guestcountchild" id ="childadult" value="0" min="0">
                </div>
            </div>
                <div class="col-auto">
                <button type="sumbit" name="checkavail" id ="roomcheck" class="btn btn-primary"> Check Availability </button>
            </div>
        </div>
    <?php }
    }
    else {
    ?>

        <div class="col-lg-3" id="availnow">
            <div class="col-auto">
                <label for="inputCheckIn" class="col-form-label">Check-In</label>
            </div>
            <div class="col-auto">
                <input class="form-control" type ="date" id="CheckIn" name="CheckIn"  type="text" onchange="checkcalendarin()"/>
            </div>  
            
            <div class="col-auto">
                <label for="inputCheckOut" class="col-form-label">Check-Out</label>
            </div>

            <div class="col-auto">
                <input class="form-control" type ="date" id="CheckOut" name="CheckOut"  type="text" onchange="checkcalendarout()"/>
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
                    <input class="form-control-num" type="number" name="guestcountchild" id ="childadult" value="0" min="0">
                </div>
            </div>
                <div class="col-auto">
                <button type="sumbit" name="checkavail" id ="roomcheck" class="btn btn-primary"> Check Availability </button>
            </div>
        </div>
<?php }
} ?>