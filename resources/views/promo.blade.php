@extends('layouts.app')

@section('content')
    <section id="promotiontitle">
      <div class="containerss">
        <div class="titles">
          <h1 class="promotionstitle">Promotions</h1>
        </div>
      </div>
    </section>
    @php
      $rows = 0;
    @endphp
    @foreach ($promos as $promo)
      @php
        $rows += 1;
      @endphp

      @if ($rows % 2 ==1)
        <!-- ODD -->
        <section id="promotiontitle">
          <div class="containerss ">
            <div class="container-lg">
              <div class="row ">
                <div class="col-md-6">
                  <div class="title1">
                    <h1 class="earlytitle">{{ $promo->promotion_name }}</h1>
                  </div>
                  <p class="abouts1"> {{ $promo->promotion_short_description }} </p>
                  <div class="promobonus">
                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light" id="promobonus" name="booknow"> Book Now</a>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <img src="{{ asset('images/'.$promo->image_name) }}" id="promopic1" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </section>
      @endif

      @if ($rows % 2 == 0)
        <!-- EVEN -->
        <section id="promotiontitle">
          <div class="containerss ">
            <div class="container-lg">
              <div class="row ">
                <div class="col-md-6">
                  <img src="{{ asset('images/'.$promo->image_name) }}" id="promopic2" class="img-fluid">
                </div>
                <div class="col-md-6">
                  <div class="title2">
                    <h1 class="earlytitle1">{{ $promo->promotion_name }}</h1>
                  </div>
                  <p class="abouts3"> {{ $promo->promotion_short_description }} </p>
                  <div class="promobonus1">
                    <form method="POST" action="">
                      <a href="{{ route('promo') }}/{{ $promo->promotion_name }}" class="text-decoration-none btn btn-light">Learn More</a>
                      <a href="{{ route('book.index') }}?promocode={{ $promo->promotion_code }}" class="btn btn-light" id="promobonus" name="booknow"> Book Now</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      @endif
    @endforeach


@endsection
