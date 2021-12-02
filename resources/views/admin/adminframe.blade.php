<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mondstadt Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Admin Panel</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="nav-link dropdown-item" style="color: black" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Overview
                            </a>
                            <a class="nav-link" href="{{ route('roomstatus') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Rooms Status
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Reservations</div>
                            <a class="nav-link" href="{{ route('adminreservation') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Reservations
                            </a>
                            <a class="nav-link" href="{{ route('admincancellation') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-minus-circle"></i></div>
                                Cancellations
                            </a>
                            <a class="nav-link" href="{{ route('adminmodification') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Modifications
                            </a>

                            <div class="sb-sidenav-menu-heading">Manage Website</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#roomcollapse" aria-expanded="false" aria-controls="collapseLayouts">

                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-bed"></i>
                                </div>

                                Guestroom
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                            </a>

                            <div class="collapse" id="roomcollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('adminroom') }}">Room</a>
                                    <a class="nav-link" href="{{ route('adminsuite') }}">Suites</a>
                                    <a class="nav-link" href="{{ route('adminamenity') }}">Amenities</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#campaigncollapse" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-glass-cheers"></i>
                                </div>
                                Campaigns
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="campaigncollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('adminpromotion') }}">Promotion</a>
                                    <a class="nav-link" href="{{ route('adminrate') }}">Rates</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Manage Accounts</div>
                            <a class="nav-link" href="{{ route('adminguestacc') }}">
                                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  </svg></div>
                                Guest
                            </a>
                            <a class="nav-link" href="{{ route('adminacc') }}">
                                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                  </svg></div>
                                Admin
                            </a>

                            <div class="sb-sidenav-menu-heading">Manage Data</div>


                            <a class="nav-link" href="{{ route('adminlog') }}">
                                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                    <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                                  </svg></div>
                                Logged Reservations
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#infocollapse" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Guest Information
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="infocollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('adminguestinfo') }}">Personal Information</a>
                                    {{-- <a class="nav-link" href="{{ route('adminguestpayment') }}">Payment Information</a> --}}
                                </nav>
                            </div>



                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: {{Auth::user()->first_name}}</div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>


                @yield('content')



                </main>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
