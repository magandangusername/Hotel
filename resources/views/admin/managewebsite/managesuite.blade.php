@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Manage Suite </h2>
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
                        <th>Suite Name</th>
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

                            <td>{{$room->suite_name}}</td>
                            <td>{{$room->suite_long_description}}</td>
                            <td>{{$room->suite_short_description}}</td>
                            <td>{{$room->suite_size}} SQM</td>
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
                                ->leftJoin('suite_descriptions', 'suite_descriptions.album_id', '=', 'gallery_albums.album_id')
                                ->where('suite_descriptions.suite_name', $room->suite_name)
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
                            </td>
                            <td>
                                <form action="{{route('admineditsuite')}}" method="post">
                                    @csrf
                                    <input type="text" name="deleteroom" value="{{$room->suite_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{route('admineditsuite')}}" method="post">
                                    @csrf
                                    <input type="text" name="editroom" value="{{$room->suite_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
            <form action="{{route('admineditsuite')}}" method="post">
                @csrf
                <input type="text" name="addsuite" value="addsuite" hidden>
                <button type="submit" class="btn btn-dark">Add New Suite</button>
            </form>
        </div>


    </div>

    <div class="card my-5">
        @if (isset($edit))
            <form class="p-5" action="/admin/addsuite" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <b>Suite Name</b>
                            <input type="text" class="form-control" id="roomname" name="suite_name" value="{{$editroom->suite_name }}">
                        </div>

                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="suite_long_description" >{{$editroom->suite_long_description}}</textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="suite_short_description" >{{$editroom->suite_short_description}}</textarea>
                        </div>
                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Size</b>
                            <input type="text" class="form-control" id="rdiscount" name="suite_size" value="{{$editroom->suite_size}}">
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
                                <input class="form-check-input" type="checkbox" value="K" id="kingbedrad" name="beds[]" @php
                                    $k = 'K';
                                    $q = 'Q';
                                    if (preg_match("/{$k}/i", $editroom->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp>
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Q" id="queenbedrad" name="beds[]" @php
                                    if (preg_match("/{$q}/i", $editroom->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp>
                                <label class="form-check-label" for="queenbedrad">
                                    Queen Bed
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">

                        <div class="col-2">
                            <b>Amenity Code</b>
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

                    <input type="text" name="submitedit" value="{{$editroom->suite_name}}" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        @elseif(isset($add))

            <form class="p-5" action="/admin/addsuite" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-4">
                            <b>Suite Name</b>
                            <input type="text" class="form-control" id="roomname" name="suite_name" >
                        </div>

                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="suite_long_description" ></textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="suite_short_description" ></textarea>
                        </div>
                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Size</b>
                            <input type="text" class="form-control" id="rdiscount" name="suite_size" >
                        </div>
                        <div class="col">
                            <b>Base Price</b>
                            <input type="text" class="form-control" id="servrate" name="base_price" >
                        </div>



                    </div>


                    <div class="row my-4">
                        <div class="col">
                            <b>Beds</b>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="K" id="kingbedrad" name="beds[]">
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Q" id="queenbedrad" name="beds[]">
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
                    <button type="submit" class="btn btn-dark mt-2">Add Suite</button>
                </fieldset>
            </form>

        @endif



    </div>

</div>

@endsection
