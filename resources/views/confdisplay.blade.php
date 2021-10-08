@extends('layouts.app')

@section('content')

<p>Booked Successfully!</p>
<p>Reservation Number: {{session('confirmation_number')}}</p>
<p>do take note chuchu</p>
<p>total price: {{session('totalprice')}}</p>
<p>downpayment: {{session('downpayment')}}</p>

@endsection
