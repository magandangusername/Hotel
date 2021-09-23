@extends('layouts.app')

@section('content')


    <!-----------availability----------->

    <section id="availabilityrese">
        <div class="containerrese">
            <div class="titlecheck">
                <h1 class="reservetitle">Rooms & Rates</h1>
            </div>
    </section>

    <section id="useredits">
        <div class="containerchecks">
            <div class="row g-2 justify-content-center">

                <div class="col-auto">
                    <p class="label">Your Stay:
                        {{ date('M d, Y', strtotime(session('CheckIn'))) . ' - ' . date('M d, Y', strtotime(session('CheckIn'))) }}
                    </p>
                </div>
                <div class="col-auto">
                    <p class="label vertical">room(s): {{ session('RoomCount') }}</p>
                </div>
                <div class="col-auto">
                    <p class="label ">adult:
                        @php

                        @endphp
                        @if (session('room') != null || session('room') > 1)
                            @php
                                $room = session('room');
                            @endphp

                        @else
                            @php
                                $room = 1;
                                // session('room') = $room;
                                Session::put('room', $room);
                            @endphp

                        @endif

                        @if ($room == 1)
                            @php
                                // session('roomchecker') = true;
                                // session('roomchecker2') = true;
                                // session('roomtype2') = '';
                                // session('ratetyoe2') = '';

                                Session::put('roomchecker', true);
                                Session::put('roomchecker2', true);
                                Session::put('roomtype2', '');
                                Session::put('ratetype2', '');
                            @endphp
                            {{ session('AdultCount') }}

                        @elseif ($room == 2)
                            {{ session('AdultCountRoom2') }}
                        @elseif ($room == 3)
                            {{ session('AdultCountRoom3') }}
                        @endif
                    </p>
                </div>
                <div class="col-auto" hidden>
                    <p class="label">children</p>
                </div>
                <div class="col-auto" hidden>
                    <p class="label">Total rate: <?php

