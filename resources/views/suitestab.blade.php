@extends('layouts.app')

@section('content')

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


    <div class="container-fluid">
        <div class="row">

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

                    <div class="container py-3">
                        <div class="row  sectioncolor">

                            <div class="col mt-4 text-center">
                                <div class="row pt-5">
                                    <div class="col">
                                        <h1 class="fw-bold">{{ $suite->suite_name }}</h1>
                                    </div>
                                </div>
                                <div class="row mt-1">
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
                    <div class="container py-3 text-center">
                        <div class="row sectioncolor ">
                            <div class="col">
                                <img src="{{ asset('images/' . $suite->image_name) }}" class="img-thumbnail">
                            </div>
                            <div class="col mt-4 text-center">
                                <div class="row pt-5">
                                    <div class="col">
                                        <h1 class="fw-bold">{{ $suite->suite_name }}</h1>
                                    </div>
                                </div>
                                <div class="row mt-1">
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
