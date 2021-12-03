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
                            <th>Reservation Number</th>
                            <th>Guest Code</th>
                            <th>User ID</th>
                            <th>Payment Code</th>
                            {{-- <th>Arrival Date</th>
                            <th>Departure Date</th> --}}
                            <th>Booked at</th>
                            <th>Log Status</th>
                            <th>End At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($logs as $log)


                        <tr>
                            <td>{{$log->reservation_number}}</td>
                            <td>{{$log->guest_code}}</td>
                            <td>{{$log->user_id}}</td>
                            <td>{{$log->payment_code}}</td>
                            {{-- <td>Too Dumb</td>
                            <td>21303182471</td> --}}

                            <td>{{$log->Booked_at}}</td>
                            <td>{{$log->log_status}}</td>
                            <td>{{$log->end_at}}</td>



                            <td>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>





@endsection
