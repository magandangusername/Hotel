@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Manage Room </h2>
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

                            <td>{{$room->room_name}}</td>
                            <td>{{$room->room_long_description}}</td>
                            <td>{{$room->room_short_description}}</td>
                            <td>{{$room->room_size}} SQM</td>
                            <td>PHP {{number_format($room->base_price, 2)}}</td>
                            @php
                                $k = 'K';
                                $q = 'Q';
                                $kq = 'King Bed';
                                $beds = '';
                                if (preg_match("/{$k}/i", $room->bed_type)) {
                                    $beds = $beds . 'King Bed';
                                }

                                if (preg_match("/{$q}/i", $room->bed_type)) {
                                    if (preg_match("/{$kq}/i", $beds)) {
                                        $beds = $beds . ', ';
                                    }
                                    $beds = $beds . 'Queen Bed';
                                }
                            @endphp
                            <td>{{$beds}}</td>
                            @php
                                $photos = DB::table('gallery_photos')
                                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                                ->where('room_descriptions.room_name', $room->room_name)
                                ->limit(3)
                                ->get();
                                // dd($photos);
                            @endphp
                            <td>
                                <image src="{{asset('images/'.$photos[0]->photo_name)}}" alt="No Image" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="{{asset('images/'.$photos[1]->photo_name)}}" alt="No Image" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="{{asset('images/'.$photos[2]->photo_name)}}" alt="No Image" width="100" height="100"></image>
                            </td>
                            <td>
                                {{$room->amenities_number}}
                                {{-- @if ($room->a1 != null || $room->a1 != "")
                                    <p> *{{$room->a1}}</p>
                                @endif
                                @if ($room->a2 != null || $room->a2 != "")
                                    <p> *{{$room->a2}}</p>
                                @endif
                                @if ($room->a3 != null || $room->a3 != "")
                                    <p> *{{$room->a3}}</p>
                                @endif
                                @if ($room->a4 != null || $room->a4 != "")
                                    <p> *{{$room->a4}}</p>
                                @endif
                                @if ($room->a5 != null || $room->a5 != "")
                                    <p> *{{$room->a5}}</p>
                                @endif
                                @if ($room->a6 != null || $room->a6 != "")
                                    <p> *{{$room->a6}}</p>
                                @endif
                                @if ($room->a7 != null || $room->a7 != "")
                                    <p> *{{$room->a7}}</p>
                                @endif
                                @if ($room->a8 != null || $room->a8 != "")
                                    <p> *{{$room->a8}}</p>
                                @endif
                                @if ($room->a9 != null || $room->a9 != "")
                                    <p> *{{$room->a9}}</p>
                                @endif
                                @if ($room->a10 != null || $room->a10 != "")
                                    <p> *{{$room->a10}}</p>
                                @endif --}}


                            </td>
                            <td>
                                <form action="/admin/addroom" method="post">
                                    @csrf
                                    <input type="text" name="deleteroom" value="{{$room->room_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="/admin/addroom" method="post">
                                    @csrf
                                    <input type="text" name="editroom" value="{{$room->room_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
            <form action="{{route('admineditroom')}}" method="post">
                @csrf
                <input type="text" name="addroom" value="addroom" hidden>
                <button type="submit" class="btn btn-dark">Add New Room</button>
            </form>
        </div>


    </div>

    <div class="card my-5">
        @if (isset($edit))
            <form class="p-5" action="/admin/addroom" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <b>Room Name</b>
                            <input type="text" class="form-control" id="roomname" name="room_name" value="{{$editroom->room_name }}">
                        </div>

                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="room_long_description" >{{$editroom->room_long_description}}</textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="room_short_description" >{{$editroom->room_short_description}}</textarea>
                        </div>
                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Size</b>
                            <input type="text" class="form-control" id="rdiscount" name="room_size" value="{{$editroom->room_size}}">
                        </div>
                        <div class="col">
                            <b>Base Price</b>
                            <input type="text" class="form-control" id="servrate" name="base_price" value="{{$editroom->base_price}}">
                        </div>



                    </div>


                    <div class="row my-4">
                        <div class="col">
                            <b>Beds</b>
                            <div class="form-check">

                                <!-- <input class="form-check-input" type="number" value="K" id="kingbedrad" name="beds[]" @php
                                    $k = 'K';
                                    $q = 'Q';
                                    if (preg_match("/{$k}/i", $editroom->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp> -->
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed
                                </label>
                            </div>
                            <div class="form-check">

                                <!-- <input class="form-check-input" type="number" value="Q" id="queenbedrad" name="beds[]" @php
                                    if (preg_match("/{$q}/i", $editroom->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp> -->
                                <label class="form-check-label" for="queenbedrad">
                                    Queen Bed
                                </label>
                            </div>


                        </div>
                    </div>
                    <div class="row my-4">

                        <div class="col-2">
                            <b>Amenity Code</b>
                            {{-- something feels wrong here --}}
                            <select name="amenities_number">
                                @foreach ($amenities as $amenity)
                                    <option value="{{$amenity->amenities_number}}" @php
                                        if($editroom->amenities_number === $amenity->amenities_number) {
                                            echo 'selected';
                                        }
                                    @endphp>{{$amenity->amenities_number}}</option>
                                @endforeach
                            </select>



                        </div>

                        {{-- i dont think this is neccessary since we can manually add a room for a specific type anytime --}}
                        {{-- <div class="col-2">
                            <b>Number of Rooms</b>
                            <input type="text" class="form-control" id="numroominput">

                        </div> --}}

                    </div>
                    <div class="row my-2">

                        <div class="col">
                            <b>Room Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Room Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg">
                            <b>Room Image 3</b>
                            <input type="file" name="image3" accept="image/png, image/gif, image/jpeg" />
                        </div>

                    </div>

                    <input type="text" name="submitedit" value="{{$editroom->room_name}}" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        @elseif(isset($add))

            <form class="p-5" action="/admin/addroom" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <b>Room Name</b>
                            <input type="text" class="form-control" id="roomname" name="room_name" >
                        </div>

                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="room_long_description" ></textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="room_short_description" ></textarea>
                        </div>
                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Size</b>
                            <input type="text" class="form-control" id="rdiscount" name="room_size" >
                        </div>
                        <div class="col">
                            <b>Base Price</b>
                            <input type="text" class="form-control" id="servrate" name="base_price" >
                        </div>



                    </div>


                    <div class="row my-4">
                        <div class="col">
                            <b>Beds</b>
                            <div class="form-check mt-3">
                                <div class="col-1">
                                <input type="text" class="form-control" id="kingbedcount" name="room_size" >
                                </div>
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed Room
                                </label>

                            </div>
                            <div class="form-check">
                                <div class="col-1">
                                <input type="text" class="form-control" id="queenbedcount" name="room_size" >
                                </div>

                                <label class="form-check-label" for="queenbedrad">
                                    Queen Bed
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">

                        <div class="col-2">
                            <b>Amenity Code</b>
                            {{-- something feels wrong here --}}
                            <select name="amenities_number">
                                @foreach ($amenities as $amenity)
                                    <option value="{{$amenity->amenities_number}}" >{{$amenity->amenities_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row my-2">

                        <div class="col">
                            <b>Room Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Room Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg">
                            <b>Room Image 3</b>
                            <input type="file" name="image3" accept="image/png, image/gif, image/jpeg" />
                        </div>

                    </div>

                    <input type="text" name="submitadd" value="submitadd" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Add Room</button>
                </fieldset>
            </form>

        @endif



    </div>

</div>

@endsection
