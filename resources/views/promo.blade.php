@extends('layouts.app')

@section('content')

    <div class="container text-center p-5">
          <h1 class="fw-bold">Promotions</h1>
          <hr class="mx-5 mb-3 p-1">

    </div>


    @php
      $rows = 0;
    @endphp
    @foreach ($promos as $promo)
      @php
        $rows += 1;
      @endphp

      @if ($rows % 2 ==1)
        <!-- ODD -->

            <div class="container mt-3 px-5 pb-5">
              <div class="row  sectioncolor">

                <div class="col mt-5 text-center">
                  <div class="row pt-5">
                    <div class="col">
                    <h1 class="fw-bold">{{ $promo->promotion_name }}</h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    <p class="abouts1"> {{ $promo->promotion_short_description }} </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a>
                    </form>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <img src="{{ asset('images/'.$promo->image_name) }}"  class="img-thumbnail">
                </div>

              </div>
            </div>
      @endif

      @if ($rows % 2 == 0)
        <!-- EVEN -->
            <div class="container mt-3 px-5 text-center">
              <div class="row sectioncolor">
                <div class="col">
                  <img src="{{ asset('images/'.$promo->image_name) }}" class="img-thumbnail">
                </div>
                <div class="col mt-5 text-center">
                  <div class="row pt-5">
                    <div class="col">
                    <h1 class="fw-bold">{{ $promo->promotion_name }}</h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    <p class="abouts1"> {{ $promo->promotion_short_description }} </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light fw-bold">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light fw-bold" id="promobonus" name="booknow"> Book Now</a>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      @endif
    @endforeach


@endsection
