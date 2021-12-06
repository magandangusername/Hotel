@extends('admin/adminframe')

@section('content')
    @php
    $total = 0;
    $total2 = 0;
    $total3 = 0;
    $totalnopromo = 0;
    $totalnopromo2 = 0;
    $totalnopromo3 = 0;
    @endphp

    <main>
        <div class="container-fluid px-4">

            <div class="card my-5">
                <div class="card-header">
                    @if (isset($_GET['success']))
                        <p class="alert alert-success">{{ $_GET['success'] }}</p>
                    @endif
                    @if (isset($_GET['error']))
                        <p class="alert alert-danger">{{ $_GET['error'] }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    @endif

                    <h2>Requests </h2>
                </div>
                <div class="card-body">
                    <table id="datatablerr">
                        <thead>
                            <tr class="text-light bg-dark">
                                <th>Reservation Number</th>
                                <th>Guest Name</th>
                                <th>Request 1</th>
                                <th>Request 2</th>
                                <th>Request 3</th>
                                <th>Request 4</th>
                                <th>Request 5</th>
                                <th>Request 6</th>
                                <th>Request 7</th>
                                <th>Request 8</th>
                                <th>Request 9</th>
                                <th>Request 10</th>
                                <th>Request Charge</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requests as $request)


                                <tr>
                                    <td>{{ $request->confirmation_number }}</td>
                                    @if ($request->guest_code !== null)
                                        @php
                                            $name = DB::table('guest_informations')
                                                ->where('guest_code', $request->guest_code)
                                                ->first();
                                        @endphp
                                    @else
                                        @php
                                            $name = DB::table('users')
                                                ->where('id', $request->user_id)
                                                ->first();
                                        @endphp
                                    @endif
                                    <td>{{ $name->first_name }} {{ $name->last_name }}</td>
                                    <td>{{ $request->rql1 }}</td>
                                    <td>{{ $request->rql2 }}</td>
                                    <td>{{ $request->rql3 }}</td>
                                    <td>{{ $request->rql4 }}</td>
                                    <td>{{ $request->rql5 }}</td>
                                    <td>{{ $request->rql6 }}</td>
                                    <td>{{ $request->rql7 }}</td>
                                    <td>{{ $request->rql8 }}</td>
                                    <td>{{ $request->rql9 }}</td>
                                    <td>{{ $request->rql10 }}</td>
                                    <td>₱ {{ number_format($request->request_charge, 2) }}</td>
                                    <td>
                                        <form action="{{ route('adminmanagerequests') }}" method="post">
                                            @csrf
                                            <input type="text" name='deleterequest' value='{{ $request->rql_id }}'
                                                hidden>
                                            <input type="text" name='confirmation_number'
                                                value='{{ $request->confirmation_number }}' hidden>
                                            <button class="btn btn-outline-dark" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>

                                        <form action="{{ route('adminmanagerequests') }}" method="post">
                                            @csrf
                                            <input type="text" name='editrequest' value='{{ $request->rql_id }}' hidden>
                                            <input type="text" name='confirmation_number'
                                                value='{{ $request->confirmation_number }}' hidden>
                                            <button class="btn btn-outline-dark" type="submit"><i
                                                    class="fas fa-pen"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    <form action="{{ route('adminmanagerequests') }}" method="post">
                        @csrf
                        <input type="text" name="addrequest" value="addrequest" hidden>
                        <button type="submit" class="btn btn-dark">Add New Request</button>
                    </form>

                </div>

            </div>

        </div>
        @if (isset($editrequest))
            <form action="{{ route('adminmanagerequests') }}" class="p-5" method="POST">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-2">
                            <input type="text" class="form-control my-1" id="amenity1"
                                value="{{ $editrequest->confirmation_number }}" disabled>
                            <input type="text" class="form-control my-1" id="amenity1"
                                value="{{ $editrequest->first_name }} {{ $editrequest->last_name }}" disabled>
                            <label for="inputreservationumber"><b>Requests</b></label>
                            <input type="text" name="rql1" class="form-control my-1" id="amenity1"
                                value="{{ $editrequest->rql1 }}" placeholder="Request 1" required>
                            <input type="text" name="rql2" class="form-control my-1" id="amenity2"
                                value="{{ $editrequest->rql2 }}" placeholder="Request 2">
                            <input type="text" name="rql3" class="form-control my-1" id="amenity3"
                                value="{{ $editrequest->rql3 }}" placeholder="Request 3">
                            <input type="text" name="rql4" class="form-control my-1" id="amenity4"
                                value="{{ $editrequest->rql4 }}" placeholder="Request 4">
                            <input type="text" name="rql5" class="form-control my-1" id="amenity5"
                                value="{{ $editrequest->rql5 }}" placeholder="Request 5">
                            <input type="text" name="rql6" class="form-control my-1" id="amenity6"
                                value="{{ $editrequest->rql6 }}" placeholder="Request 6">
                            <input type="text" name="rql7" class="form-control my-1" id="amenity7"
                                value="{{ $editrequest->rql7 }}" placeholder="Request 7">
                            <input type="text" name="rql8" class="form-control my-1" id="amenity8"
                                value="{{ $editrequest->rql8 }}" placeholder="Request 8">
                            <input type="text" name="rql9" class="form-control my-1" id="amenity9"
                                value="{{ $editrequest->rql9 }}" placeholder="Request 9">
                            <input type="text" name="rql10" class="form-control my-1" id="amenity10"
                                value="{{ $editrequest->rql10 }}" placeholder="Request 10">
                            <input type="number" name="request_charge" class="form-control my-1" id="amenity10"
                                value="{{ $editrequest->request_charge }}" placeholder="Request Charge">
                        </div>
                    </div>
                    <input type="hidden" name="submitedit" value="{{ $editrequest->rql_id }}" hidden>
                    <input type="hidden" name="confirmation_number" value="{{ $editrequest->confirmation_number }}" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        @elseif (isset($add))
            <form action="{{ route('adminmanagerequests') }}" class="p-5" method="POST">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-2">
                            <select name="confirmation_number">
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation->confirmation_number }}">
                                        {{ $reservation->confirmation_number }}</option>
                                @endforeach
                            </select>
                            <label for="inputreservationumber"><b>Requests</b></label>
                            <input type="text" name="rql1" class="form-control my-1" id="amenity1" placeholder="Request 1"
                                required>
                            <input type="text" name="rql2" class="form-control my-1" id="amenity2" placeholder="Request 2">
                            <input type="text" name="rql3" class="form-control my-1" id="amenity3" placeholder="Request 3">
                            <input type="text" name="rql4" class="form-control my-1" id="amenity4" placeholder="Request 4">
                            <input type="text" name="rql5" class="form-control my-1" id="amenity5" placeholder="Request 5">
                            <input type="text" name="rql6" class="form-control my-1" id="amenity6" placeholder="Request 6">
                            <input type="text" name="rql7" class="form-control my-1" id="amenity7" placeholder="Request 7">
                            <input type="text" name="rql8" class="form-control my-1" id="amenity8" placeholder="Request 8">
                            <input type="text" name="rql9" class="form-control my-1" id="amenity9" placeholder="Request 9">
                            <input type="text" name="rql10" class="form-control my-1" id="amenity10"
                                placeholder="Request 10">
                            <input type="number" name="request_charge" class="form-control my-1" id="amenity10" value=0
                                min=0 placeholder="Request Charge">
                        </div>
                    </div>
                    <input type="hidden" name="submitadd" value="submitadd" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Add Requests</button>
                </fieldset>
            </form>

        @endif


    </main>





@endsection
