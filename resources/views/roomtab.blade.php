@extends('layouts.app')

@section('content')

    <div class="container-fluid p-0 m-0">
        <div class="text-center roomshowcase">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">

                <div class="d-flex justify-content-center align-items-center p-5">
                    <div class="p-5 m-5 text-white">
                        <h1 class="mb-3 fw-bold">Rooms</h1>
                        <h4 class="mb-3">Each of our 70 rooms and suites offers luxury and elegance, efficiency and
                            comfort.</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!---------------------------------rooms------------------------------->


    <div class="container-fluid sectioncolor p-0 m-0">
        <div class="row  sectioncolor">

            {{-- <div class="col mt-5 text-center">
                <div class="row pt-5">
                    <div class="col">
                        <h1 class="fw-bold">this is a text</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="abouts1"> this is a text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="POST" action="">
                            <a href="" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                            <a href="" class="btn btn-light fw-bold" name="booknow"> Book Now</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <img src="" class="img-thumbnail">
            </div> --}}

        </div>
        <div class="row">
            {{-- @foreach ($rooms as $room)
                <div class="col">
                    <img src="{{ asset('images/' . $room->image_name) }}">
                </div>

                <div class="col ">
                    <a href="{{ url('roomtab') }}/{{ $room->room_name }}"></a>
                    <h4 class="bold">{{ $room->room_name }}</h4>
                    <p>{{ $room->room_short_description }}</p>
                </div>

            @endforeach --}}

            @php
            $rows = 0;
            @endphp
            @foreach ($rooms as $room)
            @php
                $rows += 1;
            @endphp

            @if ($rows % 2 ==1)
                <!-- ODD -->

                    <div class="container mt-3 px-5 pb-5">
                    <div class="row  sectioncolor">

                        <div class="col mt-5 text-center">
                        <div class="row pt-5">
                            <div class="col">
                            <h1 class="fw-bold">{{ $room->room_name }}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <p class="abouts1"> {{ $room->room_short_description }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <form method="POST" action="">
                            <a href="{{ url('roomtab') }}/{{ $room->room_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                            {{-- <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a> --}}
                            </form>
                            </div>
                        </div>
                        </div>

                        <div class="col">
                        <img src="{{ asset('images/'.$room->image_name) }}"  class="img-thumbnail">
                        </div>

                    </div>
                    </div>
            @endif

            @if ($rows % 2 == 0)
                <!-- EVEN -->
                    <div class="container mt-3 px-5 text-center">
                    <div class="row sectioncolor">
                        <div class="col">
                        <img src="{{ asset('images/'.$room->image_name) }}" class="img-thumbnail">
                        </div>
                        <div class="col mt-5 text-center">
                        <div class="row pt-5">
                            <div class="col">
                            <h1 class="fw-bold">{{ $room->room_name }}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <p class="abouts1"> {{ $room->room_short_description }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <form method="POST" action="">
                            <a href="{{ route('roomtab') }}/{{ $room->room_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                            {{-- <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a> --}}
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
            @endif
            @endforeach


            {{-- idk what this does

            yeah just ignore this idk either lol--}}
            {{-- <div class="col"></div>
                <div class="col" id="availnow">
                    <h4 class="bold"> Room</h3>
                        <p>this is standard</p>
                        <a href="">see latest room offers</a>
                </div>
                @include('layouts.checkavailability2') --}}

        </div>
    </div>

@endsection
