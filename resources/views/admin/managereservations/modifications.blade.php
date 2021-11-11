@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Modification Requests </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Reservation Number</th>
                        <th>Request On</th>
                        <th>Approval Status</th>
                        <th>Followed Up on</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>01/11/21</td>
                        <td>John Mark</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>21303182471</td>
                        <td>01/10/21</td>
                        <td>01/11/21</td>
                        <td>Blo Santa Maria</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <div class="card my-5 ">
        <div class="card-body">

            <form class="p-5">
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <h4>Original</h4>
                            <ul class="list-group my-4">
                                <li class="list-group-item">
                                    <h5>Personal Information</h5>
                                </li>
                                <li class="list-group-item list-group-item-danger"><b>Name:</b> John Mark</li>
                                <li class="list-group-item"><b>Address:</b> MarkMarkMarkMark</li>
                                <li class="list-group-item"><b>City:</b> Paseeeg</li>
                                <li class="list-group-item"><b>Phone:</b> 0123931892</li>
                                <li class="list-group-item"><b>Email:</b> jon@email.com</li>
                                <li class="list-group-item"><b>Promotion:</b> Opening Celebration</li>

                            </ul>
                            <ul class="list-group my-4">
                                <li class="list-group-item">
                                    <h5>Rooms</h5>
                                </li>
                                <li class="list-group-item">
                                    <ul class="list-group list-group-flush my-3">
                                        <li class="list-group-item"><b>Room1</b></li>
                                        <li class="list-group-item"><b>Rate:</b> Standard Rate</li>
                                        <li class="list-group-item"><b>Room/Suite:</b> Standard Room</li>
                                        <li class="list-group-item"><b>Bed:</b> Queen Bed</li>
                                        <li class="list-group-item"><b>Subtotal:</b> 5000</li>
                                    </ul>
                                    <ul class="list-group list-group-flush my-5">
                                        <li class="list-group-item list-group-item-danger"><b>Room2</b></li>
                                        <li class="list-group-item list-group-item-danger"><b>Rate:</b> Standard Rate</li>
                                        <li class="list-group-item list-group-item-danger"><b>Room/Suite:</b> Standard Room</li>
                                        <li class="list-group-item list-group-item-danger"><b>Bed:</b> Queen Bed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Subtotal:</b> 5000</li>
                                    </ul>
                                    <ul class="list-group list-group-flush my-5">
                                        <li class="list-group-item list-group-item-danger"><b>Room3</b></li>
                                        <li class="list-group-item list-group-item-danger"><b>Rate:</b> Standard Rate</li>
                                        <li class="list-group-item list-group-item-danger"><b>Room/Suite:</b> Standard Room</li>
                                        <li class="list-group-item list-group-item-danger"><b>Bed:</b> Queen Bed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Subtotal:</b> 5000</li>
                                    </ul>

                                </li>
                                <li class="list-group-item list-group-item-danger"><b>Total:</b> 1,000,000</li>

                            </ul>
                        </div>

                        <div class="col">
                            <h4>Updated</h4>
                            <ul class="list-group my-4">
                                <li class="list-group-item">
                                    <h5>Personal Information</h5>
                                </li>
                                <li class="list-group-item list-group-item-danger"><b>Name:</b> Wong</li>
                                <li class="list-group-item"><b>Address:</b> MarkMarkMarkMark</li>
                                <li class="list-group-item"><b>City:</b> Paseeeg</li>
                                <li class="list-group-item"><b>Phone:</b> 0123931892</li>
                                <li class="list-group-item"><b>Email:</b> jon@email.com</li>
                                <li class="list-group-item"><b>Promotion:</b> Opening Celebration</li>

                            </ul>
                            <ul class="list-group my-4">
                                <li class="list-group-item">
                                    <h5>Rooms</h5>
                                </li>
                                <li class="list-group-item">
                                    <ul class="list-group list-group-flush my-3">
                                        <li class="list-group-item"><b>Room1</b></li>
                                        <li class="list-group-item"><b>Rate:</b> Standard Rate</li>
                                        <li class="list-group-item"><b>Room/Suite:</b> Standard Room</li>
                                        <li class="list-group-item"><b>Bed:</b> Queen Bed</li>
                                        <li class="list-group-item"><b>Subtotal:</b> 5000</li>
                                    </ul>
                                    <ul class="list-group list-group-flush my-5">
                                        <li class="list-group-item list-group-item-danger"><b>Room2</b></li>
                                        <li class="list-group-item list-group-item-danger"><b>Rate:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Room/Suite:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Bed:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Subtotal:</b> Removed</li>
                                    </ul>
                                    <ul class="list-group list-group-flush my-5">
                                        <li class="list-group-item list-group-item-danger"><b>Room3</b></li>
                                        <li class="list-group-item list-group-item-danger"><b>Rate:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Room/Suite:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Bed:</b> Removed</li>
                                        <li class="list-group-item list-group-item-danger"><b>Subtotal:</b> Removed</li>
                                    </ul>

                                </li>
                                <li class="list-group-item list-group-item-danger"><b>Total:</b> 500,000</li>

                            </ul>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-dark mt-2">Approve</button>

                </fieldset>
            </form>

        </div>
    </div>

</div>

@endsection