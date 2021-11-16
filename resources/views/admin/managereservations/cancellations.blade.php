@extends('admin/adminframe')

@section('content')


<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

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
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>Payment Problem</td>


                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>Urgent Matter</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection