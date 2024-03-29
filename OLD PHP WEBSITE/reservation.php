<?php
include_once 'header.php';
/*
to be fixed by designer:
- distance of each rates (nagkadikit ung mga rates, ewan ko kung ano nabago ko sa code mo, 
diba dati may onting agwat bawat rate, pacheck nalang dyan sa loob ng mga looping)
question for leader:
- about the 'City View, Free Wifi' part of this page, what exactly must be pulled to there.
- what exactly does the 'read more' and 'price breakdown' does.
note to everyone:
- the huge html comment here is just for reference, it will be deleted soon.
*/
?>

<!-----------availability----------->

<section id="availabilityrese">
    <div class="containerrese">
        <div class="titlecheck">
            <h1 class="reservetitle">Rooms & Rates</h1>
        </div>
</section>

<section id="useredits">
    <div class="containerchecks">
        <div class="row g-2 justify-content-center">

            <div class="col-auto">
                <p class="label">Your Stay: <?php echo date('M d, Y', strtotime($_SESSION['checkin'])) . " - " . date('M d, Y', strtotime($_SESSION['checkout'])) ?></p>
            </div>
            <div class="col-auto">
                <p class="label vertical">room(s): <?php echo $_SESSION['rooms'] ?></p>
            </div>
            <div class="col-auto">
                <p class="label ">adult: <?php
                                            if (isset($_SESSION['room']) || $_SESSION['room'] > 1) {
                                                $room = $_SESSION['room'];
                                            } else {
                                                $room = 1;
                                                $_SESSION['room'] = $room;
                                            }
                                            if ($room == 1) {
                                                $_SESSION['roomchecker'] = true;
                                                $_SESSION['roomchecker2'] = true;
                                                if (isset($_SESSION['roomtype2']) || isset($_SESSION['ratetype2']))
                                                    $_SESSION['roomtype2'] = '';
                                                $_SESSION['ratetype2'] = '';

                                                echo $_SESSION['adult'];
                                            } else if ($room == 2) {
                                                echo $_SESSION['adult2'];
                                            } else if ($room == 3) {
                                                echo $_SESSION['adult3'];
                                            }


                                            ?></p>
            </div>
            <div class="col-auto" hidden>
                <p class="label">children</p>
            </div>
            <div class="col-auto" hidden>
                <p class="label">Total rate: <?php


                                                ?></p>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_SESSION['rooms']) && $_SESSION['rooms'] > 1) {

?>
    <div class="containerish">
        <h1>Room <?php echo $room ?> out of <?php echo $_SESSION['rooms'] ?></h1>
    </div>

<?php
}

$rt = 0;
$rs = 0;
$b = 0;

