<?php 
include_once 'header.php';
?>
    
         <!---------------------------------modify------------------------------->
         <section id="modify">
             <div class="containermod">
                
                    <a href="reservation.php" type="button"  id ="backmod" class="btn btn-primary"> Back </a>
                
                    <h1 class="modifhye">Modify Reservation</h1>
               
             </div>
        </section>

        

        <section id ="modifyone">
            <div class="containermodi">
                
                    <h2 class="modifhy">Guest Information</h2>

                <div class="row lg-2 align-items-center">

                    <div class="col-md-6">
                        <p class="userinfo">Name: John MArk SAga</p>
                    </div>
                    <div class="col-md-6">
                        <p>Email: JohnMArkSAga@gmail</p>
                    </div>
                    <div class="col-md-6">
                        <p class ="userinfo">Confirmation Number: 09184178294</p>
                    </div>    
                    <div class="col-md-6">
                        <a href="editUser.php" input type="button" class="btn btn-primary"> Edit Personal Information  </a>
                    </div>
        </section>        

                    <hr/>

        <section id ="modifytwo">
                    <div class="col-12"></div>
                        <h2 class="">Room Information</h2>
                </div>        
        </div> 
        </section>
        
        <section id ="bannerss">
            <div class="containernew">
                <div class="row">
                    <div class="col-md-5" id="new">
                        <h3 class="new">Room 1</h3>
                        <p class="new">Room type </p>
                        <p class="new">Bed: King Bed</p>
                        <p class="new">Rate type: Early  Bird</p>
                        <p class="new">room total php 2,800</p>
                    </div>

                    <div class="col-md-6">
                        <img src="photos/bonus stay.png" alt=""  class ="img-fluid">
                    </div>

                   
                   <div class ="col-md-5">
                       <h3 class ="new"> Tax and fees  </h3>
                       <p class="new">vat: php 224 </p>
                         <p class="new">service charge: php 140</p>
                        <p class="new">city tax: php  84</p>
                        <p class="new">total: php 3,248</p>
                   </div>

                   <div class ="col-md-6 terms">
                       <h3 class="term">Description Baby</h3>
                       <button type="button" id ="pindot" class="btn btn-primary"> Delete Booking </button>
                       <a href="modifyroom.php" input type="button" id ="pindot" class="btn btn-primary"> Edit Room </a>                       
                   </div>

                </div>
            </div>
          
    </section>

    <div class="containerchecks">
        <div class="row g-2 justify-content-center">

            <div class="col-auto">
                <p class="label">Arrival DAte: july 10 1999</p>
            </div>
            <div class="col-auto">
                <p class="label " >departure DAte: july 10 1999</p>
            </div>
            <div class="col-auto">
                <p class="label vertical">overall price php 10,000</p>
            </div>
            
        </div>
    </div>


    <section id ="twobutt">
       <div class="row ">
           <div class="buttwo">
               <button type="button" class="btn btn-primary"> Cancel Reservation </button>
               <button type="button" class="btn btn-primary"> Submit Request </button>
           </div>
       </div>
    </section>

                
                

</section>
</body>
</html>        