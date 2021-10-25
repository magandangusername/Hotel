





        <nav class="navbar">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand " href="{{ route('index') }}" id="titulo" font-size="40%">
                    Mondstadt Hotel
                    <img src="{{ asset('images/logomondstadt.png') }}" alt="" width="40" height="34"
                        class="d-inline-block align-text-top">
                </a>

                <!---------------------------------nav-bar------------------------------->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('index') }}">Overview</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Rooms & Suites
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="{{ route('roomtab') }}" type="button">Rooms</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('suitestab') }}" type="button">Suites</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('promo') }}">Promotion</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Reservation
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="{{ route('book.index') }}"
                                        type="button">Booking</a></li>
                                <li><a class="dropdown-item" href="/search"
                                        type="button">Modify/Cancel Reservation</a></li>
                            </ul>
                        </div>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">{{__('Login')}}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('register') }}">Register</a>
                            </li>
                        @endif

                    @else
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>



    </section>


    <div class="col text-center">
                    <a href="{{ route('roomtab') }}" input type="button" id="seeall"
                        class="btn btn-outline-info justify-content-center">See All Rooms & Suites</a>
                </div>

    <div class="col text-center">
        <a href="{{ route('promo') }}" input type="button" id="seeall"
            class="btn btn-outline-info justify-content-center">See All Special Offers</a>
    </div>






            <div class="card">
                        <img src="{{ asset('images/experiences.png') }}" class="img-thumbnail">
                        <div class="card-text">
                            <h4>Luxurious Experience</h4>
                            <h6>A level of experience like no other</h6>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{ asset('images/service.jpg') }}" class="img-thumbnail">
                        <div class="card-text">
                            <h4>Top Notch Service</h4>
                            <h6>A level of service like no other</h6>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{ asset('images/maintains.png') }}" class="img-thumbnail">
                        <div class="card-text">
                            <h4>Well-Maintained </h4>
                            <h6>A Well-Maintained place like no other</h6>
                        </div>
                    </div>


                    {{-- <div class="col"></div>
                <div class="col" id="availnow">
                    <h4 class="bold"> Room</h3>
                        <p>this is standard</p>
                        <a href="">see latest room offers</a>
                </div>
                @include('layouts.checkavailability2') --}}
