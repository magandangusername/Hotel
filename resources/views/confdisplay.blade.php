@extends('layouts.app')

@section('content')

{{-- @if (session()->exists('confirmation_number')) --}}


<p>Booked Successfully! Welcome to Mondstadt!</p>
<p>Reservation Number: {{session('confirmation_number')}}</p>
<p>total price: PHP {{number_format(session('overallprice'), 2)}}</p>
<p>downpayment: PHP {{number_format(session('overallprice') * 0.5, 2)}}</p>
<p>Follow Up Payment: PHP {{number_format(session('overallprice') * 0.5, 2)}}</p>

<hr>

<p>- Proceed to the desk after arrival</p>
<p>- Present your Reservation Number and Valid Id to confirm your identity </p>
<p>- After confirming your reservation please provide the follow up payment </p>

<p> ************************************** </p>
<h5>Cancellation Policy</h5>
<hr>
<p> Cancellation must be done 48 hours prior to your arrival doing so will not result of any charge </p>
<p> Cancellation after the given duration or failing to show will cause a one night fee via your Payment Method </p>


{{--
@else

<h1>An error occured reloading the page.</h1>

@endif
@php
    Session::forget([
            'CheckIn',
            'CheckOut',
            'RoomCount',
            'AdultCount',
            'ChildCount',
            'PromoCode',
            'room',
            'roomchecker',
            'roomchecker2',
            'roomtype2',
            'ratetype2',
            'bedcheckerq',
            'bedcheckerk',
            'roomtype',
            'ratetype',
            'bed',
            'totalrate',
            'overallprice',
            'success',
            'confirmation_number'
        ]);
@endphp --}}
@endsection
