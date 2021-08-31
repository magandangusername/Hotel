@extends('layouts.app')

@section('content')
    @if ($content != null)

        <!----------banner------------>

        <section id="banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="earlytitle">{{ $content->promotion_name }}</h1>
                        <p class="abouts">{{ $content->promotion_short_description }}</p>
                        <p class="valid"> Valid from </p>
                        <p class="valid"> {{ date('M d, Y h:ia', strtotime($content->promotion_start)) }} to
                            {{ date('M d, Y h:ia', strtotime($content->promotion_end)) }} </p>
                        <p class="valid"> +639184168959 </p>
                        <a href="{{ route('avail') }}/{{ $content->promotion_code }}"
                            class="text-decoration-none"><button class="btn btn-light" id="bonusbutton"> Book
                                Now</button></a>


                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/' . $content->image_name) }}" id="earlypic" class="img-fluid">
                    </div>

                    <div class="col-md-6">
                        <p class="bonusinfo"> {{ $content->promotion_long_description }} </p>
                    </div>
                    <div class="col-md-6 terms">
                        <h3 class="term">Terms and condition</h3>
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
        </section>
    @else
        <h1>
            <center>The promo '{{ $name }}' does not exist.</center>
        </h1>
    @endif

    <!----------otherpromotion------------>
    <section id="otherpromotion">
        <div class="container-fluid">
            <h1 class="otherpromo">Other Promotions</h1>
            <div class="row">
                @foreach ($otherpromos as $promo)
                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{ asset('images/' . $promo->image_name) }}" alt="">
                            <div class="card-text">
                                <h4>{{ $promo->promotion_name }}</h4>
                                <h6>{{ $promo->promotion_short_description }}</h6>
                                <form action="" method="POST">
                                    <a href="{{ route('promo') }}/{{ $promo->promotion_name }}"
                                        class="text-decoration-none btn btn-light" id="learnbutton">Learn More</a>
                                    <!-- <button class ="btn btn-light" id ="bonusbutton" type="submit" name='booknow'> Book Now</button> -->
                                    <a href="{{ route('avail') }}/{{ $promo->promotion_code }}"
                                        class="text-decoration-none btn btn-light" id="learnbutton">Book Now</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>
        </div>
    </section>


@endsection
