<?php 
/*
notes to designer:
- fix the terms and condition
- fix other promotions
*/

$promo_name = $_GET['promo'];
$date = date("Y-m-d h:i:sa");
$promotion = "SELECT * FROM promotion_description WHERE promotion_name = '$promo_name'";
$promotion = $conn->query($promotion);
$promotion = $promotion->fetch_row();
// if(!$promotion) {
//   $promotion = 'ERROR';
// }

?>
<!----------banner------------>

    <section id ="banner">
        <div class="container-fluid">
          <div class ="row">
            <div class ="col-md-6">
                <h1 class="earlytitle"><?php echo $promotion[1] ?></h1>
                <p class ="abouts"><?php echo $promotion[2] ?></p>
                <p class ="valid"> Valid from </p>
                <?php
                  $start_date = strtotime($promotion[7]);
                  $end_date = strtotime($promotion[8]);
                  $start_date = date('M d, Y h:ia', $start_date);
                  $end_date = date('M d, Y h:ia', $end_date);
                
                ?>
                <p class ="valid"> <?php echo $start_date ?> to <?php echo $end_date ?> </p>
                <p class ="valid"> +639184168959 </p>
                <button class ="btn btn-light" id ="bonusbutton"><a href="about.php" class="text-decoration-none"> Book Now</a></button>
            
      
            </div>
            <div class ="col-md-6">
                 <img src="photos/<?php echo $promotion[10] ?>" id ="earlypic" class ="img-fluid">
            </div>
            
            <div class ="col-md-6">
                <p class ="bonusinfo"> <?php echo $promotion[3] ?> </p>
            </div>
            <div class ="col-md-6 terms">
                <h3 class="term">Terms and condition</h3>
                <ul>
                  <?php if($promotion[4] != '') { ?>
                    <li class = "about1"><?php echo $promotion[4] ?></li>
                  <?php }
                  if($promotion[5] != '') { ?>
                    <li class = "about1"><?php echo $promotion[5] ?></li>
                  <?php }
                  if($promotion[6] != '') { ?>
                    <li class = "about1"><?php echo $promotion[6] ?></li>
                  <?php }
                  ?>
                </ul>
            </div>

          </div>
        </div>
    </section>

    
<!----------otherpromotion------------>
    <section id ="otherpromotion">
      <div class="container-fluid">
        <h1 class="otherpromo">Other Promotions</h1>
        <div class ="row">
              <?php 
                $promotion = "SELECT * FROM promotion_description WHERE promotion_name <> '$promo_name' LIMIT 2";
                $promotion = $conn->query($promotion);
                while($otherpromotion = $promotion->fetch_assoc()) {
              ?>
                <div class="col-md-6">
                  <div class="card">
                      <img src="photos/<?php echo $otherpromotion['image_name'] ?>" alt="">
                      <div class="card-text">
                          <h4><?php echo $otherpromotion['promotion_name'] ?></h4>
                          <h6><?php echo $otherpromotion['promotion_short_description'] ?></h6>
                          <form action="" method="POST">
                            <a href="promo.php?promo=<?php 
                              $page = $otherpromotion['promotion_name'];
                              echo $page;?>" class="text-decoration-none btn btn-light" id ="learnbutton">Learn More</a>
                            <button class ="btn btn-light" id ="bonusbutton" type="submit" name='booknow'> Book Now</button>
                          </form>
                      </div>
                  </div>
                </div>
              <?php } ?>
        </div>
      </div>
     </section>



</section>
</body>
</html>
