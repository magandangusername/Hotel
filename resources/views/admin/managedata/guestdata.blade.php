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
                    <tr>
                        <td>21303182471</td>
                        <td>Im Mark</td>
                        <td>Zamboanga</td>
                        <td>Sigpa</td>
                        <td>01929381930</td>
                        <td>Email@email.com</td>
                        <td>Yes</td>
                        <td>PM-01</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>21303182471</td>
                        <td>Im Mark</td>
                        <td>Zamboanga</td>
                        <td>Sigpa</td>
                        <td>01929381930</td>
                        <td>Email@email.com</td>
                        <td>Yes</td>
                        <td>PM-01</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>
            <button type="submit" class="btn btn-dark mt-2">Add Guest</button>

        </div>

    </div>

    <div class="card my-5 ">
        <div class="card-body">

            <form class="p-5">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-3">
                            <label for="inputreservationumber"><b>Guest Name</b></label>
                            <input type="text" class="form-control" id="inputfname" placeholder="Jonh">
                            <input type="text" class="form-control mt-2" id="inputname" placeholder="Mark">

                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-4">
                            <label for="arrivalinput"><b>Address</b></label>
                            <input type="text" class="form-control" id="addressinput">
                        </div>
                        <div class="col-3">
                            <label for="departureinput"><b>City</b></label>
                            <input type="text" class="form-control" id="cityinput">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-3">
                            <label for="arrivalinput"><b>Email</b></label>
                            <input type="text" class="form-control" id="emailinput">
                        </div>
                        <div class="col-3">
                            <label for="departureinput"><b>Number</b></label>
                            <input type="text" class="form-control" id="numberinput">
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-3">
                            <label for="arrivalinput"><b>Payment Info Code</b></label>
                            <input type="text" class="form-control" id="paymentinfoCODE" placeholder="PM-01">
                        </div>


                    </div>

                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        </div>
    </div>

</div>




@endsection
