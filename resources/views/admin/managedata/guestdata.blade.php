@extends('admin/adminframe')

@section('content')


<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">
            <h2>Guest Information </h2>
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
                        <th>Guest Info Code</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Account Owner</th>
                        <th>Payment Info Code</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->city}}</td>
                            <td>{{$user->mobile_num}}</td>
                            <td>{{$user->email}}</td>
                            <td>Yes</td>
                            <td>{{$user->payment_code}}</td>

                            <td>
                                <form action="{{route('admineditguestinfo')}}" method="post">
                                    @csrf
                                    <input type="text" name="deleteguestinfo" value="{{$user->id}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{route('admineditguestinfo')}}" method="post">
                                    @csrf
                                    <input type="text" name="editguestinfo" value="{{$user->id}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($guests as $guest)
                        <tr>
                            <td>{{$guest->guest_code}}</td>
                            <td>{{$guest->first_name}} {{$guest->last_name}}</td>
                            <td>{{$guest->address}}</td>
                            <td>{{$guest->city}}</td>
                            <td>{{$guest->mobile_num}}</td>
                            <td>{{$guest->email}}</td>
                            <td>No</td>
                            <td>{{$guest->payment_code}}</td>

                            <td>
                                <form action="{{route('admineditguestinfo')}}" method="post">
                                    @csrf
                                    <input type="text" name="deleteguestinfo" value="{{$guest->guest_code}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{route('admineditguestinfo')}}" method="post">
                                    @csrf
                                    <input type="text" name="editguestinfo" value="{{$guest->guest_code}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

            {{-- i dont think there is a point for this
            <button type="submit" class="btn btn-dark mt-2">Add Guest</button> --}}

        </div>

    </div>

    <div class="card my-5 ">
        <div class="card-body">
            @if (isset($edit))

                <form class="p-5" method="POST" action="{{route('admineditguestinfo')}}">
                    @csrf
                    <fieldset >
                        <div class="row">
                            <div class="col-3">
                                <label for="inputreservationumber"><b>Guest Name</b></label>
                                <input type="text" class="form-control" id="inputfname" placeholder="First Name" name="first_name" value="{{$editguest->first_name}}">
                                <input type="text" class="form-control mt-2" id="inputname" placeholder="Last Name" name="last_name" value="{{$editguest->last_name}}">

                            </div>

                        </div>

                        <div class="row my-2">
                            <div class="col-4">
                                <label for="arrivalinput"><b>Address</b></label>
                                <input type="text" class="form-control" id="addressinput" name="address" value="{{$editguest->address}}">
                            </div>
                            <div class="col-3">
                                <label for="departureinput"><b>City</b></label>
                                <input type="text" class="form-control" id="cityinput" name="city" value="{{$editguest->city}}">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-3">
                                <label for="arrivalinput"><b>Email</b></label>
                                <input type="email" class="form-control" id="emailinput" name="email" value="{{$editguest->email}}">
                            </div>
                            <div class="col-3">
                                <label for="departureinput"><b>Number</b></label>
                                <input type="text" class="form-control" id="numberinput" name="mobile_num" value="{{$editguest->mobile_num}}">
                            </div>

                        </div>

                        <div class="row my-2">
                            <div class="col-3">
                                <label for="arrivalinput"><b>Payment Info Code</b></label>
                                <input type="text" class="form-control" id="paymentinfoCODE" placeholder="PM-01" name="payment_code" value="{{$editguest->payment_code}}" disabled>
                            </div>


                        </div>

                        <input type="text" name="submitedit" value="@if ($editguest->id !== null)
                            {{$editguest->id}}
                            @else
                            {{$editguest->guest_code}}
                        @endif" hidden>
                        <button type="submit" class="btn btn-dark mt-2">Update</button>
                    </fieldset>
                </form>

            @endif


        </div>
    </div>

</div>




@endsection
