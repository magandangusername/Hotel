@extends('layouts.app')

@section('content')

    <section id="modify">
        <div class="containermod">

            <a href="reservation.php" type="button" id="backmod" class="btn btn-primary"> Back </a>

            <h1 class="modifhye">Modify Reservation</h1>

        </div>
    </section>

    <section id="modifdif">

        <section id="modifyone">
            <div class="containermodi">

                <h2 class="modifhy">Guest Information </h2>

                <div class="row lg-2 align-items-center">

                    <div class="col-md-6">
                        <p class="userinfo">Name: {{$book->first_name}} {{$book->last_name}}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Email: {{$book->email}}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="userinfo">Confirmation Number: {{$book->confirmation_number}}</p>
                    </div>
                    <div class="col-md-6">
                        <a href="editUser.php" input type="button" class="btn btn-primary"> Edit Personal Information </a>
                    </div>
                </div>
            </div>
        </section>

        <hr />

        <section id="modifytwo">
            <div class="col-12"></div>
            <h2 class="bold">Room Information</h2>


            <section id="bannerss">
                <div class="containernew">
                    <div class="row">
                        <div class="col-md-5" id="new">
                            <h3 class="new">Room 1</h3>
                            <p class="new">{{$book->room_suite_name}}</p>
                            <p class="new">Bed: {{$book->room_suite_bed}}</p>
                            <p class="new">Rate type: {{$book->rate_name}}</p>
                            <p class="new">room total @php
                                $price = DB::table('room_descriptions')->where('room_name', $book->room_suite_name)->first();
                                if($price !== null){
                                    echo $price->base_price;
                                } else {
                                    $price = DB::table('suite_descriptions')->where('suite_name', $book->room_suite_name)->first();
                                    echo $price->base_price;
                                }
                            @endphp</p>
                        </div>

                        <div class="col-md-6">
                            @php
                                $image = DB::table('gallery_albums')
                                ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->where('album_name', $book->room_suite_name)
                                ->first();
                                $image = $image->photo_name;
                            @endphp
                            <img src="{{asset('images/'.$image)}}" alt="" class="img-fluid">
                        </div>


                        <div class="col-md-5">
                            <h3 class="new"> Tax and fees </h3>
                            <p class="new">vat: php {{number_format($vat = $price->base_price * $book->vat, 2)}}</p>
                            <p class="new">service charge: php {{number_format($service_charge = $price->base_price * $book->service_rate, 2)}}</p>
                            <p class="new">city tax: php {{number_format($city_tax = $price->base_price * $book->city_tax, 2)}}</p>
                            <p class="new">total: php {{number_format($total = $price->base_price + $vat + $service_charge + $city_tax, 2)}}</p>
                        </div>

                        <div class="col-md-6 terms">
                            <h3 class="term">Description Baby</h3>
                            <button type="button" id="pindot" class="btn btn-primary"> Delete Booking </button>
                            <a href="modifyroom.php" input type="button" id="pindot" class="btn btn-primary"> Edit Room </a>
                        </div>

                    </div>
                </div>

            </section>


            <section id="twobutts">
                <div class="containerchecks">
                    <div class="row g-2 justify-content-center">

                        <div class="col-auto">
                            <p class="label">Arrival Date: {{date('M d, Y', strtotime($book->arrival_date))}}</p>
                        </div>
                        <div class="col-auto">
                            <p class="label ">Departure Date: {{date('M d, Y', strtotime($book->departure_date))}}</p>
                        </div>
                        <div class="col-auto">
                            <p class="label vertical">overall price php {{number_format($book->ctotal_price, 2)}}</p>
                        </div>

                    </div>
                </div>



                <div class="row ">
                    <div class="buttwo">
                        <button type="button" class="btn btn-primary"> Cancel Reservation </button>
                        <button type="button" class="btn btn-primary"> Submit Request </button>
                    </div>
                </div>
            </section>

        </section>
    </section>
@endsection
