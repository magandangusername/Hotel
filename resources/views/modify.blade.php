@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-4">

        <div class="container pt-0 mb-3 text-center">
            <h1 class="fw-bold"> Modify Reservation</h1>
        </div>

        <div class="infotab px-1 py-3 text-dark ">
            <div class="row mt-2">

                <div class="col-3 text-center">
                    <h4 class="fw-bold">Reservation Number</h4>
                    <h5>{{$book->confirmation_number}} </h5>
                </div>

                <div class="col">
                    <h4 class="fw-bold">Arrival/Departure</h4>
                    <h5>{{date('m/d/y', strtotime($book->arrival_date))}} - {{date('m/d/y', strtotime($book->departure_date))}} </h5>
                </div>

                <div class="col-1 text-center">
                    <h4 class="fw-bold">Adult</h4>
                    <h5>5</h5>
                </div>

                <div class="col-1 text-center">
                    <h4 class="fw-bold">Children</h4>
                    <h5>5</h5>
                </div>

                <div class="col  text-center">
                    <h4 class="fw-bold">Subtotal</h4>
                    <h5>php {{number_format($book->ctotal_price, 2)}}</h5>
                </div>

                <div class="col ">
                    <div class="px-5">
                        <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">More
                            Information</button>
                    </div>

                </div>


            </div>
        </div>
    </div>


    <div class="container p-4 my-5 bg-light">


        <div class=" text-dark ">
            <h2 class="px-5 py-3 fw-bold"> Guest Information</h2>
            <div class="row px-5 py-3">

                <div class="col-5">
                    <h5><b>Name : </b>{{$book->first_name}} {{$book->last_name}}</h5>
                    <h5><b>Email Address : </b>{{$book->email}}</h5>
                    <h5><b>Mobile Number : </b> {{$book->mobile_num}}</h5>
                </div>


                <div class="col-5">
                    <h5><b>Address : </b>{{$book->address}}</h5>
                    <h5><b>City : </b>{{$book->city}}</h5>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Guest Info</button>
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

            <div class="col">
                <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Edit Payment Info</button>
            </div>
        </div>


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
                            @php
                                $image = DB::table('gallery_albums')
                                ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->where('album_name', $book->room_suite_name)
                                ->first();
                                $image = $image->photo_name;
                            @endphp

                            <div class="col"><img src="{{asset('images/'.$image)}}" class="img-thumbnail"></div>
                            <div class="col mt-5">

                                <h5><b>Room Name : </b>{{$book->room_suite_name}}</h5>
                                <h5><b>Bed :</b> {{$book->room_suite_bed}}</h5>
                                <h5><b>Rate Applied:</b> {{$book->rate_name}} </h5>
                                <h5><b>Promo Applied:</b> @php
                                    if($book->promotion_code === null || $book->promotion_code == '') {
                                        echo 'N/A';
                                    } else {
                                        echo $book->promotion_code;
                                    }
                                @endphp </h5>
                            </div>

                            <div class="col mt-5">
                                <h5><b>Base Price : php</b> @php
                                    $price = DB::table('room_descriptions')->where('room_name', $book->room_suite_name)->first();
                                    if($price !== null){
                                        echo number_format($price->base_price, 2);
                                    } else {
                                        $price = DB::table('suite_descriptions')->where('suite_name', $book->room_suite_name)->first();
                                        echo number_format($price->base_price, 2);
                                    }
                                @endphp</h5>
                                <h5><b>Rate Discount :</b> php {{number_format($rate_discount = $price->base_price * $book->base_discount, 2)}}</h5>
                                <h5><b>City Tax :</b> php {{number_format($city_tax = $price->base_price * $book->city_tax, 2)}}</h5>
                                <h5><b>Vat:</b> php {{number_format($vat = $price->base_price * $book->vat, 2)}} </h5>
                                <h5><b>Service Charge:</b> php {{number_format($service_charge = $price->base_price * $book->service_rate, 2)}} </h5>
                                <h5><b>Total:</b> php {{number_format($total = ($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax, 2)}} </h5>

                            </div>

                            <div class="col mt-5">
                                {{-- PS: FIX THE FREAKIN BACK BUTTON!!! --}}
                                <a href="{{'roomtab/'.$book->room_suite_name}}"><button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                    Info</button></a>
                                <form action="" method="POST">
                                    @csrf
                                    <input name="confirmation_number" type="text" value="{{$book->confirmation_number}}" hidden>
                                    <input name="room_num" type="text" value="r1" hidden>
                                    <input name="rr_code" type="text" value="{{$book->rr_code}}" hidden>
                                    <input name="rate_name" type="text" value="{{$book->rate_name}}" hidden>
                                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

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
                            <div class="col"><img src="{{asset('images/'.$image)}}" class="img-thumbnail"></div>


                            <div class="col mt-5">

                                <h5><b>Room Name :</b> {{$bookinfo2->room_suite_name}}</h5>
                                <h5><b>Bed :</b> {{$bookinfo2->room_suite_bed}}</h5>
                                <h5><b>Rate Applied:</b> {{$bookinfo2->rate_name}} </h5>
                                <h5><b>Promo Applied:</b> @php
                                    if($bookinfo2->promotion_code === null || $bookinfo2->promotion_code == '') {
                                        echo 'N/A';
                                    } else {
                                        echo $bookinfo2->promotion_code;
                                    }
                                @endphp </h5>
                            </div>

                            <div class="col mt-5">
                                <h5><b>Base Price : php</b> @php
                                    $price = DB::table('room_descriptions')->where('room_name', $bookinfo2->room_suite_name)->first();
                                    if($price !== null){
                                        echo number_format($price->base_price, 2);
                                    } else {
                                        $price = DB::table('suite_descriptions')->where('suite_name', $bookinfo2->room_suite_name)->first();
                                        echo number_format($price->base_price, 2);
                                    }
                                @endphp</h5>
                                <h5><b>Rate Discount :</b> php {{number_format($rate_discount = $price->base_price * $bookinfo2->base_discount, 2)}}</h5>
                                <h5><b>City Tax :</b> php {{number_format($city_tax = $price->base_price * $bookinfo2->city_tax, 2)}}</h5>
                                <h5><b>Vat:</b> php {{number_format($vat = $price->base_price * $bookinfo2->vat, 2)}} </h5>
                                <h5><b>Service Charge:</b> php {{number_format($service_charge = $price->base_price * $bookinfo2->service_rate, 2)}} </h5>
                                <h5><b>Total:</b> php {{number_format($total = ($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax, 2)}} </h5>

                            </div>

                            <div class="col mt-5">
                                <a href="{{'roomtab/'.$book->room_suite_name}}"><button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                    Info</button></a>
                                <form action="" method="POST">
                                    @csrf
                                    <input name="confirmation_number" type="text" value="{{$book->confirmation_number}}" hidden>
                                    <input name="room_num" type="text" value="r2" hidden>
                                    <input name="rr_code" type="text" value="{{$book->rr_code}}" hidden>
                                    <input name="rate_name" type="text" value="{{$book->rate_name}}" hidden>
                                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            @endif

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
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionid">
                    <div class="card-body">
                        <div class="row">
                            @php
                                $image = DB::table('gallery_albums')
                                ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->where('album_name', $bookinfo3->room_suite_name)
                                ->first();
                                $image = $image->photo_name;
                            @endphp
                            <div class="col"><img src="{{asset('images/'.$image)}}" class="img-thumbnail"></div>


                            <div class="col mt-5">

                                <h5><b>Room Name :</b> {{$bookinfo3->room_suite_name}}</h5>
                                <h5><b>Bed :</b> {{$bookinfo3->room_suite_bed}}</h5>
                                <h5><b>Rate Applied:</b> {{$bookinfo3->rate_name}} </h5>
                                <h5><b>Promo Applied:</b> @php
                                    if($bookinfo3->promotion_code === null || $bookinfo3->promotion_code == '') {
                                        echo 'N/A';
                                    } else {
                                        echo $book->promotion_code;
                                    }
                                @endphp </h5>
                            </div>

                            <div class="col mt-5">
                                <h5><b>Base Price : php</b> @php
                                    $price = DB::table('room_descriptions')->where('room_name', $bookinfo3->room_suite_name)->first();
                                    if($price !== null){
                                        echo number_format($price->base_price, 2);
                                    } else {
                                        $price = DB::table('suite_descriptions')->where('suite_name', $bookinfo3->room_suite_name)->first();
                                        echo number_format($price->base_price, 2);
                                    }
                                @endphp</h5>
                                <h5><b>Rate Discount :</b> php {{number_format($rate_discount = $price->base_price * $bookinfo3->base_discount, 2)}}</h5>
                                <h5><b>City Tax :</b> php {{number_format($city_tax = $price->base_price * $bookinfo3->city_tax, 2)}}</h5>
                                <h5><b>Vat:</b> php {{number_format($vat = $price->base_price * $bookinfo3->vat, 2)}} </h5>
                                <h5><b>Service Charge:</b> php {{number_format($service_charge = $price->base_price * $bookinfo3->service_rate, 2)}} </h5>
                                <h5><b>Total:</b> php {{number_format($total = ($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax, 2)}} </h5>

                            </div>

                            <div class="col mt-5">
                                <a href="{{'roomtab/'.$book->room_suite_name}}"><button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Room
                                    Info</button></a>
                                <form action="" method="POST">
                                    @csrf
                                    <input name="confirmation_number" type="text" value="{{$book->confirmation_number}}" hidden>
                                    <input name="room_num" type="text" value="r3" hidden>
                                    <input name="rr_code" type="text" value="{{$book->rr_code}}" hidden>
                                    <input name="rate_name" type="text" value="{{$book->rate_name}}" hidden>
                                    <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Change Room</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Cancel Reservation</button>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary fw-bold" style="margin-top: 2em;">Submit Modification</button>
            </div>
        </div>

    </div>

@endsection
