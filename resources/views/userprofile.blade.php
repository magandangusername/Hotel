@extends('layouts.app')

@section('content')


    <div class="container pt-5">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-items-center text-center">
                                <img src="" alt="" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4 class="fw-bold">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}
                                    </h4>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex  align-items-center ">
                                <p> Active Reservation: {{ $active_reservation }} </p>

                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <p> Last Reservation: N/A </p>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('updateprofile') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($update) && $update)
                                            <input placeholder="First Name" type="text" name="first_name"
                                                value="{{ Auth::user()->first_name }}">
                                            <input placeholder="Last Name" type="text" name="last_name"
                                                value="{{ Auth::user()->last_name }}">
                                        @else
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($update) && $update)
                                            <input placeholder="email" type="email" name="email"
                                                value="{{ Auth::user()->email }}">
                                        @else
                                            {{ Auth::user()->email }}
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($update) && $update)
                                            <input placeholder="Phone" type="text" name="mobile_num"
                                                value="{{ Auth::user()->mobile_num }}">
                                        @else
                                            {{ Auth::user()->mobile_num }}
                                        @endif
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($update) && $update)
                                            <input placeholder="address" type="text" name="address"
                                                value="{{ Auth::user()->address }}">
                                        @else
                                            {{ Auth::user()->address }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (isset($update) && $update)
                                            <input type="text" name="updateprofile" value="updateprofile" hidden>
                                            <button class="btn btn-outline-dark fw-bold" type="submit">update</button>
                                        @else
                                            <input type="text" name="editprofile" value="editprofile" hidden>
                                            <button class="btn btn-outline-dark fw-bold" type="submit">Edit</button>
                                        @endif



                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (Auth::user()->payment_code == null || Auth::user()->payment_code == '')
                        @if (isset($addpayment) && $addpayment)
                            <form role="form" action="" method="post" class="require-validation" data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                @csrf
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Name on Card</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input placeholder="Card Holder Name" type="text" name="card_holder_name"
                                                    value="{{ $profile->card_holder_name }}">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Card Brand</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{-- @if (isset($update) && $update)
                                                        <input placeholder="Payment Type" type="text" name="payment_type" value="{{ $profile->payment_type }}">
                                                    @else --}}
                                                {{ $profile->payment_type }}
                                                {{-- @endif --}}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Card Number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input onkeypress='return formats(this,event)' onkeyup="return numberValidation(event)" class="card-number" placeholder="Card Number" type="text"
                                                    name="card_number" value="{{ $profile->card_number }}">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">CVC</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="card-cvc" placeholder="CVC" type="text" name="cvc"
                                                    value="{{ $profile->cvc }}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Expiration</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="card-expiry-month" placeholder="Expiration Month" type="text"
                                                    name="expiration_month" value="{{ $profile->expiration_month }}">/
                                                <input class="card-expiry-year" placeholder="Expiration Year" type="text"
                                                    name="expiration_year" value="{{ $profile->expiration_year }}">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="submitpayment" value="submitpayment" hidden>
                                                <button class="btn btn-outline-dark fw-bold" type="submit">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        @else
                            <form action="" method="post">
                                @csrf
                                <div class="col-sm-12">
                                    <input type="text" name="addpayment" value="addpayment" hidden>
                                    <button class="btn btn-outline-dark fw-bold" type="submit">Add Payment Method</button>
                                </div>
                            </form>
                        @endif
                    @else

                        @if (isset($updatepayment) && $updatepayment)
                            <form role="form" action="" method="post" class="require-validation" data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @else
                                <form action="" method="post">

                        @endif
                        @csrf
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Name on Card</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($updatepayment) && $updatepayment)
                                            <input placeholder="Card Holder Name" type="text" name="card_holder_name"
                                                value="{{ $profile->card_holder_name }}">
                                        @else
                                            {{ $profile->card_holder_name }}
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Card Brand</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{-- @if (isset($update) && $update)
                                                <input placeholder="Payment Type" type="text" name="payment_type" value="{{ $profile->payment_type }}">
                                            @else --}}
                                        {{ $profile->payment_type }}
                                        {{-- @endif --}}

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Card Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">

                                        @if (isset($updatepayment) && $updatepayment)
                                            <input onkeypress='return formats(this,event)' onkeyup="return numberValidation(event)" class="card-number" placeholder="Card Number" type="text"
                                                name="card_number" value="{{ $profile->card_number }}">
                                        @else
                                            {{ substr_replace($profile->card_number, '**** **** **** ', 0, -4) }}
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">CVC</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($updatepayment) && $updatepayment)
                                            <input class="card-cvc" placeholder="CVC" type="text" name="cvc"
                                                value="">
                                        @else
                                            ***
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Expiration</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if (isset($updatepayment) && $updatepayment)
                                            <input class="card-expiry-month" placeholder="Expiration Month" type="text"
                                                name="expiration_month" value="{{ $profile->expiration_month }}">/
                                            <input class="card-expiry-year" placeholder="Expiration Year" type="text"
                                                name="expiration_year" value="{{ $profile->expiration_year }}">
                                        @else
                                            {{ $profile->expiration_month }}/{{ $profile->expiration_year }}
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                       <div class='alert text-danger'>
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (isset($updatepayment) && $updatepayment)
                                            <input type="text" name="updatepayment" value="updatepayment" hidden>
                                            <button class="btn btn-outline-dark fw-bold" type="submit">update</button>
                                        @else
                                            <input type="text" name="editpayment" value="editpayment" hidden>
                                            <button class="btn btn-outline-dark fw-bold" type="submit">Change</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>

                    @endif



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


        function formats(ele,e){
        if(ele.value.length<19){
          ele.value= ele.value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
          return true;
        }else{
          return false;
        }
      }

      function numberValidation(e){
        e.target.value = e.target.value.replace(/[^\d ]/g,'');
        return false;
      }
    </script>


@endsection