$rates = "SELECT rate_name, rate_offer1, rate_offer2, rate_offer3 FROM rate_description";
$rates = $conn->query($rates);
while ($ratesdescription = $rates->fetch_assoc()) {
    //future notes: add a default display if there are no rates available

?>

    <section id="sliderish">
        <div class="containerish">
            <div class="row">
                <div class="col-md-5 ">
                    <h3 class="roomeb1"> <?php echo $ratesdescription['rate_name'] ?> </h3>
                    <p class="roomeb"><?php echo $ratesdescription['rate_offer1'] ?></p>
                    <p class="roomeb"><?php echo $ratesdescription['rate_offer2'] ?></p>
                    <p class="roomeb"><?php echo $ratesdescription['rate_offer3'] ?></p>
                </div>
                <div class="col-md-6 ">
                    <div class="termss">
                        <h4 class="policies1"> Policies </h4>
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
                while ($result = $roomtype->fetch_assoc()) { ?>

                    <div class="col-md-12" id="avilnows">
                        <div class="cards">
                            <?php
                            $type = $result['room_suite_name'];
                            $base_price = "SELECT room_size, base_price, image_name FROM room_description WHERE room_name LIKE '%$type%'";

                            $base_price = $conn->query($base_price);
                            $base_price = $base_price->fetch_row();

                            if ($base_price) {
                                $file_name = $base_price[2];
                                $room_size = $base_price[0];
                                $base_price = $base_price[1];
                            } else {
                                $base_price = "SELECT suite_size, base_price, image_name FROM suite_description WHERE suite_name LIKE '%$type%'";

                                $base_price = $conn->query($base_price);
                                $base_price = $base_price->fetch_row();
                                $file_name = $base_price[2];
                                $room_size = $base_price[0];
                                $base_price = $base_price[1];
                            }

                            $rate_name = $ratesdescription['rate_name'];
                            $roomprice = "SELECT base_discount, service_rate, city_tax, vat FROM rate_description WHERE rate_name LIKE '%$rate_name%'";
                            $roomprice = $conn->query($roomprice);
                            $roomprice = $roomprice->fetch_row();

                            if ($_SESSION['promocode'] != '') {
                                $promodiscount = "SELECT overall_cut FROM promotion_description WHERE promotion_code = '" . $_SESSION['promocode'] . "'";
                                $promodiscount = $conn->query($promodiscount);
                                $promodiscount = $promodiscount->fetch_row();
                                $promodiscount = $promodiscount[0];
                            }


                            $base_discount = $roomprice[0];
                            $service_rate = $roomprice[1];
                            $city_tax = $roomprice[2];
                            $vat = $roomprice[3];

                            if ($base_discount === 0) {
                                $base_discount = $base_price;
                            }

                            $base_discount = $base_price * $base_discount;
                            $new_price = $base_price - $base_discount;

                            $totalprice = $new_price + ($new_price * $service_rate) + ($new_price * $city_tax) + ($new_price * $vat);
                            // $totalprice = number_format($totalprice, 2);
                            // echo $totalprice;
                            if (isset($promodiscount)) {
                                $promototal = $totalprice * $promodiscount;
                                $newpromototal = $totalprice - $promototal;
                            }

                            if (isset($newpromototal)) {
                                $totalrate = $newpromototal;
                            } else {
                                $totalrate = $totalprice;
                            }
                            $_SESSION['downpayment'] = $totalrate * 0.5;
                            ?>
                            <img src="photos/<?php echo $file_name ?>" class="card-img-top">
                            <form action="" method="POST">
                                <div class="card-body text-muted">
                                    <h5 class="card-title"><?php echo $result['room_suite_name']; ?></h5>



                                    <p class="sizey"><?php echo $room_size ?> sqm</p>
                                    <p class="none">City View, Free Wifi</p>
                                    <a href="#" class="none"></a>
                                    <a class="isDisabled" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Read More
                                    </a>

                                    <div class="collapse" id="collapseExample">
                                        <div class="cards card-body">
                                            this is where to put the pulling data from database.
                                        </div>
                                    </div>
                                    <p class="pricey"><?php echo $new_price ?> PHP/Night</p>
                                    <p class="sizeys">Excluding Taxes and Fee</p>
                                    <a class="isDisabled" id="sizeyss" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" Disabled>

                                        <p style="text-align:center">Price Breakdown</p>
                                    </a>

                                    <div class="collapse" id="collapseExample">
                                        <div class="cards card-body">
                                            this is where to put the pulling data from database.
                                        </div>
                                    </div>
                                    <div class="radiobut">
                                        <?php

                                        $beds = "SELECT COUNT(room_suite_bed) AS beds FROM room_status WHERE room_suite_bed = 'Queen Bed' AND room_suite_name = '$type' AND status = 0";
                                        $beds = $conn->query($beds);
                                        $beds = $beds->fetch_row();
                                        $beds = $beds[0];
                                        // $table[$rt][$rs][$b] = $beds;
                                        $b += 1;
                                        //echo $beds;
                                        $q = $k = true;
                                        if ($beds > 0) {

                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bed" value="Queen Bed" <?php if($room == 1) {
                                                                                                                                            $_SESSION['bedcheckerq'] = true;
                                                                                                                                            //echo 'yes';
                                                                                                                                        }
                                                                                                                                        if ((isset($_SESSION['bedcheckerq']) && !$_SESSION['bedcheckerq']) &&
                                                                                                                                        ((isset($_SESSION['roomtype2']) && $_SESSION['roomtype2'] == $result['room_suite_name']) || ($_SESSION['roomtype'] == $result['room_suite_name'])) && 
                                                                                                                                        ($_SESSION['bed2'] == 'Queen Bed' || $_SESSION['bed'] == 'Queen Bed')) {
                                                                                                                                            echo "disabled";
                                                                                                                                            $q = false;
                                                                                                                                        } else {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                    ?>>
                                                <label class="form-check-label">Queen Bed</label>
                                            </div>
                                        <?php } else { $q = false; } 

                                        $beds = "SELECT COUNT(room_suite_bed) AS beds FROM room_status WHERE room_suite_bed = 'King Bed' AND room_suite_name = '$type' AND status = 0";
                                        $beds = $conn->query($beds);
                                        $beds = $beds->fetch_row();
                                        $beds = $beds[0];
                                        // $table[$rt][$rs][$b] = $beds;
                                        //echo $beds;
                                        if ($beds > 0) {

                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bed" value="King Bed" <?php if($room <= 1) {
                                                                                                                                            $_SESSION['bedcheckerk'] = true;
                                                                                                                                            //echo 'yes';
                                                                                                                                        }
                                                
                                                                                                                                        if ((isset($_SESSION['bedcheckerk']) && !$_SESSION['bedcheckerk']) &&
                                                                                                                                        ((isset($_SESSION['roomtype2']) && $_SESSION['roomtype2'] == $result['room_suite_name']) || ($_SESSION['roomtype'] == $result['room_suite_name'])) && 
                                                                                                                                        ($_SESSION['bed2'] == 'King Bed' || $_SESSION['bed'] == 'King Bed')) {
                                                                                                                                            echo "disabled";
                                                                                                                                            $k = false;
                                                                                                                                        } else {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                    ?>>
                                                <label class="form-check-label">King Bed</label>
                                            </div>
                                        <?php } else { $k = false; } ?>
                                    </div>
                                    <input name="room_type" value="<?php echo $type ?>" hidden>
                                    <input name="rate_type" value="<?php echo $ratesdescription['rate_name'] ?>" hidden>
                                    <input name="total_rate" value=<?php echo $totalrate ?> hidden>
                                    <?php
                                    $available = "SELECT COUNT(status) FROM room_status WHERE status = 0 AND room_suite_name = '$type'";
                                    //echo $available;
                                    $available = $conn->query($available);
                                    $available = $available->fetch_row();
                                    $available = $available[0];

                                    if (isset($_SESSION['roomchecker'])) {
                                        $roomchecker = $_SESSION['roomchecker'];
                                    }
                                    if (isset($_SESSION['roomchecker2'])) {
                                        $roomchecker2 = $_SESSION['roomchecker2'];
                                    }
                                    if ($available == 0) { ?>
                                        <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary" disabled>ROOM UNAVAILABLE</button>
                                    <?php } else if ((isset($roomchecker2) && !$roomchecker2 || isset($roomchecker) && !$roomchecker) && (!$q && !$k) && 
                                        (($_SESSION['roomtype'] == $result['room_suite_name']) || (isset($_SESSION['roomtype2']) && $_SESSION['roomtype2'] == $result['room_suite_name']))
                                    ) {


                                    ?>
                                        <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary" disabled>SELECTED THE LAST AVAILABLE</button>

                                    <?php

                                    } else {
                                    ?>
                                        <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary">Select</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                    // $rs += 1;
                }
                ?>
            </div>
        </div>
    </section>
<?php
    $rt += 1;
} ?>







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