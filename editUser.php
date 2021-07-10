<?php 
include_once 'header.php';
?>
    <!--------------------------------checkout------------------------------>
    <section id ="forms">
        <div class="checkout">
            <div class="titlecheck">
                <a href="modifyreservation.php"  input type="button" class="btn btn-primary"> Back </a>
                <h1 class="reservetitle">Edit User Information</h1>
            </div> 

            <div class="containercheck">
                <div class="row g-2 justify-content-center">

                    <div class="col-auto">
                        <p class="label">Your Stay</p>
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
        <div class="containercheck">
            <div class="titlecheck">
                <form class="row g-3"  id="whitey" action="" method="post">
                    <h1 class="personals">Personal Information</h1>
                        <div class="form-group form-inline">
                            <label>Title</label>
                            <select name="name_with_initials" id="">
                                        <option selected="selected" value="mister">Mr.</option>
                                        <option value="misis">Mrs.</option>
                                        <option value="miss">Miss.</option>
                            </select>   
                        </div>
                            

                            <div class="col-md-6 ">
                                <label for="first"> First Name:</label>
                                <input type="text" class="form-control" id="first">
                            </div>
                            <div class="col-md-5 ">
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                        

                            <div class="col-md-6 ">
                                <label for="last">Last Name:</label>
                                <input type="text" class="form-control" id="last">
                            </div>
                            
                            <div class="col-md-5 ">
                                <label for="reemail">Re-Type Email Address:</label>
                                <input type="text" class="form-control" id="reemail">
                            </div>

                            <hr />

                            <h1 class="personals">Address</h1>
                            
                                <div class="col-md-6  ">
                                    <label for="first"> Address:</label>
                                    <input type="text" class="form-control" id="first">
                                </div>
                                <div class="col-md-5  ">
                                    <label for="email">City:</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                            
    
                                <div class="col-md-6 ">
                                    <label for="last">Mobile Number:</label>
                                    <input type="text" class="form-control" id="last">
                                </div>

                                <hr />

                            <h1 class="personals">Payment Information</h1>
                            <div class="form-group form-inline">
                                <label>Payment Type</label>
                                <select name="name_with_initials" id="">
                                            <option selected="selected" value="mister">Mr.</option>
                                            <option value="misis">1.</option>
                                            <option value="miss">2.</option>
                                </select>   
                            </div>
                        
                            <div class="col-md-6  ">
                                <label for="first"> Cardholder Name:</label>
                                <input type="text" class="form-control" id="first" disabled>
                            </div>
                            <div class="col-md-5  ">
                                <label for="email">Cardholder Number:</label>
                                <input type="text" class="form-control" id="email" disabled>
                            </div>
                        
                            <div class="col-12"></div>

                            <div class="col-2 ">
                                <label>Expiration Date</label>
                            </div>

                                <div class="col-2 ">            
                                    <label for="last">M</label>
                                    <input type="text" class="form-control" id="last" disabled>
                                </div>
                                <div class="col-2">
                                    <label for="last">Y</label>
                                    <input type="text" class="form-control" id="last"disabled >
                                 </div>                             
                </form>
            </div>
        </div>  
    </div>
</section>



                 <section id ="twobutt">
                     <div class="row">
                         <p class="privacy">ito ang privacy ni papi skye</p>
                     </div>

                    <div class="row ">
                        <div class="buttwo">
                            
                            <button type="button" class="btn btn-primary"> Confirm Edit </button>
                        </div>
                    </div>
                 </section>
</section>
</body>
</html>
