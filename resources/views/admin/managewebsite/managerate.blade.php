@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Manage Rates </h2>
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
                    @foreach ($rates as $rate)
                        <tr>

                            <td>{{$rate->rate_name}}</td>
                            <td>{{$rate->rate_offer1}}</td>
                            <td>{{$rate->rate_offer2}}</td>
                            <td>{{$rate->rate_offer3}}</td>
                            <td>{{$rate->base_discount*100}}%</td>
                            <td>{{$rate->service_rate*100}}%</td>
                            <td>{{$rate->city_tax*100}}%</td>
                            <td>{{$rate->vat*100}}%</td>
                            @php
                                $photos = DB::table('gallery_photos')
                                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                                ->leftJoin('rate_descriptions', 'rate_descriptions.album_id', '=', 'gallery_albums.album_id')
                                ->where('rate_descriptions.rate_name', $rate->rate_name)
                                ->limit(3)
                                ->get();
                            @endphp
                            <td>
                                <image src="{{asset('images/'.$photos[0]->photo_name)}}" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="{{asset('images/'.$photos[1]->photo_name)}}" width="100" height="100"></image>
                            </td>
                            <td>
                                <image src="{{asset('images/'.$photos[2]->photo_name)}}" width="100" height="100"></image>
                            </td>

                            <td>
                                <form action="{{route('admineditrate')}}" method="post">
                                    @csrf
                                    <input type="text" name="deleterate" value="{{$rate->rate_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{route('admineditrate')}}" method="post">
                                    @csrf
                                    <input type="text" name="editrate" value="{{$rate->rate_name}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
            <form action="{{route('admineditrate')}}" method="post">
                @csrf
                <input type="text" name="addrate" value="addrate" hidden>
                <button type="submit" class="btn btn-dark">Add New Rate</button>
            </form>


        </div>


    </div>

    <div class="card my-5">
        @if (isset($edit))
            <form class="p-5" action="{{route('admineditrate')}}" method="post" enctype="multipart/form-data">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-4">
                            <b>Rate Name</b>
                            <input type="text" class="form-control" id="promotioname" name="rate_name">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Rate Offer 1</b>
                            <input type="text" class="form-control" id="ro1" name="rate_offer1">
                        </div>
                        <div class="col">
                            <b>Rate Offer 2</b>
                            <input type="text" class="form-control" id="ro2" name="rate_offer2">
                        </div>
                        <div class="col">
                            <b>Rate Offer 3</b>
                            <input type="text" class="form-control" id="ro3" name="rate_offer3">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Discount</b>
                            <input type="text" class="form-control" id="rdiscount" name="base_discount">
                        </div>
                        <div class="col">
                            <b>Service Rate</b>
                            <input type="text" class="form-control" id="servrate" name="service_rate">
                        </div>
                        <div class="col">
                            <b>City Tax</b>
                            <input type="text" class="form-control" id="citytax" name="city_tax">
                        </div>
                        <div class="col">
                            <b>Vat</b>
                            <input type="text" class="form-control" id="vat" name="vat">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg" />
                            <b>Image 3</b>
                            <input type="file" name="image3" accept="image/png, image/gif, image/jpeg" />

                        </div>

                    </div>

                    <input type="text" name="submitedit" value="{{$editroom->suite_name}}" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Update</button>
                </fieldset>
            </form>

        @elseif (isset($add))

            <form class="p-5" action="{{route('admineditrate')}}" method="post" enctype="multipart/form-data">
                <fieldset disabled>
                    <div class="row">
                        <div class="col-4">
                            <b>Rate Name</b>
                            <input type="text" class="form-control" id="promotioname" name="rate_name">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Rate Offer 1</b>
                            <input type="text" class="form-control" id="ro1" name="rate_offer1">
                        </div>
                        <div class="col">
                            <b>Rate Offer 2</b>
                            <input type="text" class="form-control" id="ro2" name="rate_offer2">
                        </div>
                        <div class="col">
                            <b>Rate Offer 3</b>
                            <input type="text" class="form-control" id="ro3" name="rate_offer3">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Room Discount</b>
                            <input type="text" class="form-control" id="rdiscount" name="base_discount">
                        </div>
                        <div class="col">
                            <b>Service Rate</b>
                            <input type="text" class="form-control" id="servrate" name="service_rate">
                        </div>
                        <div class="col">
                            <b>City Tax</b>
                            <input type="text" class="form-control" id="citytax" name="city_tax">
                        </div>
                        <div class="col">
                            <b>Vat</b>
                            <input type="text" class="form-control" id="vat" name="vat">
                        </div>

                    </div>

                    <div class="row my-2">

                        <div class="col">
                            <b>Image 1</b>
                            <input type="file" name="image1" accept="image/png, image/gif, image/jpeg" />
                            <b>Image 2</b>
                            <input type="file" name="image2" accept="image/png, image/gif, image/jpeg" />
                            <b>Image 3</b>
                            <input type="file" name="image3" accept="image/png, image/gif, image/jpeg" />

                        </div>

                    </div>

                    <input type="text" name="submitadd" value="{{$editroom->suite_name}}" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Add Rate</button>
                </fieldset>
            </form>

        @endif


    </div>

</div>

@endsection
