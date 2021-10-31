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

    <script src="https://js.stripe.com/v3/"></script>

</head>

<body  onload="calendar()">
    <div class="container-fluid m-0 p-0 bodyback">
    <nav class="navbar navbar-expand-lg navbar-light  bg-primary px-5 py-3">
      <a class="navbar-brand fw-bold" href="#">Mondstadt Hotel <span class=""><img src="{{ asset('images/logomondstadt.png') }}" alt="" width="30" height="24"></span></a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="justify-content-center collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('index') }}">Overview</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Reservation
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('book.index') }}">Booking</a>
              <a class="dropdown-item" href="/search">Modify/Cancel Booking</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        </ul>
      </div>
    </nav>






    <div class="container bg-light p-0">

        @yield('content')

    </div>

    <footer class="container-fluid footnote " style="background-color: rgba(21, 143, 243)">
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
                        <a href="#!" class="text-dark">About Us</a>
                      </li>
                      <li>
                        <a href="#!" class="text-dark">Privacy and Cancellation Policies</a>
                      </li>
                      <li>
                        <a href="#!" class="text-dark">Contact Us</a>
                      </li>
                      <li>
                        <a href="#!" class="text-dark ">Frequently Asked Questions </a>
                      </li>
                    </ul>
                  </div>

                  <div class="col-3">
                      <img src="{{asset('images/anemo.png')}}" class="footnote_img">
                  </div>

                </div>
            </div>



        </footer>

        <div class="text-center p-3 ml-0" style="background-color:rgba(0, 112, 204)">
              © 2021 Copyright All rights reserve to:
              <a class="text-light" href="#">Monstadt Corporation</a>
        </div>


</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
