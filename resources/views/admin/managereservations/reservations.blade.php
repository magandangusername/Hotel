@extends('admin/adminframe')


@section('content')

    <div class="container-fluid px-4">

        <div class="card my-5">
            <div class="card-header">

                <h2>Reservations </h2>
            </div>
            <div class="card-body">
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
                                    @if ($room2->room_suite_name !== null)
                                        @if ($reservation->room_suite_name !== null)
                                            , {{ $room2->room_suite_name }}
                                        @else
                                            {{ $room2->room_suite_name }}
                                        @endif

                                    @endif
                                    @if ($room3->room_suite_name !== null)
                                        @if ($reservation->room_suite_name !== null || $room2->room_suite_name !== null)
                                            , {{ $room3->room_suite_name }}
                                        @else
                                            {{ $room3->room_suite_name }}
                                        @endif

                                    @endif

                                    {{-- {{$reservation->guest_code}} --}}
                                </td>
                                <td>{{ $reservation->Booked_at }}</td>
                                <td>{{ $reservation->promotion_code }}</td>
                                <td>{{ number_format($reservation->ctotal_price / 2, 2) }}</td>
                                <td>{{ $reservation->adult + $room2->adult + $room3->adult }}</td>
                                <td>{{ $reservation->child + $room2->child + $room3->child }}</td>
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
                                    <form action="" method="post">
                                        @csrf
                                        <input type="text" name='deletereservation'
                                            value='{{ $reservation->confirmation_number }}' hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="" method="post">
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

        @if (isset($editreserve))
            <div class="card my-5 " id="edit">
                <div class="card-body">
                    <form class="p-5" method="POST">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <label for="inputreservationumber"><b>Reservation Number</b></label>
                                    <input type="text" class="form-control" id="reservationumber"
                                        placeholder="Enter Reservation Number" name="confirmation_number" value="{{$room->confirmation_number}}" disabled>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="arrivalinput"><b>Arrival Date</b></label>
                                    <input type="date" class="form-control" id="arrivalinput" name="arrival_date" value="{{$room->arrival_date}}">
                                </div>
                                <div class="col">
                                    <label for="departureinput"><b>Departure Date</b></label>
                                    <input type="date" class="form-control" id="departureinput" name="departure_date" value="{{$room->departure_date}}">
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="promotioncode"><b>Promotion Code</b></label>
                                    <input type="number" class="form-control" id="promotioncode"
                                        placeholder="Enter Promotion Code" name="promotion_code" value="{{$room->promotion_code}}">
                                </div>

                            </div>
                            <input type="text" name="updatereservation" value="updatereservation" hidden>
                            <input type="text" name="confirmation_number" value="{{$room->confirmation_number}}" hidden>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </fieldset>
                    </form>

                </div>
            </div>

            <div class="card my-5 ">
                <div class="row p-3">
                    <h4>Reservation Number: {{$room->confirmation_number}}</h4>
                    <p>Nights: 5</p>
                    <div class="col">

                        <ul class="list-group my-4">
                            <li class="list-group-item bg-dark text-light">
                                <h5>Room 1</h5>
                            </li>
                            <li class="list-group-item"><b>Rate:</b> {{$room->rate_name}}</li>
                            <li class="list-group-item"><b>Adult:</b> 5</li>
                            <li class="list-group-item"><b>Children:</b> 3</li>
                            <li class="list-group-item"><b>Room Charge:</b> 19,000</li>
                            <li class="list-group-item"><b>Vat:</b> 20</li>
                            <li class="list-group-item"><b>Service:</b> 30</li>
                            <li class="list-group-item"><b>City Tax:</b> 50</li>
                            <li class="list-group-item"><b>Subtotal :</b> 20</li>
                            <li class="list-group-item"><b>Promotion Discount:</b> -20k</li>
                            <li class="list-group-item"><b>Rate Discount:</b> -10k</li>
                            <li class="list-group-item"><b>Total :</b> 10,000</li>
                        </ul>

                    </div>

                    <div class="col">
                        <ul class="list-group my-4">
                            <li class="list-group-item bg-dark text-light">
                                <h5>Room 2</h5>
                            </li>
                            <li class="list-group-item"><b>Rate:</b> John Mark</li>
                            <li class="list-group-item"><b>Adult:</b> 5</li>
                            <li class="list-group-item"><b>Children:</b> 3</li>
                            <li class="list-group-item"><b>Room Charge:</b> 19,000</li>
                            <li class="list-group-item"><b>Vat:</b> 20</li>
                            <li class="list-group-item"><b>Service:</b> 30</li>
                            <li class="list-group-item"><b>City Tax:</b> 50</li>
                            <li class="list-group-item"><b>Subtotal :</b> 20</li>
                            <li class="list-group-item"><b>Promotion Discount:</b> -20k</li>
                            <li class="list-group-item"><b>Rate Discount:</b> -10k</li>
                            <li class="list-group-item"><b>Total :</b> 10,000</li>
                        </ul>

                    </div>

                    <div class="col">
                        <ul class="list-group my-4">
                            <li class="list-group-item bg-dark text-light">
                                <h5>Room 3</h5>
                            </li>
                            <li class="list-group-item"><b>Rate:</b> John Mark</li>
                            <li class="list-group-item"><b>Adult:</b> 5</li>
                            <li class="list-group-item"><b>Children:</b> 3</li>
                            <li class="list-group-item"><b>Room Charge:</b> 19,000</li>
                            <li class="list-group-item"><b>Vat:</b> 20</li>
                            <li class="list-group-item"><b>Service:</b> 30</li>
                            <li class="list-group-item"><b>City Tax:</b> 50</li>
                            <li class="list-group-item"><b>Subtotal :</b> 20</li>
                            <li class="list-group-item"><b>Promotion Discount:</b> -20k</li>
                            <li class="list-group-item"><b>Rate Discount:</b> -10k</li>
                            <li class="list-group-item"><b>Total :</b> 10,000</li>
                        </ul>

                    </div>
                    <div class="row mx-5">
                        <h5><b>To pay: </b> 5,000 PHP</h5>
                        <h5><b>Total: </b> 10,000 PHP</h5>
                    </div>


                </div>

            </div>

    </div>
    @endif

@endsection
