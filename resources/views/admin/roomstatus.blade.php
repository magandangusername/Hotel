@extends('admin/adminframe')

@section('content')

<main>
    <div class="container-fluid px-4">

        <div class="card my-5">
            <div class="card-header">

                <h2>Past Reservations </h2>
            </div>
            <div class="card-body">
                <table id="datatablerr">
                    <thead>
                        <tr class="text-light bg-dark">
                            <th>Room Number</th>
                            <th>Status</th>
                            <th>Reservation Number</th>
                            <th>Room/Suite Name</th>
                            <th>Bed</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($statuses as $status)


                        <tr>
                            <td>{{$status->room_number}}</td>
                            <td>{{$status->status}}</td>
                            <td>{{$status->confirmation_number}}</td>
                            <td>{{$status->room_suite_name}}</td>
                            <td>{{$status->room_suite_bed}}</td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>





@endsection
