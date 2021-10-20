@extends('layouts.app')

@section('content')

{{-- @if (session()->exists('confirmation_number')) --}}


<p>Booked Successfully!</p>
<p>Reservation Number: {{session('confirmation_number')}}</p>
<p>do take note chuchu</p>
<p>total price: PHP {{number_format(session('overallprice'), 2)}}</p>
<p>downpayment: PHP {{number_format(session('overallprice') * 0.5, 2)}}</p>
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
