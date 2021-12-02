<!DOCTYPE html>
<html>

<head>

    <title>Mondstadt Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/logomondstadt.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <script src="https://kit.fontawesome.com/c7c1afa5a2.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <meta charset="utf-8">

    <!-- <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
    integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
    integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c7c1afa5a2.js" crossorigin="anonymous"></script>
  <script src="index.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"> -->

    <script src="https://js.stripe.com/v3/"></script>

</head>

<body onload="calendar()">

    <div class="container-fluid m-0 p-0 bodyback">
        <nav class="navbar navbar-expand-lg navbar-light navcolor px-5 py-3">
            <a class="navbar-brand fw-bold" href="{{route('index')}}">Mondstadt Hotel <span class=""><img
                        src="{{ asset('images/logomondstadt.png') }}" alt="" width="30" height="24"></span></a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="justify-content-center collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav" style="font-size: 120%;">
                    <li class="nav-item active">
                        <a class="nav-link " href="{{ route('index') }}">Overview</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Room/Suites
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('roomtab') }}">Room</a>
                            <a class="dropdown-item" href="{{ route('suitestab') }}">Suites</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promo') }}">Promotion</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Reservation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('book.index') }}">Booking</a>
                            <a class="dropdown-item" href="/search">Modify/Cancel Booking</a>
                        </div>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">{{ __('Sign-In') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('register') }}">Sign-Up</a>
                            </li>
                        @endif

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userprofile') }}">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

        {{-- announcement --}}
        {{-- <div class="alert alert-danger text-center m-0 fw-bold">
            <p>In progress: Please report any bugs or errors. Thank you<a href="#" class="fw-bold" data-dismiss="alert"
                aria-label="close">×</a></p>
        </div> --}}


        <div class="container centerbox p-0">

            @yield('content')

        </div>

        <footer class="container-fluid footnote footnotecolor">
            <div class="container p-5">

                <div class="row">

                    <div class="col-6 mt-md-3">
                        <h5 class="text-uppercase fw-bold">Mondstadt Hotel</h5>
                        <p>Providing guests with a top class accomodation like no other.</p>
                    </div>

                    <div class="col-3 ">
                        <h5 class="text-uppercase">Links</h5>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="{{ route('aboutus') }}" class="text-dark">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('policies') }}" class="text-dark">Hotel Policies</a>
                            </li>
                            <li>
                                <a href="{{ route('aboutus') }}" class="text-dark">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-dark ">Frequently Asked Questions </a>
                            </li>
                            <li>
                                <a href="{{ route('reservationpolicies') }}" class="text-dark ">Modification/Cancellation Policy </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-3">
                        <img src="{{ asset('images/anemo.png') }}" class="footnote_img">
                    </div>

                </div>
            </div>



        </footer>

        <div class="text-center p-3 ml-0" style="background-color: #b99f88;">
            © 2021 Copyright All rights reserve to:
            <a class="text-light" href="#">Monstadt Corporation</a>
        </div>


    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
