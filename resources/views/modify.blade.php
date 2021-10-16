@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">

<div class="container pt-0 mb-3 text-center">
    <h1 class="fw-bold"> Modify Reservation</h1>
</div>

<div class="infotab px-1 py-3 text-dark ">
  <div class="row mt-2">

    <div class="col-3 text-center">
      <h4 class="fw-bold">Reservation Number</h4>
      <h5>21385670 </h5>
    </div>

    <div class="col">
      <h4 class="fw-bold">Arrival/Departure</h4>
      <h5>01/25/21 - 01/27/21 </h5>
    </div>

    <div class="col-1 text-center">
      <h4 class="fw-bold">Adult</h4>
      <h5>5</h5>
    </div>

    <div class="col-1 text-center">
      <h4 class="fw-bold">Children</h4>
      <h5>5</h5>
    </div>

    <div class="col  text-center">
      <h4 class="fw-bold">Subtotal</h4>
      <h5>$5,000</h5>
    </div>

    <div class="col ">
      <div class="px-5">
        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">More Information</button>
      </div>

    </div>


  </div>
</div>
</div>


<div class="container p-4 my-5 bg-light">


        <div class=" text-dark ">
            <h2 class="px-5 py-3 fw-bold"> Guest Information</h2>
              <div class="row px-5 py-3">

                <div class="col-5">
                  <h5><b>Name :</b> John Mark</h5>
                  <h5><b>Email Address :</b> John Mark@email.com</h5>
                  <h5><b>Mobile Number : </b> 09231523952</h5>
                </div>


                <div class="col-5">
                  <h5><b>Address : </b> Blk9, U7 Mark St, Brgy Bordadora</h5>
                  <h5><b>City : </b> Pasig City</h5>
                </div>

                <div class="col">
                  <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Guest Info</button>
                </div>

              </div>
        </div>

    <hr class="mx-5 mt-3 mb-4 p-1">

    <h3 class="px-5 py-0 fw-bold  text-dark "> Payment Information </h3>
        <div class="row px-5 py-3  text-dark ">

          <div class="col-5">
            <h5><b>Cardholder Name :</b> Jo*****</h5>
            <h5><b>Card Number :</b> 4********</h5>
          </div>

          <div class="col-5">
            <h5><b>Expiry Date : </b> 21/02</h5>
            <h5><b>CVV : </b> ***</h5>
          </div>

          <div class="col">
            <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Payment Info</button>
          </div>
        </div>


    <hr class="mx-5 mt-4 mb-4 p-1">

         <h2 class="px-5 py-3 fw-bold text-center  text-dark  "> Room Information </h2>

         <div class="accordion" id="accordionid">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> Room 1</button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionid">
              <div class="card-body">

                <div class="row">
                  <div class="col"><img src="../assets/abstract.jpg" class="img-thumbnail"></div>
                  <div class="col mt-5">

                    <h5><b>Room Name :</b> Standard Room</h5>
                    <h5><b>Bed :</b> King Bed</h5>
                    <h5><b>Rate Applied:</b> Bread and Breakfast </h5>
                    <h5><b>Promo Applied:</b> N/A </h5>
                  </div>

                  <div class="col mt-5">
                    <h5><b>Base Price :</b> 10,000</h5>
                    <h5><b>City Tax :</b> 20</h5>
                    <h5><b>Vat:</b> 10 </h5>
                    <h5><b>Service Charge:</b> 30 </h5>
                    <h5><b>Total:</b> 10,060 </h5>

                  </div>

                  <div class="col mt-5">
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room Info</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Room 2
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionid">
              <div class="card-body">
                  <div class="row">
                    <div class="col"><img src="../assets/abstract.jpg" class="img-thumbnail"></div>


                    <div class="col mt-5">

                      <h5><b>Room Name :</b> Standard Room</h5>
                      <h5><b>Bed :</b> King Bed</h5>
                      <h5><b>Rate Applied:</b> Bread and Breakfast </h5>
                      <h5><b>Promo Applied:</b> N/A </h5>
                    </div>

                    <div class="col mt-5">
                      <h5><b>Base Price :</b> 10,000</h5>
                      <h5><b>City Tax :</b> 20</h5>
                      <h5><b>Vat:</b> 10 </h5>
                      <h5><b>Service Charge:</b> 30 </h5>
                      <h5><b>Total:</b> 10,060 </h5>

                    </div>

                    <div class="col mt-5">
                      <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room Info</button>
                      <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                    </div>

                  </div>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                   Room 3
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionid">
              <div class="card-body">
                <div class="row">
                  <div class="col"><img src="../assets/abstract.jpg" class="img-thumbnail"></div>


                  <div class="col mt-5">

                    <h5><b>Room Name :</b> Standard Room</h5>
                    <h5><b>Bed :</b> King Bed</h5>
                    <h5><b>Rate Applied:</b> Bread and Breakfast </h5>
                    <h5><b>Promo Applied:</b> N/A </h5>
                  </div>

                  <div class="col mt-5">
                    <h5><b>Base Price :</b> 10,000</h5>
                    <h5><b>City Tax :</b> 20</h5>
                    <h5><b>Vat:</b> 10 </h5>
                    <h5><b>Service Charge:</b> 30 </h5>
                    <h5><b>Total:</b> 10,060 </h5>

                  </div>

                  <div class="col mt-5">
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room Info</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Cancel Reservation</button>
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Submit Modification</button>
                  </div>
                </div>

</div>

@endsection
