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
                        <th>Suite Size</th>
                        <th>Base Price</th>
                        <th>Beds</th>
                        <th>Suite Image 1</th>
                        <th>Suite Image 2</th>
                        <th>Suite Image 3</th>
                        <th>Amenities Set</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($suites as $suite)


                        <tr>

                            <td>{{$suite->suite_name}}</td>
                            <td>{{$suite->suite_long_description}}</td>
                            <td>{{$suite->suite_short_description}}</td>
                            <td>{{$suite->suite_size}} SQM</td>
                            <td>PHP {{number_format($suite->base_price, 2)}}</td>
                            @php
                                $k = 'K';
                                $q = 'Q';
                                $kq = 'King Bed';
                                $beds = '';
                                if (preg_match("/{$k}/i", $suite->bed_type)) {
                                    $beds = $beds . 'King Bed';
                                }

                                if (preg_match("/{$q}/i", $suite->bed_type)) {
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
                                ->where('suite_descriptions.suite_name', $suite->suite_name)
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
                                {{$suite->amenities_number}}
                                {{-- @if ($suite->a1 != null || $suite->a1 != "")
                                    <p> *{{$suite->a1}}</p>
                                @endif
                                @if ($suite->a2 != null || $suite->a2 != "")
                                    <p> *{{$suite->a2}}</p>
                                @endif
                                @if ($suite->a3 != null || $suite->a3 != "")
                                    <p> *{{$suite->a3}}</p>
                                @endif
                                @if ($suite->a4 != null || $suite->a4 != "")
                                    <p> *{{$suite->a4}}</p>
                                @endif
                                @if ($suite->a5 != null || $suite->a5 != "")
                                    <p> *{{$suite->a5}}</p>
                                @endif
                                @if ($suite->a6 != null || $suite->a6 != "")
                                    <p> *{{$suite->a6}}</p>
                                @endif
                                @if ($suite->a7 != null || $suite->a7 != "")
                                    <p> *{{$suite->a7}}</p>
                                @endif
                                @if ($suite->a8 != null || $suite->a8 != "")
                                    <p> *{{$suite->a8}}</p>
                                @endif
                                @if ($suite->a9 != null || $suite->a9 != "")
                                    <p> *{{$suite->a9}}</p>
                                @endif
                                @if ($suite->a10 != null || $suite->a10 != "")
                                    <p> *{{$suite->a10}}</p>
                                @endif --}}


                            </td>
                            <td>
                                <form action="/admin/addsuite" method="post">
                                    @csrf
                                    <input type="text" name="deletesuite" value="{{$suite->suite_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="/admin/addsuite" method="post">
                                    @csrf
                                    <input type="text" name="editsuite" value="{{$suite->suite_name}}" hidden>
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
                            <input type="text" class="form-control" id="suitename" name="suite_name" value="{{$editsuite->suite_name }}">
                        </div>

                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="suite_long_description" >{{$editsuite->suite_long_description}}</textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="suite_short_description" >{{$editsuite->suite_short_description}}</textarea>
                        </div>
                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Suite Size</b>
                            <input type="text" class="form-control" id="rdiscount" name="suite_size" value="{{$editsuite->suite_size}}">
                        </div>
                        <div class="col">
                            <b>Base Price</b>
                            <input type="text" class="form-control" id="servrate" name="base_price" value="{{$editsuite->base_price}}">
                        </div>



                    </div>


                    <div class="row my-4">
                        <div class="col">
                            <b>Beds</b>
                            @php
                                $kingbeds = DB::table('room_statuses')
                                ->where('room_suite_name', $editsuite->suite_name)
                                ->where('room_suite_bed', 'King Bed')
                                ->count();

                                $queenbeds = DB::table('room_statuses')
                                ->where('room_suite_name', $editsuite->suite_name)
                                ->where('room_suite_bed', 'Queen Bed')
                                ->count();
                            @endphp

                            <div class="form-check mt-3">
                                <div class="col-1">
                                <input type="number" class="form-control" id="kingbedcount" name="King_bed_count" value="{{$kingbeds}}">
                                </div>
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed Suite
                                </label>

                            </div>
                            <div class="form-check">
                                <div class="col-1">
                                <input type="number" class="form-control" id="queenbedcount" name="Queen_bed_count" value="{{$queenbeds}}">
                                </div>

                                <label class="form-check-label" for="queenbedrad">
                                    Queen Bed
                                </label>
                            </div>
                            {{-- <div class="form-check">

                                <!-- <input class="form-check-input" type="number" value="K" id="kingbedrad" name="beds[]" @php
                                    $k = 'K';
                                    $q = 'Q';
                                    if (preg_match("/{$k}/i", $editsuite->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp> -->
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed
                                </label>
                            </div>
                            <div class="form-check">

                                <!-- <input class="form-check-input" type="number" value="Q" id="queenbedrad" name="beds[]" @php
                                    if (preg_match("/{$q}/i", $editsuite->bed_type)) {
                                        echo 'checked';
                                    }
                                @endphp> -->
                                <label class="form-check-label" for="queenbedrad">
                                    Queen Bed
                                </label>
                            </div> --}}


                        </div>
                    </div>
                    <div class="row my-4">

                        <div class="col-2">
                            <b>Amenity Code</b>
                            {{-- something feels wrong here --}}
                            <select name="amenities_number">
                                @foreach ($amenities as $amenity)
                                    <option value="{{$amenity->amenities_number}}" @php
                                        if($editsuite->amenities_number === $amenity->amenities_number) {
                                            echo 'selected';
                                        }
                                    @endphp>{{$amenity->amenities_number}}</option>
                                @endforeach
                            </select>


                        </div>

                        {{-- i dont think this is neccessary since we can manually add a suite for a specific type anytime --}}
                        {{-- <div class="col-2">
                            <b>Number of Suites</b>
                            <input type="text" class="form-control" id="numsuiteinput">

                        </div> --}}

                    </div>
                    <div class="row my-2">

                        <div class="col">
                            <b>Suite Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Suite Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg">
                            <b>Suite Image 3</b>
                            <input type="file" name="image3" accept="image/png, image/gif, image/jpeg" />
                        </div>

                    </div>

                    <input type="text" name="submitedit" value="{{$editsuite->suite_name}}" hidden>
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
                            <input type="text" class="form-control" id="suitename" name="suite_name" >
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
                            <b>Suite Size</b>
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
                            <div class="form-check mt-3">
                                <div class="col-1">
                                <input type="number" class="form-control" id="kingbedcount" name="King_bed_count" value=1>
                                </div>
                                <label class="form-check-label" for="kingbedrad">
                                    King Bed Suite
                                </label>

                            </div>
                            <div class="form-check">
                                <div class="col-1">
                                <input type="number" class="form-control" id="queenbedcount" name="Queen_bed_count" value=1>
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
                            <b>Suite Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Suite Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg">
                            <b>Suite Image 3</b>
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
