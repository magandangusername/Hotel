@extends('layouts.app')

@section('content')

<section id="forms">
    <div class="checkout">
        <div class="titlecheck">
            <a href="modifyreservation.php" input type="button" id="backmod" class="btn btn-primary"> Back </a>
            <h1 class="modifhye">Checkout</h1>
        </div>
    </div>
</section>

<section id="usereditss">
    <div class="containerchecks">
        <div class="row g-2 justify-content-center">

            <div class="col-auto">
                <p class="label">Your Stay: {{date('M d, Y', strtotime(session('checkin')))}} - {{date('M d, Y', strtotime(session('checkout')))}}</p>
            </div>
            <div class="col-auto" hidden>
                <p class="label vertical">adult</p>
            </div>
            <div class="col-auto" hidden>
                <p class="label">children</p>
            </div>
            <div class="col-auto">
                <p class="label">Total rate: @php
                if (session('RoomCount') >= 1) {
                    $totalrate = floatval(session('totalrate'));
                    if (session('RoomCount') >= 2) {
                        $totalrate += floatval(session('totalrate2'));
                        if (session('RoomCount') == 3) {
                            $totalrate += floatval(session('totalrate3'));
                        }
                    }

                }
                Session::put('overallprice', number_format($totalrate, 2));
                echo session('overallprice');
                @endphp</p>
            </div>
        </div>
    </div>
</section>
<form action="bookinformation" method="post">
    <div class="containercheckuser">
        <div class="titlechecks">
            <div class="row g-3" id="whitey">
                <h1 class="personals">Personal Information</h1>
                <section id="wowo">
                    <div class="form-group form-inline">
                        <label>Title</label>
                        <select name="name_with_initials" id="">
                            <option selected="selected" value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </div>


                    <div class="col-md-5 ">
                        <label for="first"> First Name:</label>
                        <input type="text" class="form-control" id="firstname">
                    </div>

                    <div class="col-md-5 ">
                        <label for="last">Last Name:</label>
                        <input type="text" class="form-control" id="lastname">
                    </div>


                    <div class="col-md-5 ">
                        <label for="email">Email Address:</label>
                        <input type="text" class="form-control-plaintext" id="firste">
                    </div>


                    <div class="col-md-5 ">
                        <label for="reemail">Re-Type Email Address:</label>
                        <input type="text" class="form-control-plaintext" id="firste">
                    </div>

                </section>
                <hr />
                <section id="wowo1">
                    <h1 class="personals">Address</h1>

                    <div class="col-md-6  ">
                        <label for="first"> Address:</label>
                        <input type="text" class="form-control-plaintext" id="first" name='address'>
                    </div>
                    <div class="col-md-5  ">
                        <label for="email">City:</label>
                        <input type="text" class="form-control" id="email" name='city'>
                    </div>


                    <div class="col-md-6 ">
                        <label for="last">Mobile Number:</label>
                        <input type="text" class="form-control" id="last" name='mobilenum'>
                    </div>
                </section>

            </div>
        </div>
    </div>


    <section id="twobutt">


        <div class="row ">
            <div class="buttwo">
                <button type="submit"  name="review" class="btn btn-primary"> Review Reservation </button>
                <button type="submit"  name="checkout" class="btn btn-primary"> Proceed to payment </button>
            </div>
        </div>

    </section>
</form>

@endsection
