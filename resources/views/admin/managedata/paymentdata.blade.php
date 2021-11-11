@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">
            <h2>Payments </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Payment Code</th>
                        <th>Name on Card</th>
                        <th>Card Number</th>
                        <th>Card Brand</th>
                        <th>Expiration</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>PM-01</td>
                        <td> Mark</td>
                        <td>213123123123123</td>
                        <td>Ligma </td>
                        <td>01/10</td>


                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>PM-01</td>
                        <td> Mark</td>
                        <td>213123123123123</td>
                        <td>Ligma </td>
                        <td>01/10</td>


                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>


</div>

@endsection