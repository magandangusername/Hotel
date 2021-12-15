@extends('layouts.app')

@section('content')



<div class="container">
    <h1 class="text-center fw-bold pt-5"><u>Guest Information</u></h1>

    <div class="row g-2 justify-content-center mt-3">

        <div class="col-auto" style="font-size: 110%;">
            <p class="label">Your Stay:
                {{ date('M d, Y', strtotime(session('CheckIn'))) . ' - ' . date('M d, Y', strtotime(session('CheckOut'))) }}
            </p>
        </div>
        <div class="col-auto" hidden>
            <p class="label vertical">adult</p>
        </div>
        <div class="col-auto" hidden>
            <p class="label">children</p>
        </div>
        <div class="col-auto" style="font-size: 110%;">
            <p class="label">Total rate: @php
                if (session('RoomCount') >= 1) {
                $totalrate = floatval(session('totalrate'));
                if (session('RoomCount') >= 2) {
                $totalrate += floatval(session('totalrate2'));
                if (session('RoomCount') == 3) {
                $totalrate += floatval(session('totalrate3'));
                }
                }
                }
                Session::put('overallprice', $totalrate);
                echo number_format(session('overallprice'), 2);
                @endphp</p>
        </div>
    </div>
</div>

<hr>


{{-- <form action="bookinfo" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"> --}}
<form action="bookinfo" method="post">
    @csrf

    <div class="container px-5">

        @guest

        <div class="container my-5">
            <h1 class="fw-bold">Personal Information</h1>



            <div class="form-group">
                <label>Title</label>
                <select name="name_with_initials" id="" required>
                    <option selected="selected" value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Miss">Miss</option>
                </select>
            </div>
            <div class="row my-2">

                <div class="col">

                    <label for="first"> First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="fn" required>

                    <label for="last">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="ln" required>
                </div>

                <div class="col">
                    <label for="email">Email Address:</label>
                    <input type="text" class="form-control" id="firste" name="email" required>

                    <label for="reemail">Re-Type Email Address:</label>
                    <input type="text" class="form-control" id="firste" required>
                </div>



            </div>

        </div>
        <hr />



        <div class="container my-4">
            <h1 class="fw-bold">Address</h1>
            <div class="row my-3">
                <div class="col-md-6">
                    <label for="first"> Address:</label>
                    <input type="text" class="form-control" id="first" name='address' required>
                    <label for="email">City:</label>
                    <input type="text" class="form-control" id="email" name='city' required>
                </div>


                <div class="col-md-6 ">
                    <label for="last">Mobile Number:</label>
                    <input type="text" class="form-control" id="last" name='mobilenum' required>
                </div>
            </div>
        </div>
        <hr>
        @endguest

        <div class="row my-3">
            <div class="col">
                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" required>
                <label for="vehicle1"> I accept <a href="" data-toggle="modal" data-target="#rpm">Reservation Policies</a> </label><br>
                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" required>
                <label for="vehicle2"> I have read and accept the <a href="" data-toggle="modal" data-target="#hpm">Hotel Policies</a>
                </label><br>
            </div>
        </div>




        <div class="row pb-5  text-center">

            <div class="col">
                <div id="forms">
                    <a href="modifyreservation.php" input type="button" id="backmod" class="btn btn-outline-dark fw-bold"> Back </a>
                    <!-- {{-- <form action="/bookinfo" method="post">
                    <input type="text" name='review' value='review' hidden>
                    <button type="submit"  name="review" class="btn btn-primary"> Review Reservation </button>
                </form> --}} -->
                    <button onclick="checkbox()" type="submit" name="checkout" class="btn btn-outline-dark fw-bold">
                        Proceed </button>
                </div>
            </div>
        </div>

    </div>

</form>

<!-- Modal Policies -->
<div class="modal fade" id="rpm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Reservation Policies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container">
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Reservation Policy</h4>
                        <p style="font-size:110%"> - Reservations must be guaranteed via a credit card payment during reservation. After booking, an email will be sent to the guest containing their invoice and reservation number to be used during arrival </p>
                        <p style="font-size:110%"> - Guests are required to be 18 and above and must present a valid or government issued id(Passport,Drivers License. Etc) </p>


                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Modification Policy </h4>
                        <p style="font-size:110%"> - Modification to your reservation must be done 24 hour before arrival, modification requests done after this time will be not accepted </p>
                        <p style="font-size:110%"> - Guest without an account will not be able to update their payment information during modification</p>
                        <p style="font-size:110%"> - Depending on the updated reservation, guests will be refunded or charged accordingly depending on their selected rate/rooms</p>


                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Cancellation Policy </h4>
                        <p style="font-size:110%"> - Cancellations done 24 hours prior to arrival will result in a full refund of reservation, failing to do so will not result in a refund. </p>
                        <p style="font-size:110%"> - Guests who want to appeal for refund can call the hotel directly or send an appeal through the cancellation tab. </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="hpm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Reservation Policies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container">
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Check-In Time and Check-Out Time </h4>
                        <p style="font-size:110%"> - Check-in times are from 13:00 to 16:00 early check-ins are available depending on room availability / Check-out time 12:00 </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Check-In Requirements </h4>
                        <p style="font-size:110%"> - Guests must be 18 or older to Check-In and must provide a government issued id or valid for verification of their reservation. (Driver's License, passport,etc) </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Early Departures </h4>
                        <p style="font-size:110%"> - Notify the desk for early departures. </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Special Requests </h4>
                        <p style="font-size:110%"> - We will try our best to make effort to honor a guest special requests. However the avaiability of items requested cannot be guaranteed in advance </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Deposits and Guarantees </h4>
                        <p style="font-size:110%"> - All reservations require deposits of 50% percent of the total charge for your stay. After this process your reservation is guaranteed and will be on hold until your arrival date. </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            No Show Charges</h4>
                        <p style="font-size:110%"> - Failure to check or notify the hotel in advance will result in a one night charge fee. Full one night plus the taxes and fees and reservations will be cancelled </p>
                    </div>
                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            Group Reservations </h4>
                        <p style="font-size:110%"> - Please contact the hotel directly for Group Reservations. </p>
                    </div>

                    <div class="row mx-5 py-3">
                        <h4 class="fw-bold"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                            What we Collect </h4>
                        <p style="font-size:110%"> - The information provided to us may provide us with various information that personally identifies you. We collect personal information used for reservation and payment methods used by our guests. </p>
                        <p style="font-size:110%"> - The information we collect will only be held by our hotel and may be used to improve our products and services. </p>
                        <p style="font-size:110%"> - We will not share you information with third parties. </p>


                    </div>

                </div>

            </div>

        </div>
    </div>
</div>




<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });

    function checkbox() {
        var x = document.getElementById("vehicle1").required;
        var y = document.getElementById("vehicle2").required;
    }
</script>

@endsection