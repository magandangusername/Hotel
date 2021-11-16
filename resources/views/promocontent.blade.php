@extends('layouts.app')

@section('content')
    @if ($content != null)

        <!----------banner------------>

            <div class="container p-5">
                <div class="row pt-5">
                    <div class="col pt-4 ps-5 ">
                        <h1 class="fw-bold"><u>{{ $content->promotion_name }}</u></h1>
                        <p class="abouts pt-2">{{ $content->promotion_short_description }}</p>
                        <p class="valid"> Valid from: </p>

                        <p class="valid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar pe-1" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                            {{ date('M d, Y h:ia', strtotime($content->promotion_start)) }} to
                            {{ date('M d, Y h:ia', strtotime($content->promotion_end)) }}
                        </p>
                        <p class="valid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                            +639184168959
                         </p>
                        <a href="{{ route('book.index') }}/{{ $content->promotion_code }}"
                            class="text-decoration-none"><button class="btn btn-light btn-outline-dark fw-bold" id="bonusbutton"> Book
                                Now</button></a>


                    </div>
                    <div class="col p-0 m-0">
                        <img src="{{ asset('images/' . $content->image_name) }}" id="earlypic" class="img-fluid">
                    </div>

                    <div class="row p-5">
                    <div class="col">
                        <p> {{ $content->promotion_long_description }} </p>
                    </div>
                    <div class="col border-start ps-4 ms-5">
                        <h3 class="fw-bold">Terms and condition</h3>
                        <ul>
                            @if ($content->terms_conditions1 != '')
                                <li class="about1">{{ $content->terms_conditions1 }}</li>
                            @endif
                            @if ($content->terms_conditions2 != '')
                                <li class="about1">{{ $content->terms_conditions2 }}</li>
                            @endif
                            @if ($content->terms_conditions3 != '')
                                <li class="about1">{{ $content->terms_conditions3 }}</li>
                            @endif
                        </ul>
                    </div>
                    </div>

                </div>
            </div>
    @else
        <h1>
            <center>The promo '{{ $name }}' does not exist.</center>
        </h1>
    @endif

    <!----------otherpromotion------------>
        <div class="container-fluid sectioncolor">
            <div class="container">
            <h1 class="fw-bold ms-5 pt-5 border-bottom">Other Promotions</h1>

            <div class="row">
                @foreach ($otherpromos as $promo)
                    <div class="col-sm">
                        <div class="card m-5 text-center">
                            <img src="{{ asset('images/' . $promo->image_name) }}" class="card-img-top img-fluid">
                            <div class="card-body">
                                <h4 class="fw-bold pt-3 pb-2">{{ $promo->promotion_name }}</h4>
                                <h6 class="subhead pb-4">{{ $promo->promotion_short_description }}</h6>
                                <form action="" method="POST">
                                    <a href="{{ route('promo') }}/{{ $promo->promotion_name }}"
                                        class="text-decoration-none btn btn-light btn-outline-dark fw-bold" id="learnbutton">Learn More</a>
                                    <a href="{{ route('book.index') }}/{{ $promo->promotion_code }}"
                                        class="text-decoration-none btn btn-light btn-outline-dark fw-bold" id="learnbutton">Book Now</a>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach




            </div>
            </div>
        </div>


@endsection
