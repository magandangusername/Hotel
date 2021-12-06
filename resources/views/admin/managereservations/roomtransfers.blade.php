@extends('admin/adminframe')

@section('content')

    <main>
        <div class="container-fluid px-4">

            <div class="card my-5">
                <div class="card-header">

                    <h2>Room Transfers </h2>
                </div>
                <div class="card-body">
                    <table id="datatablerr">
                        <thead>
                            <tr class="text-light bg-dark">
                                <th>Transfer Date</th>
                                <th>Previous Room</th>
                                <th>Transferred Room</th>
                                <th>Confirmation Number</th>
                                <th>Reason</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roomtransfers as $roomtransfer)


                                <tr>
                                    <td>{{ $roomtransfer->transfer_date }}</td>
                                    <td>{{ $roomtransfer->previous_room }}</td>
                                    <td>{{ $roomtransfer->transferred_room }}</td>
                                    <td>{{ $roomtransfer->confirmation_number }}</td>
                                    <td>{{ $roomtransfer->reason }}</td>


                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </main>





@endsection
