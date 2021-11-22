@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Manage Room </h2>
        </div>
        <div class="card-body">
            <table id="datatablerr">
                <thead>
                    <tr class="text-light bg-dark">
                        <th>Room Name</th>
                        <th>Detailed Description</th>
                        <th>Short Description</th>
                        <th>Room Size</th>
                        <th>Base Price</th>
                        <th>Beds</th>
                        <th>Room Image 1</th>
                        <th>Room Image 2</th>
                        <th>Room Image 3</th>
                        <th>Amenities Set</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rooms as $room)


                        <tr>

                            <td>Standard Room</td>
                            <td>This room is cool and long</td>
                            <td>And its also short</td>
                            <td>1M SQM</td>
                            <td>1T USD</td>
                            <td>King,Queen</td>
                            @php
                                $photos = DB::table('gallery_photos')
                                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                                ->where('room_descriptions.room_name', $room->room_name)
                                ->limit(3)
                                ->get();
                                dd($photos);
                            @endphp
                            <td>
                                <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="https://www.jquery-az.com/html/images/banana.jpg" width="100" height="100"></image>
                            </td>
                            <td>Set 1</td>
                            <td>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
            <button type="button" class="btn btn-dark">Add New Room</button>

        </div>


    </div>

    <div class="card my-5">
        <form class="p-5">
            <fieldset>
                <div class="row">
                    <div class="col-4">
                        <b>Room Name</b>
                        <input type="text" class="form-control" id="roomname">
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
                        <b>Room Size</b>
                        <input type="text" class="form-control" id="rdiscount">
                    </div>
                    <div class="col">
                        <b>Base Price</b>
                        <input type="text" class="form-control" id="servrate">
                    </div>



                </div>


                <div class="row my-4">
                    <div class="col">
                        <b>Beds</b>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kingbedrad">
                            <label class="form-check-label" for="kingbedrad">
                                King Bed
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="queenbedrad">
                            <label class="form-check-label" for="queenbedrad">
                                Queen Bed
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="doublequeenrad">
                            <label class="form-check-label" for="doublequeenrad">
                                Double Queen Bed
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row my-4">

                    <div class="col-2">
                        <b>Amenity Code</b>
                        <input type="text" class="form-control" id="amenitycode">

                    </div>
                    <div class="col-2">
                        <b>Number of Rooms</b>
                        <input type="text" class="form-control" id="numroominput">

                    </div>

                </div>
                <div class="row my-2">

                    <div class="col">
                        <b>Room Image 1</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
                        <b>Room Image 2</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
                        <b>Room Image 3</b>
                        <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
                    </div>

                </div>


                <button type="submit" class="btn btn-dark mt-2">Update</button>
            </fieldset>
        </form>

    </div>

</div>

@endsection
