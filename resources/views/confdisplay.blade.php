@extends('layouts.app')

@section('content')

<p>Booked Successfully!</p>
<p>Reservation Number: {{session('confirmation_number')}}</p>
<p>do take note chuchu</p>
<p>total price: PHP {{number_format(session('overallprice'), 2)}}</p>
<p>downpayment: PHP {{number_format(session('overallprice') * 0.5, 2)}}</p>

@endsection
