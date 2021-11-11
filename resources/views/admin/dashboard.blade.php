@extends('admin/adminframe')

@section('content')



<div class="container-fluid px-4">
    <h1 class="mt-4">Overview</h1>

    <div class="row mt-5">

        <div class="col">
            <div class="card bg-info text-dark mb-4">
                <div class="card-body"><b>Rooms Booked:</b> 18/30</div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body "><b>Unoccupied Rooms:</b> 12/30</div>

            </div>
        </div>
        <div class="col">
            <div class="card bg-success text-dark mb-4">
                <div class="card-body"><b>Booked Reservations:</b> 10</div>

            </div>
        </div>

        <div class="col">
            <div class="card bg-danger text-dark mb-4">
                <div class="card-body"><b>Booked Update Requests:</b> 10</div>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Room:</b> Standard Room</div>


            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Rate</b> Breakfast</div>

            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Promotion</b> Opening Celebration</div>

            </div>
        </div>

    </div>


    <h3 class="my-3"><u>Tables</u></h3>
    <div class="card  my-5">
        <div class="card-header">

            <h3>Recent Reservations</h3>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr>
                        <th>Reservation Number</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Guest Code</th>
                        <th>RR Code</th>
                        <th>Booked At</th>
                        <th>Promotion Code</th>
                        <th>Computed Price Id</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>01/11/21</td>
                        <td>12</td>
                        <td>16</td>
                        <td>01/10/21</td>
                        <td>213131231</td>
                        <td>121</td>

                    </tr>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr>

                </tbody>

            </table>


        </div>

    </div>


    <div class="card my-5">
        <div class="card-header">

            <h3>Recent Modifications</h3>
        </div>
        <div class="card-body">
            <table id="datatablerc">
                <thead>
                    <tr>
                        <th>Reservation Number</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Guest Code</th>
                        <th>RR Code</th>
                        <th>Booked At</th>
                        <th>Promotion Code</th>
                        <th>Computed Price Id</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>01/11/21</td>
                        <td>12</td>
                        <td>16</td>
                        <td>01/10/21</td>
                        <td>213131231</td>
                        <td>121</td>

                    </tr>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <div class="card my-5">
        <div class="card-header">
            <h3>Recent Cancellations</h3>

        </div>
        <div class="card-body">
            <table id="datatableru">
                <thead>
                    <tr>
                        <th>Reservation Number</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Guest Code</th>
                        <th>RR Code</th>
                        <th>Booked At</th>
                        <th>Promotion Code</th>
                        <th>Computed Price Id</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>01/11/21</td>
                        <td>12</td>
                        <td>16</td>
                        <td>01/10/21</td>
                        <td>213131231</td>
                        <td>121</td>

                    </tr>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


@endsection