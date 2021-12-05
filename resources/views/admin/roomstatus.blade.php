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

    <main>
        <div class="container-fluid px-4">

            <div class="card my-5">
                <div class="card-header">

                    <h2>Past Reservations </h2>
                </div>
                <div class="card-body">
                    <table id="datatablerr">
                        <thead>
                            <tr class="text-light bg-dark">
                                <th>Room Number</th>
                                <th>Status</th>
                                <th>Reservation Number</th>
                                <th>Room/Suite Name</th>
                                <th>Bed</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($statuses as $status)


                                <tr>
                                    <td>{{ $status->room_number }}</td>
                                    <td>{{ $status->status }}</td>
                                    <td>{{ $status->confirmation_number }}</td>
                                    <td>{{ $status->room_suite_name }}</td>
                                    <td>{{ $status->room_suite_bed }}</td>

                                    @if ($status->status == 1)
                                        <td>
                                            <form action="{{route('editroomstatus')}}" method="post">
                                                @csrf
                                                <input type="text" name='editroomstatus'
                                                    value='{{ $status->confirmation_number }}' hidden>
                                                <input type="text" name='roomnumber'
                                                    value='{{ $status->room_number }}' hidden>
                                                <button class="btn btn-outline-dark" type="submit"><i
                                                        class="fas fa-pen"></i></button>
                                            </form>
                                        </td>

                                    @endif


                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
        @if (isset($editstatus))
            <form action="{{route('editroomstatus')}}" class="p-5" method="POST">
                <div class="card my-5 " id="edit">
                    <div class="card-body">

                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <label for="inputreservationumber"><b>Reservation Number</b></label>
                                    <input type="text" class="form-control" id="reservationumber"
                                        placeholder="Enter Reservation Number" name="confirmation_number"
                                        value="{{ $editstatus->confirmation_number }}" disabled>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="arrivalinput"><b>Arrival Date</b></label>
                                    <input type="date" class="form-control" id="arrivalinput" name="CheckIn"
                                        value="{{ $editstatus->arrival_date }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="departureinput"><b>Departure Date</b></label>
                                    <input type="date" class="form-control" id="departureinput" name="CheckOut"
                                        value="{{ $editstatus->departure_date }}" disabled>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="promotioncode"><b>Promotion Code</b></label>
                                    <input type="number" class="form-control" id="promotioncode"
                                        placeholder="Enter Promotion Code" name="PromoCode"
                                        value="{{ $editstatus->promotion_code }}" disabled>
                                </div>

                            </div>


                        </fieldset>


                    </div>
                </div>

                <div class="card my-5 ">
                    <div class="row p-3">
                        <h4>Reservation Number: {{ $editstatus->confirmation_number }}</h4>
                        <p>Nights:
                            {{ $nights = (new DateTime(date('Y-m-d', strtotime($editstatus->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($editstatus->departure_date))))->days }}
                        </p>


                        @if ($roomnum == 1)
                            <div class="col">

                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 1</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $editstatus->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $editstatus->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $editstatus->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $editstatus->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $editstatus->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $editstatus->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $editstatus->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $editstatus->city_tax, 2) }}</li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($editstatus->promotion_code != '' || $editstatus->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $editstatus->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $editstatus->base_discount, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Total :</b>
                                        {{ number_format($total = ($subtotal - ($rate_discount + $promo)) * $nights, 2) }}
                                        @php
                                            $totalnopromo = $subtotal - $rate_discount;
                                        @endphp
                                    </li>
                                </ul>

                            </div>
                        @elseif ($roomnum == 2)
                            <div class="col">
                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 2</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $editstatus->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $editstatus->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $editstatus->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $editstatus->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $editstatus->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $editstatus->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $editstatus->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $editstatus->city_tax, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($editstatus->promotion_code != '' || $editstatus->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $editstatus->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $editstatus->base_discount, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Total :</b>
                                        {{ number_format($total2 = ($subtotal - ($rate_discount + $promo)) * $nights, 2) }}
                                        @php
                                            $totalnopromo2 = $subtotal - $rate_discount;
                                        @endphp
                                    </li>
                                </ul>

                            </div>
                        @elseif ($roomnum == 3)
                            <div class="col">
                                <ul class="list-group my-4">
                                    <li class="list-group-item bg-dark text-light">
                                        <h5>Room 3</h5>
                                    </li>
                                    <li class="list-group-item"><b>Rate:</b> {{ $editstatus->rate_name }}</li>
                                    <li class="list-group-item"><b>Adult:</b> {{ $editstatus->adult }}</li>
                                    <li class="list-group-item"><b>Children:</b> {{ $editstatus->child }}</li>
                                    <li class="list-group-item"><b>Room Charge:</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $editstatus->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $editstatus->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</li>
                                    <li class="list-group-item"><b>Vat:</b>
                                        {{ number_format($vat = $price->base_price * $editstatus->vat, 2) }}</li>
                                    <li class="list-group-item"><b>Service:</b>
                                        {{ number_format($service_charge = $price->base_price * $editstatus->service_rate, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>City Tax:</b>
                                        {{ number_format($city_tax = $price->base_price * $editstatus->city_tax, 2) }}
                                    </li>
                                    <li class="list-group-item"><b>Subtotal :</b>
                                        {{ number_format($subtotal = $price->base_price + $vat + $service_charge + $city_tax, 2) }}
                                    </li>
                                    @php
                                        if ($editstatus->promotion_code != '' || $editstatus->promotion_code != null) {
                                            $promodiscount = DB::table('promotion_descriptions')
                                                ->where('promotion_code', $editstatus->promotion_code)
                                                ->first();
                                            $promodiscount = $promodiscount->overall_cut;
                                        } else {
                                            $promodiscount = 0;
                                        }
                                    @endphp
                                    <li class="list-group-item"><b>Promotion Discount:</b>
                                        -{{ number_format($promo = $price->base_price * $promodiscount, 2) }}</li>
                                    <li class="list-group-item"><b>Rate Discount:</b>
                                        -{{ number_format($rate_discount = $price->base_price * $editstatus->base_discount, 2) }}
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

                <select name="room" >
                    @foreach ($rooms as $room)
                        <option value="{{$room->room_number}}">{{$room->room_number}}</option>
                    @endforeach

                </select>
                <input type="text" name="roomnum" value="{{$roomnum}}" hidden>
                <input type="text" name="updateroom" value="{{$editstatus->room_number}}" hidden>
                <input type="text" name="confirmation_number" value="{{ $editstatus->confirmation_number }}" hidden>
                <button type="submit" class="btn btn-primary mt-2">Change Room</button>

                {{-- <input type="text" name="totalsubtotal" value="{{$totalnopromo}}" hidden>
        <input type="text" name="totalsubtotal2" value="{{$totalnopromo2}}" hidden>
        <input type="text" name="totalsubtotal3" value="{{$totalnopromo3}}" hidden> --}}
            </form>
        @endif


    </main>





@endsection
