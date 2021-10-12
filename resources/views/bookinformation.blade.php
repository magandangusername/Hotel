@extends('layouts.app')

@section('content')

<style type="text/css">
    .panel-title {
    display: inline;
    font-weight: bold;
    }
    .display-table {
    display: table;
    }
    .display-tr {
    display: table-row;
    }
    .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 61%;
    }
 </style>

<section id="forms">
    <div class="checkout">
        <div class="titlecheck">
            <a href="modifyreservation.php" input type="button" id="backmod" class="btn btn-primary"> Back </a>
            <h1 class="modifhye">Checkout</h1>
        </div>
    </div>
</section>

<section id="usereditss">
    <div class="containerchecks">
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
</section>
<form action="bookinfo" method="post" class="require-validation"
data-cc-on-file="false"
data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
id="payment-form">
    @csrf
    <div class="containercheckuser">
        <div class="titlechecks">
            <div class="row g-3" id="whitey">
                @guest


                <h1 class="personals">Personal Information</h1>
                <section id="wowo">
                    <div class="form-group form-inline">
                        <label>Title</label>
                        <select name="name_with_initials" id="" required>
                            <option selected="selected" value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>


                    <div class="col-md-5 ">
                        <label for="first"> First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="fn" required>
                    </div>

                    <div class="col-md-5 ">
                        <label for="last">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="ln" required>
                    </div>


                    <div class="col-md-5 ">
                        <label for="email">Email Address:</label>
                        <input type="text" class="form-control-plaintext" id="firste" name="email" required>
                    </div>


                    <div class="col-md-5 ">
                        <label for="reemail">Re-Type Email Address:</label>
                        <input type="text" class="form-control-plaintext" id="firste" required>
                    </div>

                </section>
                <hr />
                <section id="wowo1">
                    <h1 class="personals">Address</h1>

                    <div class="col-md-6  ">
                        <label for="first"> Address:</label>
                        <input type="text" class="form-control-plaintext" id="first" name='address' required>
                    </div>
                    <div class="col-md-5  ">
                        <label for="email">City:</label>
                        <input type="text" class="form-control" id="email" name='city' required>
                    </div>


                    <div class="col-md-6 ">
                        <label for="last">Mobile Number:</label>
                        <input type="text" class="form-control" id="last" name='mobilenum' required>
                    </div>
                </section>

                @endguest




                <div class="container">
                    {{-- <h1>Stripe Payment Page - HackTheStuff</h1> --}}
                    <div class="row">
                       <div class="col-md-6 col-md-offset-3">
                          <div class="panel panel-default credit-card-box">
                             {{-- <div class="panel-heading display-table" >
                                <div class="row display-tr" > --}}
                                   <h3 class="panel-title display-td" >Payment Details</h3>
                                   {{-- <div class="display-td" >
                                      <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                   </div>
                                </div>
                             </div> --}}
                             <div class="panel-body">
                                @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                   <p>{{ Session::get('success') }}</p>
                                </div>
                                @endif
                                {{-- <form
                                   role="form"
                                   action="{{ route('stripe.post') }}"
                                   method="post"
                                   class="require-validation"
                                   data-cc-on-file="false"
                                   data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                   id="payment-form"> --}}
                                   @csrf
                                   <div class='form-row row'>
                                      <div class='col-xs-12 form-group required'>
                                         <label class='control-label'>Name on Card</label> <input
                                            class='form-control' size='4' type='text' value="pp">
                                      </div>
                                   </div>
                                   <div class='form-row row'>
                                      <div class='col-xs-12 form-group card required'>
                                         <label class='control-label'>Card Number</label> <input
                                            autocomplete='off' class='form-control card-number' size='20'
                                            type='text' value="4242424242424242">
                                      </div>
                                   </div>
                                   <div class='form-row row'>
                                      <div class='col-xs-12 col-md-4 form-group cvc required'>
                                         <label class='control-label'>CVC</label> <input autocomplete='off'
                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                            type='text' value="123">
                                      </div>
                                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                                         <label class='control-label'>Expiration Month</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text' value="12">
                                      </div>
                                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                                         <label class='control-label'>Expiration Year</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text' value="22">
                                      </div>
                                   </div>
                                   <div class='form-row row'>
                                      <div class='col-md-12 error form-group hide'>
                                         <div class='alert-danger alert'>Please correct the errors and try
                                            again.
                                         </div>
                                      </div>
                                   </div>
                                   {{-- <div class="row">
                                      <div class="col-xs-12">
                                         <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                                      </div>
                                   </div> --}}
                                {{-- </form> --}}
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>



            </div>
        </div>












    </div>

    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" required>
    <label for="vehicle1"> I have a pen</label><br>
    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" required>
    <label for="vehicle2"> I have pineapple</label><br>


    <section id="twobutt">


        <div class="row ">
            <div class="buttwo">
                <button type="submit"  name="review" class="btn btn-primary"> Review Reservation </button>
                <button onclick="checkbox()" type="submit"  name="checkout" class="btn btn-primary"> Proceed to payment </button>
            </div>
        </div>

    </section>
</form>



<!--
SKYE GAWA KA EMAIL RETYPE VALIDATION!!!!!!!!!!!!!!!!!!!!!!

-->

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
