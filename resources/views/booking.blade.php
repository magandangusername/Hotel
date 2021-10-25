@extends('layouts.app')

@section('content')
    <form action="/book" method="POST">
        @csrf

            <div class="container px-5 py-3">
                    <h1 class="fw-bold text-center pt-5"> Check Availability </h1>
                    <hr class="mx-5 mb-5 p-1">

                    <div class="row mx-5">

                        <div class="col-xl-3 col-5">
                            <label for="inputCheckIn" class="col-form-label">Check-In</label>
                            <input class="form-control" type="date" id="CheckIn" name="CheckIn" type="text" onchange="checkcalendarin()"/>
                        </div>

                        <div class="col-xl-3 col-5">
                            <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                            <input class="form-control" type="date" id="CheckOut" name="CheckOut" type="text" onchange="checkcalendarout()"/>
                        </div>



                        <div class="col px-xl-5  px-lg-5 px-md-3">
                            <label for="inputRoom" class="col-form-label">Room</label>
                            <input class="form-control-num" type="number" name="RoomCount" id="roomcount" value="1" min="1"
                                max="3" onchange="rooms(this.value)">
                        </div>

                        <div class="col">

                            <label for="inputAdult" class="col-form-label">Adult</label>
                            <input class="form-control-num" type="number" name="AdultCount" id="adultcount" value="1"
                                min="1">

                            <div id="adultcount2l" hidden>
                                <label for="inputAdult" id="adultcount2" class="col-form-label">Adult</label>
                                <input class="form-control-nam1" type="number" name="AdultCount2" id="adultcount2" value="1"
                                    min="1">
                            </div>
                            <div id="adultcount2i" hidden></div>

                            <div id="adultcount3l" hidden>
                                <label for="inputAdult" id="adultcount2" class="col-form-label">Adult</label>
                                <input class="form-control-nam1" type="number" name="AdultCount3" id="adultcount3"
                                    value="1" min="1">
                            </div>
                            <div id="adultcount3i" hidden></div>

                        </div>

                        <div class="col">

                            <label for="inputChild" class="col-form-label">Child</label>
                            <input class="form-control-num" type="number" name="ChildCount" id="childadult" value="0"
                                min="0">


                            <div id="childadult2l" hidden>
                                <label for="inputChild" class="col-form-label">Child</label>
                                <input class="form-control-nam" type="number" name="ChildCount2" id="childadult2"
                                    value="0" min="0">
                            </div>
                            <div id="childadult2i" hidden></div>

                            <div id="childadult3l" hidden>
                                <label for="inputChild" class="col-form-label">Child</label>
                                <input class="form-control-nam" type="number" name="ChildCount3" id="childadult3"
                                    value="0" min="0">
                            </div>
                            <div id="childadult3i" hidden></div>

                        </div>

                    </div>

                    <div class="row mx-5">

                            <div class="col-4">
                                <label for="inputpromo" id="promotitle" class="col-form-label">Promotion Code</label>
                                <input class="form-control" type="text" name="PromoCode" id="promopromo" @if (isset($_GET['promocode']))
                                value="{{ $_GET['promocode'] }}"
                                @endif
                                >
                            </div>

                    </div>

                    <div class="row mt-4 text-center">
                        <div class="col">
                            <a href="/search" class="btn btn-primary fw-bold" id="roomcheck">Modify/Cancel</a>
                            <!-- <a href="reservation.php" input type="sumbit" name="checkavail" id="roomcheck" class="btn btn-primary"> Check Availability </a> -->
                            {{-- <button type="submit" name="checkavail" id="roomcheck" class="btn btn-primary"> Check Availability</button> --}}
                            <input type="submit" name="checkavail" id="roomcheck" class="btn btn-primary fw-bold" value="Check Availability">
                        </div>
                    </div>


            </div>



                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </div>
                @endif





            <div class="container px-5 py-3">
                 <h1 class="fw-bold pt-4 mx-5"> Preffered</h1>
                    <hr class="mx-5 p-1">

                <div class="row mx-5">
                    <div class="col p-1">

                            <div class="jumbotron text-white jumbotron-image shadow preffer text-center">
                            <h2 class="fw-bold p-4">
                                Executive Suite
                            </h2>
                            <p class="mb-4">
                                With its fancy interior and
                            </p>
                            <a href="" class="btn btn-primary m-5">View More</a>
                            </div>


                    </div>

                    <div class="col p-1">

                            <div class="jumbotron text-white jumbotron-image shadow preffer text-center">
                            <h2 class="fw-bold p-4">
                                Online Exclusive
                            </h2>
                            <p class="mb-4">
                                Hey, check this out.
                            </p>
                            <a href="" class="btn btn-primary m-5">View More</a>
                            </div>

                    </div>

                    <div class="col  p-1">
                            <div class="jumbotron text-white jumbotron-image shadow preffer text-center" >
                            <h2 class="fw-bold p-4">
                                Bread and Breakfast
                            </h2>
                            <p class="mb-4">
                                Hey, check this out.
                            </p>
                            <a href="" class="btn btn-primary m-5">View More</a>
                            </div>
                    </div>



                </div>
            </div>


    </form>


@endsection
