@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Guest Accounts </h2>
        </div>
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
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Guest Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Guest Info Code</th>
                        <th>Guest Payment Code</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Active Reservation/s</th>
                        <th>Active Numbers/s</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->password}}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->payment_code}}</td>
                            <td>{{date('m/d/Y', strtotime($user->created_at))}}</td>
                            <td>{{date('m/d/Y', strtotime($user->updated_at))}}</td>
                            <td>@php
                                $reservations = DB::table('reservation_tables')
                                ->where('guest_code', {{$user->id}})
                                ->where('arrival_date', '>=', date('Y-m-d'))
                                ->get();
                                $reservationstotal = DB::table('reservation_tables')
                                ->where('guest_code', {{$user->id}})
                                ->where('arrival_date', '>=', date('Y-m-d'))
                                ->count();
                            @endphp @foreach ($reservations as $reservation)
                                {{$reservation->reservation_number}}&nbsp;
                            @endforeach</td>
                            <td>{{$reservationstotal}}</td>


                            <td>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                            </td>
                        </tr>

                    @endforeach


                </tbody>

            </table>
            <button type="submit" class="btn btn-dark mt-2">Add Guest Account</button>

        </div>

    </div>


    <div class="card my-5 ">
        <div class="card-body">

            <form class="p-5">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-3">
                            <b>Email</b>
                            <input type="email" class="form-control" id="inputemail" placeholder="User@email.com">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-2">
                            <label for="arrivalinput"><b>Password</b></label>
                            <input type="text" class="form-control" id="passwordinput">
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-2">
                            <b>Guest Info Code</b>
                            <input type="number" class="form-control" id="guestinfocode">
                        </div>
                        <div class="col-2">
                            <b>Payment Info Code</b>
                            <input type="number" class="form-control" id="paymentinfocode">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        </div>
    </div>



</div>







@endsection
