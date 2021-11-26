@extends('admin/adminframe')

@section('content')

    <div class="container-fluid px-4">

        <div class="card my-5">
            <div class="card-header">

                <h2>Admin Accounts </h2>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Created At</th>
                            <th>Updated At</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->password }}</td>
                                <td>{{ date('m/d/Y', strtotime($admin->created_at)) }}</td>
                                <td>{{ date('m/d/Y', strtotime($admin->updated_at)) }}</td>
                                <td>
                                    <form action="{{ route('admineditacc') }}" method="post">
                                        @csrf
                                        <input type="text" name="deleteadminacc" value="{{ $admin->id }}" hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="{{ route('admineditacc') }}" method="post">
                                        @csrf
                                        <input type="text" name="editadminacc" value="{{ $admin->id }}" hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-pen"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach


                    </tbody>

                </table>
                <form action="{{ route('admineditacc') }}" method="post">
                    @csrf
                    <input type="text" name="addadminacc" value="addadminacc" hidden>
                    <button type="submit" class="btn btn-dark">Add Admin Account</button>
                </form>

            </div>

        </div>


        <div class="card my-5 ">
            <div class="card-body">
                @if (isset($edit))
                    <form class="p-5" method="post" action="{{ route('admineditacc') }}">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-3">
                                    <b>First Name</b>
                                    <input type="text" class="form-control" id="inputemail" placeholder="First Name"
                                        name="first_name" value="{{ $editadmin->first_name }}" disabled>
                                </div>
                                <div class="col-3">
                                    <b>Last Name</b>
                                    <input type="text" class="form-control" id="inputemail" placeholder="Last Name"
                                        name="last_name" value="{{ $editadmin->last_name }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <b>Email</b>
                                    <input type="email" class="form-control" id="inputemail" placeholder="User@email.com"
                                        name="email" value="{{ $editadmin->email }}" disabled>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-2">
                                    <label for="arrivalinput"><b>Password</b></label>
                                    <input type="text" class="form-control" id="passwordinput" name="password">
                                </div>

                            </div>


                            <input type="text" name="submitedit" value="{{ $editadmin->id }}" hidden>
                            <button type="submit" class="btn btn-dark mt-2">Update</button>
                        </fieldset>
                    </form>

                @elseif (isset($add))
                    <form class="p-5" method="post" action="{{ route('admineditacc') }}">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-3">
                                    <b>First Name</b>
                                    <input type="text" class="form-control" id="inputemail" placeholder="First Name"
                                        name="first_name" >
                                </div>
                                <div class="col-3">
                                    <b>Last Name</b>
                                    <input type="text" class="form-control" id="inputemail" placeholder="Last Name"
                                        name="last_name" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <b>Email</b>
                                    <input type="email" class="form-control" id="inputemail" placeholder="User@email.com"
                                        name="email">
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-2">
                                    <label for="arrivalinput"><b>Password</b></label>
                                    <input type="text" class="form-control" id="passwordinput" name="password">
                                </div>

                            </div>

                            <input type="text" name="submitadd" value="submitadd" hidden>
                            <button type="submit" class="btn btn-dark mt-2">Add Account</button>
                        </fieldset>
                    </form>

                @endif


            </div>
        </div>



    </div>







@endsection
