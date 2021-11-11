@extends('admin/adminframe')


@section('content')

<div class="container-fluid px-4">

<div class="card my-5">
    <div class="card-header">

       <h2>Reservations </h2>
    </div>
    <div class="card-body">
        <table id="datatablerr">
            <thead>
                <tr class="text-light bg-dark">
                    <th>Reservation Number</th>
                    <th>Arrival Date</th>
                    <th>Departure Date</th>
                    <th>Guest Name</th>
                    <th>Room/s Selected</th>
                    <th>Booked At</th>
                    <th>Promotion Applied</th>
                    <th>Remaining Balance</th>
                    <th>Adult</th>
                    <th>Children</th>
                    <th>Payment Type</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>21303182471</td>
                    <td>01/10/21</td>
                    <td>01/11/21</td>
                    <td>John Mark</td>
                    <td>Standard Room</td>
                    <td>01/10/21</td>
                    <td>213131231</td>
                    <td>121</td>
                    <td>2</td>
                    <td>5</td>
                    <td>Credit Card</td>

                    <td>
                        <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>21303182471</td>
                    <td>01/10/21</td>
                    <td>01/11/21</td>
                    <td>Blo Santa Maria</td>
                    <td>Executive Suite</td>
                    <td>01/10/21</td>
                    <td>213131231</td>
                    <td>121</td>
                    <td>2</td>
                    <td>5</td>
                    <td>Credit Card</td>
                    <td>
                        <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>


<div class="card my-5 ">
    <div class="card-body">

            <form class="p-5">
                <fieldset disabled>
                <div class="row">
                    <div class="col">
                            <label for="inputreservationumber"><b>Reservation Number</b></label>
                            <input type="email" class="form-control" id="reservationumber"  placeholder="Enter Reservation Number">
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <label for="arrivalinput"><b>Arrival Date</b></label>
                        <input type="date" class="form-control" id="arrivalinput" >
                     </div>
                     <div class="col">
                        <label for="departureinput"><b>Departure Date</b></label>
                        <input type="date" class="form-control" id="departureinput" >
                     </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <label for="promotioncode"><b>Promotion Code</b></label>
                        <input type="number" class="form-control" id="promotioncode" placeholder="Enter Promotion Code" >
                     </div>

                </div>

                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </fieldset>
            </form>

    </div>
</div>



</div>

@endsection