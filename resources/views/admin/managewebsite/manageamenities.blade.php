@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Amenities </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Amenities Code</th>
                        <th>Amenity 1</th>
                        <th>Amenity 2</th>
                        <th>Amenity 3</th>
                        <th>Amenity 4</th>
                        <th>Amenity 5</th>
                        <th>Amenity 6</th>
                        <th>Amenity 7</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>AM-01</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>

                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>AM-01</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>
                        <td>Coke</td>
                        <td>Wine</td>
                        <td>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>

                </tbody>

            </table>
            <button type="submit" class="btn btn-dark mt-2">Add New Amenity</button>

        </div>

    </div>


    <div class="card my-5 ">
        <div class="card-body">

            <form class="p-5">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-2">
                            <label for="inputreservationumber"><b>Amenities</b></label>
                            <input type="text" class="form-control my-1" id="amenity1" placeholder="Amenity 1">
                            <input type="text" class="form-control my-1" id="amenity2" placeholder="Amenity 2">
                            <input type="text" class="form-control my-1" id="amenity3" placeholder="Amenity 3">
                            <input type="text" class="form-control my-1" id="amenity4" placeholder="Amenity 4">
                            <input type="text" class="form-control my-1" id="amenity5" placeholder="Amenity 5">
                            <input type="text" class="form-control my-1" id="amenity6" placeholder="Amenity 6">
                            <input type="text" class="form-control my-1" id="amenity7" placeholder="Amenity 7">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        </div>
    </div>

</div>

@endsection