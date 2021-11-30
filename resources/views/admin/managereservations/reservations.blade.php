@extends('admin/adminframe')


@section('content')
    @php
    $total = 0;
    $total2 = 0;
    $total3 = 0;
    $totalnopromo = 0;
    $totalnopromo2 = 0;
    $totalnopromo3 = 0;
    @endphp

    <div class="container-fluid px-4">

        <div class="card my-5">
            <div class="card-header">

                <h2>Reservations </h2>
            </div>
            <div class="card-body">
                @if (isset($_GET['success']))
                    <p class="alert alert-success">{{ $_GET['success'] }}</p>
                @endif
                <table id="datatablerr">
                    <thead>
                        <tr class="text-light bg-dark">
                            <th>Reservation Number</th>
                            <th>Arrival Date</th>
                            <th>Departure Date</th>
                            <th>Guest Name</th>
                            <th>Room/s Selected</th>
                            <th>Booked At</th>
                            <th>Promotion Applied</th>
                            <th>Status</th>
                            <th>Adult</th>
                            <th>Children</th>
                            <th>Payment Type</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>

                                <td>{{ $reservation->confirmation_number }}</td>
                                <td>{{ date('m/d/Y', strtotime($reservation->arrival_date)) }}</td>
                                <td>{{ date('m/d/Y', strtotime($reservation->departure_date)) }}</td>
                                <td>
                                    @if ($reservation->first_name == null || $reservation->first_name == '')
                                        @php
                                            $name = DB::table('reservation_tables')
                                                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                                                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                                                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                                                // ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                                                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                                                ->where('reservation_tables.confirmation_number', $reservation->confirmation_number)
                                                ->first();
                                        @endphp
                                        {{ $name->first_name }} {{ $name->last_name }}
                                    @else
                                        {{ $reservation->first_name }} {{ $reservation->last_name }}
                                    @endif
                                </td>
                                <td>@php
                                    $room2 = DB::table('reservation_tables')
                                        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                                        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id2', '=', 'hc1.id')
                                        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                                        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                                        ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                                        ->where('reservation_tables.confirmation_number', $reservation->confirmation_number)
                                        ->first();
                                    $room3 = DB::table('reservation_tables')
                                        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                                        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id3', '=', 'hc1.id')
                                        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                                        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                                        ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                                        ->where('reservation_tables.confirmation_number', $reservation->confirmation_number)
                                        ->first();
                                @endphp
                                    @if ($reservation->room_suite_name !== null)
                                        {{ $reservation->room_suite_name }}
                                    @endif
                                    @if ($reservation->r2 != '')
                                        @if ($reservation->room_suite_name !== null)
                                            , {{ $room2->room_suite_name }}
                                        @else
                                            {{ $room2->room_suite_name }}
                                        @endif

                                    @endif
                                    @if ($reservation->r3 != '')
                                        @if ($reservation->room_suite_name !== null || $room2->room_suite_name !== null)
                                            , {{ $room3->room_suite_name }}
                                        @else
                                            {{ $room3->room_suite_name }}
                                        @endif

                                    @endif

                                    {{-- {{$reservation->guest_code}} --}}
                                </td>
                                @php
                                    if ($reservation->r1 == '') {
                                        $roomadult = 0;
                                        $roomchild = 0;
                                    } else {
                                        $roomadult = $reservation->adult;
                                        $roomchild = $reservation->child;
                                    }


                                    if ($reservation->r2 == '') {
                                        $roomadult2 = 0;
                                        $roomchild2 = 0;
                                    } else {
                                        $roomadult2 = $room2->adult;
                                        $roomchild2 = $room2->child;
                                    }

                                    if ($reservation->r3 == '') {
                                        $roomadult3 = 0;
                                        $roomchild3 = 0;
                                    } else {
                                        $roomadult3 = $room3->adult;
                                        $roomchild3 = $room3->child;
                                    }

                                @endphp
                                <td>{{ $reservation->Booked_at }}</td>
                                <td>{{ $reservation->promotion_code }}</td>
                                <td>{{ number_format($reservation->ctotal_price / 2, 2) }}</td>
                                <td>{{ $roomadult + $roomadult2 + $roomadult3 }}</td>
                                <td>{{ $roomchild + $roomchild2 + $roomchild3 }}</td>
                                <td>
                                    @if ($reservation->first_name == null || $reservation->first_name == '')
                                        @php
                                            $name = DB::table('reservation_tables')
                                                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                                                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                                                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                                                // ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                                                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                                                ->where('reservation_tables.confirmation_number', $reservation->confirmation_number)
                                                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                                                ->first();
                                        @endphp
                                        {{ $name->payment_type }}
                                    @else
                                        {{ $reservation->payment_type }}
                                    @endif
                                </td>

                                <td>
                                    <form action="/admin/reservation" method="post">
                                        @csrf
                                        <input type="text" name='deletereservation'
                                            value='{{ $reservation->confirmation_number }}' hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="/admin/reservation" method="post">
                                        @csrf
                                        <input type="text" name='editreservation'
                                            value='{{ $reservation->confirmation_number }}' hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-pen"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif

        @if (isset($editreserve))
            <form action="/admin/reservation" class="p-5" method="POST">
                <div class="card my-5 " id="edit">
                    <div class="card-body">

                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <label for="inputreservationumber"><b>Reservation Number</b></label>
                                    <input type="text" class="form-control" id="reservationumber"
                                        placeholder="Enter Reservation Number" name="confirmation_number"
                                        value="{{ $room->confirmation_number }}" disabled>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="arrivalinput"><b>Arrival Date</b></label>
                                    <input type="date" class="form-control" id="arrivalinput" name="CheckIn"
                                        value="{{ $room->arrival_date }}">
                                </div>
                                <div class="col">
                                    <label for="departureinput"><b>Departure Date</b></label>
                                    <input type="date" class="form-control" id="departureinput" name="CheckOut"
                                        value="{{ $room->departure_date }}">
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="promotioncode"><b>Promotion Code</b></label>
                                    <input type="number" class="form-control" id="promotioncode"
                                        placeholder="Enter Promotion Code" name="PromoCode"
                                        value="{{ $room->promotion_code }}">
                                </div>

                            </div>

                            <input type="text" name="updatereservation" value="updatereservation" hidden>
                            <input type="text" name="confirmation_number" value="{{ $room->confirmation_number }}"
                                hidden>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </fieldset>


                    </div>
                </div>

                <div class="card my-5 ">
                    <div class="row p-3">
                        <h4>Reservation Number: {{ $room->confirmation_number }}</h4>
                        <p>Nights:
                            {{ $nights = (new DateTime(date('Y-m-d', strtotime($room->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($room->departure_date))))->days }}
                        </p>


                        @if ($room->r1 != '' || $room->r1 != null)
                            <div class="col">

                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 1</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $room->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $room->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $room->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $room->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $room->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $room->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $room->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $room->city_tax, 2) }}</li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($room->promotion_code != '' || $room->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $room->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $room->base_discount, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Total :</b>
                                        {{ number_format($total = ($subtotal - ($rate_discount + $promo)) * $nights, 2) }}
                                        @php
                                            $totalnopromo = $subtotal - $rate_discount;
                                        @endphp
                                    </li>
                                </ul>

                            </div>
                        @endif

                        @if ($room->r2 != '' || $room->r2 != null)
                            <div class="col">
                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 2</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $roominfo2->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $roominfo2->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $roominfo2->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $roominfo2->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $roominfo2->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $roominfo2->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $roominfo2->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $roominfo2->city_tax, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($room->promotion_code != '' || $room->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $room->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $roominfo2->base_discount, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Total :</b>
                                        {{ number_format($total2 = ($subtotal - ($rate_discount + $promo)) * $nights, 2) }}
                                        @php
                                            $totalnopromo2 = $subtotal - $rate_discount;
                                        @endphp
                                    </li>
                                </ul>

                            </div>
                        @endif

                        @if ($room->r3 != '' || $room->r3 != null)
                            <div class="col">
                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 3</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $roominfo3->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $roominfo3->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $roominfo3->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $roominfo3->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $roominfo3->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $roominfo3->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $roominfo3->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $roominfo3->city_tax, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($room->promotion_code != '' || $room->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $room->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $roominfo3->base_discount, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Total :</b>
                                        {{ number_format($total3 = ($subtotal - ($rate_discount + $promo)) * $nights, 2) }}
                                        @php
                                            $totalnopromo3 = $subtotal - $rate_discount;
                                        @endphp
                                    </li>
                                </ul>

                            </div>
                        @endif
                        <div class="row mx-5">
                            <h5><b>To pay: </b> {{ number_format(($total + $total2 + $total3) / 2, 2) }}</h5>
                            <h5><b>Total: </b> {{ number_format($total + $total2 + $total3, 2) }}</h5>
                        </div>


                    </div>

                </div>

                {{-- <input type="text" name="totalsubtotal" value="{{$totalnopromo}}" hidden>
                <input type="text" name="totalsubtotal2" value="{{$totalnopromo2}}" hidden>
                <input type="text" name="totalsubtotal3" value="{{$totalnopromo3}}" hidden> --}}
            </form>
        @endif
    </div>

@endsection
