@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-4">

        <div class="container pt-0 mb-3 text-center">
            @if (!isset($review))
                <h1 class="fw-bold"> Modify Reservation</h1>
            @else
                <h1 class="fw-bold"> Review Reservation</h1>
            @endif
        </div>

        <div class="infotab px-1 py-3 text-dark ">
            <div class="row mt-2">

                @if (!isset($review))
                    <div class="col-3 text-center">
                        <h4 class="fw-bold">Reservation Number</h4>
                        <h5>{{ $book->confirmation_number }} </h5>
                    </div>
                @endif


                <div class="col">
                    <h4 class="fw-bold">Arrival/Departure</h4>
                    @if (!isset($review))
                        <h5>{{ date('m/d/y', strtotime($book->arrival_date)) }} -
                            {{ date('m/d/y', strtotime($book->departure_date)) }} </h5>
                    @else
                        <h5>{{ date('m/d/y', strtotime(session('CheckIn'))) }} -
                            {{ date('m/d/y', strtotime(session('CheckOut'))) }} </h5>
                    @endif
                </div>
                @if (!isset($review))
                    <div class="col-1 text-center">
                        <h4 class="fw-bold">Adult</h4>
                        <h5>5</h5>
                    </div>

                    <div class="col-1 text-center">
                        <h4 class="fw-bold">Children</h4>
                        <h5>5</h5>
                    </div>
                @endif
                <div class="col  text-center">
                    <h4 class="fw-bold">Subtotal</h4>
                    @if (!isset($review))
                        <h5>php {{ number_format($book->ctotal_price, 2) }}</h5>
                    @else
                        <h5>php {{ number_format(session('totalrate') + session('totalrate2') + session('totalrate3')) }}
                        </h5>
                    @endif
                </div>


                <div class="col ">
                    @if (!isset($review))
                        <div class="px-5">
                            <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">More
                                Information</button>
                        </div>
                    @endif

                </div>


            </div>
        </div>
    </div>


    <div class="container p-4 my-5 bg-light">

        @if (!isset($review))
            <div class=" text-dark ">
                <h2 class="px-5 py-3 fw-bold"> Guest Information</h2>
                <div class="row px-5 py-3">

                    <div class="col-5">
                        <h5><b>Name : </b>{{ $book->first_name }} {{ $book->last_name }}</h5>
                        <h5><b>Email Address : </b>{{ $book->email }}</h5>
                        <h5><b>Mobile Number : </b> {{ $book->mobile_num }}</h5>
                    </div>


                    <div class="col-5">
                        <h5><b>Address : </b>{{ $book->address }}</h5>
                        <h5><b>City : </b>{{ $book->city }}</h5>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Guest
                            Info</button>
                    </div>

                </div>
            </div>

            <hr class="mx-5 mt-3 mb-4 p-1">

            <h3 class="px-5 py-0 fw-bold  text-dark "> Payment Information </h3>
            <div class="row px-5 py-3  text-dark ">

                <div class="col-5">
                    <h5><b>Cardholder Name :</b> Jo*****</h5>
                    <h5><b>Card Number :</b> 4********</h5>
                </div>

                <div class="col-5">
                    <h5><b>Expiry Date : </b> 21/02</h5>
                    <h5><b>CVV : </b> ***</h5>
                </div>

                {{-- <div class="col" >
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Payment
                        Info</button>
                </div> --}}
            </div>

        @endif
        <hr class="mx-5 mt-4 mb-4 p-1">

        <h2 class="px-5 py-3 fw-bold text-center  text-dark  "> Room Information </h2>

        <div class="accordion" id="accordionid">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne"> Room 1</button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionid">
                    <div class="card-body">

                        <div class="row">
                            @if (!isset($review))
                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', $book->room_suite_name)
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp
                            @else
                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', session('roomtype'))
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp
                            @endif

                            <div class="col"><img src="{{ asset('images/' . $image) }}" class="img-thumbnail">
                            </div>

                            @if (!isset($review))
                                <div class="col mt-5">

                                    <h5><b>Room Name : </b>{{ $book->room_suite_name }}</h5>
                                    <h5><b>Bed :</b> {{ $book->room_suite_bed }}</h5>
                                    <h5><b>Rate Applied:</b> {{ $book->rate_name }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if ($book->promotion_code === null || $book->promotion_code == '') {
                                            echo 'N/A';
                                        } else {
                                            echo $book->promotion_code;
                                        }
                                    @endphp </h5>
                                </div>
                            @else
                                <div class="col mt-5">

                                    <h5><b>Room Name : </b>{{ session('roomtype') }}</h5>
                                    <h5><b>Bed :</b> {{ session('bed') }}</h5>
                                    <h5><b>Rate Applied:</b> {{ session('ratetype') }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if (session('PromoCode') === null || session('PromoCode') == '') {
                                            echo 'N/A';
                                        } else {
                                            echo session('PromoCode');
                                        }
                                    @endphp </h5>
                                </div>
                            @endif

                            @if (!isset($review))
                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $book->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $book->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $book->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $book->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $book->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>
                            @else
                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', session('roomtype'))
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', session('roomtype'))
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                        $book = DB::table('rate_descriptions')
                                            ->where('rate_name', session('ratetype'))
                                            ->first();
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $book->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $book->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $book->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>
                            @endif

                            @if (!isset($review))
                                <div class="col mt-5">
                                    {{-- PS: FIX THE FREAKIN BACK BUTTON!!! --}}
                                    <a href="{{ 'roomtab/' . $book->room_suite_name }}"><button type="submit"
                                            class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                            Info</button></a>
                                    <form action="" method="POST">
                                        @csrf
                                        <input name="confirmation_number" type="text"
                                            value="{{ $book->confirmation_number }}" hidden>
                                        <input name="room_num" type="text" value="r1" hidden>
                                        <input name="rr_code" type="text" value="{{ $book->rr_code }}" hidden>
                                        <input name="rate_name" type="text" value="{{ $book->rate_name }}" hidden>
                                        <button type="submit" class="btn btn-primary fw-bold"
                                            style="margin-top: 2em;">Change Room</button>
                                    </form>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>



            @if (session('roomtype2') && isset($review))

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Room 2
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionid">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', session('roomtype2'))
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp
                                <div class="col"><img src="{{ asset('images/' . $image) }}"
                                        class="img-thumbnail"></div>


                                <div class="col mt-5">

                                    <h5><b>Room Name : </b>{{ session('roomtype2') }}</h5>
                                    <h5><b>Bed :</b> {{ session('bed2') }}</h5>
                                    <h5><b>Rate Applied:</b> {{ session('ratetype2') }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if (session('PromoCode') === null || session('PromoCode') == '') {
                                            echo 'N/A';
                                        } else {
                                            echo session('PromoCode');
                                        }
                                    @endphp </h5>
                                </div>


                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', session('roomtype2'))
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', session('roomtype2'))
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                        $book = DB::table('rate_descriptions')
                                            ->where('rate_name', session('ratetype'))
                                            ->first();
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $book->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $book->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $book->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>



            @elseif (isset($bookinfo2))

                @if ($bookinfo2->room_suite_name !== null || $bookinfo2->room_suite_name != '')
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Room 2
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionid">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', $bookinfo2->room_suite_name)
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp
                                <div class="col"><img src="{{ asset('images/' . $image) }}"
                                        class="img-thumbnail"></div>

                                <div class="col mt-5">

                                    <h5><b>Room Name :</b> {{ $bookinfo2->room_suite_name }}</h5>
                                    <h5><b>Bed :</b> {{ $bookinfo2->room_suite_bed }}</h5>
                                    <h5><b>Rate Applied:</b> {{ $bookinfo2->rate_name }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if ($bookinfo2->promotion_code === null || $bookinfo2->promotion_code == '') {
                                            echo 'N/A';
                                        } else {
                                            echo $bookinfo2->promotion_code;
                                        }
                                    @endphp </h5>
                                </div>


                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', $bookinfo2->room_suite_name)
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', $bookinfo2->room_suite_name)
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $bookinfo2->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $bookinfo2->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $bookinfo2->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $bookinfo2->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>


                                <div class="col mt-5">
                                    <a href="{{ 'roomtab/' . $book->room_suite_name }}"><button type="submit"
                                            class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                            Info</button></a>
                                    <form action="" method="POST">
                                        @csrf
                                        <input name="confirmation_number" type="text"
                                            value="{{ $book->confirmation_number }}" hidden>
                                        <input name="room_num" type="text" value="r2" hidden>
                                        <input name="rr_code" type="text" value="{{ $book->rr_code }}" hidden>
                                        <input name="rate_name" type="text" value="{{ $book->rate_name }}" hidden>
                                        <button type="submit" class="btn btn-primary fw-bold"
                                            style="margin-top: 2em;">Change Room</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                @endif

            @endif

            @if (session('roomtype3') && isset($review))

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                Room 3
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionid">
                        <div class="card-body">
                            <div class="row">

                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', session('roomtype3'))
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp

                                <div class="col"><img src="{{ asset('images/' . $image) }}"
                                        class="img-thumbnail"></div>


                                <div class="col mt-5">

                                    <h5><b>Room Name : </b>{{ session('roomtype3') }}</h5>
                                    <h5><b>Bed :</b> {{ session('bed3') }}</h5>
                                    <h5><b>Rate Applied:</b> {{ session('ratetype3') }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if (session('PromoCode') === null || session('PromoCode') == '') {
                                            echo 'N/A';
                                        } else {
                                            echo session('PromoCode');
                                        }
                                    @endphp </h5>
                                </div>



                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', session('roomtype3'))
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', session('roomtype3'))
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                        $book = DB::table('rate_descriptions')
                                            ->where('rate_name', session('ratetype'))
                                            ->first();
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $book->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $book->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $book->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

            @elseif (isset($bookinfo3))
                @if ($bookinfo3->room_suite_name !== null || $bookinfo3->room_suite_name != '')
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                Room 3
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionid">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $image = DB::table('gallery_albums')
                                        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                        ->where('album_name', session('roomtype3'))
                                        ->first();
                                    $image = $image->photo_name;
                                @endphp

                                <div class="col"><img src="{{ asset('images/' . $image) }}"
                                        class="img-thumbnail"></div>


                                <div class="col mt-5">

                                    <h5><b>Room Name : </b>{{ session('roomtype3') }}</h5>
                                    <h5><b>Bed :</b> {{ session('bed3') }}</h5>
                                    <h5><b>Rate Applied:</b> {{ session('ratetype3') }} </h5>
                                    <h5><b>Promo Applied:</b> @php
                                        if (session('PromoCode') === null || session('PromoCode') == '') {
                                            echo 'N/A';
                                        } else {
                                            echo session('PromoCode');
                                        }
                                    @endphp </h5>
                                </div>



                                <div class="col mt-5">
                                    <h5><b>Base Price : php</b> @php
                                        $price = DB::table('room_descriptions')
                                            ->where('room_name', session('roomtype3'))
                                            ->first();
                                        if ($price !== null) {
                                            echo number_format($price->base_price, 2);
                                        } else {
                                            $price = DB::table('suite_descriptions')
                                                ->where('suite_name', session('roomtype3'))
                                                ->first();
                                            echo number_format($price->base_price, 2);
                                        }
                                        $book = DB::table('rate_descriptions')
                                            ->where('rate_name', session('ratetype'))
                                            ->first();
                                    @endphp</h5>
                                    <h5><b>Rate Discount :</b> php
                                        -{{ number_format($rate_discount = $price->base_price * $book->base_discount, 2) }}
                                    </h5>
                                    <h5><b>City Tax :</b> php
                                        {{ number_format($city_tax = $price->base_price * $book->city_tax, 2) }}</h5>
                                    <h5><b>Vat:</b> php {{ number_format($vat = $price->base_price * $book->vat, 2) }}
                                    </h5>
                                    <h5><b>Service Charge:</b> php
                                        {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }}
                                    </h5>
                                    <h5><b>Total:</b> php
                                        {{ number_format($total = $price->base_price - $rate_discount + $vat + $service_charge + $city_tax, 2) }}
                                    </h5>

                                </div>



                                <div class="col mt-5">
                                    <a href="{{ 'roomtab/' . $book->room_suite_name }}"><button type="submit"
                                            class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                            Info</button></a>
                                    <form action="" method="POST">
                                        @csrf
                                        <input name="confirmation_number" type="text"
                                            value="{{ $book->confirmation_number }}" hidden>
                                        <input name="room_num" type="text" value="r3" hidden>
                                        <input name="rr_code" type="text" value="{{ $book->rr_code }}" hidden>
                                        <input name="rate_name" type="text" value="{{ $book->rate_name }}" hidden>
                                        <button type="submit" class="btn btn-primary fw-bold"
                                            style="margin-top: 2em;">Change Room</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

            @endif

        </div>
        @if (!isset($review))
            <div class="row">
                <form action="/modify" method="POST">
                    @csrf
                    <div class="col">

                        <input type="text" name="cancel" value="cancel" hidden>
                        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Cancel
                            Reservation</button>
                    </div>
                </form>
                <div class="col" hidden>
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Submit
                        Modification</button>
                </div>
            </div>
        @else
            <div class="row">
                <form
                    role="form"
                    action="/bookinfo"
                    method="post"
                    class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="payment-form">
                    @csrf
                    <input type="text" name="proceed" value="proceed" hidden>
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
                                                class='form-control' size='4' type='text' value="pp" name="cardname">
                                          </div>
                                       </div>
                                       <div class='form-row row'>
                                          <div class='col-xs-12 form-group card required'>
                                             <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text' value="4242424242424242" name="cardnum">
                                          </div>
                                       </div>
                                       <div class='form-row row'>
                                          <div class='col-xs-12 col-md-4 form-group cvc required'>
                                             <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text' value="123" name="cardcvc">
                                          </div>
                                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                                             <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text' value="12" name="cardexprm">
                                          </div>
                                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                                             <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text' value="22" name="cardexpry">
                                          </div>
                                       </div>
                                       {{-- <div class='form-row row'>
                                          <div class='col-md-12 error form-group hide'>
                                             <div class='alert-danger alert'>Please correct the errors and try
                                                again.
                                             </div>
                                          </div>
                                       </div> --}}
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
                    <div class="col">


                        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Proceed</button>
                    </div>
                </form>
            </div>
        @endif

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

function checkbox() {
  var x = document.getElementById("vehicle1").required;
  var y = document.getElementById("vehicle2").required;
}



</script>
@endsection
