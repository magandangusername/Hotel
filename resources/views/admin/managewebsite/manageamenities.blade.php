@extends('admin/adminframe')

@section('content')

    <div class="container-fluid px-4">

        <div class="card my-5">
            <div class="card-header">

                <h2>Amenities </h2>
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
                            <th>Amenities Code</th>
                            <th>Amenity 1</th>
                            <th>Amenity 2</th>
                            <th>Amenity 3</th>
                            <th>Amenity 4</th>
                            <th>Amenity 5</th>
                            <th>Amenity 6</th>
                            <th>Amenity 7</th>
                            <th>Amenity 8</th>
                            <th>Amenity 9</th>
                            <th>Amenity 10</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($amenities as $amenity)
                            <tr>
                                <td>{{ $amenity->amenities_number }}</td>
                                <td>{{ $amenity->a1 }}</td>
                                <td>{{ $amenity->a2 }}</td>
                                <td>{{ $amenity->a3 }}</td>
                                <td>{{ $amenity->a4 }}</td>
                                <td>{{ $amenity->a5 }}</td>
                                <td>{{ $amenity->a6 }}</td>
                                <td>{{ $amenity->a7 }}</td>
                                <td>{{ $amenity->a8 }}</td>
                                <td>{{ $amenity->a9 }}</td>
                                <td>{{ $amenity->a10 }}</td>


                                <td>
                                    <form action="{{ route('admineditamenity') }}" method="post">
                                        @csrf
                                        <input type="text" name="deleteamenity" value="{{ $amenity->amenities_number }}"
                                            hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="{{ route('admineditamenity') }}" method="post">
                                        @csrf
                                        <input type="text" name="editamenity" value="{{ $amenity->amenities_number }}"
                                            hidden>
                                        <button class="btn btn-outline-dark" type="submit"><i
                                                class="fas fa-pen"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <form action="{{ route('admineditamenity') }}" method="post">
                    @csrf
                    <input type="text" name="addamenity" value="addamenity" hidden>
                    <button type="submit" class="btn btn-dark">Add New Amenity</button>
                </form>

            </div>

        </div>


        <div class="card my-5 ">
            <div class="card-body">

                @if (isset($edit))
                    <form class="p-5" method="POST">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-2">
                                    <input type="text" class="form-control my-1" id="amenity1" value="{{$editamenity->amenities_number}}" placeholder="Amenity 1"
                                        disabled>
                                    <label for="inputreservationumber"><b>Amenities</b></label>
                                    <input type="text" name="a1" class="form-control my-1" id="amenity1" value="{{$editamenity->a1}}"
                                        placeholder="Amenity 1">
                                    <input type="text" name="a2" class="form-control my-1" id="amenity2" value="{{$editamenity->a2}}"
                                        placeholder="Amenity 2">
                                    <input type="text" name="a3" class="form-control my-1" id="amenity3" value="{{$editamenity->a3}}"
                                        placeholder="Amenity 3">
                                    <input type="text" name="a4" class="form-control my-1" id="amenity4" value="{{$editamenity->a4}}"
                                        placeholder="Amenity 4">
                                    <input type="text" name="a5" class="form-control my-1" id="amenity5" value="{{$editamenity->a5}}"
                                        placeholder="Amenity 5">
                                    <input type="text" name="a6" class="form-control my-1" id="amenity6" value="{{$editamenity->a6}}"
                                        placeholder="Amenity 6">
                                    <input type="text" name="a7" class="form-control my-1" id="amenity7" value="{{$editamenity->a7}}"
                                        placeholder="Amenity 7">
                                    <input type="text" name="a8" class="form-control my-1" id="amenity8" value="{{$editamenity->a8}}"
                                        placeholder="Amenity 8">
                                    <input type="text" name="a9" class="form-control my-1" id="amenity9" value="{{$editamenity->a9}}"
                                        placeholder="Amenity 9">
                                    <input type="text" name="a10" class="form-control my-1" id="amenity10" value="{{$editamenity->a10}}"
                                        placeholder="Amenity 10">
                                </div>
                            </div>
                            <input type="text" name="submitedit" value="{{$editamenity->amenities_number}}" hidden>
                            <button type="submit" class="btn btn-dark mt-2">Update</button>
                        </fieldset>
                    </form>

                @elseif (isset($add))
                    <form class="p-5" method="POST">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-2">
                                    @php
                                        $totalamenities = DB::table('amenities')
                                        ->count();

                                        $amenityid = 'DA-'.$totalamenities;


                                        while(true){
                                            $checkamenityid = DB::table('amenities')
                                            ->where('amenities_number', $amenityid)
                                            ->count();
                                            if($checkamenityid != 0){
                                                $totalamenities++;
                                                $amenityid = 'DA-'.$totalamenities;
                                            } else {
                                                $amenityid = 'DA-'.$totalamenities;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <input type="text" class="form-control my-1" id="amenity1" value="{{$amenityid}}" placeholder="Amenity 1"
                                        disabled>
                                    <label for="inputreservationumber"><b>Amenities</b></label>
                                    <input type="text" name="a1" class="form-control my-1" id="amenity1"
                                        placeholder="Amenity 1">
                                    <input type="text" name="a2" class="form-control my-1" id="amenity2"
                                        placeholder="Amenity 2">
                                    <input type="text" name="a3" class="form-control my-1" id="amenity3"
                                        placeholder="Amenity 3">
                                    <input type="text" name="a4" class="form-control my-1" id="amenity4"
                                        placeholder="Amenity 4">
                                    <input type="text" name="a5" class="form-control my-1" id="amenity5"
                                        placeholder="Amenity 5">
                                    <input type="text" name="a6" class="form-control my-1" id="amenity6"
                                        placeholder="Amenity 6">
                                    <input type="text" name="a7" class="form-control my-1" id="amenity7"
                                        placeholder="Amenity 7">
                                    <input type="text" name="a8" class="form-control my-1" id="amenity8"
                                        placeholder="Amenity 8">
                                    <input type="text" name="a9" class="form-control my-1" id="amenity9"
                                        placeholder="Amenity 9">
                                    <input type="text" name="a10" class="form-control my-1" id="amenity10"
                                        placeholder="Amenity 10">
                                </div>
                            </div>
                            <input type="text" name="submitadd" value="submitadd" hidden>
                            <button type="submit" class="btn btn-dark mt-2">Add Amenity</button>
                        </fieldset>
                    </form>

                @endif


            </div>
        </div>

    </div>

@endsection
