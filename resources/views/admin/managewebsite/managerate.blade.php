@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Manage Rates </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Rate Name</th>
                        <th>Rate Offer 1</th>
                        <th>Rate Offer 2</th>
                        <th>Rate Offer 3</th>
                        <th>Room Discount</th>
                        <th>Service Rate</th>
                        <th>City Tax</th>
                        <th>Vat</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Image 3</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <td>Opening Celebration</td>
                        <td>Wafe</td>
                        <td>Wafet</td>
                        <td>Raters</td>
                        <td>10%</td>
                        <td>01/10/21</td>
                        <td>03/10/21</td>
                        <td>03/10/21</td>

                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>
                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>
                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>

                    </tr>
                    <tr>
                        <td>Opening Celebration</td>
                        <td>102810281831</td>
                        <td>Wafet</td>
                        <td>Short Description</td>
                        <td>10%</td>
                        <td>01/10/21</td>
                        <td>03/10/21</td>
                        <td>03/10/21</td>

                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>
                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>
                        <td>
                            <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                        </td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>

                    </tr>

                </tbody>

            </table>
            <button type="button" class="btn btn-dark">Add New Rate</button>


        </div>


    </div>

    <div class="card my-5">
        <form class="p-5">
            <fieldset disabled>
                <div class="row">
                    <div class="col-4">
                        <b>Rate Name</b>
                        <input type="text" class="form-control" id="promotioname">
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col">
                        <b>Rate Offer 1</b>
                        <input type="text" class="form-control" id="ro1">
                    </div>
                    <div class="col">
                        <b>Rate Offer 2</b>
                        <input type="text" class="form-control" id="ro2">
                    </div>
                    <div class="col">
                        <b>Rate Offer 3</b>
                        <input type="text" class="form-control" id="ro3">
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col">
                        <b>Room Discount</b>
                        <input type="text" class="form-control" id="rdiscount">
                    </div>
                    <div class="col">
                        <b>Service Rate</b>
                        <input type="text" class="form-control" id="servrate">
                    </div>
                    <div class="col">
                        <b>City Tax</b>
                        <input type="text" class="form-control" id="citytax">
                    </div>
                    <div class="col">
                        <b>Vat</b>
                        <input type="text" class="form-control" id="vat">
                    </div>

                </div>

                <div class="row my-2">

                    <div class="col">
                        <b>Image 1</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
                        <b>Image 2</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
                        <b>Image 3</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />

                    </div>

                </div>


                <button type="submit" class="btn btn-dark mt-2">Update</button>
            </fieldset>
        </form>

    </div>

</div>

@endsection