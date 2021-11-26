@extends('admin/adminframe')

@section('content')

<div class="container-fluid px-4">

    <div class="card my-5">
        <div class="card-header">

            <h2>Promotion Resources</h2>
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
                        <th>Promotion Name</th>
                        <th>Promotion Code</th>
                        <th>Long Description</th>
                        <th>Short Description</th>
                        <th>Promotion Discount</th>
                        <th>Promotion Start</th>
                        <th>Promotion End</th>
                        <th>Promotion Image</th>
                        <th>T&C1</th>
                        <th>T&C2</th>
                        <th>T&C3</th>
                        <th></th>


                    </tr>
                </thead>

                <tbody>
                    @foreach ($promotions as $promotion)
                        <tr>

                            <td>{{$promotion->promotion_name}}</td>
                            <td>{{$promotion->promotion_code}}</td>
                            <td>{{$promotion->promotion_long_description}}</td>
                            <td>{{$promotion->promotion_short_description}}</td>
                            <td>{{$promotion->overall_cut * 100}}%</td>
                            <td>{{date('m/d/Y', strtotime($promotion->promotion_start))}}</td>
                            <td>{{date('m/d/Y', strtotime($promotion->promotion_end))}}</td>
                            <td>
                                <image src="{{asset('images/'.$promotion->image_name)}}" width="100" height="100"></image>
                            </td>
                            <td>
                                <form action="{{route('adminpromotion')}}" method="post">
                                    @csrf
                                    <input type="text" name="deletepromo" value="{{$promotion->promotion_code}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{route('adminpromotion')}}" method="post">
                                    @csrf
                                    <input type="text" name="editpromo" value="{{$promotion->promotion_code}}" hidden>
                                    <button class="btn btn-outline-dark" type="submit"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach


                </tbody>

            </table>
            <form action="{{route('adminpromotion')}}" method="post">
                @csrf
                <input type="text" name="addpromo" value="addpromo" hidden>
                <button type="submit" class="btn btn-dark">Add New Promotion</button>
            </form>

        </div>


    </div>


    <div class="card my-5">
        @if (isset($edit))
            <form action="{{route('adminpromotion')}}" class="p-5" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col">
                            <b>Promotion Name</b>
                            <input type="text" class="form-control" id="promotioname" name="promotion_name" value="{{$editpromo->promotion_name}}">
                        </div>
                        <div class="col">
                            <b>Promotion Code</b>
                            <input type="text" class="form-control" id="promotioncode" name="promotion_code" value="{{$editpromo->promotion_code}}">
                        </div>
                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="promotion_long_description">{{$editpromo->promotion_long_description}}</textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="promotion_short_description">{{$editpromo->promotion_short_description}}</textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col">
                            <label for="promotioncode"><b>Promotion Discount</b></label>
                            <input type="number" class="form-control" name="overall_cut" id="discount" placeholder="3%" value="{{$editpromo->overall_cut * 100}}">%
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col">
                            <label for="promotioncode"><b>Promotion Start</b></label>
                            <input type="date" class="form-control" id="arrivalinput" name="promotion_start" value="{{date("Y-m-d", strtotime($editpromo->promotion_start))}}">
                        </div>
                        <div class="col">
                            <label for="promotioncode"><b>Promotion End</b></label>
                            <input type="date" class="form-control" id="arrivalinput" name="promotion_end" value="{{date("Y-m-d", strtotime($editpromo->promotion_end))}}">
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col">
                            <b>Promotion Image</b>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            <input type="file" id="imgInp" name="image_name" accept="image/png, image/gif, image/jpeg">
                                        </span>
                                    </span>
                                </div>
                                <img id='img-upload' />
                            </div>
                        </div>

                    </div>
                    <input type="text" name="submitedit" value="{{$editpromo->promotion_code}}" hidden>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </fieldset>
            </form>

        @elseif (isset($add))
            <form action="{{route('adminpromotion')}}" class="p-5" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-2">
                            <b>Promotion Name</b>
                            <input type="text" class="form-control" id="promotioname" name="promotion_name">
                        </div>
                        <div class="col-2">
                            <b>Promotion Code</b>
                            <input type="text" class="form-control" id="promotioncode" name="promotion_code">
                        </div>
                    </div>

                    <div class="row my-2">
                        <b>Detailed Description</b>

                        <div class="col">
                            <textarea rows="4" cols="80" name="promotion_long_description"></textarea>
                        </div>

                        <b>Short Description</b>

                        <div class="col">
                            <textarea rows="4" cols="60" name="promotion_short_description"></textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-1">
                            <label for="promotioncode"><b>Promotion Discount</b></label>
                            <input type="number" class="form-control" name="overall_cut" id="discount" placeholder="3%">%
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-2">
                            <label for="promotioncode"><b>Promotion Start</b></label>
                            <input type="date" class="form-control" id="arrivalinput" name="promotion_start" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-2">
                            <label for="promotioncode"><b>Promotion End</b></label>
                            <input type="date" class="form-control" id="arrivalinput" name="promotion_end" value="{{date('Y-m-d')}}">
                        </div>
                    </div>


                    <div class="row my-2">
                        <div class="col-2">
                           <b>T&C1</b>
                            <textarea rows="4" cols="80" name="termsandcondition1"></textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-2">
                           <b>T&C2</b>
                            <textarea rows="4" cols="80" name="termsandcondition2"></textarea>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-2">
                           <b>T&C3</b>
                            <textarea rows="4" cols="80" name="termsandcondition3"></textarea>
                        </div>
                    </div>


                    <div class="row my-2">
                        <div class="col">
                            <b>Promotion Image</b>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            <input type="file" id="imgInp" name="image_name" accept="image/png, image/gif, image/jpeg">
                                        </span>
                                    </span>
                                </div>
                                <img id='img-upload' />
                            </div>
                        </div>

                    </div>
                    <input type="text" name="submitadd" value="submitadd" hidden>
                    <button type="submit" class="btn btn-dark mt-2">Add promo</button>
                </fieldset>
            </form>

        @endif


    </div>

</div>

@endsection
