@extends('layouts.app')

@section('content')







    <div class="container text-center p-5">
        <div class="titles">
          <h1 class="fw-bold">Promotions</h1>
        </div>
    </div>


<!-- - experimental jumbotron class

  </div> -->




    @php
      $rows = 0;
    @endphp
    @foreach ($promos as $promo)
      @php
        $rows += 1;
      @endphp

      @if ($rows % 2 ==1)
        <!-- ODD -->
            <div class="container p-5  bg-info">
              <div class="row">

                <div class="col mt-5">

                  <div class="title1">
                    <h1 class="fw-bold">{{ $promo->promotion_name }}</h1>
                  </div>

                  <p class="abouts1"> {{ $promo->promotion_short_description }} </p>

                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a>
                    </form>

                </div>

                <div class="col">
                  <img src="{{ asset('images/'.$promo->image_name) }}"  class="img-fluid">
                </div>

              </div>
            </div>
      @endif

      @if ($rows % 2 == 0)
        <!-- EVEN -->
            <div class="container p-5  bg-info">
              <div class="row">
                <div class="col">
                  <img src="{{ asset('images/'.$promo->image_name) }}" class="img-fluid">
                </div>
                <div class="col mt-5">
                  <div class="title2">
                    <h1 class="fw-bold">{{ $promo->promotion_name }}</h1>
                  </div>
                  <p class="abouts3"> {{ $promo->promotion_short_description }} </p>
                  <div class="promobonus1">
                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
      @endif
    @endforeach


@endsection
