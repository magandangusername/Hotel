@extends('admin/adminframe')

@section('content')



<div class="container-fluid px-4">
    <h1 class="mt-4">Overview</h1>

    <div class="row mt-5">

        <div class="col">
            <div class="card bg-info text-dark mb-4">
                <div class="card-body"><b>Rooms Booked:</b> {{$totalbooked}}/{{$totalrooms}}</div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body "><b>Unoccupied Rooms:</b> {{$unusedrooms}}/{{$totalrooms}}</div>

            </div>
        </div>
        <div class="col">
            <div class="card bg-success text-dark mb-4">
                <div class="card-body"><b>Booked Reservations:</b> {{$reservations}}</div>

            </div>
        </div>

        <div class="col">
            <div class="card bg-danger text-dark mb-4">
                <div class="card-body"><b>Booked Update Requests:</b> {{$updaterequests}}</div>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Room:</b> {{$frequentroom}}</div>


            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Rate</b> {{$frequentrate}}</div>

            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-outline-dark text-dark mb-4">
                <div class="card-body"><b>Preffered Promotion</b> {{$frequentpromotion}}</div>

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
                        <th>User ID</th>
                        <th>Guest Code</th>
                        <th>RR Code</th>
                        <th>Booked At</th>
                        <th>Promotion Code</th>
                        <th>Computed Price Id</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($recentreservations as $recentreservation)
                        <tr>
                            <td>{{$recentreservation->confirmation_number}}</td>
                            <td>{{date("m/d/Y", strtotime($recentreservation->arrival_date))}}</td>
                            <td>{{date("m/d/Y", strtotime($recentreservation->departure_date))}}</td>
                            <td>{{$recentreservation->user_id}}</td>
                            <td>{{$recentreservation->guest_code}}</td>
                            <td>{{$recentreservation->rr_code}}</td>
                            <td>{{date("m/d/Y", strtotime($recentreservation->Booked_at))}}</td>
                            <td>{{$recentreservation->promotion_code}}</td>
                            <td>{{$recentreservation->computed_price_id}}</td>
                        </tr>
                    @endforeach

                    {{-- <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr> --}}

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
                        <th>Modification Number</th>
                        <th>Confirmation Number</th>
                        <th>Update Code</th>
                        <th>Request on</th>
                        <th>Approcal status</th>
                        <th>Approved At</th>
                        <th>Denied At</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($recentmodifications as $recentmodification)
                        <tr>
                            <td>{{$recentmodification->midc}}</td>
                            <td>{{$recentmodification->confirmation_number}}</td>
                            <td>{{$recentmodification->update_code}}</td>
                            <td>{{date("m/d/Y", strtotime($recentmodification->request_on))}}</td>
                            <td>{{$recentmodification->approval_status}}</td>
                            <td>{{date("m/d/Y", strtotime($recentmodification->approved_at))}}</td>
                            <td>{{date("m/d/Y", strtotime($recentmodification->denied_at))}}</td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr> --}}

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
                        <th>Cancellation Number</th>
                        <th>Confirmation Number</th>
                        <th>Request on</th>
                        <th>Guest Code</th>
                        <th>Approval Status</th>
                        <th>Approved on</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($recentmodifications as $recentmodification)
                        <tr>
                            <td>{{$recentmodification->crqc}}</td>
                            <td>{{$recentmodification->confirmation_number}}</td>
                            <td>{{date("m/d/Y", strtotime($recentmodification->request_on))}}</td>
                            <td>{{$recentmodification->approval_status}}</td>
                            <td>{{date("m/d/Y", strtotime($recentmodification->approved_on))}}</td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>

                    </tr> --}}

                </tbody>

            </table>

        </div>

    </div>

</div>


@endsection
