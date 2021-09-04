@extends('layouts.app')

@section('content')

@if (isset($roominfo))
    <section id="standroomtitle">
        <div class="containersdeluxe">
            <div class="titless">
                <a href="roomtab.php" input type="button" id="backmod" class="btn btn-primary"> Back </a>
                <h1 class="standardtitle" id="gitna">
                    @if (isset($roominfo->suite_name))
                        {{$roominfo->suite_name}}
                    @else
                        {{$roominfo->room_name}}
                    @endif
                </h1>
            </div>
        </div>
    </section>




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

                </div>
                <div class="carousel-inner">
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($photos as $photo)
                        @php
                            $counter += 1;
                        @endphp
                        <div class="carousel-item @if ($counter == 1)
                    active
                    @endif">
                            <img src="{{ asset('images/' . $photo['photo_name']) }}" class="d-block w-100" alt="...">
                        </div>
                    @endforeach

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

    <!---------------------------------description------------------------------->

    <section id="roomtab">
        <div class="container4">
            <div class="row row-cols-2 row-cols-lg-2">

                <div class="col-md-6" id="standstand">
                    <h3 class="standesc">Description</h3>
                    <p class="standesc">
                        @if (isset($roominfo->suite_short_description))
                            {{$roominfo->suite_short_description}}
                        @else
                            {{$roominfo->room_short_description}}
                        @endif
                    </p>
                    <h3 class="stanAmenities">Details & Amenities</h3>
                    <p class="standesc">
                        @if (isset($roominfo->suite_long_description))
                            {{$roominfo->suite_long_description}}
                        @else
                            {{$roominfo->room_long_description}}
                        @endif</p>
                    @if ($roominfo->a1 != '')
                        <p class="standesc">&bull; {{ $roominfo->a1 }}</p>
                    @elseif ($a2 != '')
                        <p class="standesc">&bull; {{ $roominfo->a2 }}</p>
                    @elseif ($a3 != '')
                        <p class="standesc">&bull; {{ $roominfo->a3 }}</p>
                    @elseif ($a4 != '')
                        <p class="standesc">&bull; {{ $roominfo->a4 }}</p>
                    @elseif ($a5 != '')
                        <p class="standesc">&bull; {{ $roominfo->a5 }}</p>
                    @elseif ($a6 != '')
                        <p class="standesc">&bull; {{ $roominfo->a6 }}</p>
                    @elseif ($a7 != '')
                        <p class="standesc">&bull; {{ $roominfo->a7 }}</p>
                    @elseif ($a8 != '')
                        <p class="standesc">&bull; {{ $roominfo->a8 }}</p>
                    @elseif ($a9 != '')
                        <p class="standesc">&bull; {{ $roominfo->a9 }}</p>
                    @elseif ($a10 != '')
                        <p class="standesc">&bull; {{ $roominfo->a10 }}</p>
                    @endif



                </div>

                @include('layouts.checkavailability2')
            </div>
        </div>
    </section>

    </section>


    @else
        <h1>ERROR: Invalid URL</h1>

    @endif
@endsection
