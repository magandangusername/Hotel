@extends('layouts.app')

@section('content')



    <div class="container">
    <h1 class="text-center fw-bold pt-5">Checkout</h1>

        <div class="row g-2 justify-content-center">

            <div class="col-auto">
                <p class="label">Your Stay: {{ date('M d, Y', strtotime(session('CheckIn'))) . ' - ' . date('M d, Y', strtotime(session('CheckOut'))) }}</p>
            </div>
            <div class="col-auto" hidden>
                <p class="label vertical">adult</p>
            </div>
            <div class="col-auto" hidden>
                <p class="label">children</p>
            </div>
            <div class="col-auto">
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

            <div class ="row my-3">
                <div class="col">
                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" required>
                <label for="vehicle1"> I accept <a href="">terms and conditions </a> </label><br>
                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" required>
                <label for="vehicle2"> I have read and accept the <a href="">Privacy and Cancellation Policies</a>  </label><br>
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
                <button onclick="checkbox()" type="submit"  name="checkout" class="btn btn-outline-dark fw-bold"> Proceed </button>
            </div>
        </div>
    </div>

    </div>








</form>



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
