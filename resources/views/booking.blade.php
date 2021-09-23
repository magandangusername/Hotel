@extends('layouts.app')

@section('content')
    <form action="/book" method="POST">
        @csrf
        <section id="availability">
            <div class="container">
                <div class="shadow-sm p-1 bg-body rounded">

                    <div class="row g-2 align-items-center justify-content-center ">
                        <div class="col-auto">
                            <label for="inputCheckIn" class="col-form-label">Check-In</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" id="CheckIn" name="CheckIn" type="text"
                                onchange="checkcalendarin()" />
                        </div>

                        <div class="col-auto">
                            <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" id="CheckOut" name="CheckOut" type="text"
                                onchange="checkcalendarout()" />
                        </div>

                        <div class="col-auto ">
                            <label for="inputRoom" class="col-form-label">Room</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control-num" type="number" name="RoomCount" id="roomcount" value="1" min="1"
                                max="3" onchange="rooms(this.value)">
                        </div>

                        <div class="col-auto ">
                            <label for="inputAdult" class="col-form-label">Adult</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control-num" type="number" name="AdultCount" id="adultcount" value="1"
                                min="1">
                        </div>


                        <div class="col-auto">
                            <label for="inputChild" class="col-form-label">Child</label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control-num" type="number" name="ChildCount" id="childadult" value="0"
                                min="0">
                        </div>


                        <div class="row g-2 align-items-center">


                            <div class="col-auto">
                                <label for="inputpromo" id="promotitle" class="col-form-label">Promotion Code</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" name="PromoCode" id="promopromo" @if (isset($_GET['promocode']))
                                value="{{ $_GET['promocode'] }}"
                                @endif
                                >

                            </div>

                            <div class="col-auto " id="adultcount2l" hidden>
                                <label for="inputAdult" id="adultcount2" class="col-form-label">Adult</label>
                            </div>

                            <div class="col-auto" id="adultcount2i" hidden>
                                <input class="form-control-nam1" type="number" name="AdultCountRoom2" id="adultcount2" value="1"
                                    min="1">
                            </div>

                            <div class="col-auto" id="childadult2l" hidden>
                                <label for="inputChild" class="col-form-label">Child</label>
                            </div>

                            <div class="col-auto" id="childadult2i" hidden>
                                <input class="form-control-nam" type="number" name="ChildCountRoom2" id="childadult2"
                                    value="0" min="0">
                            </div>

                            <div class="row g-2 align-items-center">

                                <div class="col-auto " id="adultcount3l" hidden>
                                    <label for="inputAdult" id="adultcount2" class="col-form-label">Adult</label>
                                </div>

                                <div class="col-auto" id="adultcount3i" hidden>
                                    <input class="form-control-nam1" type="number" name="AdultCountRoom3" id="adultcount3"
                                        value="1" min="1">
                                </div>

                                <div class="col-auto" id="childadult3l" hidden>
                                    <label for="inputChild" class="col-form-label">Child</label>
                                </div>

                                <div class="col-auto" id="childadult3i" hidden>
                                    <input class="form-control-nam" type="number" name="ChildCountRoom3" id="childadult3"
                                        value="0" min="0">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>

            </div>
            <!-- </div> -->
        </section>


        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>

            @endforeach
        </div>
    @endif







        <!------calendar--------->



        <!-- <body onload="renderDate()"> -->
        <section id="backcolor">
            <section id="availtitle" hidden>
                <h1 class="availtitles">Availability Calendar</h1>

            </section>
            <div class="container" hidden>
                <div class="col-md-6">
                    <h4 class="checkingin"> Check-In</h4>
                    <div class="calendar">
                        <div class="month">
                            <div class="prev" onclick="moveDate('prev')">
                                <span>&#10094;</span>
                            </div>
                            <div>
                                <h2 id="month"></h2>
                                <p id="date_str"></p>
                            </div>
                            <div class="next" onclick="moveDate('next')">
                                <span>&#10095;</span>
                            </div>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days">

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4 class="checkingout"> Check-Out</h4>
                    <div class="calendar">
                        <div class="monthh">
                            <div class="prevv" onclick="moveDate('prev')">
                                <span>&#10094;</span>
                            </div>
                            <div>
                                <h2 id="monthhs"></h2>
                                <p id="date_strr"></p>
                            </div>
                            <div class="nextt" onclick="moveDate('next')">
                                <span>&#10095;</span>
                            </div>
                        </div>
                        <div class="weekdayss">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="dayss">

                        </div>
                    </div>
                </div>
            </div>
            <hr />

            <section id="footleg">

                <button type="submit" name="checkavail" id="roomcheck" class="btn btn-primary"> Modify/Cancel</button>
                <!-- <a href="reservation.php" input type="sumbit" name="checkavail" id="roomcheck" class="btn btn-primary"> Check Availability </a> -->
                {{-- <button type="submit" name="checkavail" id="roomcheck" class="btn btn-primary"> Check Availability</button> --}}
                <input type="submit" name="checkavail" id="roomcheck" class="btn btn-primary" value="Check Availability">

            </section>
        </section>
    </form>

    <script>
        var dt = new Date();

        function renderDate() {
            dt.setDate(1);
            var day = dt.getDay();
            var today = new Date();
            var endDate = new Date(
                dt.getFullYear(),
                dt.getMonth() + 1,
                0
            ).getDate();

            var prevDate = new Date(
                dt.getFullYear(),
                dt.getMonth(),
                0
            ).getDate();
            var months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ]
            document.getElementById("month").innerHTML = months[dt.getMonth()];
            document.getElementById("date_str").innerHTML = dt.toDateString();
            var cells = "";
            for (x = day; x > 0; x--) {
                cells += "<div class='prev_date'>" + (prevDate - x + 1) + "</div>";
            }
            console.log(day);
            for (i = 1; i <= endDate; i++) {
                if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today'>" + i +
                "</div>";
                else
                    cells += "<div>" + i + "</div>";
            }
            document.getElementsByClassName("days")[0].innerHTML = cells;

        }




        function moveDate(para) {
            if (para == "prev") {
                dt.setMonth(dt.getMonth() - 1);
            } else if (para == 'next') {
                dt.setMonth(dt.getMonth() + 1);
            }
            renderDate();
        }
    </script>

@endsection
