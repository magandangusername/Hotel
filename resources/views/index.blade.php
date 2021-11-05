@extends('layouts.app')

@section('content')
    <!--------------------------------slider------------------------------->
    <div class="container-fluid m-0 p-0">
    <section id="slider">
        <div class="col mx-auto d-block">
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
    </div>
    <!---------------------------------availability------------------------------->
    <div class="container text-center my-5">
        <div class="col-md">
            <p class="location"> <i class="fas fa-map-pin"></i> <a href="#">Justin Street, Brngy Anemo, Makati Avenue, Jean Kazama City 1299,
                    Philippines. </a> </p>
            <p class="num">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                </svg>
                +63819272869
            </p>
        </div>
    </div>
    <!-----About------>

        <div class="container text-center p-5 sectioncolor ">
            <h1 class="fw-bold"> Mondstadt Hotel</h1>
            <div class="row text-center">
                <p class="desc">A one of a kind experience in hotel service and rooms. Mondstadt hotel has been
                    serving travelers and such since 1990, with over 3 awards and a billion satisfied customers we guarantee
                    and premium service like no other hotels can offer.</p>
            </div>







    <!-----service------>
        <div class="container sectioncolor">
            <div class="row">
                <div class="col">
                    <div class="card text-dark">
                        <img src="{{ asset('images/experiences.png') }}" class="card-img" alt="...">
                        <div class="card-img-overlay" style="background-color: rgba(255, 254, 254, 0.349);">
                            <h5 class="card-title fw-bold">Cancellation and Privacy Policy</h5>
                            <p class="card-text">A disclosure on our Cancellation and Privacy Policy</p>
                            <a href="#!" class="btn btn-outline-dark">See More</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-dark text-dark">
                            <img src="{{ asset('images/service.jpg') }}" class="card-img" alt="...">
                        <div class="card-img-overlay" style="background-color: rgba(255, 254, 254, 0.349);">
                            <h5 class="card-title fw-bold mb-4">Careers</h5>
                            <p class="card-text">We're hiring! See our open positions and contact us for an interview</p>
                            <a href="#!" class="btn btn-outline-dark">See More</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                <div class="card bg-dark text-dark">
                        <img src="{{ asset('images/maintains.png') }}" class="card-img" alt="...">
                        <div class="card-img-overlay" style="background-color: rgba(255, 254, 254, 0.349);">
                            <h5 class="card-title fw-bold">Frequently Asked Questions</h5>
                            <p class="card-text">List of frequently asked questions by our guests</p>
                            <a href="#!" class="btn btn-outline-dark">See More</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-----roomandsuites------>
        <div class="container p-5">
            <div class="title">
                <h1 class="text-center fw-bold">Room and Suites</h1>
            </div>
            <hr class="mx-5 mt-4 mb-3 p-1">

            <div class="row my-5">
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

                    <div class="col">
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
                                    <h5 class="card-title fw-bold">{{ $room->room_suite_name }}</h5>
                                    <p class="card-text">{{ $beds }}</p>
                                    <p class="card-texts">{{ $short_desc }}</p>
                                    <button type="button" class="btn btn-outline-dark fw-bold">View More</button>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="row text-center">
                <div class="col"></div>
                <div class="col">
                <a href="{{ route('roomtab') }}" input type="button" class="btn btn-outline-dark fw-bold">See All Rooms & Suites</a>
                </div>
                <div class="col"></div>
            </div>

        </div>

    <!-----special offer------>
        <div class="container p-5 sectioncolor">
            <div class="text-center">
                <h1 class="fw-bold">Special Offers</h1>
            </div>
            <hr class="mx-5 mt-4 mb-3 p-1">

            <div class="row my-5">
                @foreach ($promos as $promo)
                    <div class="col">
                        <a href="{{ route('promo') }}/{{ $promo->promotion_name }}"
                            class="text-decoration-none link-dark">
                            <div class="card text-center">
                                <img src="{{ asset('images/' . $promo->image_name) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $promo->promotion_name }}</h5>
                                    <p class="card-texts">{{ $promo->promotion_short_description }}</p>
                                    <button type="button" class="btn btn-outline-dark fw-bold">View Promo</button>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
                <div class="row text-center">
                    <div class="col"></div>
                    <div class="col">
                    <a href="{{ route('promo') }}" input type="button" class="btn btn-outline-dark fw-bold">See Special Offers</a>
                    </div>
                    <div class="col"></div>
                </div>
        </div>


@endsection
