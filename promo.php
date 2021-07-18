<?php
include_once 'header.php';
/*
note to designer:
- fix the design, i think it messed up a little from looping
*/


//displays the content of the specific promo
if (isset($_GET['promo'])) {
  include_once "promocontent.php";
} else {

?>
  <section id="promotiontitle">
    <div class="containerss">
      <div class="titles">
        <h1 class="promotionstitle">Promotions</h1>
      </div>
    </div>
  </section>

  <?php

  $date = date("Y-m-d h:i:sa");
  $promos = "SELECT * FROM promotion_description WHERE promotion_start <= '$date' AND promotion_end >= '$date'";
  $promos = $conn->query($promos);

  $rows = 0;

  while ($promo = $promos->fetch_assoc()) {
    $rows += 1;
  ?>

    <?php if ($rows % 2 == 1) { ?>
      <!-- ODD -->
      <section id="promotiontitle">
        <div class="containerss ">
          <div class="container-lg">
            <div class="row ">
              <div class="col-md-6">
                <div class="title1">
                  <h1 class="earlytitle"><?php echo $promo['promotion_name'] ?></h1>
                </div>
                <p class="abouts1"> <?php echo $promo['promotion_short_description'] ?> </p>
                <div class="promobonus">
                  <form method="POST" action="">
                    <a href="promo.php?promo=<?php
                                              $page = $promo['promotion_name'];
                                              echo $page; ?>" class="text-decoration-none btn btn-light">Learn More</a>
                    <button class="btn btn-light" id="promobonus" name="booknow" type="submit"> Book Now</button>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <img src="photos/<?php echo $promo['image_name'] ?>" id="promopic1" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>


    <?php if ($rows % 2 == 0) { ?>
      <!-- EVEN -->
      <section id="promotiontitle">
        <div class="containerss ">
          <div class="container-lg">
            <div class="row ">
              <div class="col-md-6">
                <img src="photos/<?php echo $promo['image_name'] ?>" id="promopic2" class="img-fluid">
              </div>
              <div class="col-md-6">
                <div class="title1">
                  <h1 class="earlytitle"><?php echo $promo['promotion_name'] ?></h1>
                </div>
                <p class="abouts1"> <?php echo $promo['promotion_short_description'] ?> </p>
                <div class="promobonus">
                  <form method="POST" action="">
                    <a href="promo.php?promo=<?php
                                              $page = $promo['promotion_name'];
                                              echo $page; ?>" class="text-decoration-none btn btn-light">Learn More</a>
                    <button class="btn btn-light" id="promobonus" name="booknow" type="submit"> Book Now</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>

  <?php } ?>

  </section>
  </body>

  </html>
<?php } ?>