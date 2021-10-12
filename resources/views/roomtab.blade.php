@extends('layouts.app')

@section('content')

    <!---------------------------------slider------------------------------->
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

    <!---------------------------------rooms------------------------------->
    <section id="roomtab">
        <div class="container4">
            <div class="row row-cols-3 row-cols-lg-3">

                @foreach ($rooms as $room)
                    <div class="col">
                        <a href="{{ url('roomtab') }}/{{ $room->room_name }}"> <img
                                src="{{ asset('images/' . $room->image_name) }}"></a>
                    </div>
                    <div class="col">
                        <h4 class="bold">{{ $room->room_name }}</h4>
                        <p>{{ $room->room_short_description }}</p>
                    </div>
                @endforeach

                {{-- <div class="col-12"></div>
                <div class="col-lg-2" id="availnow">
                    <h4 class="bold"> Room</h3>
                        <p>this is standard</p>
                        <a href="">see latest room offers</a>
                </div>
                @include('layouts.checkavailability2') --}}

            </div>
        </div>
    </section>
@endsection
