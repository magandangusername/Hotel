@extends('layouts.app')

@section('content')
    {{-- <!---------------------------------slider------------------------------->
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

    <!---------------------------------rooms------------------------------->
        <div class="container">
            <div class="row p-5">

                @foreach ($suites as $suite)
                    <div class="col">
                        <a href="{{url('suitestab')}}/{{$suite->suite_name}}"> <img src="{{asset('images/'.$suite->image_name)}}"></a>
                        <h4 class="bold">{{$suite->suite_name}}</h3>
                            <p>{{$suite->suite_short_description}}</p>
                    </div>
                    <div class="col">

                    </div>
                @endforeach

                <!-- <div class="col"></div>
                <div class="col-lg-2" id="availnow">
                    <h4 class="bold"> Room</h3>
                        <p>this is standard</p>
                        <a href="">see latest room offers</a>
                </div>

                @include('layouts.checkavailability2') -->

            </div>
        </div> --}}










    <div class="container-fluid p-0 m-0">
        <div class="text-center roomshowcase">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">

                <div class="d-flex justify-content-center align-items-center p-5">
                    <div class="p-5 m-5 text-white">
                        <h1 class="mb-3 fw-bold">Suites</h1>
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


        </div>
        <div class="row">
            @php
                $rows = 0;
            @endphp
            @foreach ($suites as $suite)
                @php
                    $rows += 1;
                @endphp

                @if ($rows % 2 == 1)
                    <!-- ODD -->

                    <div class="container mt-3 px-5 pb-5">
                        <div class="row  sectioncolor">

                            <div class="col mt-5 text-center">
                                <div class="row pt-5">
                                    <div class="col">
                                        <h1 class="fw-bold">{{ $suite->suite_name }}</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="abouts1"> {{ $suite->suite_short_description }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form method="POST" action="">
                                            <a href="{{ url('suitestab') }}/{{ $suite->suite_name }}"
                                                class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                                            {{-- <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <img src="{{ asset('images/' . $suite->image_name) }}" class="img-thumbnail">
                            </div>

                        </div>
                    </div>
                @endif

                @if ($rows % 2 == 0)
                    <!-- EVEN -->
                    <div class="container mt-3 px-5 text-center">
                        <div class="row sectioncolor">
                            <div class="col">
                                <img src="{{ asset('images/' . $suite->image_name) }}" class="img-thumbnail">
                            </div>
                            <div class="col mt-5 text-center">
                                <div class="row pt-5">
                                    <div class="col">
                                        <h1 class="fw-bold">{{ $suite->suite_name }}</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="abouts1"> {{ $suite->suite_short_description }} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form method="POST" action="">
                                            <a href="{{ route('roomtab') }}/{{ $suite->suite_name }}"
                                                class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                                            {{-- <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach



        </div>
    </div>


@endsection