?></p>
                </div>
            </div>
        </div>
    </section>


    @if (session('RoomCount') > 1)
        <div class="containerish">
            <h1>Room {{$room}} out of {{session('RoomCount')}}</h1>
        </div>
    @endif

    @php
    $rt = 0;
    $rs = 0;
    $b = 0;
    @endphp

    @foreach ($rates as $rateinfo)


        <section id="sliderish">
            <div class="containerish">
                <div class="row">
                    <div class="col-md-5 ">
                        <h3 class="roomeb1"> {{ $rateinfo->rate_name }} </h3>
                        <p class="roomeb">{{ $rateinfo->rate_offer1 }}</p>
                        <p class="roomeb">{{ $rateinfo->rate_offer2 }}</p>
                        <p class="roomeb">{{ $rateinfo->rate_offer3 }}</p>
                    </div>
                    <div class="col-md-6 ">
                        <div class="termss">
                            <h4 class="policies1"> Policies </h4>
                            <p class="policies">Must cancel prior to 4:00PM one day before arrival to avoid a one
                                night
                                room charge plus surcharge. </p>
                            <p class="policies">Reservation must be guaranteed with credit card at time of booking.
                                Room
                                will be held until 12 midnight on the day of the arrival (hotel local time).</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sliderearly">
            <div class="containerearly">
                <div class="titlesa">
                    <h4 class="availroom"> Available Rooms </h4>
                </div>


                <div class="row slider">
                    @foreach ($roomtype as $result)
                        <div class="col-md-12" id="avilnows">
                            <div class="cards">
                                @php
                                    $base_price = \App\Models\room_description::where('room_name', 'like', $result->room_suite_name)->first();

                                    if ($base_price != null) {
                                        $short_desc = $base_price->room_short_description;
                                        $bed_type = $base_price->bed_type;
                                        $image_name = $base_price->image_name;
                                        $room_size = $base_price->suite_size;
                                    } else {
                                        $base_price = \App\Models\suite_description::where('suite_name', 'like', $result->room_suite_name)->first();
                                        $short_desc = $base_price->suite_short_description;
                                        $bed_type = $base_price->bed_type;
                                        $image_name = $base_price->image_name;
                                        $room_size = $base_price->suite_size;
                                    }

                                    $k = 'K';
                                    $q = 'Q';
                                    $kq = 'King Bed';
                                    $beds = '';
                                    if (preg_match("/{$k}/i", $bed_type)) {
                                        $beds = $beds . 'King Bed';
                                    }

                                    if (preg_match("/{$q}/i", $bed_type)) {
                                        if (preg_match("/{$kq}/i", $beds)) {
                                            $beds = $beds . ', ';
                                        }
                                        $beds = $beds . 'Queen Bed';
                                    }
                                @endphp

                                <img src="{{asset('images/'.$image_name)}}" class="card-img-top">
                                <form action="" method="POST">
                                    <div class="card-body text-muted">
                                        <h5 class="card-title">{{$result->room_suite_name}}</h5>



                                        <p class="sizey">{{$room_size}} sqm</p>
                                        <p class="none">City View, Free Wifi</p>
                                        <a href="#" class="none"></a>
                                        <a class="isDisabled" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Read More
                                        </a>

                                        <div class="collapse" id="collapseExample">
                                            <div class="cards card-body">
                                                this is where to put the pulling data from database.
                                            </div>
                                        </div>
                                        <p class="pricey">{{$new_price}} PHP/Night</p>
                                        <p class="sizeys">Excluding Taxes and Fee</p>
                                        <a class="isDisabled" id="sizeyss" data-bs-toggle="collapse"
                                            href="#collapseExample" role="button" aria-expanded="false"
                                            aria-controls="collapseExample" Disabled>

                                            <p style="text-align:center">Price Breakdown</p>
                                        </a>

                                        <div class="collapse" id="collapseExample">
                                            <div class="cards card-body">
                                                this is where to put the pulling data from database.
                                            </div>
                                        </div>
                                        <div class="radiobut">
                                        @php
                                            $beds = \App\Models\room_status::where('room_suite_bed', 'like', 'Queen Bed')->count();
                                            $b += 1;
                                            $q = $k = true;

                                        @endphp

                                        @if ($beds > 0)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bed" value="Queen Bed"
                                                    @php
                                                        if ($room == 1) {
                                                            // session('bedcheckerq') = true;
                                                            Session::put('bedcheckerq', true);
                                                            //echo 'yes';
                                                        }
                                                        if (session('bedcheckerq') !== null && !session('bedcheckerq') && ((session('roomtype2') !== null && session('roomtype2') == $result->room_suite_name) || session('roomtype') == $result->room_suite_name) && (session('bed2') == 'Queen Bed' || session('bed') == 'Queen Bed')) {
                                                            echo 'disabled';
                                                            $q = false;
                                                        } else {
                                                            echo 'checked';
                                                        }
                                                    @endphp
                                                    >

                                                <label class="form-check-label">Queen Bed</label>
                                            </div>

                                        @else
                                            @php
                                                $q = false;
                                            @endphp
                                        @endif


                                        @php
                                            $beds = \App\Models\room_status::where('room_suite_bed', 'like', 'King Bed')->where('room_suite_name', '='. "'".$type."'")->where('status', '=', '0')->count();

                                        @endphp

                                        @if ($beds > 0)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bed" value="King Bed"
                                                    @php if ($room <= 1) {
                                                        // session('bedcheckerk') = true;
                                                        Session::put('bedcheckerk', true);
                                                        //echo 'yes';
                                                    }

                                                    if (session('bedcheckerk') !== null && !session('bedcheckerk') && ((session('roomtype2') !== null && session('roomtype2') == $result->room_suite_name) || session('roomtype') == $result->room_suite_name) && (session('bed2') == 'King Bed' || session('bed') == 'King Bed')) {
                                                        echo 'disabled';
                                                        $k = false;
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    @endphp>
                                                <label class="form-check-label">King Bed</label>
                                            </div>

                                        @else
                                            @php
                                                $k = false;
                                            @endphp

                                        @endif


                                        </div>
                                        <input name="room_type" value="{{$type}}" hidden>
                                        <input name="rate_type" value="{{$rateinfo->rate_name}}" hidden>
                                        <input name="total_rate" value={{$totalrate}} hidden>


                                    @php
                                        $available = \App\Models\room_status::where('room_suite_bed', 'like', 'Queen Bed')->count();

                                        if (session('roomchecker') !== null) {
                                            $roomchecker = session('roomchecker');
                                        }
                                        if (session('roomchecker2') !== null) {
                                            $roomchecker2 = session('roomchecker2');
                                        }

                                    @endphp

                                    @if ($available == 0)
                                        <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary"
                                        disabled>ROOM
                                        UNAVAILABLE</button>
                                    @elseif ((isset($roomchecker2) && !$roomchecker2 || isset($roomchecker) && !$roomchecker)
                                    && (!$q && !$k)
                                    && ((session('roomtype') == $result->room_suite_name)
                                    || (session('roomtype2') !== null && session('roomtype2') == $result->room_suite_name))
                                    )

                                        <button type="submit" name="chooseroom" id="butbut" class="btn btn-primary"
                                        disabled>SELECTED THE LAST AVAILABLE</button>

                                    @else

                                    <button type="submit" name="chooseroom" id="butbut"
                                            class="btn btn-primary">Select</button>

                                    @endif


                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>


@php
   $rt += 1;
@endphp


    @endforeach







    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script type="text/javascript">
        $('.slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerPadding: 5,
            infinite: false,
        });
    </script>




@endsection
