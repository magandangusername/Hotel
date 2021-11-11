@extends('admin/adminframe')

@section('content')


<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Admin Accounts </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Created At</th>
                        <th>Updated At</th>


                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Kazui</td>
                        <td>mark@email.com</td>
                        <td>2323123</td>
                        <td>01/10/21</td>
                        <td>01/10/21</td>


                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Kazui</td>
                        <td>mark@email.com</td>
                        <td>2323123</td>
                        <td>01/10/21</td>
                        <td>01/10/21</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>

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