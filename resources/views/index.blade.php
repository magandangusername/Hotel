@extends('layouts.app')

@section('content')
    <!--------------------------------slider------------------------------->
    <section id="slider">
        <div class="col-lg-11 mx-auto d-block">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/place1.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/place2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/place4.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/place5.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!---------------------------------availability------------------------------->
    {{-- @include('layouts.checkavailability') --}}
    <div class="containers">
        <div class="col-md">
            <p class="location"> <a href="#">Justin Street, Brngy Anemo, Makati Avenue, Jean Kazama City 1299,
                    Philippines. </a> <i class="fas fa-map-pin"></i></p>
            <p class="num">+63819272869</p>
        </div>
    </div>
    <!-----About------>
    <section id="about">
        <div class="container text-center">
            <h1 class="hotelname"> Mondstadt Hotel</h1>
            <div class="row text-center">
                <p class="desc">A one of a kind experience in hotel service and rooms. Mondstadt hotel has been
                    serving travelers and such since 1990, with over 3 awards and a billion satisfied customers we guarantee
                    and premium service like no other hotels can offer.</p>
            </div>
        </div>
    </section>

    <!-----service------>
    <section id="service">
        <div class="container1">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <img src="{{ asset('images/experiences.png') }}" alt="">
                        <div class="card-text">
                            <h4>Luxurious Experience</h4>
                            <h6>A level of experience like no other</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <img src="{{ asset('images/service.jpg') }}" alt="">
                        <div class="card-text">
                            <h4>Top Notch Service</h4>
                            <h6>A level of service like no other</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card">
                        <img src="{{ asset('images/maintains.png') }}" alt="">
                        <div class="card-text">
                            <h4>Well-Maintained </h4>
                            <h6>A Well-Maintained place like no other</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-----roomandsuites------>
    <section id="roomandsuites">
        <div class="container2">
            <div class="title">
                <h1 class="roomites">Room and Suites</h1>
            </div>

            <div class="row">
                @foreach ($roomtype as $room)
                    @php
                        $base_price = \App\Models\room_description::where('room_name', 'like', $room->room_suite_name)->first();

                        if ($base_price != null) {
                            $short_desc = $base_price->room_short_description;
                            $bed_type = $base_price->bed_type;
                            $image_name = $base_price->image_name;
                        } else {
                            $base_price = \App\Models\suite_description::where('suite_name', 'like', $room->room_suite_name)->first();
                            $short_desc = $base_price->suite_short_description;
                            $bed_type = $base_price->bed_type;
                            $image_name = $base_price->image_name;
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

                    <div class="col-md-3 ">
                        <a href="@php
                            $roomsuite = \App\Models\room_description::where('room_name', 'like', $room->room_suite_name)->first();
                            if ($roomsuite != null) {
                                echo route('roomtab') . '/' . $room->room_suite_name;
                            } else {
                                echo route('suitestab') . '/' . $room->room_suite_name;
                            }

                        @endphp" class="text-decoration-none link-dark">
                            <div class="card text-center">
                                <img src="{{ asset('images/' . $image_name) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->room_suite_name }}</h5>
                                    <p class="card-text">{{ $beds }}</p>
                                    <p class="card-texts">{{ $short_desc }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col text-center">
                    <a href="{{ route('roomtab') }}" input type="button" id="seeall"
                        class="btn btn-outline-info justify-content-center">See All Rooms & Suites</a>
                </div>
            </div>
        </div>
    </section>

    <!-----special offer------>
    <section id="roomandsuites">
        <div class="container3">
            <div class="title">
                <h1 class="special">Special Offers</h1>
            </div>

            <div class="row">
                @foreach ($promos as $promo)
                    <div class="col-md-3 ">
                        <a href="{{ route('promo') }}/{{ $promo->promotion_name }}"
                            class="text-decoration-none link-dark">
                            <div class="card text-center">
                                <img src="{{ asset('images/' . $promo->image_name) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $promo->promotion_name }}</h5>
                                    <div class="card-text" style="text-align: left">
                                        <h4>Click to view promo.</h4>
                                    </div>
                                    <p class="card-texts">{{ $promo->promotion_short_description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col text-center">
                    <a href="{{ route('promo') }}" input type="button" id="seeall"
                        class="btn btn-outline-info justify-content-center">See All Special Offers</a>
                </div>
            </div>
        </div>
    </section>


@endsection
