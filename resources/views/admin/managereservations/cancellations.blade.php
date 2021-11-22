@extends('admin/adminframe')

@section('content')


<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">
            @if (isset($_GET['success']))
                <p class="alert alert-success">{{ $_GET['success'] }}</p>
            @endif
            <h2>Cancellations </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Reservation Number</th>
                        <th>Request On</th>
                        <th>Reason</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cancellations as $cancellation)
                        <tr>
                            <td>{{$cancellation->confirmation_number}}</td>
                            <td>{{date('m/d/Y', strtotime($cancellation->request_on))}}</td>
                            <td>{{$cancellation->reason}}</td>


                            <td>
                                <form action="/admin/cancellation" method="post">
                                    @csrf
                                    <input type="text" name="id" value="{{$cancellation->id}}" hidden>
                                    <input type="text" name="deny" value="deny" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="/admin/cancellation" method="post">
                                    @csrf
                                    <input type="text" name="id" value="{{$cancellation->id}}" hidden>
                                    <input type="text" name="approve" value="approve" hidden>
                                    <input type="text" name="confirmation_number" value="{{$cancellation->confirmation_number}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>
                        </tr>

                    @endforeach


                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
