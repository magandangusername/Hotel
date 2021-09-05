<!DOCTYPE html>
<html>

    <head>

      <title>Mondstadt Hotel</title>

      <link rel="icon" href="{{ asset('images/logomondstadt.png') }}">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/c7c1afa5a2.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    </head>

    <body onLoad='calendar(), renderDate()'>
      <!----title--->
      <section id="title">
        <nav class="navbar">
          <div class="container-fluid justify-content-center">
            <a class="navbar-brand " href="{{ route('index') }}" id="titulo" font-size="40%">
              Mondstadt Hotel
              <img src="{{ asset('images/logomondstadt.png') }}" alt="" width="40" height="34" class="d-inline-block align-text-top">
            </a>

            <!---------------------------------nav-bar------------------------------->
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link " href="{{ route('index') }}">Overview</a>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <a class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    Rooms & Suites
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><a class="dropdown-item" href="{{ route('roomtab') }}" type="button">Rooms</a></li>
                    <li><a class="dropdown-item" href="{{ route('suitestab') }}" type="button">Suites</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{ route('promo') }}">Promotion</a>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <a class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    Reservation
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><a class="dropdown-item" href="{{ route('book.index') }}" type="button">Booking</a></li>
                    <li><a class="dropdown-item" href="{{ route('modifyreservation') }}" type="button">Modify/Cancel Reservation</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>



      </section>

      <section id="all">


        @yield('content')


      </section>
    </body>

</html>
