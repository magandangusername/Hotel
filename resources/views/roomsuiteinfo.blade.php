@extends('layouts.app')

@section('content')

@if (isset($roominfo))

        <div class="container text-center p-5">
            <div class="titless">
                <!-- <a href="roomtab.php" input type="button" id="backmod" class="btn btn-primary"> Back </a> -->
                <h1 class="standardtitle fw-bold" id="gitna">
                    @if (isset($roominfo->suite_name))
                        {{$roominfo->suite_name}}
                    @else
                        {{$roominfo->room_name}}
                    @endif
                </h1>
            </div>
        </div>





    <!---------------------------------slider------------------------------->
    <div class="container-fluid p-0">
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
                    @php
                        $photos = DB::table('gallery_photos')
                            ->join('gallery_albums as a', 'gallery_photos.album_id', '=', 'a.album_id')
                            ->where('a.album_name', '=', $roominfo->suite_name)
                            ->get();
                        if ($roominfo->suite_name === null) {
                            $photos = DB::table('gallery_photos')
                            ->join('gallery_albums as a', 'gallery_photos.album_id', '=', 'a.album_id')
                            ->where('a.album_name', '=', $roominfo->room_name)
                            ->get();
                        }
                        $photonum  = 1;
                    @endphp
                    @foreach ($photos as $photo)
                        <div class="carousel-item @php
                            if($photonum == 1){
                                echo 'active';
                            }
                        @endphp">
                            <img src="{{ asset('images/'.$photo->photo_name) }}" class="d-block w-100" alt="...">
                        </div>
                        @php
                            $photonum += 1;
                        @endphp
                    @endforeach


                    {{-- <div class="carousel-item">
                        <img src="{{ asset('images/place2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/place4.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/place5.jpg') }}" class="d-block w-100" alt="...">
                    </div> --}}
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










    {{-- <section id="slider">
        <div class="col mx-auto d-block">
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
                            <img src="{{ asset('images/' . $photo['photo_name']) }}" class="d-block " alt="...">
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
    </section> --}}


















</div>


    <!---------------------------------description------------------------------->

        <div class="container py-5 sectioncolor">
            <div class="row ps-5">
                <div class="col">
                    <h5> {{$roominfo->room_long_description}} </h5>
                </div>
            </div>
            <div class="row ps-5 pt-3">
                <div class="col">
                    <ul>
                        @if ($roominfo->suite_size != null)
                            <li> <p> {{$roominfo->suite_size}} Square Meter </p> </li>
                        @elseif ($roominfo->room_size != null)
                            <li> <p> {{$roominfo->room_size}} Square Meter </p> </li>
                        @endif

                    </ul>
                </div>
            </div>
            <hr class="mx-5 my-4">
            <div class="row ps-5 pt-3">
                <div class="col">
                   <h4 class="fw-bold"> Details and Amenities </h4>
                   <ul class="mt-4">
                    @if ($roominfo->a1 != '' || $roominfo->a1 != null )
                        <li> {{ $roominfo->a1 }}</li>
                        @endif
                    @if ($roominfo->a2 != '' || $roominfo->a2 != null )
                        <li> {{ $roominfo->a2 }}</li>
                        @endif
                    @if ($roominfo->a3 != '' || $roominfo->a3 != null )
                        <li> {{ $roominfo->a3 }}</li>
                        @endif
                    @if ($roominfo->a4 != '' || $roominfo->a4 != null )
                        <li> {{ $roominfo->a4 }}</li>
                        @endif
                    @if ($roominfo->a5 != '' || $roominfo->a5 != null )
                        <li> {{ $roominfo->a5 }}</li>
                        @endif
                    @if ($roominfo->a6 != '' || $roominfo->a6 != null )
                        <li> {{ $roominfo->a6 }}</li>
                        @endif
                    @if ($roominfo->a7 != '' || $roominfo->a7 != null )
                        <li> {{ $roominfo->a7 }}</li>
                        @endif
                    @if ($roominfo->a8 != '' || $roominfo->a8 != null )
                        <li> {{ $roominfo->a8 }}</li>
                        @endif
                    @if ($roominfo->a9 != '' || $roominfo->a9 != null )
                        <li> {{ $roominfo->a9 }}</li>
                        @endif
                    @if ($roominfo->a10 != '' || $roominfo->a10 != null )
                        <li> {{ $roominfo->a10 }}</li>
                    @endif
                  </ul>
                </div>

            </div>




        </div>

    </section>


    @else
        <h1>ERROR: Invalid URL</h1>

    @endif
@endsection












