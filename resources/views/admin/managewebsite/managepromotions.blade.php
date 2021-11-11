@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Promotion Resources</h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Promotion Name</th>
                        <th>Promotion Code</th>
                        <th>Long Description</th>
                        <th>Short Description</th>
                        <th>Promotion Discount</th>
                        <th>Promotion Start</th>
                        <th>Promotion End</th>
                        <th>Promotion Image</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <td>Opening Celebration</td>
                        <td>102810281831</td>
                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui debitis eius deserunt dolorem architecto culpa veniam magnam doloribus. Reiciendis, veritatis illum laboriosam aspernatur quia earum amet quae harum perferendis impedit?</td>
                        <td>Short Description</td>
                        <td>10%</td>
                        <td>01/10/21</td>
                        <td>03/10/21</td>
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
                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui debitis eius deserunt dolorem architecto culpa veniam magnam doloribus. Reiciendis, veritatis illum laboriosam aspernatur quia earum amet quae harum perferendis impedit?</td>
                        <td>Short Description</td>
                        <td>10%</td>
                        <td>01/10/21</td>
                        <td>03/10/21</td>
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
            <button type="button" class="btn btn-dark">Add New Promotion</button>


        </div>


    </div>


    <div class="card my-5">
        <form class="p-5">
            <fieldset>
                <div class="row">
                    <div class="col">
                        <b>Promotion Name</b>
                        <input type="text" class="form-control" id="promotioname">
                    </div>
                    <div class="col">
                        <b>Promotion Code</b>
                        <input type="text" class="form-control" id="promotioncode">
                    </div>
                </div>

                <div class="row my-2">
                    <b>Detailed Description</b>

                    <div class="col">
                        <textarea rows="4" cols="80"></textarea>
                    </div>

                    <b>Short Description</b>

                    <div class="col">
                        <textarea rows="4" cols="60"></textarea>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <label for="promotioncode"><b>Promotion Discount</b></label>
                        <input type="number" class="form-control" id="discount" placeholder="3%">
                    </div>

                </div>

                <div class="row my-2">
                    <div class="col">
                        <label for="promotioncode"><b>Promotion Start</b></label>
                        <input type="date" class="form-control" id="arrivalinput" placeholder="3%">
                    </div>
                    <div class="col">
                        <label for="promotioncode"><b>Promotion End</b></label>
                        <input type="date" class="form-control" id="arrivalinput" placeholder="3%">
                    </div>

                </div>

                <div class="row my-2">
                    <div class="col">
                        <b>Promotion Image</b>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        <input type="file" id="imgInp">
                                    </span>
                                </span>
                            </div>
                            <img id='img-upload' />
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </fieldset>
        </form>

    </div>

</div>

@endsection